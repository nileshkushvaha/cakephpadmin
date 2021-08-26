<?php
namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\Event;
use Cake\Mailer\Email;
use Cake\Utility\Text;
use Cake\View\View;
use Cake\Core\Configure;

/**
 * ContactUs Controller
 *
 * @property \App\Model\Table\ContactUsTable $ContactUs
 */
class ContactUsController extends AppController
{
  public function initialize()
  {
    parent::initialize();
    
    $this->Auth->allow(['index']);
    $this->viewBuilder()->setLayout('home');
  }

  public function beforeFilter(Event $event)
  {
    parent::beforeFilter($event);
  }

  public function index(){
    $this->loadModel('Users');
    $contact = $this->ContactUs->newEntity();
    if ($this->request->is('post')) {
      $data = $this->request->getData();
      $contact = $this->ContactUs->patchEntity($contact,$data);
      if ($this->ContactUs->save($contact)) {
        $this->Flash->success(__('The contact has been saved.'));
        return $this->redirect(['action' => 'index']);
      }
      $this->Flash->error(__('The contact could not be saved. Please, try again.'));
    }
    $this->set(compact('contact'));
	}
  
}