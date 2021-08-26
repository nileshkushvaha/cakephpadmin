<?php
namespace App\Controller\Admin;

use App\Controller\Admin\AppController;
use Cake\Event\Event;

/**
 * Teams Controller
 *
 * @property \App\Model\Table\TeamsTable $Teams
 *
 * @method \App\Model\Entity\Team[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class TeamsController extends AppController
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
        $this->paginate = [
            'contain' => ['Users']
        ];
        $teams = $this->paginate($this->Teams);

        $this->set(compact('teams'));
    }

    /**
     * View method
     *
     * @param string|null $id Team id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $team = $this->Teams->get($id, [
            'contain' => ['Users']
        ]);

        $this->set('team', $team);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $team = $this->Teams->newEntity();
        if ($this->request->is('post')) {
            $data = $this->request->getData();
            $team = $this->Teams->patchEntity($team, $data);
            if ($data['profile_photo']) {
                if($data['profile_photo']['name']!=''){
                    $teamImage = $this->uploadFiles('teams', $data['profile_photo']);
                    $team->profile_photo = $teamImage['filename'];
                }
            } else {
                $team->profile_photo = null;
            }            
            $team->created = date('Y-m-d H:i:s');
            $team->updated = date('Y-m-d H:i:s');
            if ($this->Teams->save($team)) {
                $this->Flash->success(__('The team has been saved.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The team could not be saved. Please, try again.'));
        }
        $users = $this->Teams->Users->find('list', ['limit' => 200]);
        $this->set(compact('team', 'users'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Team id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $team = $this->Teams->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $data = $this->request->getData();
            $team = $this->Teams->patchEntity($team, $data);
            if ($data['profile_photo']) {
                if($data['profile_photo']['name']!=''){
                    $teamImage = $this->uploadFiles('teams', $data['profile_photo']);
                    $team->profile_photo = $teamImage['filename'];
                } else {
                    $team->profile_photo = $data['old_profile_photo'];
                }
            } else {
                $team->profile_photo = $data['old_profile_photo'];
            }
            if ($this->Teams->save($team)) {
                $this->Flash->success(__('The team has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The team could not be saved. Please, try again.'));
        }
        $users = $this->Teams->Users->find('list', ['limit' => 200]);
        $this->set(compact('team', 'users'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Team id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $team = $this->Teams->get($id);
        if ($this->Teams->delete($team)) {
            $this->Flash->success(__('The team has been deleted.'));
        } else {
            $this->Flash->error(__('The team could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
