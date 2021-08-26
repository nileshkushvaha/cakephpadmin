<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Core\Configure;
use Cake\Event\Event;
use Cake\Network\Exception\NotFoundException;
use Cake\View\Exception\MissingTemplateException;
use Cake\Routing\Router;

/**
 * Articles Controller
 *
 * @property \App\Model\Table\ArticlesTable $Articles
 *
 * @method \App\Model\Entity\Article[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ArticlesController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        $this->viewBuilder()->setLayout('home');
        $this->Auth->allow(['home', 'page','getDetails','getSuggestiveSearch','getStates']);
    }

    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
    }

    /**
     * Page method
     *
     * @return \Cake\Http\Response|void
     */
    public function page($article_id)
    {
        if($this->isDevice) {
            $this->request->allowMethod(['get']);            
            $_status = false;
            $_message = '';
            
            $language = 'en';
            if(!empty($this->request->params) && !empty($this->request->params['language'])){
                $language = $this->request->params['language'];
            }
        }
        $select = [
                'id',
                'title'   => "IF(ArticleTranslation.title != '',ArticleTranslation.title,Articles.title)",
                'slug'    => "IF(ArticleTranslation.slug != '',ArticleTranslation.slug,Articles.slug)",
                'excerpt' => "IF(ArticleTranslation.excerpt != '',ArticleTranslation.excerpt,Articles.excerpt)",
                'content' => "IF(ArticleTranslation.content != '',ArticleTranslation.content,Articles.content)",
                'url'     => "IF(ArticleTranslation.url != '',ArticleTranslation.url,Articles.url)",
                'sort_order','header_image','created_at','modified_at','meta_title','meta_keywords','meta_description',
            ];
        
        $article = $this->Articles->findById($article_id)
            ->select($select)
            ->contain([
                'ArticleTranslation' => function ($q) {
                    if (Configure::check('language')) {
                        $q->where(['ArticleTranslation.culture' => Configure::read('language.culture')]);
                    } else {
                        $q->where(['ArticleTranslation.language_id' => 0]);
                    }
                    return $q;
                },'ArticleImages','ArticleLinks'
            ])
            ->where(['status' => 1])->first();
        if (empty($article)) {
            if($this->isDevice) {
                $_message = 'Article not found';
            }else{
                throw new NotFoundException(__('Article not found'));
            }
        }
        
        if($this->isDevice) {
            $_status = true;
            $_message = 'Article found';            
            $content = $article->content;            
            $this->set(compact('_status','_message','language','content'));
            $this->set('_serialize', ['_status','_message','language','content']);
        }
        
        $_template = 'page_' . $article->id;
        
        if (!empty($article->slug)) {
            $_template = 'page_' . $article->slug;
        }
        //echo  $_template;
        $this->loadModel('Teams');
        $teams = $this->Teams->find('all')->where(['status'=>1])->enableHydration(false)->toArray();
        if(!$this->isDevice) {
            $this->set(compact('article','teams'));
        }
        try {
            $this->render($_template);
        } catch (MissingTemplateException $e) {
            $this->render('page');
        }
    }

    public function getSuggestiveSearch()
    {
        $this->loadModel('BranchOffices');
        if ($this->request->is('ajax')) {
            $this->autoRender = false;
            $name = $this->request->query['term'];
            $branches = $this->BranchOffices->find('all', [
                'conditions' => [ 'OR' =>[
                    'BranchOffices.branch_name LIKE' =>'%'. $name . '%',
                    'BranchOffices.location LIKE' =>'%'. $name . '%',
                ]],
                'contain'=>['States']
            ])->distinct('States.name')->toArray();
            $resultsArr = [];
            foreach ($branches as $branch) {
                $resultsArr[] =['title' => $branch['state_id'], 'value' => $branch['state']['name']];
            }
            echo json_encode($resultsArr);
        }
    }

    public function getStates(){
        $this->viewBuilder()->layout('ajax');
        $this->loadModel('BranchOffices');
        $data = $this->BranchOffices->find('all',[
            'contain'=>['States'],
            'fields'=>['BranchOffices.state_id'],
            'conditions'=>['States.name'=>$_REQUEST['branch']],
        ])->first();
        echo json_encode($data);
    }
}
