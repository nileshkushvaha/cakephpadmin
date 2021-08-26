<?php
namespace App\Controller\Api;

use Cake\Event\Event;
use Cake\Http\Exception\UnauthorizedException;
use Cake\Utility\Security;
use Firebase\JWT\JWT;
use Cake\Http\ServerRequest;
use Cake\I18n\Time;
use Cake\Routing\Router;
use Cake\Validation\Validator;
use Cake\Auth\DefaultPasswordHasher;
use Cake\Utility\Text;
use Cake\Network\Exception\NotFoundException;
use Cake\Datasource\Exception\RecordNotFoundException;
use Cake\Http\Exception\MethodNotAllowedException;

class ApiController extends AppController
{
	public $dateFormat = 'Y-m-d';
    public $dateFormatFull = 'Y-m-d H:i:s';

    public function initialize()
    {
        parent::initialize();
        $this->loadModel('Users');
        $this->loadComponent('Sanitize');
        $this->loadComponent('Email');

        $this->Auth->allow(['login','registration','validateOtp','forgotPassword','resetPassword']);
    }

    public function beforeFilter(Event $event) {
        parent::beforeFilter($event); 
    }

    /**
     * Login User to generate token
     */

    public function login()
    {
        $userdata = json_decode(file_get_contents('php://input'), true);
    	$this->request->allowMethod(['post']);
        $msg=[];
        $profileBaseUrl = Router::Url('/files/profile_pic',true);
        //$userdata = $this->request->data;
        $this->request->data=$userdata;
        $validator = new Validator();
        $validator->email('email');
        $validError = $validator->errors(['email' => $this->request->data['email']]);
        if (empty($validError)) {
            $this->Auth->setConfig('authenticate', [
                'Form' => ['fields' => ['username' => 'email']],
            ]);
            $this->request = $this->request->withData('email', $this->request->data['email']);
            $this->request = $this->request->withoutData('username');
        }
        $user = $this->Auth->identify();
        $user_data = new \stdClass();
        if ($user){
            if ($user['role_id'] == 5 || $user['role_id']==6) {
                if ($user['status']) {
                    $registration=[];
                    $role = $this->Users->Roles->find('all')->where(['id' => $user['role_id']])->first();
                    $registration = $this->Users->UserProfiles->find('all')->where(['user_id'=>$user['id']])->first();
                    $this->Auth->setUser($user);
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
                    $tokenId  = base64_encode(32);
		            $issuedAt = time();
		            $key = Security::salt();
		            $token = [
                        'token' => JWT::encode([
                            'alg' => 'HS256',
                            'id' => $user_data['id'],
                            'sub' => $user_data['id'],
                            'iat' => time(),
                            'exp' =>  time() + 86400,
                        ],
                        $key)];                        
                    $message = __('Login successfully.');
                    $status = true;
                    $user = $user_data;
                    $this->set(compact('message', 'status','token','user','key'));
                    $this->set('_serialize', ['message', 'status','token','user','key']);
                } else {
                	$message = __('Please activate your account by clicking activation link on your registered mail address.');
	                $status = false;
			        $this->set(compact('status', 'message'));
			        $this->set('_serialize', ['status', 'message']);
                }
            } else {
            	$message = __('Invalid login details.');
	        	$status = false;
	        	$this->set(compact('status', 'message'));
			    $this->set('_serialize', ['status', 'message']);
            }
        } else {
        	$message = __('Invalid username or password.');
	        $status = false;
	        $this->set(compact('status', 'message'));
			$this->set('_serialize', ['status', 'message']);
        }
    }


    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */

    public function users()
    {
        $this->paginate = [
            'contain' => ['Roles','UserProfiles'],'order' => ['id' => 'desc']
        ];
        $users = $this->paginate($this->Users);

        $this->set(compact('users'));
        $this->set('_serialize', ['users']);
    }


    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function userProfile($userId = null)
    {
        $this->request->allowMethod(['get']);
        try {
            if (isset($userId) && !empty($userId)) {
                $user = $this->Users->get($userId, [
                    'contain' => ['UserProfiles']
                ]);
                if (empty($user)) {
                    $msg['message'] = 'User not found';
                    $msg['status'] = false;
                } else {
                    $msg['message'] = 'User profile';
                    $msg['status'] = true;
                    $userData=[];
                    $userData['id']=$user->id;
                    $userData['name']=$user->name;
                    $userData['username']=$user->username;
                    $userData['email']=$user->email;
                    $userData['role_id']=$user->role_id;
                    $userData['status']=$user->status;
                    $userData['screening']=$user->screening;
                    $userData['stage_status']=$user->stage_status;
                    $userData['created']=date('d-m-Y H:i:s',strtotime($user->created));
                    $userData['modified']=date('d-m-Y H:i:s',strtotime($user->modified));
                    $userProfile=[];
                    $profileBaseUrl = Router::Url('/files/profiles/'.$user->id.'/',true);
                    $userProfile['id']=$user->user_profile->id;
                    $userProfile['user_id']=$user->user_profile->user_id;
                    $userProfile['date_of_birth']= date('m-d-Y',strtotime($user->user_profile->date_of_birth)) ?? '';
                    $userProfile['shortname']=$user->user_profile->shortname ?? '';
                    $userProfile['first_name']=$user->user_profile->first_name ?? '';
                    $userProfile['middle_name']=$user->user_profile->middle_name ?? '';
                    $userProfile['last_name']=$user->user_profile->last_name ?? '';
                    $userProfile['gender']=$user->user_profile->gender ?? '';
                    $userProfile['email']=$user->user_profile->email ?? '';
                    $userProfile['mobile_number']=$user->user_profile->mobile_number ?? '';
                    $userProfile['phone']=$user->user_profile->phone ?? '';
                    $userProfile['fax']=$user->user_profile->fax ?? '';
                    $userProfile['country']=$user->user_profile->country ?? '';
                    $userProfile['city_name']=$user->user_profile->city_name ?? '';
                    $userProfile['address']=$user->user_profile->address ?? '';
                    $userProfile['pincode']=$user->user_profile->pincode ?? '';
                    $userProfile['profile_photo']=isset($user->user_profile->profile_photo)? $profileBaseUrl.$user->user_profile->profile_photo:'';
                    $userProfile['user_video']=isset($user->user_profile->user_video)?$profileBaseUrl.'video/'.$user->user_profile->user_video :'';
                    $userProfile['user_cv']=isset($user->user_profile->user_cv)?$profileBaseUrl.'cv/'.$user->user_profile->user_cv : '';
                    $userProfile['driving_license']=isset($user->user_profile->driving_license)?$profileBaseUrl.'dl/'.$user->user_profile->driving_license :'';
                    $userProfile['driving_license_back']=isset($user->user_profile->driving_license_back)? $profileBaseUrl.'dl/'.$user->user_profile->driving_license_back :'';
                    $userProfile['national_insurance_number']=isset($user->user_profile->national_insurance_number)?$profileBaseUrl.'nin/'.$user->user_profile->national_insurance_number :'';
                    $userProfile['dbs_copy']=isset($user->user_profile->dbs_copy)?$profileBaseUrl.'dbs/'.$user->user_profile->dbs_copy :'';
                    $userProfile['address_proof']=isset($user->user_profile->address_proof)?$profileBaseUrl.'address/'.$user->user_profile->address_proof :'';
                    $userProfile['passport_copy']=isset($user->user_profile->passport_copy)? $profileBaseUrl.'passport/'.$user->user_profile->passport_copy : '';
                    $userProfile['passport_copy_back']=isset($user->user_profile->passport_copy_back)? $profileBaseUrl.'passport/'.$user->user_profile->passport_copy_back :'';
                    $userProfile['dvla_document']=isset($user->user_profile->dvla_document)? $profileBaseUrl.'dvla/'.$user->user_profile->dvla_document :'';
                    $userProfile['website']=$user->user_profile->website ?? '';
                    $userProfile['isApplicationRegistered'] = false;
                    $userData['user_profile']=$userProfile;
                    $msg['data'] = $userData;
                }            
            } else {
                $msg['message'] = 'Invalid user Id';
                $msg['status'] = false;
            }
        } catch (RecordNotFoundException $e) {
            $msg['message'] = $e->getMessage();
            $msg['status'] = false;
        }
        extract($msg);
        $this->set(compact('message','status','data'));
        $this->set('_serialize', ['message','status','data']);
    }

    /**
     * Registration method
     *
     * @return \Cake\Network\Response|void Redirects on successful registration, renders view otherwise.
     */

    public function registration()
    {
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
        	//$data = $this->request->getData();
            $data = json_decode(file_get_contents('php://input'), true);
            $data = $this->Sanitize->clean($data);
        	$userName = preg_replace('/([^@]*).*/', '$1', $data['email']);
            $usernameArr = $this->Users->find()->select('username')->where(['username like'=>"%$userName%"])->toArray();
            $userCount  = count($usernameArr)+1;
            $userName   = $userName.$userCount;
            $password   = trim($data['password']);
            $data['username']       = $userName;
            $data['password']       = $password;
            $data['status']         = 0;
            $data['password_hint']  = md5($password);
            $data['fp_token']       = Text::uuid();
            $data['fp_token_at']    = date('Y-m-d H:i:s');            
            $user = $this->Users->patchEntity($user, $data);
            if ($this->Users->save($user)) {
                $this->__passwordLog($user);
                $this->loadModel('UserProfiles');
                $profile = $this->UserProfiles->newEntity();
                $profile->user_id       = $user->id;
                $profile->email         = $data['email'];
                $profile->mobile_number = $data['mobile_number'];
                if(!empty($data['first_name'])){
                    $profile->first_name = $data['first_name'];
                }
                if ($this->UserProfiles->save($profile)) {
                    $otpSt = sprintf('%04u', rand('0000','9999'));
                    $user_email = isset($user->email)?$user->email:'';
                    $this->loadModel('Otps');
                    $seletOtp=$this->Otps->find()->where(['user_id'=>$user->id])->first();
                    if (empty($seletOtp)) {
                        $otpObj = $this->Otps->newEntity();
                    } else {
                        $otpObj = $this->Otps->get($seletOtp->id);
                    }
                    $otpData=[
                        'user_id'=>$user->id,
                        'email'=>$user_email,
                        'otp'=>$otpSt,
                        'created'=>date('Y-m-d H:i:s')
                    ];
                    $otpObj = $this->Otps->patchEntity($otpObj, $otpData);
                    if($this->Otps->save($otpObj)){
                        if($user_email){
                            $emailData = [
                                'setHelpers'     => ['Html'],
                                'setTemplate'    => 'otp_email',
                                'setEmailFormat' => 'html',
                                'setTo'          => trim($user_email),
                                'setCc'          => 'nileshcszone@gmail.com',
                                'setSubject'     => __('Drivers Hub - Registration Successful'),
                                'setViewVars'    => ['otp'=>$otpSt,'name'=>$user->name],
                            ];
                            $this->Email->send($emailData);
                        }
                    }                    
                    //$this->__sendActivationEmail($user->id,$user->fp_token);
                    $otp = $otpSt;
                    $message = 'Your account has been created successfully. We have send OTP on your email.';
                    $status = true;
                    $this->set(compact('message','status','otp','user'));
                    $this->set('_serialize', ['message','status','otp','user']);
                } else {
                    $inesrtedUser = $this->Users->get($user->id);
                    $this->Users->delete($inesrtedUser);
                    $message = 'Internal Server Error. Please, try again.';
                    $status = false;
                    $error = $profile->getErrors();
                    $this->set(compact('message','status','error'));
                    $this->set('_serialize', ['message','status','error']);
                }
            } else {
                $message = 'Your online registration could not be completed. Please, try again.';
                $status = false;
                $error = $user->getErrors();
                $this->set(compact('message','status','error'));
                $this->set('_serialize', ['message','status','error']);
            }
        }
    }

    public function validateOtp()
    {
        $data = $this->request->getData();
        $error = [];
        if (!isset($data['otp']) && !empty($data['otp'])) {
            $error['otp'] = "OTP is required";
        }
        if (!isset($data['user_id']) && !empty($data['user_id'])) {
            $error['user_id'] = "User Id is required";
        }
        if (!empty($error)) {
            $message = __('Invalid data.');
            $status = false;
            $this->set(compact('status', 'message','error'));
            $this->set('_serialize', ['status', 'message','error']);
        }
        $rotp = isset($data['otp'])?$data['otp']:'';
        $user_id = isset($data['user_id']) ? $data['user_id']:'';
        $this->loadModel('Otps');
        $seletOtp = $this->Otps->find()->where(['user_id'=>$user_id])->first();
        if (isset($seletOtp) && !empty($seletOtp)) {
            if ($rotp==$seletOtp->otp && $user_id==$seletOtp->user_id) {
                // Activate User
                $user = $this->Users->get($user_id);
                $user->status=1;
                $user->fp_token='';
                $user->fp_token_at='';
                if($this->Users->save($user)){
                    // Delete OTP
                    $otpObj = $this->Otps->get($seletOtp->id);
                    $this->Otps->delete($otpObj);
                    $message = __('Otp verified and Your account has been successfully activated.');
                    $status = true;
                } else {
                    $message = __('Otp could not be verified.');
                    $status = false;
                }                
                $this->set(compact('status', 'message'));
                $this->set('_serialize', ['status', 'message']);
            }else{
                $message = __('Invalid OTP.');
                $status = false;
                $this->set(compact('status', 'message'));
                $this->set('_serialize', ['status', 'message']);
            }            
        }else{
            $message = __('Invalid user.');
            $status = false;
            $this->set(compact('status', 'message'));
            $this->set('_serialize', ['status', 'message']);
        }
    }

    /**
     * UpdateProfile method
     *
     * @param string|null $id User id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */

    public function updateProfile()
    {
        $this->request->allowMethod(['patch', 'post', 'put']);
        $msg=[];
        try {
            //$data = $this->request->getData();
            $data = json_decode(file_get_contents('php://input'), true);
            if ($data['user_id'] && !empty($data['user_id'])) {
                $user = $this->Users->get($data['user_id']);
                if (isset($data['name']) && !empty($data['name'])) {
                    $user->name = $data['name'];
                }
                if (isset($data['email']) && !empty($data['email'])) {
                    //$user->email = $data['email'];
                }
                $user->modified = $this->dateFormatFull;
                if ($this->Users->save($user)) {
                    $userId = $user->id;
                    $this->loadModel('UserProfiles');
                    $profileArr = $this->UserProfiles->find()->select('id')->where(['user_id'=>$userId])->first();
                    if (empty($profileArr)) {
                        $profile = $this->UserProfiles->newEntity();
                    } else {
                        $profile = $this->UserProfiles->get($profileArr->id);
                    }
                    $profile->user_id  = $userId;                    
                    $profile->mobile_number  = $data['mobile_number'];
                    if(!empty($data['name'])){
                        $profile->first_name = $data['name'];
                    }
                    if(!empty($data['last_name'])){
                        $profile->last_name  = $data['last_name'];
                    }
                    if(!empty($data['date_of_birth'])){
                        $profile->date_of_birth = date('Y-m-d',strtotime($data['date_of_birth']));
                    }
                    if(!empty($data['gender'])){
                        $profile->gender     = $data['gender'];
                    }
                    if(!empty($data['address'])){
                        $profile->address = $data['address'];
                    }
                    if(!empty($data['country'])){
                        $profile->country = $data['country'];
                    }
                    if(!empty($data['city'])){
                        $profile->city_name = $data['city'];
                    }
                    if(!empty($data['pincode'])){
                        $profile->pincode = $data['pincode'];
                    }
                    $this->UserProfiles->save($profile);
                    $user->user_profile = $profile;
                    $message = 'Profile has been updated successfully.';
                    $status = true;
                    $data = $user;
                    $this->set(compact('message','status','data'));
                    $this->set('_serialize', ['message', 'status','data']);
                } else {
                    $message = 'Profile could not be updated. Please, try again.';
                    $status = false;
                    $error = $user->getErrors();
                    $this->set(compact('message','status','error'));
                    $this->set('_serialize', ['message', 'status','error']);
                }
            } else {
                $message = 'User id can not be null.';
                $status = false;
                $this->set(compact('message','status'));
                $this->set('_serialize', ['message', 'status']);
            }
        } catch (Exception $e) {
            $error = $e->getMessage();
            $message = 'Somthing went wrong.';
            $status = false;
            $this->set(compact('message','status','error'));
            $this->set('_serialize', ['message', 'status','error']);
        }
    }

    public function changePassword()
    {
        $this->request->allowMethod(['post']);
        try {
            $udata = $this->request->getData();
            //$udata = json_decode(file_get_contents('php://input'), true);
            if (isset($udata['user_id']) && !empty($udata['user_id'])) {
                $user = $this->Users->get($udata['user_id']);
                $user = $this->Users->patchEntity($user, [
                    'old_password'      => $udata['old_password'],
                    'password'          => $udata['new_password'],
                    'new_password'      => $udata['new_password'],
                    'confirm_password'  => $udata['confirm_password']
                    ],['validate' => 'updatePassword']
                );
                if($this->Users->save($user)){
                    $this->__passwordLog($user);
                    $msg['message'] = 'Your password has been changed successfully.';
                    $msg['status'] = true;
                    //$msg['data'] = $user;
                } else {
                    $msg['message'] = 'Error changing password. Please try again!';
                    $msg['status'] = false;
                    $msg['error'] = $user->getErrors();
                }
            } else {
                $msg['message'] = 'User id can not be null.';
                $msg['status'] = false;
            }
        } catch (RecordNotFoundException $e) {
            $msg['message'] = 'User not found';
            $msg['status'] = false;
            $msg['error'] = $e->getMessage();
        }
        extract($msg);
        $this->set(compact('message','status','data','error'));
        $this->set('_serialize', ['message', 'status','data','error']);
    }

    /**
     * forgotPassword method
     *
     * @return \Cake\Network\Response|null
     */

    public function forgotPassword()
    {
        $this->request->allowMethod(['post']);
        try {
            if ($this->request->is('post')) {
                $udata = $this->request->getData();

                if (!empty(trim($udata['email']))) {
                    $email  = trim($this->request->getData('email'));
                    $validator = new Validator();
                    $validator->email('email');
                    $validError = $validator->errors(['email' => $email]);
                    $UserExist=[];
                    if (empty($validError)) {
                        $UserExist = $this->Users->findByEmail($email)->first();
                    } else {
                        $msg['message'] = 'Invalid email!';
                        $msg['status'] = false;
                        $msg['error'] = $validError;
                    }
                    if ($UserExist) {
                        $UserExist->fp_token    = Text::uuid();
                        $UserExist->fp_token_at = date('Y-m-d H:i:s');
                        if ($this->Users->save($UserExist)) {
                            $otpSt = sprintf('%04u', rand('0000','9999'));
                            $user_email = isset($UserExist->email)?$UserExist->email:'';
                            $this->loadModel('Otps');
                            $seletOtp=$this->Otps->find()->where(['user_id'=>$UserExist->id])->first();
                            if (empty($seletOtp)) {
                                $otpObj = $this->Otps->newEntity();
                            } else {
                                $otpObj = $this->Otps->get($seletOtp->id);
                            }
                            $otpData=[
                                'user_id'=>$UserExist->id,
                                'email'=>$user_email,
                                'otp'=>$otpSt,
                                'created'=>date('Y-m-d H:i:s')
                            ];
                            $otpObj = $this->Otps->patchEntity($otpObj, $otpData);
                            if($this->Otps->save($otpObj)){
                                if($user_email){
                                    $emailData = [
                                        'setHelpers'     => ['Html'],
                                        'setTemplate'    => 'forgot_password',
                                        'setEmailFormat' => 'html',
                                        'setTo'          => trim($UserExist->email),
                                        'setCc'          => 'nileshcszone@gmail.com',
                                        'setSubject'     => __('Drivers Hub - Reset your password'),
                                        'setViewVars'    => ['otp'=>$otpSt,'name'=>$UserExist->name],
                                    ];
                                    $this->Email->send($emailData);
                                }
                            }
                            $msg['message'] = 'OTP has been sent to your email address.';
                            $msg['status'] = true;
                            $msg['data'] = ['otp'=>$otpSt,'user_id'=>$UserExist->id,'email'=>$UserExist->email];
                        } else {
                            $msg['message'] = 'Error in forgetting password. Please try again!';
                            $msg['status'] = false;
                            $msg['error'] = $UserExist->getErrors();
                        }
                    } else {
                        $msg['message'] = 'Invalid email or user does not exist. Please try again!';
                        $msg['status'] = false;
                    }
                } else {
                    $msg['message'] = 'Email Id can not be null.';
                    $msg['status'] = false;
                }
            }
        } catch (Exception $e) {
            $msg['message'] = 'User not found';
            $msg['status'] = false;
            $msg['error'] = $e->getMessage();
        }
        extract($msg);
        $this->set(compact('message','status','data','error'));
        $this->set('_serialize', ['message', 'status','data','error']);
    }

    /**
     * Reset Password method
     *
     * @return \Cake\Http\Response|void
     */
    public function resetPassword()
    {
        $this->request->allowMethod(['post']);
        try {
            if ($this->request->is('post')) {
                $udata = $this->request->getData();
                $userId = isset($udata['user_id']) ? trim($udata['user_id']):'';
                $rotp = isset($udata['otp']) ? trim($udata['otp']):'';
                if (!empty($userId) && !empty($rotp)) {
                    $this->loadModel('Otps');
                    $seletOtp = $this->Otps->find()->where(['user_id'=>$userId])->first();
                    if (isset($seletOtp) && !empty($seletOtp)) {
                        if ($rotp==$seletOtp->otp && $userId==$seletOtp->user_id) {
                            $user = $this->Users->get($userId);
                            $user = $this->Users->patchEntity($user, [
                                'new_password'     => $udata['password'],
                                'password'         => $udata['password'],
                                'confirm_password' => $udata['confirm_password'],
                            ], ['validate' => 'updatePassword']);
                            $user->fp_token    = "";
                            $user->fp_token_at = "";
                            if ($this->Users->save($user)) {
                                $this->__passwordLog($user);
                                $emailData = [
                                    'setHelpers'     => ['Html'],
                                    'setTemplate'    => 'resetpassword',
                                    'setEmailFormat' => 'html',
                                    'setTo'          => trim($user->email),
                                    'setCc'          => 'nileshcszone@gmail.com',
                                    'setSubject'     => __('Drivers Hub - You Password has changed'),
                                    'setViewVars'    => ['name' => trim($user->name)],
                                ];
                                $this->Email->send($emailData);
                                
                                $msg['message'] = 'Your password has been successfully changed.';
                                $msg['status'] = true;
                            } else {
                                $msg['message'] = 'Password could not be reset. Please try again!';
                                $msg['status'] = false;
                                $msg['error'] = $user->getErrors();
                            }
                        } else {
                            $msg['message'] = 'Invalid otp or user Id';
                            $msg['status'] = false;
                        }
                    } else {
                        $msg['message'] = 'Invalid User Id!';
                        $msg['status'] = false;
                    }                    
                } else {
                    $msg['message'] = 'Please enter user Id and Otp';
                    $msg['status'] = false;
                }
            }
        } catch (Exception $e) {
            $msg['message'] = 'User not found';
            $msg['status'] = false;
            $msg['error'] = $e->getMessage();
        }
        extract($msg);
        $this->set(compact('message','status','error'));
        $this->set('_serialize', ['message', 'status','error']);
    }

    public function profilePicture()
    {
        $this->request->allowMethod(['patch', 'post', 'put']);
        try {
            if ($this->request->is(['patch', 'post', 'put'])) {
                $data = $this->request->getData();
                $data = $this->Sanitize->clean($data);
                $user_id = isset($data['user_id'])?trim($data['user_id']):'';
                $profile_photo = isset($data['profile_photo'])?$data['profile_photo']:array();

                if (!empty($user_id) && is_numeric($user_id) && !empty($profile_photo)) {
                    $allowed = array('gif', 'png', 'jpg', 'jpeg');
                    $ext = pathinfo($profile_photo['name'], PATHINFO_EXTENSION);
                    if (!in_array($ext, $allowed)) {
                        $message = 'File extension not allowed.';
                        $status = false;
                        $this->set(compact('message','status'));
                        $this->set('_serialize', ['message', 'status']);
                    } else {
                        $this->loadModel('UserProfiles');
                        $UserExist = $this->Users->findById($user_id)->first();
                        if (!empty($UserExist)) {                            
                            $profileBaseUrl = Router::Url('/files/',true);
                            if($profile_photo['name']!=''){
                                $profileImage = $this->uploadFiles('profiles/'.$user_id, $profile_photo);
                                if (isset($profileImage['errors']) && !empty($profileImage['errors'])) {
                                    $message = $profileImage['errors'];
                                    $status = false;
                                    $this->set(compact('message','status'));
                                    $this->set('_serialize', ['message', 'status']);
                                } else {
                                    $profileData = $this->UserProfiles->find()->where(['user_id'=>$user_id])->first();
                                    if (empty($profileData)) {
                                      $profile = $this->UserProfiles->newEntity();
                                    } else {
                                      $profile = $this->UserProfiles->get($profileData->id);
                                    }
                                    $profile->profile_photo = $profileImage['filename'];
                                    $profile->user_id = $user_id;
                                    if ($this->UserProfiles->save($profile)) {
                                        $message = 'Profile picture has been uploaded successfully.';
                                        $status = true;
                                        $data = [
                                            'user_id'=>$user_id,
                                            'photo_file_name'=>$profileImage['filename'],
                                            'photo_url'=>$profileImage['url'],
                                            'photo_full_url'=>$profileBaseUrl.$profileImage['url']
                                        ];
                                        $this->set(compact('message','status','data'));
                                        $this->set('_serialize', ['message', 'status','data']);
                                    } else {
                                        $message = 'Please select profile picture.';
                                        $status = false;
                                        $this->set(compact('message','status'));
                                        $this->set('_serialize', ['message', 'status']);
                                    }
                                }                                
                            } else {
                                $message = 'Please select profile picture.';
                                $status = false;
                                $this->set(compact('message','status'));
                                $this->set('_serialize', ['message', 'status']);
                            }
                        } else {
                            $message = 'User does not exist!';
                            $status = false;
                            $this->set(compact('message','status'));
                            $this->set('_serialize', ['message', 'status']);
                        }
                    }
                } else {
                    $message = 'User Id or profile photo is missing.';
                    $status = false;
                    $this->set(compact('message','status'));
                    $this->set('_serialize', ['message', 'status']);
                }
            }
        } catch (Exception $e) {
            $message = 'User not found';
            $status = false;
            $error = $e->getMessage();
            $this->set(compact('message','status','error'));
            $this->set('_serialize', ['message', 'status','error']);
        }
    }

    public function profileVideo()
    {
        $this->request->allowMethod(['patch', 'post', 'put']);
        try {
            if ($this->request->is(['patch', 'post', 'put'])) {
                $data = $this->request->getData();
                $data = $this->Sanitize->clean($data);
                $user_id = isset($data['user_id'])?trim($data['user_id']):'';
                $profile_video = isset($data['profile_video'])?$data['profile_video']:array();

                if (!empty($user_id) && is_numeric($user_id) && !empty($profile_video)) {
                    $allowed = array('mp4');
                    $ext = pathinfo($profile_video['name'], PATHINFO_EXTENSION);
                    if (!in_array($ext, $allowed)) {
                        $message = 'File extension not allowed.';
                        $status = false;
                        $this->set(compact('message','status'));
                        $this->set('_serialize', ['message', 'status']);
                    } else {
                        $this->loadModel('UserProfiles');
                        $UserExist = $this->Users->findById($user_id)->first();
                        if (!empty($UserExist)) {                            
                            $profileBaseUrl = Router::Url('/files/',true);
                            if($profile_video['name']!=''){
                                $profileVideo = $this->uploadFiles('profiles/'.$user_id, $profile_video,'video');
                                if (isset($profileVideo['errors']) && !empty($profileVideo['errors'])) {
                                    $message = $profileVideo['errors'];
                                    $status = false;
                                    $this->set(compact('message','status'));
                                    $this->set('_serialize', ['message', 'status']);
                                } else {
                                    $profileData = $this->UserProfiles->find()->where(['user_id'=>$user_id])->first();
                                    if (empty($profileData)) {
                                      $profile = $this->UserProfiles->newEntity();
                                    } else {
                                      $profile = $this->UserProfiles->get($profileData->id);
                                    }
                                    $profile->user_video = $profileVideo['filename'];
                                    $profile->user_id = $user_id;
                                    if ($this->UserProfiles->save($profile)) {
                                        $message = 'Video has been uploaded successfully.';
                                        $status = true;
                                        $data = [
                                            'user_id'=>$user_id,
                                            'photo_file_name'=>$profileVideo['filename'],
                                            'photo_url'=>$profileVideo['url'],
                                            'photo_full_url'=>$profileBaseUrl.$profileVideo['url']
                                        ];
                                        $this->set(compact('message','status','data'));
                                        $this->set('_serialize', ['message', 'status','data']);
                                    } else {
                                        $message = 'Please select profile video.';
                                        $status = false;
                                        $this->set(compact('message','status'));
                                        $this->set('_serialize', ['message', 'status']);
                                    }
                                }
                            } else {
                                $message = 'Please select profile video.';
                                $status = false;
                                $this->set(compact('message','status'));
                                $this->set('_serialize', ['message', 'status']);
                            }
                        } else {
                            $message = 'User does not exist!';
                            $status = false;
                            $this->set(compact('message','status'));
                            $this->set('_serialize', ['message', 'status']);
                        }
                    }
                } else {
                    $message = 'User Id or profile photo is missing.';
                    $status = false;
                    $this->set(compact('message','status'));
                    $this->set('_serialize', ['message', 'status']);
                }
            }
        } catch (Exception $e) {
            $message = 'User not found';
            $status = false;
            $error = $e->getMessage();
            $this->set(compact('message','status','error'));
            $this->set('_serialize', ['message', 'status','error']);
        }
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */

    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $msg['status'] = 1;
            $msg['msg'] = 'The user has been deleted.';
        } else {
            $msg['status'] = 0;
            $msg = 'The user could not be deleted. Please, try again.';
        }
        extract($msg);
        $this->set(compact('status', 'msg'));
        $this->set('_serialize', ['status', 'msg']);
    }

    protected function __passwordLog($user)
    {
        $this->loadModel('ChangePasswordLogs');
        $changePassword = $this->ChangePasswordLogs->newEntity();
        $ipaddress = $this->request->clientIp();
        $changePassword->user_id = $user->id;
        $changePassword->password = $user->password;
        $changePassword->change_time = date('Y-m-d H:i:s');
        $changePassword->ip_address = inet_pton($ipaddress);
        $this->ChangePasswordLogs->save($changePassword);
    }

    protected function __sendActivationEmail($user_id, $token)
    {
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


}