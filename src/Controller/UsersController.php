<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Mailer\Email;
use Cake\ORM\TableRegistry;
use Cake\Error\Exceptions;
use Cake\I18n\Time;
use Cake\Routing\Router;
use Cake\Auth\DefaultPasswordHasher;
use Cake\Utility\Text;
use Cake\Validation\Validator;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 *
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UsersController extends AppController
{
    public $dateFormat = 'Y-m-d';

    public $dateFormatFull = 'Y-m-d H:i:s';
    
    public function initialize()
    {
        parent::initialize();
        $this->Auth->allow(['userTypes','login', 'forgotPassword', 'resetPassword', 'captcha','registration','emailcheck','mobileexists','jcryption','checkMail','registrationVerification']);
        // load the Captcha component and set its parameter
        //$this->loadComponent('CakephpCaptcha.Captcha');
        $this->loadComponent('Captcha', ['captchaConfig' => 'LoginCaptcha']);
        //$this->loadComponent('Csrf');
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
        if($this->isDevice) {
            $this->request->allowMethod(['post']);
            $_status = false;
            $_message = '';        
            $profileBaseUrl = Router::Url('/files/profile_pic',true);
            $userdata = $this->request->data;
            $validator = new Validator();
            $validator->email('email');
            $validError = $validator->errors(['email' => $this->request->data['username']]);
            if (empty($validError)) {
                $this->Auth->setConfig('authenticate', [
                    'Form' => ['fields' => ['username' => 'email']],
                ]);
                $this->request = $this->request->withData('email', $this->request->data['username']);
                $this->request = $this->request->withoutData('username');
            }
            $uname = $userdata['username'];
            $cUser = $this->Users->find('all')->where(['email'=>$uname])->orWhere(['username'=>$uname])->first();
            if (!empty($cUser)) {
                $uId = $cUser['id'];
            } else {
                $uId = 0;
            }
            $user = $this->Auth->identify();
            $user_data = new \stdClass();
            if ($user) {
                if ($user['role_id'] != 1) {
                    if ($user['status']) {
                        $registration=[];
                        $role = $this->Users->Roles->find('all')->where(['id' => $user['role_id']])->first();
                        $registration = $this->Users->UserProfiles->find('all')->where(['user_id'=>$user['id']])->first();
                        
                        //$user['role'] = $role;
                        //$user['registration'] = $registration;
                        
                        $this->Auth->setUser($user);                        
                        $_status = true;
                        $_message = __('Login Successful.'); 
                        //echo "<pre>";print_r($registration);die;           
                        if(!empty($user['fp_token_at'])){
                            $user['fp_token_at'] = date($this->dateFormat, strtotime($user['fp_token_at']));
                        }
                        $user['created'] = date($this->dateFormat, strtotime($user['created']));
                        $user['modified'] = date($this->dateFormat, strtotime($user['modified']));
                        $user_data = $user;                        
                        $user_data['role_id'] = $role->id;
                        $user_data['role_name'] = $role->name;
                        if(!empty($registration) && !empty($registration->date_of_birth)){
                            $user_data['date_of_birth'] = $registration->date_of_birth->format('Y-m-d');
                        }
                        $user_data['organization'] = isset($registration->organization)?$registration->organization:'';
                        $user_data['shortname'] = isset($registration->shortname)?$registration->shortname:'';
                        $user_data['first_name'] = isset($registration->first_name)?$registration->first_name:'';
                        $user_data['last_name'] = isset($registration->last_name)?$registration->last_name:'';
                        $user_data['gender'] = isset($registration->gender)?$registration->gender:'' ;
                        $user_data['email'] = isset($registration->email)?$registration->email:'';
                        $user_data['mobile_number'] = isset($registration->mobile_number)?$registration->mobile_number:'';
                        $user_data['phone'] = isset($registration->phone)?$registration->phone:'';
                        $user_data['fax'] = isset($registration->fax)?$registration->fax:'';
                        $user_data['state_id'] = isset($registration->state_id)?$registration->state_id:'';
                        $user_data['district_id'] = isset($registration->district_id)?$registration->district_id:'';
                        $user_data['city'] = isset($registration->city)?$registration->city:'';
                        $user_data['address'] = isset($registration->address)?$registration->address:'';
                        $user_data['pincode'] = isset($registration->pincode)?$registration->pincode:'';
                        if ($registration['profile_photo']) {
                            $user_data['profile_photo'] = $profileBaseUrl.'/'.$registration['profile_photo'];
                        }else{
                            $user_data['profile_photo'] = '';
                        }                        
                        $user_data['website'] = isset($registration->website)?$registration->website:'';
                        $user_data['isApplicationRegistered'] = false;
                    } else {
                        $_message = __('Please activate your account by clicking activation link on your registered mail address.');
                    }
                } else {
                    $_message = __('Login with admin Url.');
                }
            } else {
                $_message = __('Invalid username or password.');
            }
            $this->set(compact('_status','_message','user_data'));
            $this->set('_serialize', ['_status','_message','user_data']);
        } else {
            $this->viewBuilder()->setLayout('home');
            if ($this->request->getSession()->check('Auth.User')) {
                return $this->redirect(['controller' => 'Dashboard', 'action' => 'index']);
            }
            if ($this->request->is('post')) {
                $token = $this->request->getParam('_csrfToken');
                $jcryption = new \JCryption;
                $jcryption->decrypt();
                $this->request->data = $_REQUEST;
                $userdata = $this->request->data;
                $errors = [];
                //if ($this->Captcha->getCode('securitycode') != $this->request->getData('securitycode')) {
                    //$errors['captcha']['_empty'] = 'Invalid captcha,try again.';
                //}
                if (empty($errors)) {
                    $validator = new Validator();
                    $validator->email('email');
                    $validError = $validator->errors(['email'=>$this->request->data['username']]);
                    if (empty($validError)) {
                        $this->Auth->setConfig('authenticate', [
                            'Form' => ['fields' => ['username' => 'email']],
                        ]);
                        $this->request = $this->request->withData('email', $this->request->data['username']);
                        $this->request = $this->request->withoutData('username');
                    }
                    $uname = $userdata['username'];
                    $cUser = $this->Users->find('all')->where(['email' => $uname])->orWhere(['username'=>$uname])->first();
                    if (!empty($cUser)) {
                        $uId = $cUser['id'];
                    } else {
                        $uId = 0;
                    }
                    $user = $this->Auth->identify();
                    if ($user) {
                        if ($user['role_id'] != 1) {
                            if ($user['status']) {
                                $role = $this->Users->Roles->find('all')->where(['id' => $user['role_id']])->first();
                                $profile = $this->Users->UserProfiles->find('all')->where(['user_id' => $user['id']])->first();
                                $user['role'] = $role;
                                $user['profile'] = $profile;
                                $this->Auth->setUser($user);
    
                                $this->adminLog($user['id'],'Login Successful.');
                                return $this->redirect($this->Auth->redirectUrl());
                            } else {
                                $this->adminLog($user['id'],'Please activate your account by clicking activation link on your registered mail address.');
                                $this->Flash->error(__('Please activate your account by clicking activation link on your registered mail address.'));
                                return $this->redirect($this->referer());
                            }
                        } else {
                            $this->adminLog($user['id'],'Login with admin Url.');
                            $this->Flash->error(__('Login with admin Url.'));
                            return $this->redirect($this->referer());
                        }
                    } else {
                        $this->adminLog($uId,'Login Failed.');
                        $this->Flash->error(__('Invalid credentials.'));
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
    }

    public function adminLog($uid,$logSms='')
    {
        /* admin log code starts */
        $ipaddress = $_SERVER['REMOTE_ADDR'];
        if($ipaddress=='::1'){
            $ipadd = '127.0.0.1';
        } else {
            $ipadd = $ipaddress;
        }
        $ipaddress = $_SERVER['REMOTE_ADDR'];
        $date_today = date('Y-m-d H:i:s');
        $logtime = Time::createFromFormat('Y-m-d H:i:s', $date_today);
        $adminLogTable = TableRegistry::get('admin_logs');
        $adminLog = $adminLogTable->newEntity();
        $adminLog->uid = $uid;
        $adminLog->logsms = $logSms;
        $adminLog->logtime = $logtime;
        $adminLog->ipaddress = inet_pton($ipadd);//string inet_ntop ( string $in_addr )
        $adminLogTable->save($adminLog);
        /* admin log code ends */
    }

    /**
     * logout method
     *
     * @return \Cake\Network\Response|null
     */

    public function logout()
    {
        $this->Flash->success(__('You have logged out successfully.'));
        $user_id = $this->request->session()->read('Auth.User.id');
        $this->adminLog($user_id,'Logout.');
        return $this->redirect($this->Auth->logout());
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
        $this->viewBuilder()->setLayout('home');
        if ($this->request->is('post')) {
            $errors = [];
            // if ($this->Captcha->getCode('securitycode') != $this->request->getData('securitycode')) {
            //     $errors['captcha']['_empty'] = 'Invalid captcha,try again.';
            // }
            if (empty($errors)) {
                if (!empty(trim($this->request->getData('username')))) {
                    $username  = trim($this->request->getData('username'));
                    $validator = new Validator();
                    $validator->email('email');
                    $validError = $validator->errors(['email' => $username]);
                    if (empty($validError)) {
                        $UserExist = $this->Users->findByEmail($username)->first();
                    } else {
                        $UserExist = $this->Users->findByUsername($username)->first();
                    }
                    if ($UserExist) {
                        $UserExist->fp_token    = Text::uuid();
                        $UserExist->fp_token_at = date('Y-m-d H:i:s');
                        if ($this->Users->save($UserExist)) {
                            if (!empty($UserExist)) {
                                $emailData = [
                                    'setHelpers'     => ['Html'],
                                    'setTemplate'    => 'forgot_password',
                                    'setEmailFormat' => 'html',
                                    'setTo'          => trim($UserExist->email),
                                    'setSubject'     => __('Drivers Hub - Reset your password'),
                                    'setViewVars'    => ['user' => $UserExist],
                                ];
                                $this->Email->send($emailData);
                            }
                            $this->Flash->success(__('Password reset instructions have been sent to your email address. You have 24 hours to complete the request.'));
                            return $this->redirect(['controller' => 'Users', 'action' => 'login']);
                        } else {
                            $this->Flash->error(__('Email not send successful, try again'));
                            return $this->redirect(['controller' => 'Users', 'action' => 'forgotPassword']);
                        }
                    } else {
                        $this->Flash->error(__('Invalid username, try again'));
                        return $this->redirect(['controller' => 'Users', 'action' => 'forgotPassword']);
                    }
                }
            } else {
                $this->Flash->error(__($errors['captcha']['_empty']));
                return $this->redirect(['controller' => 'Users', 'action' => 'forgotPassword']);
            }
        }
    }

    /**
     * Reset Password method
     *
     * @return \Cake\Http\Response|void
     */

    public function resetPassword($fp_token = null)
    {
        $this->viewBuilder()->setLayout('home');
        $user = $this->Users->newEntity();
        if (isset($fp_token)) {
            $TokenExist = $this->Users->findByFpToken($fp_token)->first();
            if ($TokenExist) {
                $tokenGeneratedDate = $TokenExist['fp_token_at'];
                $convertDate        = date("Y-m-d", strtotime($tokenGeneratedDate));
                if (strtotime($convertDate) <= strtotime('-1 day')) {
                    $TokenExist->fp_token    = "";
                    $TokenExist->fp_token_at = "";
                    $this->Users->save($TokenExist);
                    $this->Flash->error('Your link has been expired, try again.');
                    return $this->redirect(['controller' => 'Users', 'action' => 'forgotPassword']);
                } else {
                    if ($this->request->is('post')) {
                        $errors = [];
                        if ($this->Captcha->getCode('securitycode') != $this->request->getData('securitycode')) {
                            $errors['captcha']['_empty'] = 'Invalid captcha,try again.';
                        }
                        if (empty($errors)) {
                            $user = $this->Users->patchEntity($TokenExist, [
                                'new_password'     => $this->request->getData('password'),
                                'password'         => $this->request->getData('password'),
                                'confirm_password' => $this->request->getData('confirm_password'),
                            ], ['validate' => 'password']);
                            $user->fp_token    = "";
                            $user->fp_token_at = "";
                            if ($this->Users->save($user)) {
                                $this->__passwordLog($user);
                                if (!empty($user)) {
                                    $emailData = [
                                        'setHelpers'     => ['Html'],
                                        'setTemplate'    => 'resetpassword',
                                        'setEmailFormat' => 'html',
                                        'setTo'          => trim($user->email),
                                        'setSubject'     => __('Drivers Hub - You Password has changed'),
                                        'setViewVars'    => ['name' => trim($user->name)],
                                    ];
                                    $this->Email->send($emailData);
                                }
                                $this->Flash->success(__('Your password has been changed successfully! Thank you.'));
                                return $this->redirect(['controller'=>'Users','action'=>'login']);
                            }
                        } else {
                            $this->Flash->error(__($errors['captcha']['_empty']));
                        }
                    }
                }
            } else {
                $this->Flash->error(__('Invalid Token.'));
                return $this->redirect(['controller' => 'Users', 'action' => 'login']);
            }
        } else {
            $this->Flash->error(__('Something missing in URL.'));
            return $this->redirect(['controller' => 'Users', 'action' => 'login']);
        }
        $this->set(compact('fp_token', 'user'));
        $this->set('_serialize', ['fp_token']);
    }

    protected function __passwordLog($user)
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
        $this->viewBuilder()->setLayout('home');
        $user = $this->Users->get($this->Auth->user('id'));
        if ($this->request->is('post')) {
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
                    $this->__passwordLog($user);
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
        }
        $this->set('user',$user);
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        return $this->redirect(['controller'=>'Users', 'action' => 'login']);
    }
    
    public function userTypes()
    {
        if($this->isDevice) {
            $this->request->allowMethod(['get']);
            
            $_status = false;
            $_message = '';
            $totalCounts = 0;
            
            $types = array(7,8,9,10,11,12,15);
            $this->loadModel('Roles');
            
            $roles = $this->Roles->find('list',['keyField'=>'id','valueField'=>'name'])->where(['id IN'=>$types])->toArray();
            $user_roles = array();
            if(empty($roles)){
                $_status = true;
                $_message = 'User types not found.';
            }else{
                $_status = true;
                $_message = 'User types found';
                
                $totalCounts = count($roles);
                
                $i=0;
                foreach($roles as $key=>$value){
                    $user_roles[$i]['id'] = $key;
                    $user_roles[$i]['name'] = $value;
                    
                    $i++;
                }
            }
            
            $this->set(compact('_status','_message','totalCounts','user_roles'));
            $this->set('_serialize', ['_status','_message','totalCounts','user_roles']);
        }
    }

    public function registration()
    {
        if($this->isDevice) {
            $this->request->allowMethod(['post']);
            $_status = false;
            $_message = '';
        }
        
        if(!$this->isDevice) {
            $this->viewBuilder()->setLayout('home');
        }
        $user = $this->Users->newEntity();
       
        if ($this->request->is('post')) {
            $errors = [];
            if($this->isDevice){
                $userdata = $this->request->data;
            }else{
                $jcryption = new \JCryption;
                $jcryption->decrypt();
                $userdata = $_REQUEST;
                // if ($this->Captcha->getCode('securitycode') != $userdata['securitycode']) {
                //     $errors['captcha']['_empty'] = 'Invalid captcha,try again.';
                //     $email = $userdata['email'];
                //     $name = $userdata['name'];
                //     $mobile_number = $userdata['mobile_number'];
                //     $this->set(compact('email','name','mobile_number'));
                // }
            }
            
            if (empty($errors)) {
                $userName = preg_replace('/([^@]*).*/', '$1', $userdata['email']);
                $usernameArr = $this->Users->find()->select('username')->where(['username like'=>"%$userName%"])->toArray();
                $userArr = count($usernameArr)+1;
                $userName = $userName.$userArr;
                $password = trim($userdata['password']);
                $password = $this->Sanitize->stripAll( $password);
                $password = $this->Sanitize->clean( $password);
                $userRecord = [
                    'name'          => $userdata['name'],
                    'username'      => $userName,
                    'email'         => trim($userdata['email']),
                    'password'      => $password,
                    'role_id'       => 2, //$userdata['role_id'],
                    'status'        => 0,
                    'password_hint' => md5($password),
                    'fp_token'      => Text::uuid(),
                    'fp_token_at'   => date('Y-m-d H:i:s')
                ];
                
                $user = $this->Users->patchEntity($user, $userRecord);
                //pr($user); die;
                if ($result = $this->Users->save($user)) {
                    $this->loadModel('UserProfiles');
                    $profile = $this->UserProfiles->newEntity();
                    $profile->user_id  = $result->id;
                    if(!empty($userdata['gender'])){
                        $profile->gender     = $userdata['gender'];
                    }
                    $profile->email          = $userdata['email'];
                    $profile->name           = $userdata['name'];
                    $profile->mobile_number  = $userdata['mobile_number'];
                    if(!empty($userdata['first_name'])){
                        $profile->first_name = $userdata['name'];
                    }
                    if(!empty($userdata['middle_name'])){
                        $profile->middle_name = $userdata['middle_name'];
                    }
                    if(!empty($userdata['last_name'])){
                        $profile->last_name  = $userdata['last_name'];
                    }                    
                    //$profile->date_of_birth  = date('Y-m-d',strtotime($userdata['date_of_birth']));
                    if(!empty($userdata['other_designation'])){
                        $profile->other_designation = $userdata['other_designation'];
                    }
                    if(!empty($userdata['address'])){
                        $profile->address = $userdata['address'];
                    }
                    if(!empty($userdata['country_id'])){
                        $profile->country_id = $userdata['country_id'];
                    }
                    if(!empty($userdata['state_id'])){
                        $profile->state_id = $userdata['state_id'];
                    }
                    if(!empty($userdata['district_id'])){
                        $profile->district_id = $userdata['district_id'];
                    }
                    if(!empty($userdata['city'])){
                        $profile->city = $userdata['city'];
                    }
                    if(!empty($userdata['pincode'])){
                        $profile->pincode = $userdata['pincode'];
                    }
                    if ($this->UserProfiles->save($profile)) {
                        $this->__passwordLog($result);
                        $this->__sendActivationEmail($result->id,$result->fp_token);
                        
                        if($this->isDevice){
                            $_status = true;
                            $_message = 'Your account has been created successfully. Please activate your account by clicking on the link sent on your email.';
                        }else{
                            $this->Flash->success(__('Your account has been created successfully. Please activate your account by clicking on the link sent on your email.'));
                            return $this->redirect(['controller'=>'Users', 'action' => 'login']);
                        }
                    } else {
                        $inesrtedUser = $this->Users->get($result->id);
                        $this->Users->delete($inesrtedUser);
                        
                        if($this->isDevice){
                            $_message = 'Internal Server Error. Please, try again.';
                        }else{
                            $this->Flash->error(__('Internal Server Error. Please, try again.'));
                        }
                    }
                } else {
                    $errs=[];
                    if(!empty($user->errors())){
                        foreach($user->errors() as $key=>$value){
                            if(is_array($value)){
                                foreach($value as $k=>$v){
                                    $errs[] = $v;
                                }
                            }else{
                                $errs[] = $value;
                            }
                        }
                    }
                    if($this->isDevice){
                        $_message = implode(", ",$errs);
                    }else{
                        if (!empty($errs)) {
                            $this->Flash->error(__(implode(", ",$errs)));
                        } else {
                            $this->Flash->error(__('Your online registration could not be completed. Please, try again.'));
                        }                        
                    }
                }
            } else {
                if(!empty($errors['captcha']['_empty'])){
                    $this->Flash->error(__($errors['captcha']['_empty']));
                } else {
                    $this->Flash->error(__('Your Captcha is expire. Please refresh the page'));
                }
            }
        }
        
        if($this->isDevice){
            $this->set(compact('_status','_message'));
            $this->set('_serialize', ['_status','_message']);
        }else{
            $this->set(compact('user'));
        }
    }

    protected function __sendActivationEmail($user_id, $token){
        if (empty($token) && empty($user_id)) {
            $this->Flash->success(__('Somthing went wrong.'));
            return $this->redirect(['action' => 'login']);
        }
        $user = $this->Users->find()->where(['id'=>$user_id])->first();
        $link = Router::url('/en/users/registration-verification/' . $token.'/'.$user->id, true);
        if (!empty($user)) {
            $emailData = [
                'setHelpers'     => ['Html'],
                'setTemplate'    => 'activation_email',
                'setEmailFormat' => 'html',
                'setTo'          => trim($user->email),
                'setCc'          => 'nileshcszone@gmail.com',
                'setSubject'     => __('Drivers Hub - Registration Successful'),
                'setViewVars'    => ['link'=>$link,'name'=>$user->name],
            ];
            $this->Email->send($emailData);
        }
    }

    public function registrationVerification($token,$user_id)
    {
        if (empty($token) && empty($user_id)) {
            $this->Flash->success(__('Somthing went wrong.'));
            return $this->redirect(['action' => 'login']);
        }
        $user = $this->Users->find()->where(['id'=>$user_id,'fp_token'=>$token])->first();
        if (!empty($user)) {
            if (empty($user['status'])) {
                $query = $this->Users->query();
                $query->update()
                ->set(['status'=>1,'fp_token'=>'','fp_token_at'=>''])
                ->where(['id' => $user->id])
                ->execute();
                $this->Flash->success(__('Your account has been successfully activated.'));
            } elseif ($user['status'] == 1) {
                $this->Flash->success(__('Your account has already been activated.'));            
            }
        } else {
            $this->Flash->success(__('Your account has already been activated.'));  
        }        
        return $this->redirect(['action' => 'login']);
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

    public function emailcheck() {
        $this->viewBuilder()->setLayout('ajax');
        $email = $_POST['email'];        
        $emailResult = $this->Users->find('all', ['conditions' => ['email' => $email], 'fields' => ['email']])->enableHydration(false)->first();
        if (!empty($emailResult)) {
            echo 'false';
        } else {
            echo 'true';
        }
        exit();
    }

    public function mobileexists() {
        $this->loadModel('UserProfiles');
        $this->viewBuilder()->setLayout('ajax');
        $mobileno = trim($_POST['mobile_number']);
        $newmobile = substr($mobileno, -10);
        $mobilenoResult = $this->UserProfiles->find('all', ['conditions' => ['mobile_number' => $newmobile], 'fields' => ['mobile_number']])->enableHydration(false)->first();
        if (!empty($mobilenoResult)) {
            echo 'false';
        } else {
            echo 'true';
        }
        exit();
    }


    public function editProfile()
    {
        $this->viewBuilder()->layout('frontend');
        $this->loadModel('States');
        $state = $this->States->find('list',['keyField'=>'id','valueField'=>'name'])->where(['flag'=>1]);
        $user = $this->Users->get($this->Auth->user('id'),['contain'=>['UserProfiles']]);
        $this->loadModel('Designations');
        $designation = $this->Designations->find('list',['keyField'=>'id','valueField'=>'name']);
        if(!empty($user->profile->district_id)){
            $this->loadModel('Districts');
            $district = $this->Districts->find('list',['keyField'=>'id','valueField'=>'name'])->where(['state_id'=>$user->profile->state_id]);
            $this->set('district',$district);
        }
        if($this->request->is(['post','put'])){
            $data = $this->request->getData();
            $data = $this->Sanitize->clean($data);
            $saveData = $this->Users->patchEntity($user, $data, ['associated' => ['UserProfiles']]);
            
            if($data['profile']['profile_photo']['name']!=''){
                $photo = $this->uploadFiles('profile_pic', $data['profile']['profile_photo']);
                $saveData->profile->profile_photo = $photo['filename'];
            }else{
                $saveData->profile->profile_photo = @$data['profile']['profile_photo_old'];
            }
            $saveData->profile->date_of_birth = date('Y-m-d',strtotime($data['profile']['date_of_birth']));
            if ($userdata = $this->Users->save($saveData, ['associated'=>['UserProfiles']])) {
                $this->Flash->success(__("Profile has been updated successfully"));
                return $this->redirect(['controller'=>'Dashboard']);
            }
        }
        $this->set(compact('user','state','designation'));
    }
    
    public function apiEditProfile()
    {
        if ($this->isDevice == false) {
            return $this->redirect(['controller' => 'Dashboard', 'action' => 'index']);
        }
        
        $this->request->allowMethod(['post']);
        $_status  = false;
        $_message = '';
        
        $profileBaseUrl = Router::Url('/files/profile_pic',true);
        
        if ($this->request->is(['post'])) {
            $userId = $this->request->getData('userId');
        
        }
        $this->loadModel('UserProfiles');
        
        $user_registration = new \stdClass();
        if (!empty($userId)) {
            $user_registration = $this->UserProfiles->findByUserId($userId)->first();
        } else {
            $_message = __('UserID is required');
        }
        if(empty($user_registration)){
            $user_registration = $this->UserProfiles->newEntity();
        }
        //echo "<pre>";print_r($user_registration);exit;
        if (empty($_message) && $this->request->is(['post'])) {
            $data = $this->request->getData();
            $data = $this->Sanitize->clean($data);
            
            $data['user_id'] = $data['userId'];
            if(!empty($data['date_of_birth'])){
                $data['date_of_birth'] = date('Y-m-d',strtotime($data['date_of_birth']));
            }
            if(!empty($data['profile_photo']) && $data['profile_photo']['name'] != ''){
                $photo = $this->uploadFiles('profile_pic', $data['profile_photo']);
                $data['profile_photo'] = $photo['filename'];
            }
            
            $saveData = $this->UserProfiles->patchEntity($user_registration, $data);
            if($this->Users->UserProfiles->save($saveData)) {
                $_status  = true;
                $_message = 'Profile has been updated successfully';
            }else{
                //pr($saveData->errors());exit;
                if(!empty($saveData->errors())){
                    foreach($saveData->errors() as $key=>$value){
                        if(is_array($value)){
                            foreach($value as $k=>$v){
                            $errs[] = $v;
                            }
                        }else{
                            $errs[] = $value;
                        }
                    }
                }
                $_message = implode(", ",$errs);
            }
        }
        if(!empty((array)$user_registration)) {
            $dateFields = ['date_of_birth','created'];
            foreach ($dateFields as $field) {
                $date = $user_registration->get($field);
                if(!empty($date)) {
                    $user_registration->{$field} = $date->format($this->dateFormat);
                }
            }
        }
        $this->set([
            '_status'    => $_status,
            '_message' => $_message,
            'user_data'   => $user_registration,
            'profileBaseUrl'   => $profileBaseUrl,
            '_serialize' => [
                '_status', '_message', 'user_data','profileBaseUrl'
            ],
        ]);
        //$this->set(compact('_status','_message','user_registration'));
        //$this->set('_serialize', ['_status','_message','user_registration']);
    }

}
