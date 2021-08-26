<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Core\Configure;
use Cake\Event\Event;
use Cake\Network\Exception\NotFoundException;
use Cake\View\Exception\MissingTemplateException;
use Cake\Utility\Text;
use Cake\Mailer\Email;
use Cake\I18n\Time;
use Cake\Routing\Router;
use Cake\Chronos\Chronos;

/**
 * Home Controller
 *
 */

class HomeController extends AppController
{
	public function initialize()
    {
        parent::initialize();
        $this->viewBuilder()->setLayout('home');
        $this->Auth->allow(['index', 'subscribe','mainSearch','unsubscribe','confirmSubscription','homeSearch','getSuggestiveSearch','message','jobs','jobsDescription']);
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
    public function index()
    {
        $this->loadModel('Banners');
        $this->loadModel('Articles');
		$this->loadModel('Teams');
		
        $bannerData = $this->Banners->find('all',['conditions'=>['status'=>1,'banner_category_id'=>1]])->first();

        $select = [
                'id',
                'title'   => "IF(ArticleTranslation.title != '',ArticleTranslation.title,Articles.title)",
                'slug'    => "IF(ArticleTranslation.slug != '',ArticleTranslation.slug,Articles.slug)",
                'excerpt' => "IF(ArticleTranslation.excerpt != '',ArticleTranslation.excerpt,Articles.excerpt)",
                'content' => "IF(ArticleTranslation.content != '',ArticleTranslation.content,Articles.content)",
                'url'     => "IF(ArticleTranslation.url != '',ArticleTranslation.url,Articles.url)",
                'sort_order',
                'header_image',
                'created_at',
                'modified_at',
            ];

        $drivingRecruitment1 = $this->Articles->findById(8)->where(['status' => 1])->first();

        $drivingRecruitment2 = $this->Articles->findById(9)->where(['status' => 1])->first();

        $drivingRecruitment3 = $this->Articles->findById(10)->where(['status' => 1])->first();
        
        $howItWork = $this->Articles->findById(3)->where(['status' => 1])->first();
        
        $teams = $this->Teams->find('all')->where(['status'=>1])->enableHydration(false)->toArray();


        $this->set(compact('bannerData','teams','drivingRecruitment1','drivingRecruitment2','drivingRecruitment3','howItWork'));
    }

    /**
     * Subscribe method
     *
     * @return \Cake\Http\Response|void
     */

    public function subscribe() 
    {
        //$this->viewBuilder()->setLayout('ajax');
        //debug($this->request->data);exit;
        $this->loadModel('Newsletters');
        if (!empty($_POST)) {
            $valid = true;
            $category = '';
            $email    = trim($_POST['email']);
            (int) $categoryId    = trim($_POST['category_id']);
            if ($categoryId == 39) {
                $category = 2;
            } elseif (in_array($categoryId, [40,3])) {
                $category = 3;
            } elseif (in_array($categoryId, [41,4])) {
                $category = 4;
            } else {
                $category = 1;
            }
            if (empty($email)) {
                $message = "The email address field must not be blank";
                $valid = false;
            } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $message = "You must fill the field with a valid email address";
                $valid = false;
            }
            if ($valid) {
                $dataExists = $this->Newsletters->find('all',[
                    'conditions' => ['email' => $email,'category_id' => $category],
                ])->first();
                if(empty($dataExists)){
                    $newsletters = $this->Newsletters->newEntity();
                    $newsletters->email  = $email;
                    $newsletters->category_id  = $category;
                    $newsletters->status  = 0;
                   
                    if ($this->Newsletters->save($newsletters)) {
                        $nemail = new Email('default');
                        $nemail->template('subscribe');
                        $nemail->emailFormat('html');
                        $nemail->viewVars(['email' => $email]);
                        $nemail->viewVars(['base_url' => Router::url('/', true)]);

                        $status = $nemail->from(['info@silvermail.com' => 'SIDBI'])
                        //$status = $nemail->from(['vanjiwalesiddhant@gmail.com' => 'SIDBI'])
                            ->to($email)
                            ->subject('SIDBI : Please Confirm Subscription')
                            ->send();
                        $message = "You have been successfully subscribed.";
                    } else {
                        $message = "An error occurred, please try again";
                    }
                } else {
                    $message = "This email is already subscribed.";
                }
            }
            echo $message;
            //$data = json_encode($data);
        }
        //$this->autoRender = false;
        exit();
    }

    public function confirmSubscription($value='')
    {
        $this->viewBuilder()->setLayout('email');
        $userEmail   = !empty($this->request->getQuery('q1'))? base64_decode($this->request->getQuery('q1')) : null;
        if (!empty($userEmail)) {
            $this->loadModel('Newsletters');
            $dataExists = $this->Newsletters->find('all',['conditions' => ['email' => $userEmail]])->first();
            if (!empty($dataExists)) {
                $newsletters = $this->Newsletters->get($dataExists['id']);
            } else {
                $newsletters = $this->Newsletters->newEntity();
            }
            $data = [
                'email' => $userEmail,
                'status' => 1
            ];
            $newsletters->email = $userEmail;
            $newsletters->status = 1;
            $newsletters = $this->Newsletters->patchEntity($newsletters, $data);
            if ($this->Newsletters->save($newsletters)) {
                $this->Flash->success(__('Your subscription has been confirmed.'));
            }
        }
    }

    /**
     * Unsubscribe method
     *
     * @return \Cake\Http\Response|void
     */

    public function unsubscribe() 
    {
        $this->viewBuilder()->setLayout('email');
        $this->loadModel('Newsletters');
        if (!empty($_POST)) {
            $valid = true;
            $email    = trim($_POST['email']);
            $reason   = trim($_POST['reason']);
            if (empty($email)) {
                $message = "The email address field must not be blank";
                $valid = false;
            } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $message = "You must fill the field with a valid email address";
                $valid = false;
            }
            if (empty($reason)) {
                $message = "The reason field must not be blank";
                $valid = false;
            }
            if ($valid) {
                $dataExists = $this->Newsletters->find('all',[
                    'conditions' => ['email' => $email],
                    ])->first();

                if(!empty($dataExists)){
                    $newsletters = $this->Newsletters->newEntity();
                    $newsletters->id              = $dataExists->id;
                    $newsletters->is_unsubscribe  = 1;
                    $newsletters->reason          = $reason;
                    if ($this->Newsletters->save($newsletters)) {                        
                        $message = "You have been successfully unsubscribed.";
                    } else {
                        $message = "An error occurred, please try again";
                    }
                } else {
                    $message = "This email does not exit.";
                }
            }
            $this->Flash->success($message);
            return $this->redirect(['action' => 'message']);
        }        
    }


    /**
     * Search method
     *
     * @return \Cake\Http\Response|void
     */

    public function mainSearch()
    {
    }

    public function homeSearch()
    {
    }
    
    public function getSuggestiveSearch()
    {
    }

    public function message(){ 
        $this->viewBuilder()->setLayout('email');
    }
	public function jobs(){
		
	}
	public function jobsDescription(){
		
	}
}
