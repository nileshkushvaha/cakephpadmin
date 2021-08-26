<?php
namespace App\Controller\Admin;

use App\Controller\Admin\AppController;
use Cake\Event\Event;

/**
 * Dashboard Controller
 *
 * @property \App\Model\Table\DashboardTable $Dashboard
 *
 * @method \App\Model\Entity\Article[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class DashboardController extends AppController
{
	
    public function initialize()
    {
        parent::initialize();
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
        $this->loadModel('Users');
        
        $userId = $this->Auth->user('id');

        $totalDriver=$this->Users->find()->where(['role_id'=>6])->contain(['UserProfiles'])->count();
        $totalClient=$this->Users->find()->where(['role_id'=>5])->contain(['UserProfiles'])->count();
        
        $this->set(compact('totalDriver','totalClient'));
    }

    public function contactUs()
    {
        $this->loadModel('ContactUs');
        $search_condition = array();
        if (!empty($this->request->getQuery('name'))) {
            $name = trim($this->request->getQuery('name'));
            $this->set('name', $name);
            $search_condition[] = "ContactUs.name like '%" . $name . "%'";
        }
        if (!empty($this->request->getQuery('email'))) {
            $email = trim($this->request->getQuery('email'));
            $this->set('email', $email);
            $search_condition[] = "ContactUs.email like '%" . $email . "%'";
        }
        if (!empty($this->request->getQuery('phone'))) {
            $phone = trim($this->request->getQuery('phone'));
            $this->set('phone', $phone);
            $search_condition[] = "ContactUs.phone like '%" . $phone . "%'";
        }
        if(!empty($search_condition)){
            $searchString = implode(" AND ",$search_condition);
        } else {
            $searchString = '';
        }
        $postQuery = $this->ContactUs->find('all')
            ->where([$searchString])
            ->order(['ContactUs.id'=>'desc']);

        $this->paginate = ['limit' => 10];
        $contacts = $this->paginate($postQuery);
        $this->set(compact('contacts'));

    }

}
