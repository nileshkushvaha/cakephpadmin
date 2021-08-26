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
 * MyProfile Controller
 *
 * @property \App\Model\Table\MyProfileTable $MyProfile
 */

class MyProfileController extends AppController
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
	 
	public function index()
  {
    $userId = $this->Auth->user('id');
    $this->loadModel('UserProfiles');
    $this->loadModel('Users');
    $profileData = $this->UserProfiles->find()->where(['user_id'=>$userId])->first();
    if (empty($profileData)) {
      $profile = $this->UserProfiles->newEntity();
    } else {
      $profile = $this->UserProfiles->get($profileData->id);
    }
    $user = $this->Users->get($userId);
    if ($this->request->is(['patch', 'post', 'put'])) {
      $data = $this->request->getData();
      $data = $this->Sanitize->clean($data);
      // pr($data); die;
      $user->name = $data['first_name'];
      $this->Users->save($user);

      $profile->first_name = $data['first_name'];
      $profile = $this->UserProfiles->patchEntity($profile, $data);
      $profile->user_id = $userId;
      $profile->date_of_birth = date('Y-m-d',strtotime($data['date_of_birth']));
      if ($this->UserProfiles->save($profile)) {
        $this->Flash->success(__('Profile has been updated successfully.'));
        return $this->redirect(['action' => 'index']);
      } else {
        pr($profile->errors());die;
      }
      $this->Flash->error(__('Profile could not be updated. Please, try again.'));
    }
    $this->set(compact('profile','user'));
	}

}