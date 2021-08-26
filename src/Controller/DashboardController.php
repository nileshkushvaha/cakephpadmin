<?php
namespace App\Controller;

use App\View\Helper\SilverFormHelper;
use Cake\Controller\Controller;
use Cake\Event\Event;
use Cake\Mailer\Email;
use Cake\ORM\TableRegistry;
use Cake\Utility\Text;
use Cake\View\View;
use Cake\Core\Configure;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 */
class DashboardController extends AppController
{
  public function initialize()
  {
    parent::initialize();
    
    //$this->Auth->allow(['index']);
    $this->viewBuilder()->setLayout('home');
  }

  public function beforeFilter(Event $event)
  {
    parent::beforeFilter($event);
  }
	 
	public function index(){
    $this->loadModel('Users');
    $userId = $this->Auth->user('id');

   
    $this->set(compact('userId'));
	}

  public function myProfile()
  {

  }


}