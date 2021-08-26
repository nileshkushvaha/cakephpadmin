<?php
namespace App\Controller\Admin;

use App\Controller\Admin\AppController;
use Cake\Event\Event;
use Cake\Mailer\Email;
use Cake\ORM\TableRegistry;
use Cake\Error\Exceptions;
use Cake\I18n\Time;
use Cake\Routing\Router;
use Cake\Validation\Validator;
use Cake\Auth\DefaultPasswordHasher;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 *
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UsersController extends AppController
{

    public function initialize()
    {
        parent::initialize();
        //$this->loadComponent('CakephpCaptcha.Captcha');
        $this->loadComponent('Captcha', ['captchaConfig' => 'LoginCaptcha']);
        $this->Auth->allow(['jcryption', 'forgotPassword','resetPassword','captcha']);
    }

    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
    }

    /**
     * login method
     *
     * @return \Cake\Network\Response|null
     */
 
    public function login()
    {
        $this->viewBuilder()->setLayout('login');
        if ($this->request->getSession()->check('Auth.User')) {
            return $this->redirect(['controller' => 'Dashboard', 'action' => 'index']);
        }

        if ($this->request->is('post')) {
            $token = $this->request->getParam('_csrfToken');
            $jcryption = new \JCryption;
            $jcryption->decrypt();
            @$this->request->data = $_REQUEST;            
            $userdata = @$this->request->data;
            $errors = array();
            if ($this->Captcha->getCode('securitycode') != $userdata['captcha']) {
                $errors['captcha']['_empty'] = 'Invalid captcha,try again.';
            }
            $uname = $userdata['email'];
            $login_attempts_id = '';
            $previousFailedAttempt = '';
            if (empty($errors)) {

                /***   Checking for login attempts   ***/
                $attempt_status = 0;
                $cUser = $this->Users->find('all')->where(['email' => $uname])->first();
                if (!empty($cUser)) {
                    $uid = $cUser['id'];
                } else {
                    $uid = 0;
                }
                $ip = $_SERVER['REMOTE_ADDR'];

                if ($ip == '::1') {
                    $ipadd = '127.0.0.1';
                } else {
                    $ipadd = $ip;
                }
                $failed_attempts = 1;

                $login_attemptsTable = TableRegistry::get('login_attempts');
                $login_attemptsResult = $login_attemptsTable->find('all', ['conditions' => ['ipaddress' => $ipadd, 'last_attempt >' => new Time('-15 minutes')]]);
                $login_attemptsResult->enableHydration(false);
                $login_attemptsResultArr = $login_attemptsResult->toArray();

                //for deleting all records before 15 minutes
                $attempts_15minBefore = $login_attemptsTable->find('all', ['conditions' => ['ipaddress' => $ipadd, 'last_attempt <' => new Time('-15 minutes')]])->enableHydration(false)->toArray();
                
                if (!empty($attempts_15minBefore)) {
                    foreach ($attempts_15minBefore as $keyA => $valueA) {
                        $recordIdToDelete = $valueA['id'];
                        $recordEntity = $login_attemptsTable->get($recordIdToDelete);
                        $login_attemptsTable->delete($recordEntity);
                    }
                }

                if (empty($login_attemptsResultArr)) {
                    $login_attempts = $login_attemptsTable->newEntity();
                    $login_attempt_data = array(
                        'uid' => $uid,
                        'ipaddress' => $ipadd,
                        'failed_attempts' => $failed_attempts,
                    );
                    $login_attempts = $login_attemptsTable->patchEntity($login_attempts, $login_attempt_data);
                    $result = $login_attemptsTable->save($login_attempts);

                    if ($result) {
                        $attempt_status = 1;
                    } else {
                        $attempt_status = 0;
                    }
                } else {
                    $login_attempts_id = $login_attemptsResultArr[0]['id'];
                    $previousFailedAttempt = $login_attemptsResultArr[0]['failed_attempts'];
                    $login_attempts = $login_attemptsTable->get($login_attemptsResultArr[0]['id']);
                    $login_attempt_data['failed_attempts'] = $login_attempts->failed_attempts + 1;
                    $login_attempt_data['uid'] = $uid;

                    $login_attempts = $login_attemptsTable->patchEntity($login_attempts, $login_attempt_data);
                    $result = $login_attemptsTable->save($login_attempts);
                    //if($result['failed_attempts'] >= 6 && $hours==0 && $minutes<=15){
                    if ($result['failed_attempts'] >= 6) {
                        $attempt_status = 0;
                    } else {
                        $attempt_status = 1;
                    }
                }

                /***   Ends   ***/
                $auth = $this->Auth->identify();
                if ($attempt_status == 1) {
                    if ($auth) {
                        $user_id = $auth['id'];
                        // for check already login or not.
                        $adminLogsTable = TableRegistry::get('admin_logs');
                        $loggedInCheck = $adminLogsTable->find('all', [
                                'conditions' => ['uid' => $user_id]
                            ])->last();
                        if ($auth['role_id'] != '5' || $auth['role_id'] != '6') {
                            $loginAttemptsTable = TableRegistry::get('login_attempts');
                            $UserLoginExistsQ = $loginAttemptsTable->find('all', [
                                'conditions' => ['uid' => $user_id, 'last_attempt >' => new Time('-15 minutes')]
                            ]);
                            $UserLoginExists = $UserLoginExistsQ->enableHydration(false)->toArray();

                            if ($auth['status']) {
                                /* admin log code starts */
                                $ipaddress = $_SERVER['REMOTE_ADDR'];
                                if ($ipaddress == '::1') {
                                    $ipadd = '127.0.0.1';
                                } else {
                                    $ipadd = $ipaddress;
                                }
                                $uid = $auth['id'];
                                $adminLogTable = TableRegistry::get('admin_logs');
                                $adminLog = $adminLogTable->newEntity();
                                $adminLog->uid = $uid;
                                $adminLog->flag = 1;
                                $adminLog->logtime = date('Y-m-d H:i:s');
                                $adminLog->ipaddress = inet_pton($ipadd);//string inet_ntop ( string $in_addr )
                                $adminLogTable->save($adminLog);
                                /* admin log code ends */

                                $this->Auth->setUser($auth);
                                // code for updating login attempt status for already login
                                $UserLoginExistsQ = $loginAttemptsTable->find('all', [
                                    'conditions' => ['uid' => $user_id, 'last_attempt >' => new Time('-15 minutes')],
                                ]);
                                $UserLoginExists = $UserLoginExistsQ->enableHydration(false)->toArray();
                                if (!empty($UserLoginExists)) {
                                    $userLoggedInStatus = end($UserLoginExists)['login_flag'];
                                    $loginUserAttemptFlagEntity = $loginAttemptsTable->get(end($UserLoginExists)['id']);
                                    $loginUAttemptFlagData = [
                                        'login_flag' => 1,
                                    ];
                                    $loginUserAttemptFlagEntityPatch = $loginAttemptsTable->patchEntity($loginUserAttemptFlagEntity, $loginUAttemptFlagData);
                                    $loginAttemptsTable->save($loginUserAttemptFlagEntityPatch);
                                }
                                //ends here.
                                if ($login_attempts_id) {
                                    $this->set('userd', $this->Auth->user());
                                    $entity1 = $login_attemptsTable->get($login_attempts_id);
                                    $entityData = $login_attemptsTable->patchEntity($entity1, ['failed_attempts' => 0]);
                                    $login_attemptsTable->save($entityData);
                                }
                                return $this->redirect($this->Auth->redirectUrl());
                            } else {
                                $this->Flash->error(__('User is deactivated or blocked.'));
                                return $this->redirect($this->referer());
                            }
                        } else {
                            $this->Auth->logout();
                            $this->Flash->error(__('Invalid credentials for admin login.'));
                        }
                    } else {
                        $this->Flash->error(__('Invalid credentials.'));
                    }
                } else {
                    $this->Flash->error(__('You have entered wrong credentials 5 or more times, User is blocked.'));
                    return $this->redirect($this->referer());
                }
            } else {
                if(!empty($errors['captcha']['_empty'])){
                    $this->Flash->error(__($errors['captcha']['_empty']));
                } else {
                    $this->Flash->error(__('Your Captcha is expire. Please refresh the page'));
                }
            }
        }
    }

    /**
     * logout method
     *
     * @return \Cake\Network\Response|null
     */

    public function logout()
    {
        $this->Flash->success(__('You are logged out '));
        $user_id = $this->request->session()->read('Auth.User.id');

        $adminLogTable = TableRegistry::get('admin_logs');
        $loggedInUser = $adminLogTable->find('all',[
            'conditions' => ['uid'=>$user_id],
        ])->last();

        $adminLog = $adminLogTable->get($loggedInUser['id']);
        $adminLog->flag = 0;
        $adminLogTable->save($adminLog);

        $loginAttemptsTable = TableRegistry::get('login_attempts');
        $UserLoginExists = $loginAttemptsTable->find('all',[
            'conditions' => ['uid'=>$user_id,'last_attempt >'=>new Time('-15 minutes')],
        ])->enableHydration(false)->toArray();
        if(!empty($UserLoginExists)){
            $loginUserAttemptFlagEntity = $loginAttemptsTable->get(end($UserLoginExists)['id']);
            $loginUserAttemptFlagEntityPatch = $loginAttemptsTable->patchEntity($loginUserAttemptFlagEntity, ['login_flag'=>0]);
            $loginAttemptsTable->save($loginUserAttemptFlagEntityPatch);
        }
        $ip = $_SERVER['REMOTE_ADDR'];
        if($ip=='::1'){
            $ipadd = '127.0.0.1';
        } else {
            $ipadd = $ip;
        }
        $login_attempts_ipArr = $loginAttemptsTable->find('all', ['conditions' => ['ipaddress' => $ipadd]])->enableHydration(false)->toArray();

        $login_attempts_id = $login_attempts_ipArr[0]['id'];
        if($login_attempts_id){
            $entity = $loginAttemptsTable->get($login_attempts_id);
            $entityData = $loginAttemptsTable->patchEntity($entity, ['failed_attempts'=>0]);
            $loginAttemptsTable->save($entity);
        }
        //$this->Auth->config('logoutRedirect', ['controller' => 'Users', 'action' => 'login']);
        $this->redirect($this->Auth->logout());
    }

    /**
     * forgotPassword method
     *
     * @return \Cake\Network\Response|null
     */

    public function forgotPassword()
    {
        if ($this->request->getSession()->check('Auth.User')) {
            return $this->redirect(['controller' => 'Dashboard', 'action' => 'index']);
        }
        $this->viewBuilder()->setLayout('login');        
        if (!empty($this->request->getData())) {
            $errors=[];
            if ($this->Captcha->getCode('securitycode') != $this->request->getData('captcha')) {
                $errors['captcha']['_empty'] = 'Invalid captcha,try again.';
            }
            if (empty($errors)) {
                if (empty($this->request->getData('email'))) {
                    $this->Flash->error('Please Provide email.');
                } else {
                    $uemail = $this->request->getData('email');
                    $fu = $this->Users->find('all')->where(['email'=>$uemail])->first();
                    if (!empty($fu)) {
                        $uemail = $fu->email;
                        $email = new Email('default');
                        $email->template('forgot_password');
                        $email->emailFormat('html');
                        $email->viewVars(['user'=>$fu]);
                        $status = $email->to($uemail)
                            ->subject('Drivers Hub - Reset your password')
                            ->send();
                        $this->Flash->success('Check your inbox for a password reset email.');
                    } else {
                        $this->Flash->error('Email does not exist.');
                    }
                }
            } else {
                $this->Flash->error(__('Invalid captcha. Please try again.'));
            }
        }
    }

    public function userLog()
    {
        $this->loadModel('AdminLogs');
        $rid = $this->Auth->user('role_id');
        $adminLog = $this->AdminLogs->find('all')
            ->contain(['Users'])
            ->order(['AdminLogs.id'=>'DESC']);
        if ($rid != 1) {
            $adminLog = $adminLog->where(['uid' => $this->Auth->user('id')]);
        }
        $this->paginate = ['limit' => 20];
        $adminLog = $this->paginate($adminLog);
        $this->set(compact('adminLog'));
    }

    public function changePasswordHistory()
    {
        $changePasswordTable = TableRegistry::get('change_password_logs');
        $changePassword = $changePasswordTable->find('all')->where(['user_id'=>$this->Auth->user('id')]);
        $this->paginate = ['limit' => 20];
        $changePassword = $this->paginate($changePassword);
        $this->set(compact('changePassword'));
    }
    
    /**
     * Change Password method
     *
     * @return \Cake\Http\Response|void
     */

    public function changePassword()
    {
        $user = $this->Users->get($this->Auth->user('id'));
        if(!empty($_REQUEST))
        {
            $jcryption = new \JCryption;
            $jcryption->decrypt();
            $userdata = $_REQUEST;
            $user = $this->Users->patchEntity($user, [
                    'old_password'      => $userdata['old_password'],
                    'password'          => $userdata['new_password'],
                    'new_password'      => $userdata['new_password'],
                    'confirm_password'  => $userdata['confirm_password']
                ],
                    ['validate' => 'password']
            );
            if($this->Users->save($user)) 
            {
                $changePasswordTable = TableRegistry::get('change_password_logs');
                $changePassword = $changePasswordTable->newEntity();
                $ipaddress = $_SERVER['REMOTE_ADDR'];
                if ($ipaddress == '::1') {
                    $ipadd = '127.0.0.1';
                } else {
                    $ipadd = $ipaddress;
                }
                $changePassword->user_id = $user->id;
                $changePassword->password = $user->password;
                $changePassword->change_time = date('Y-m-d H:i:s');
                $changePassword->ip_address = inet_pton($ipadd);
                $changePasswordTable->save($changePassword);
                $this->Flash->success('Your password has been changed successfully.');
                //Email code
                //$this->redirect(['action'=>'view']);
            } else {
                if($user->errors()){
                    $error_msg = [];
                    foreach( $user->errors() as $errors){
                        if(is_array($errors)){
                            foreach($errors as $error){
                                $error_msg[]    =   $error;
                            }
                        }else{
                            $error_msg[]    =   $errors;
                        }
                    }
                    if(!empty($error_msg)){
                        $this->Flash->error(
                                    __("Please fix the following error(s):".implode("\r\n", $error_msg))
                        );
                    }
                }else{
                    $this->Flash->error('Error changing password. Please try again!');
                }
            }
        }
        $this->set('user',$user);
    }

    /**
     * Change User Password method
     *
     * @return \Cake\Http\Response|void
     */

    public function changeUserPassword($userId=null)
    {
        if (empty($userId)) {
            $this->Flash->success('Select user for change password.');
            return $this->redirect(['controller'=>'Registration','action'=>'index']);
        }

        $user = $this->Users->get($userId);        
        if(!empty($this->request->data)){
            $user = $this->Users->patchEntity($user, [
                    'password' => $this->request->data['new_password'],
                    'password_hint' =>  $this->request->data['new_password']
                ]
            );
            if($this->Users->save($user)) {
                $this->Flash->success('Your password has been changed successfully');
                $this->redirect(['controller'=>'Registers','action'=>'index']);
            } else {
                if($user->errors()){
                    $error_msg = [];
                    foreach( $user->errors() as $errors){
                        if(is_array($errors)){
                            foreach($errors as $error){
                                $error_msg[]    =   $error;
                            }
                        }else{
                            $error_msg[]    =   $errors;
                        }
                    }
                    if(!empty($error_msg)){
                        $this->Flash->error(
                                    __("Please fix the following error(s):".implode("\r\n", $error_msg))
                        );
                    }
                }else{
                    $this->Flash->error('Error changing password. Please try again!');
                }
            }
        }
        $this->set('user',$user);
    }
    
    /**
     * Reset Password method
     *
     * @return \Cake\Http\Response|void
     */

    public function resetPassword($val=null)
    {
        $this->viewBuilder()->setLayout('login');
        $user_id   = !empty($this->request->query['q1'])? base64_decode($this->request->query['q1']) : null;
        $current_time  = !empty($this->request->query['q2'])? base64_decode($this->request->query['q2']) : null;
        $expire_time   = $current_time + 10*60;
        if(time() < $expire_time){
            if(!empty($user_id)) {
                $user = $this->Users->get($user_id);
                if ($this->request->is(['post','put','patch'])) {
                    $password = $this->request->data['password'];
                    $confirmPassword = $this->request->data['confirm_password'];
                    if($password==$confirmPassword){
                        $user = $this->Users->patchEntity($user, ['password' => $password]);
                        $user->password_hint = $confirmPassword;
                        if ($this->Users->save($user)) {
                            $this->Flash->success(__('Your password has been changed successfully.'));
                            $this->redirect(['controller' => 'Users', 'action' => 'login']);
                        } else {
                        $this->Flash->error(__('The password could not be changed. Please, try again.'));
                        }
                    }else{
                        $this->Flash->error(__('Confirm password does not match. Please, try again.'));
                    }
                }
            } else {
            //$this->redirect(['controller' => 'Users', 'action' => 'pnLogin']);
            }
        } else {
        $this->Flash->error(__('Your time is expire. Please, try again.'));
        }
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $search_condition = array();
        $page_length = !empty($this->request->query['page_length']) ? $this->request->query['page_length'] : 10;
        $page = !empty($this->request->query['page']) ? $this->request->query['page'] : 1;
        
        if (!empty($this->request->getQuery('name'))) {
            $name = trim($this->request->getQuery('name'));
            $this->set('name', $name);
            $search_condition[] = "Users.name like '%" . $name . "%'";
        }

        if (!empty($this->request->getQuery('email'))) {
            $email = trim($this->request->getQuery('email'));
            $this->set('email', $email);
            $search_condition[] = "Users.email like '%" . $email . "%'";
        }

        if (!empty($this->request->getQuery('role_id'))) {
            $role_id = trim($this->request->getQuery('role_id'));
            $this->set('roleId', $role_id);
            $search_condition[] = "Users.role_id like '%" . $role_id . "%'";
        }

        if (isset($this->request->query['status']) && $this->request->query['status'] !='') {
            $status = trim($this->request->query['status']);
            $this->set('status', $status);
            $search_condition[] = "Users.status = '" . $status . "'";
        }

        if(!empty($search_condition)){
            $searchString = implode(" AND ",$search_condition);
        } else {
            $searchString = '';
        }
        if ($page_length != 'all' && is_numeric($page_length)) {
            $this->paginate = [
                'limit' => $page_length,
            ];
        }

        if($this->request->is('get')){
            if(!empty($this->request->getQuery('export_excel'))) {
                $ExportResultData = $this->Users->find('all')->contain(['Roles'])->where([$searchString])->order(['Users.id' =>'asc'])->limit($page_length)->enableHydration(false)->toArray();
                $fileName = "Users-".date("d-m-y:h:s").".xls";
                $headerRow = array("S.No","Name","Email","Username","Role Name","Status","Created");
                $data = array();
                $i=1;
                $stat = ['0'=>'Inactive', 'Active'];
                foreach($ExportResultData As $rows){
                    $data[]=array($i, $rows['name'],$rows['email'],$rows['username'],$rows['role']['name'], $stat[$rows['status']],date('Y-m-d H:i:s',strtotime($rows['created'])));
                    $i++;
                }
                $this->exportInExcel($fileName, $headerRow, $data);
            }
        }

        $usersQuery = $this->Users->find('all')->contain(['Roles'])->where([$searchString,'role_id NOT IN'=>['5','6']])->order(['Users.id' => 'desc']);

        $this->paginate = ['limit' => 10];
        $users = $this->paginate($usersQuery);
        $this->set('selectedLen', $page_length);
        $roles = $this->Users->Roles->find('list', ['limit' => 200]);
        $this->set(compact('users','roles'));
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => ['Roles']
        ]);

        $this->set('user', $user);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $roles = $this->Users->Roles->find('list', ['limit' => 200]);
        $this->set(compact('user', 'roles'));
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $roles = $this->Users->Roles->find('list', ['limit' => 200]);
        $this->set(compact('user', 'roles'));
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        $loginUser = $this->Auth->user();
        if ($user->id != $loginUser['id']) {
            if ($user->role_id != 1) {
                if ($this->Users->delete($user)) {
                    $this->Flash->success(__('The user has been deleted.'));
                } else {
                    $this->Flash->error(__('The user could not be deleted. Please, try again.'));
                }
            } else {
                $this->Flash->error(__('You are not authorized to delete this user.'));
            }
        } else {
            $this->Flash->error(__('You can not delete currently logged in User.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function __generatePasswordToken($user)
    {
        if (empty($user)) {
            return null;
        }
        $token = "";
        // Generate a random string 100 chars in length.
        for ($i = 0; $i < 100; $i++) {
            $d = rand(1, 100000) % 2;
            $d ? $token .= chr(rand(33, 79)) : $token .= chr(rand(80, 126));
        }
        (rand(1, 100000) % 2) ? $token = strrev($token) : $token = $token;

        // Generate a hash of random string
        $hash = Security::hash($token, 'sha256', true);;
        for ($i = 0; $i < 20; $i++) {
            $hash = Security::hash($hash, 'sha256', true);
        }
        $user['User']['reset_password_token'] = $hash;
        $user['User']['token_created_at'] = date('Y-m-d H:i:s');
    }

    public function jcryption()
    {
        $this->autoRender = false;
        $jc = new \JCryption;
        $jc->go();
        header('Content-type: text/plain');
    }

    public function captchass()
    {
        $this->autoRender = false;
        echo $this->Captcha->image(5);
    }

    public function captcha()
    {
        $this->autoRender = false;
        //$this->viewBuilder()->layout('ajax');
        $this->Captcha->create();
    }

    public function downloadFile($filePath) {
        if($filePath){
            $filePath = base64_decode($filePath);
            ob_clean();
            if(file_exists($filePath)){
                $this->response->file($filePath,['download' => true]);
                return $this->response;
            }else{
                $this->Flash->error('File isn\'t available on server.');
                return $this->redirect($this->referer());
            }
        }else{
            $this->Flash->error('Not a valid file.');
            return $this->redirect($this->referer());
        }
    }

}