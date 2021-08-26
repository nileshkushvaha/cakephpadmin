<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\Validation\Validator;
use Cake\Controller\Controller;
use Cake\Mailer\Email;
use Cake\Error\Exceptions;
use Cake\I18n\Time;
use Cake\Routing\Router;
use Cake\Event\Event;
use Cake\Auth\DefaultPasswordHasher;
use Cake\View\Helper\SessionHelper ;
/**
 * Registration Controller
 *
 * @property \App\Model\Table\RegistrationTable $Registration
 *
 * @method \App\Model\Entity\Registration[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class RegistrationController extends AppController
{
    public $resQueryOtp;
    public function initialize() {
        parent::initialize();        
        $this->loadModel('Users');
        $this->loadModel('Otps');
        $this->viewBuilder()->setLayout('login');
        $this->Auth->allow(['index','resendOtp','restartRegistration','validateOtp','expireotp','add','view','edit','delete','emailcheck','mobileexists','sendOtp','getDistrictList','getCityList']);
        //$this->Auth->allow();
        if($this->getRequest()->getSession()->read('otpId')){           
            $this->resQueryOtp = $this->Otps->findById($this->getRequest()->getSession()->read('otpId'))->enableHydration(false)->first();
        }
    }

    public function beforeFilter(Event $event){
        parent::beforeFilter($event);
    }

    public function index(){
        if ($this->request->getSession()->check('Auth.User')) {
            return $this->redirect(['controller' => 'Dashboard', 'action' => 'index']);
        }
        if(!empty($this->getRequest()->getSession()->read('otpId'))){
            $this->Flash->success(__("Please verify your OTP."));
            return $this->redirect(['action' => 'validateOtp']);
        }
        if($this->request->is('post')){
            $mobileNumber = $this->request->getData('mobile_number');
            $mobileNumber = substr($mobileNumber, -10);
            $rndno = rand(1000, 9999);
            $message = urlencode("OTP for registration to SilverCMS is ".$rndno);
            $query = $this->Users->find('all',['conditions'=>['email'=>$this->request->getData('email')]])->first();
            
            if(empty($query)){
                $otpNew = $this->Otps->newEntity();

                // delete the previous opt records
                $queryOtp = $this->Otps->find('all',['conditions'=>['mobile_number'=>$mobileNumber]])->first();
                if(!empty($queryOtp['id'])){
                    $OtpEntity = $this->Otps->get($queryOtp['id']);
                    $result = $this->Otps->delete($OtpEntity);
                }
                
                //$otpPatch     = $this->Otps->patchEntity($otpNew,$this->request->data);
                $otpNew->email = $this->request->getData('email');
                $otpNew->mobile_number = $mobileNumber;
                $otpNew->otp = $rndno;
                $otpNew->created = date('Y-m-d H:i:s');
                if($result  = $this->Otps->save($otpNew)) {
                    
                    $to = $this->request->getData('email');
                    $subject = "OTP for SilverCMS Registration";
                    $msg = "Your OTP for SilverCMS is Registration: ".$rndno;
                    $email = new Email('default');
                    $sendMail=$email->setTemplate('otp_mail')
                        ->setViewVars(['msg'=>[$msg]])
                        ->setTo($to)
                        ->setSubject($subject)
                        ->setEmailFormat('html')
                        ->send();
                    //$send = $this->sendOtp($mobileNumber,$message);
                    
                    $send = true;
                    if(!empty($send) && !empty($sendMail)){
                        $this->getRequest()->getSession()->write('otpId', $otpNew->id);
                        $this->Flash->success(__('Thanks for giving your details. An OTP has been sent to your Mobile Number and Email. Please enter the 4 digit OTP below for Successful Registration'));
                        return $this->redirect(['action' => 'validate_otp']);
                    } else {
                         $this->Flash->error(__("OTP could not send. Please tray again"));
                    }
                } else {
                     $this->Flash->error(__("There are some error in database. Please tray again"));
                }
            } else {
                $this->Flash->error(__('Email already exist !'));
            }
        }
        
    }

    public function resendOtp(){
        if(!empty($this->getRequest()->getSession()->read('otpId')) && !empty($this->resQueryOtp['repeats']) >= 0){
            if($this->request->is('post')){
                $id = $this->getRequest()->getSession()->read('otpId');
                $email = $this->resQueryOtp['email'];
                $mobile = $this->resQueryOtp['mobile_number'];
                $rndno = rand(1000, 9999);
                $message = urlencode("OTP for registration to SilverCMS is : ".$rndno);
                //pr($this->request->data);
                $otpTable = TableRegistry::get('otps');
                $queryOtp = $otpTable->find('all',['conditions'=>['id'=>$id]])->first();
                $queryOtp->otp = $rndno;
                $queryOtp->repeats = $queryOtp['repeats']+1;
                $queryOtp->created = date('Y-m-d H:i:s');

                if($result  = $otpTable->save($queryOtp)) {
                    $to = $email;
                    $subject = "OTP for SilverCMS Registration";
                    $msg = "Your OTP for SilverCMS Registration is : ".$rndno;
                    $email = new Email('default');
                    $sendMail = $email->setTemplate('otp_mail')
                        ->setViewVars(['msg'=>[$msg]])
                        ->setTo($to)
                        ->setSubject($subject)
                        ->setEmailFormat('html')
                        ->send();
                    $send = $this->sendOtp($mobile, $message);
                    //if(!empty($sendMail)){
                    if(!empty($send) && !empty($sendMail)){
                        $this->Flash->success(__('OTP has been Resent on your Mobile Number/Email Id, please verify'));
                        return $this->redirect(['action' => 'validateOtp']);
                    } else {
                        $this->Flash->error(__("OTP could not send. Please tray again"));
                    }
                } else {
                    $this->Flash->error(__("There are some error in database. Please tray again"));
                }
            }else{
                return $this->redirect(['action' => 'validateOtp']);
            }
        }else{
            $this->Flash->error(__('Please provide your Mobile No. and Email Id for OTP.'));
            return $this->redirect(['action' => 'index']);
        }
        exit();
    }

    public function restartRegistration() {
        if($this->request->is('post')){
            if($this->resQueryOtp['id']){
                $id = $this->resQueryOtp['id'];
                $otpTable = TableRegistry::get('otps');
                $queryOtp = $otpTable->findById($id)->enableHydration(false)->first();
                $OtpEntity = $otpTable->get($queryOtp['id']);
                $result = $otpTable->delete($OtpEntity);
            }
            $this->getRequest()->getSession()->destroy();
            $this->Flash->error(__('You are ready to Restart registration process.'));
            return $this->redirect(['action' => 'index']);
        }else{
            return $this->redirect(['action' => 'index']);
        }
    }

    public function validateOtp(){
        $this->set('repeats', $this->resQueryOtp['repeats']);
        if(!empty($this->resQueryOtp)){
            if(empty($this->getRequest()->getSession()->read('otp_time')) || $this->getRequest()->getSession()->read('update_time') != strtotime($this->resQueryOtp['created'])){
            $otptime = strtotime($this->resQueryOtp['created'])+4*60+(date('U')-strtotime($this->resQueryOtp['created']));
                $this->getRequest()->getSession()->write('otp_time', $otptime);
                $this->getRequest()->getSession()->write('update_time', strtotime($this->resQueryOtp['updated']));
            }
            if(!empty($this->resQueryOtp['verified'])){
                $this->Flash->success(__('OTP verification has been done, Please continue registration.'));
                return $this->redirect(['action' => 'add']);
            }
            if($this->request->is('post')){
                $this->loadModel('Otps');
                $id = $this->resQueryOtp['id'];
                $queryOtp = $this->Otps->find('all',['conditions'=>['id'=>$id, 'otp'=>$this->request->getData('otp')]])->first();

                if(empty($queryOtp)){
                    $wrong_att = $this->Otps->find('all',['conditions'=>['id'=>$id]])->first();
                    $wrong_att->attempt = $wrong_att['attempt']+1;
                    $wrong = $this->Otps->save($wrong_att);
                    if($wrong->attempt >= 3){
                        $OtpEntity = $this->Otps->get($id);
                        $this->Otps->delete($OtpEntity);
                        $this->getRequest()->getSession()->destroy();
                        $this->Flash->error(__("You have reached maximum failed OTP verification. Try new registration."));
                        return $this->redirect(['action' => 'index']);
                    }else{
                        $total = 3;
                        $left = $total - $wrong->attempt;
                        $this->Flash->error(__("Only ".$left." attempt left. Please provide correct OTP."));
                        return $this->redirect(['action' => 'validateOtp']);
                    }
                }
                $queryOtp->verified = 1;
                $result = $this->Otps->save($queryOtp);
                if(empty($result)){
                    $this->Flash->error(__("OTP could not be verified. Please try again"));
                    return $this->redirect(['action' => 'validateOtp']);
                }
                $this->getRequest()->getSession()->delete('otp_time');
                $this->getRequest()->getSession()->delete('update_time');
                $this->Flash->success(__('OTP is verified, Please complete your registration.'));
                return $this->redirect(['action' => 'add']);
            }
        }else{
            $this->Flash->error(__('Enter your Mobile No. and Email Id. for OTP'));
            return $this->redirect(['action' => 'index']);
        }
    }

    public function expireotp() {
        $this->set('title', 'Expire OTP');
        if(empty($this->resQueryOtp['id'])){
            $this->Flash->error(__('Please provide below details for OTP request.'));
            return $this->redirect(['action' => 'index']);
        }
        $this->loadModel('Otps');
        $OtpEntity = $this->Otps->get($this->resQueryOtp['id']);
        $this->Otps->delete($OtpEntity);
        $this->getRequest()->getSession()->destroy();
        $this->Flash->error(__("Your OTP has been expired. Please Re-try registration."));
        return $this->redirect(['action' => 'index']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */

    public function add(){
        $email = $this->resQueryOtp['email'];
        $mobile_number = $this->resQueryOtp['mobile_number'];
        $this->set(compact('email','mobile_number'));

        if(empty($email) ||  empty($mobile_number) ){
            $this->Flash->error(__('Please provide your Mobile No. and Email Id. for OTP'));
            $this->redirect(['action' => 'index']);
        }

        $this->loadModel('Users');
        $users = $this->Registration->Users->find('list', ['limit' => 200]);
        $designations = $this->Registration->Designations->find('list', ['limit' => 200]);
        $states = $this->Registration->States->find('list', ['limit' => 200]);
        $districts = $this->Registration->Districts->find('list', ['limit' => 200]);
        $cities = $this->Registration->Cities->find('list', ['limit' => 200]);
        
        $this->set(compact('users', 'designations', 'states', 'districts', 'cities', 'userData'));

        $user = $this->Users->newEntity();
        $registration = $this->Registration->newEntity();
        
        if ($this->request->is('post')) {
            $userName = preg_replace('/@.*/', '', $this->request->getData('email'));
            $password = trim($this->request->getData('password'));
            $password = $this->Sanitize->stripAll( $password);
            $password = $this->Sanitize->clean( $password);
            $userRecord = [
                            'name'  => $this->request->getData('name'),
                            'username'  => $userName,
                            'email'     => $this->request->getData('email'),
                            'password'  => $password,
                            'role_id'   => 2,
                            'status'    => 1,
                            'password_hint' => $this->request->getData('confirm_password')
                          ];

            $user = $this->Users->patchEntity($user, $userRecord);
            if ($result = $this->Users->save($user)) {            
                $registration->user_id  = $result->id;
                $registration = $this->Registration->patchEntity($registration,$this->request->getData());
                $registration->date_of_birth = date('Y-m-d',strtotime($this->request->getData('date_of_birth')));
                $registration->address  = 'Address';
                if ($this->Registration->save($registration)) {
                    $otpid      = $this->resQueryOtp['id'];
                    $queryOtp   = $this->Otps->findById($otpid)->enableHydration(false)->first();
                    $OtpEntity  = $this->Otps->get($queryOtp['id']);
                    $result     = $this->Otps->delete($OtpEntity);
                    $this->getRequest()->getSession()->destroy();
                    $this->Flash->success(__('Your online registration has been successfully completed.'));
                    return $this->redirect(['controller'=>'Users', 'action' => 'login']);
                } else {
                    $inesrtedUser = $this->Users->get($result->id);
                    $this->Users->delete($inesrtedUser);
                    $this->Flash->error(__('Your online registration could not be completed. Please, try again.'));
                }
            } else {
                $this->Flash->error(__('Your online registration could not be completed. Please, try again.'));
            }
        }
        $this->set(compact('registration', 'users'));
        $this->set('_serialize', ['registration']);
    }

    /**
     * View method
     *
     * @param string|null $id Registration id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $registration = $this->Registration->get($id, [
            'contain' => ['Users', 'Designations', 'States', 'Districts', 'Cities']
        ]);

        $this->set('registration', $registration);
    }

    /**
     * Edit method
     *
     * @param string|null $id Registration id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $registration = $this->Registration->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $registration = $this->Registration->patchEntity($registration, $this->request->getData());
            if ($this->Registration->save($registration)) {
                $this->Flash->success(__('The registration has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The registration could not be saved. Please, try again.'));
        }
        $users = $this->Registration->Users->find('list', ['limit' => 200]);
        $designations = $this->Registration->Designations->find('list', ['limit' => 200]);
        $states = $this->Registration->States->find('list', ['limit' => 200]);
        $districts = $this->Registration->Districts->find('list', ['limit' => 200]);
        $cities = $this->Registration->Cities->find('list', ['limit' => 200]);
        $this->set(compact('registration', 'users', 'designations', 'states', 'districts', 'cities'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Registration id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $registration = $this->Registration->get($id);
        if ($this->Registration->delete($registration)) {
            $this->Flash->success(__('The registration has been deleted.'));
        } else {
            $this->Flash->error(__('The registration could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function emailcheck() {
        $this->viewBuilder()->setLayout('ajax');
        $this->loadModel('Users');
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
        $this->viewBuilder()->setLayout('ajax');
        $mobileno = $_POST['mobile_number'];
        $newmobile = substr($mobileno, -10);
        $mobilenoResult = $this->Registration->find('all', ['conditions' => ['mobile_number' => $newmobile], 'fields' => ['mobile_number']])->enableHydration(false)->first();
        if (!empty($mobilenoResult)) {
            echo 'false';
        } else {
            echo 'true';
        }
        exit();
    }
    
    public function sendOtp($mobile,$message){
        $authKey = "181778AzTzW2qriQ7N59f9c086";
        $mobileNumber = $mobile;
        //Sender ID,While using route4 sender id should be 6 characters long.
        $senderId = "ABCDEF";
        //Define route
        $route = "route=4";
        $postData = array(
            'authkey' => $authKey,
            'mobiles' => $mobileNumber,
            'message' => $message,
            'sender' => $senderId,
            'route' => $route
        );
        //API URL
        $url="https://control.msg91.com/api/sendhttp.php";
        // init the resource
        $ch = curl_init();
        curl_setopt_array($ch, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS => $postData
        //,CURLOPT_FOLLOWLOCATION => true
        ));
        //Ignore SSL certificate verification
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        //get response
        $output = curl_exec($ch);

        //Print error if any
        /* if(curl_errno($ch))
        {
            echo 'error:' . curl_error($ch);
        } */
        
        curl_close($ch);
        return $output;
            
    }
    
    public function getDistrictList(){
        $this->viewBuilder()->layout('ajax');
        $state_id = $_POST['state_id'];
        $this->loadModel('Districts');
        $districtResult = $this->Districts->find('list',['keyField'=>'id','valueField'=>'name','conditions'=>['state_id'=>$state_id,'flag'=>1]])->enableHydration(false)->toArray();
        $select = array('' =>'--Select--');
        $final  = array();
        foreach( $select as $key=>$each ){
            $final[$key]    = $each;
        }
        foreach( $districtResult as $key=>$each ){
            $final[$key]    = $each;
        }
        $this->set('district_list',$final);
    }

    public function getCityList(){
        $this->viewBuilder()->layout('ajax');
        $district_id = $_POST['district_id'];
        $this->loadModel('Cities');
        $citytResult = $this->Cities->find('list',['keyField'=>'id','valueField'=>'name','conditions'=>['district_id'=>$district_id,'status'=>1]])->enableHydration(false)->toArray();
        $slect = array('' =>'--Select--');
        $final  = array();
        foreach( $slect as $key=>$each ){
            $final[$key]    = $each;
        }
        foreach( $citytResult as $key=>$each ){
            $final[$key]    = $each;
        }
        $this->set('city_list',$final);
    }

    public function startupRegistration()
    {
        $this->viewBuilder()->layout('frontend');
        $this->loadModel('StartupApplications');
        $check_status = $this->StartupApplications->findByUserId($this->Auth->user('id'))->toArray();
        //pr($check_status); die();
        if(!empty($check_status)){
            $this->Flash->error(__('You have already registered for Startup.'));
            $this->redirect(['controller' => 'Dashboard']);
        }
        $application = $this->StartupApplications->newEntity();
        $this->loadModel('Users');
        $users = $this->Users->get($this->Auth->user('id'),['contain'=>['Registration.Designations']]);
        //pr($users); die();
        $name = $this->Auth->user('name');
        $email = $this->Auth->user('email');
        if($this->request->is(['post','put'])){
            //pr($this->request->data); die();
            $application  = $this->StartupApplications->patchEntity($application, $this->request->getData());
            $application->registration_date = date('Y-m-d',strtotime($this->request->data['registration_date']));
            if($this->request->data['registration_certificate']['name']!=''){
                $certificate = $this->uploadFiles('files/registration/', $this->request->data['registration_certificate']);
                //pr($certificate); die();
                $application->registration_certificate = $certificate['filename'];
            }else{
                $application->registration_certificate = @$this->request->data['registration_certificate_old'];
            }
            $application->user_id = $this->Auth->user('id');
            $application->name = $name;
            $application->email = $email;
            $application->created = date('Y-m-d H:i:s');
            $application->category_id = implode(',', $this->request->data['category_id']);
            //pr($application); die();
            if($result = $this->StartupApplications->save($application)) {
                $reference_no = $this->generateReferenceNo($result->id);
                $query = $this->StartupApplications->query();
                $query->update()
                    ->set(['reference_no' => $reference_no])
                    ->where(['id' => $result->id])
                    ->execute();
                $this->Flash->success('You have successfully registered for startup.');
                $this->redirect(['controller' => 'Dashboard']);
            }else{
                $this->Flash->error(__('Something went wrong. Please, try again.'));
            }
        }
        $this->loadModel('NatureOfStartup');
        $nature_of_startup = $this->NatureOfStartup->find('list',['keyField'=>'id','valueField'=>'nature'])->where(['status'=>1]);
        $this->loadModel('Industries');
        $industries = $this->Industries->find('list')->where(['status'=>1]);
        /*$this->loadModel('Sectors');
        $sectors = $this->Sectors->find('list',['keyField'=>'id','valueField'=>'name'])->where(['status'=>1]);*/
        $this->loadModel('StartupCategories');
        $startup_categories = $this->StartupCategories->find('list',['keyField'=>'id','valueField'=>'name'])->where(['status'=>1]);
        $this->loadModel('States');
        $states = $this->States->find('list',['keyField'=>'id','valueField'=>'name'])->where(['flag'=>1]);
        $this->loadModel('StartupStages');
        $startup_stages = $this->StartupStages->find('list',['keyField'=>'id','valueField'=>'startup_stage'])->where(['status'=>1]);
        
        $this->set(compact('application','nature_of_startup','industries','sectors','startup_categories','states','startup_stages','name','email','users'));

    }

    public function generateReferenceNo($id)
    {
        $string = '';
        $string.= 'HRS-';
        $string.= str_pad(($id), 4, 0, STR_PAD_LEFT);
        return $string;
    }

    public function getSectorList()
    {
        $this->viewBuilder()->layout('ajax');
        $industry_id = $_POST['industry_id'];
        $this->loadModel('Sectors');
        $sectorsResult = $this->Sectors->find('list',['keyField'=>'id','valueField'=>'name','conditions'=>['industry_id'=>$industry_id,'status'=>1]])->enableHydration(false)->toArray();
        $select = array('' =>'Select');
        $final  = array();
        foreach( $select as $key=>$each ){
            $final[$key]    = $each;
        }
        foreach( $sectorsResult as $key=>$each ){
            $final[$key]    = $each;
        }
        $this->set('district_list',$final);
    }
}
