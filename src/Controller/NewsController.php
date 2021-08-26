<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Core\Configure;
use Cake\Event\Event;
use Cake\Network\Exception\NotFoundException;
use Cake\View\Exception\MissingTemplateException;

/**
 * News Controller
 *
 * @property \App\Model\Table\NewsTable $News
 *
 * @method \App\Model\Entity\Tender[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class NewsController extends AppController
{

    public function initialize()
    {
        parent::initialize();
        $this->viewBuilder()->setLayout('frontend');
        $this->Auth->allow(['index','page']);
        $this->loadModel('News');
    }

    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */

    public function index($value='')
    {
        $news = $this->News->find('all')->select([
                'id',
                'title'   => "IF(NewsTranslation.title != '',NewsTranslation.title,News.title)",
                'excerpt' => "IF(NewsTranslation.excerpt != '',NewsTranslation.excerpt,News.excerpt)",
                'content' => "IF(NewsTranslation.content != '',NewsTranslation.content,News.content)",
                'news_url'=> "IF(NewsTranslation.news_url != '',NewsTranslation.news_url,News.news_url)",
                'sort_order','display_date','custom_link','status','created','meta_description','meta_keywords','meta_title','header_image'
            ])->contain([
            'NewsTranslation' => function ($q) {
                if (Configure::check('language')) {
                    $q->where(['NewsTranslation.culture' => Configure::read('language.culture')]);
                } else {
                    $q->where(['NewsTranslation.language_id' => 0]);
                }
                return $q;
            }
        ])->where(['status' => 1])->order(['News.display_date'=>'DESC']);
        $this->paginate = ['limit' => 15];
        $news = $this->paginate($news);
        $this->set('news', $news);
    }

    /**
     * Page method
     *
     * @return \Cake\Http\Response|void
     */
    public function page($news_id = null)
    {
        $news = $this->News->findById($news_id)
        ->select([
            'id',
            'title'   => "IF(NewsTranslation.title != '',NewsTranslation.title,News.title)",
            'excerpt' => "IF(NewsTranslation.excerpt != '',NewsTranslation.excerpt,News.excerpt)",
            'content' => "IF(NewsTranslation.content != '',NewsTranslation.content,News.content)",
            'news_url'=> "IF(NewsTranslation.news_url != '',NewsTranslation.news_url,News.news_url)",
            'sort_order','display_date','custom_link','upload_document_1','upload_document_2','status','created','meta_description','meta_keywords','meta_title','header_image'
        ])->contain([
            'NewsTranslation' => function ($q) {
                if (Configure::check('language')) {
                    $q->where(['NewsTranslation.culture' => Configure::read('language.culture')]);
                } else {
                    $q->where(['NewsTranslation.language_id' => 0]);
                }
                return $q;
            }
        ])->where(['status' => 1])->first();
        $_template = 'page_' . $news->id;
        if (empty($news)) {
            throw new NotFoundException(__('News not found'));
        }
        $this->set('news', $news);
        try {
            $this->render($_template);
        } catch (MissingTemplateException $e) {
            $this->render('page');
        }
    }
}