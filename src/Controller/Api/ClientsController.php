<?php
namespace App\Controller\Api;

use App\Controller\Api\AppController;
use App\Error;
use Cake\Event\Event;
use Cake\Http\Exception\UnauthorizedException;
use Cake\Utility\Security;
use Firebase\JWT\JWT;
use Cake\Http\ServerRequest;
use Cake\I18n\Time;
use Cake\Routing\Router;
use Cake\Validation\Validator;
use Cake\Utility\Text;
use Cake\Network\Exception\NotFoundException;
use Cake\Datasource\Exception\RecordNotFoundException;
use Cake\Http\Exception\MethodNotAllowedException;

class ClientsController extends AppController
{
	public $dateFormat = 'Y-m-d';
    public $dateFormatFull = 'Y-m-d H:i:s';

    public function initialize()
    {
        parent::initialize();
        $this->loadModel('Users');
        $this->loadComponent('Sanitize');
        $this->loadComponent('Email');

        $this->Auth->allow(['requestedDrivers']);
    }

    public function beforeFilter(Event $event) {
        parent::beforeFilter($event); 
    }

    public function resourceRequest()
    {
        $this->request->allowMethod(['post']);
        try {
            $rdata = $this->request->getData();
            $rdata = $this->Sanitize->clean($rdata);
            $client_id = isset($rdata['client_id'])? $rdata['client_id']:'';
            $this->loadModel('JobLists');
            $postQuery = $this->JobLists->find()->where(['client_id'=>$client_id])->order(['id'=>'desc'])->toArray();
            $fileBaseUrl = Router::Url('/files/',true);
            $data=[];
            if (!empty($postQuery)) {
                foreach ($postQuery as $key => $value) {
                    $rValue['id']=$value->id;
                    $rValue['client_id']=$value->client_id;
                    $rValue['jobid']=$value->jobid;
                    $rValue['job_title']=$value->job_title;
                    $rValue['job_location']=$value->job_location;
                    $rValue['job_description']=$value->job_description;
                    $rValue['upload_document']=$fileBaseUrl.'new_request/'.$value->client_id.'/'.$value->upload_document;
                    $rValue['created']=$value->created;
                    $rValue['updated']=$value->updated;
                    $data[]=$rValue;
                }
            }
            $message = 'List of New Resource Request.';
            $status = true;
            $this->set(compact('message','status','data'));
            $this->set('_serialize', ['message', 'status','data']);
            
        } catch (Exception $e) {
            $message = 'Client not found';
            $status = false;
            $error = $e->getMessage();
            $this->set(compact('message','status','error'));
            $this->set('_serialize', ['message', 'status','error']);
        }
    }

    public function newResourceRequest()
    {
        $this->request->allowMethod(['post']);
        try {
            $this->loadModel('JobLists');            
            $lastVal = $this->JobLists->find()->select('id')->last();
            $lastId = isset($lastVal->id) && !empty($lastVal->id) ? ($lastVal->id+1) : 1;
            $newRequest = $this->JobLists->newEntity();
            if ($this->request->is(['patch', 'post', 'put'])) {
                $data = $this->request->getData();
                $data = $this->Sanitize->clean($data);
                $client_id = isset($data['client_id'])? $data['client_id']:'';
                $newRequest = $this->JobLists->patchEntity($newRequest, $data);
                if (isset($data['upload_document']) && !empty($data['upload_document'])) {
                    if($data['upload_document']['name']!=''){
                        $profileCv = $this->uploadFiles('new_request/'.$client_id, $data['upload_document']);
                        $newRequest->upload_document = $profileCv['filename'];
                    }
                }
                $jobId = "JOB".date('mdY').'-'.str_pad($lastId,6,'00000',STR_PAD_LEFT);
                $newRequest->jobid = $jobId;
                $newRequest->client_id = $client_id;
                $newRequest->created = date('Y-m-d H:i:s');
                $newRequest->updated = date('Y-m-d H:i:s');
                if ($this->JobLists->save($newRequest)) {
                    $message = 'Your new driver request has been saved successfully.';
                    $status = true;
                    $data = $newRequest;
                    $this->set(compact('message','status','data'));
                    $this->set('_serialize', ['message', 'status','data']);
                } else {
                    $message = 'Your new driver request could not be saved. Please, try again.';
                    $status = true;
                    $error = $newRequest->getErrors();
                    $this->set(compact('message','status','error'));
                    $this->set('_serialize', ['message', 'status','error']);
                }
            }
        } catch (Exception $e) {
            $message = 'Somthing went wrong.';
            $status = false;
            $error = $e->getMessage();
            $this->set(compact('message','status','error'));
            $this->set('_serialize', ['message', 'status','error']);
        }
    }

    public function requestedDriver()
    {
        $this->request->allowMethod(['get']);
        try {
            $this->loadModel('AssignDrivers');
            $search_condition = array();
            $client_id='';
            if (!empty($this->request->getQuery('client_id'))) {
              $client_id = trim($this->request->getQuery('client_id'));
            }
            if (!empty($client_id) && is_numeric($client_id)) {
                if (!empty($this->request->getQuery('driver_name'))) {
                  $driverName = trim($this->request->getQuery('driver_name'));
                  $search_condition[] = "Drivers.name like '%" . $driverName . "%'";
                }
                if (!empty($this->request->getQuery('driver_email'))) {
                  $driverEmail = trim($this->request->getQuery('driver_email'));
                  $search_condition[] = "Drivers.email like '%" . $driverEmail . "%'";
                }
                if (!empty($this->request->getQuery('mobile_number'))) {
                  $mobileNumber = trim($this->request->getQuery('mobile_number'));
                  $this->loadModel('UserProfiles');
                  $userPro = $this->UserProfiles->find()->select('user_id')->where(['mobile_number'=>$mobileNumber])->toArray();      
                  if (!empty($userPro)) {
                    $uuId=[];
                    foreach ($userPro as $key => $proValue) {
                      $uuId[]=$proValue->user_id;
                    }
                    $useId = implode(',', $uuId);
                    $search_condition[] = "Drivers.id IN ($useId)";
                  }
                }
                if (!empty($this->request->getQuery('driver_status'))) {
                  $driverStatus = trim($this->request->getQuery('driver_status'));
                  $search_condition[] = "AssignDrivers.status like '%" . $driverStatus . "%'";
                }
                if(!empty($search_condition)){
                    $searchString = implode(" AND ",$search_condition);
                } else {
                    $searchString = '';
                }
                $this->loadModel('JobLists');
                $requestDriver = $this->AssignDrivers->find('all')
                    ->contain(['Drivers.UserProfiles','JobLists'])
                    ->where(['JobLists.client_id'=>$client_id,$searchString])
                    ->toArray();
                $data = [];
                if (!empty($requestDriver)) {
                    foreach ($requestDriver as $key => $reqValue) {
                        $requestArr=[];
                        $requestArr['id']=$reqValue->id;
                        $requestArr['job_list_id']=$reqValue->job_list_id;
                        $requestArr['driver_id']=$reqValue->driver_id;
                        $requestArr['status']=$reqValue->status;
                        $requestArr['start_date']=isset($reqValue->start_date)? date('m-d-Y',strtotime($reqValue->start_date)):'';
                        $requestArr['end_date']=isset($reqValue->end_date)? date('m-d-Y',strtotime($reqValue->end_date)):'';
                        $requestArr['hire_rate']=$reqValue->hire_rate;
                        $requestArr['comments']=$reqValue->comments;
                        $requestArr['created']=date('m-d-Y H:i:s',strtotime($reqValue->created));
                        $jobListArr=[];
                        $jobListArr['id']=$reqValue->job_list->id;
                        $jobListArr['client_id']=$reqValue->job_list->client_id;
                        $jobListArr['jobid']=$reqValue->job_list->jobid;
                        $jobListArr['job_title']=$reqValue->job_list->job_title;
                        $jobListArr['job_location']=$reqValue->job_list->job_location;
                        $jobListArr['job_description']=$reqValue->job_list->job_description;
                        $jobListArr['upload_document']=isset($reqValue->job_list->upload_document)? Router::Url('/files/new_request/'.$reqValue->job_list->client_id.'/',true).$reqValue->job_list->upload_document:'';
                        $jobListArr['created']=date('m-d-Y H:i:s',strtotime($reqValue->job_list->created));
                        $jobListArr['updated']=date('m-d-Y H:i:s',strtotime($reqValue->job_list->updated));
                        $requestArr['job_list']=$jobListArr;
                        $driverArr=[];
                        $driverArr['id']=$reqValue->driver->id;
                        $driverArr['name']=$reqValue->driver->name;
                        $driverArr['email']=$reqValue->driver->email;
                        $driverArr['role_id']=$reqValue->driver->role_id;
                        $driverArr['status']=$reqValue->driver->status;
                        $driverArr['screening']=$reqValue->driver->screening;
                        $driverArr['stage_status']=$reqValue->driver->stage_status;
                        $driverArr['created']=date('m-d-Y H:i:s',strtotime($reqValue->driver->created));
                        $driverArr['modified']=date('m-d-Y H:i:s',strtotime($reqValue->driver->modified));
                        $userProfile=[];
                        $profileBaseUrl = Router::Url('/files/profiles/'.$reqValue->driver->id.'/',true);
                        $userProfile['id']=$reqValue->driver->user_profile->id;
                        $userProfile['user_id']=$reqValue->driver->user_profile->user_id;
                        $userProfile['date_of_birth']= date('m-d-Y',strtotime($reqValue->driver->user_profile->date_of_birth)) ?? '';
                        $userProfile['shortname']=$reqValue->driver->user_profile->shortname ?? '';
                        $userProfile['first_name']=$reqValue->driver->user_profile->first_name ?? '';
                        $userProfile['middle_name']=$reqValue->driver->user_profile->middle_name ?? '';
                        $userProfile['last_name']=$reqValue->driver->user_profile->last_name ?? '';
                        $userProfile['gender']=$reqValue->driver->user_profile->gender ?? '';
                        $userProfile['email']=$reqValue->driver->user_profile->email ?? '';
                        $userProfile['mobile_number']=$reqValue->driver->user_profile->mobile_number ?? '';
                        $userProfile['phone']=$reqValue->driver->user_profile->phone ?? '';
                        $userProfile['fax']=$reqValue->driver->user_profile->fax ?? '';
                        $userProfile['country']=$reqValue->driver->user_profile->country ?? '';
                        $userProfile['city_name']=$reqValue->driver->user_profile->city_name ?? '';
                        $userProfile['address']=$reqValue->driver->user_profile->address ?? '';
                        $userProfile['pincode']=$reqValue->driver->user_profile->pincode ?? '';
                        $userProfile['profile_photo']=isset($reqValue->driver->user_profile->profile_photo)? $profileBaseUrl.$reqValue->driver->user_profile->profile_photo:'';
                        $userProfile['user_video']=isset($reqValue->driver->user_profile->user_video)?$profileBaseUrl.'video/'.$reqValue->driver->user_profile->user_video :'';
                        $userProfile['user_cv']=isset($reqValue->driver->user_profile->user_cv)?$profileBaseUrl.'cv/'.$reqValue->driver->user_profile->user_cv : '';
                        $userProfile['driving_license']=isset($reqValue->driver->user_profile->driving_license)?$profileBaseUrl.'dl/'.$reqValue->driver->user_profile->driving_license :'';
                        $userProfile['driving_license_back']=isset($reqValue->driver->user_profile->driving_license_back)? $profileBaseUrl.'dl/'.$reqValue->driver->user_profile->driving_license_back :'';
                        $userProfile['national_insurance_number']=isset($reqValue->driver->user_profile->national_insurance_number)?$profileBaseUrl.'nin/'.$reqValue->driver->user_profile->national_insurance_number :'';
                        $userProfile['dbs_copy']=isset($reqValue->driver->user_profile->dbs_copy)?$profileBaseUrl.'dbs/'.$reqValue->driver->user_profile->dbs_copy :'';
                        $userProfile['address_proof']=isset($reqValue->driver->user_profile->address_proof)?$profileBaseUrl.'address/'.$reqValue->driver->user_profile->address_proof :'';
                        $userProfile['passport_copy']=isset($reqValue->driver->user_profile->passport_copy)? $profileBaseUrl.'passport/'.$reqValue->driver->user_profile->passport_copy : '';
                        $userProfile['passport_copy_back']=isset($reqValue->driver->user_profile->passport_copy_back)? $profileBaseUrl.'passport/'.$reqValue->driver->user_profile->passport_copy_back :'';
                        $userProfile['dvla_document']=isset($reqValue->driver->user_profile->dvla_document)? $profileBaseUrl.'dvla/'.$reqValue->driver->user_profile->dvla_document :'';
                        $userProfile['website']=$reqValue->driver->user_profile->website ?? '';
                        $userProfile['isApplicationRegistered'] = false;
                        $driverArr['user_profile']=$userProfile;
                        $requestArr['driver']=$driverArr;
                        $data[]=$requestArr;
                    }
                }

                $message = 'List of requested driver.';
                $status = true;
                //$data = $requestDriver;
                $this->set(compact('message','status','data'));
                $this->set('_serialize', ['message', 'status','data']);
            } else {
                $message = 'Client ID field is required.';
                $status = false;
                $this->set(compact('message','status'));
                $this->set('_serialize', ['message', 'status']);
            }            
        } catch (UnauthorizedException $e) {
            $message = 'Client not found';
            $status = false;
            $error = $e->getMessage();
            $this->set(compact('message','status','error'));
            $this->set('_serialize', ['message', 'status','error']);
        }
    }

    public function hireRejectDriver()
    {
        $this->request->allowMethod(['patch', 'post', 'put']);
        try {
            $this->loadModel('AssignDrivers');
            if ($this->request->is(['patch', 'post', 'put'])) {
                $data = $this->request->getData();
                $data = $this->Sanitize->clean($data);
                if (isset($data['assign_id']) && !empty($data['assign_id'])) {
                    $assignArr = $this->AssignDrivers->findById($data['assign_id'])->first();
                    if (empty($assignArr)) {
                        $message = 'Invalid Assign Id.';
                        $status = false;
                        $this->set(compact('message','status'));
                        $this->set('_serialize', ['message', 'status']);
                    } else {
                        $status   = isset($data['status']) ? $data['status']:'';
                        $startDate = isset($data['start_date']) ? $data['start_date'] :null;
                        $endDate  = isset($data['end_date']) ? $data['end_date'] :null;
                        $hireRate = isset($data['hire_rate']) ? $data['hire_rate']:null;
                        $setData  = ['start_date'=>$startDate,'end_date'=>$endDate,'hire_rate'=>$hireRate,'comments'=>$data['comments'],'status'=>$status];
                        $queryUpdate = $this->AssignDrivers->query();
                        $queryUpdate->update()
                            ->set($setData)
                            ->where(['id'=>$data['assign_id']])
                            ->execute();
                        if ($status=='allocated') {
                            $message = 'Driver has been allocated successfully.';
                            $status = true;
                            $this->set(compact('message','status'));
                            $this->set('_serialize', ['message', 'status']);
                        } elseif ($status=='rejected') {
                            $message = 'Driver has been rejected successfully.';
                            $status = true;
                            $this->set(compact('message','status'));
                            $this->set('_serialize', ['message', 'status']);
                        }
                    }
                } else {
                    $message = 'Assign Id is required.';
                    $status = false;
                    $this->set(compact('message','status'));
                    $this->set('_serialize', ['message', 'status']);
                }
            }
        } catch (Exception $e) {
            $message = 'Client not found';
            $status = false;
            $error = $e->getMessage();
            $this->set(compact('message','status','error'));
            $this->set('_serialize', ['message', 'status','error']);
        }
    }

    public function worksheets()
    {
        $this->request->allowMethod(['get']);
        try {
            $this->loadModel('Worksheets');            
            $search_condition = array();
            $client_id='';
            //pr($this->request->getQuery()); die;
            if (!empty($this->request->getQuery('client_id'))) {
              $client_id = trim($this->request->getQuery('client_id'));
            }
            if (!empty($client_id) && is_numeric($client_id)) {
                if (!empty($this->request->getQuery('job_list_id'))) {
                    $jobListId = trim($this->request->getQuery('job_list_id'));
                    $search_condition[] = "Worksheets.job_list_id = '" . $jobListId . "'";
                }
                if (!empty($this->request->getQuery('driver_id'))) {
                    $driverId = trim($this->request->getQuery('driver_id'));
                    $search_condition[] = "Worksheets.driver_id = '" . $driverId . "'";
                }
                if(!empty($search_condition)){
                    $searchString = implode(" AND ",$search_condition);
                } else {
                    $searchString = '';
                }
                $postQuery = $this->Worksheets->find('all')
                    ->contain(['JobLists','Drivers','WorksheetDetails'])
                    ->where([$searchString,'Worksheets.client_id'=>$client_id])
                    ->order(['Worksheets.id'=>'desc']);
                $data=[];
                if (!empty($postQuery)) {
                    foreach ($postQuery as $key => $postValue) {
                        $wValue=[];
                        $wValue['id'] = $postValue->id;
                        $wValue['jobid'] = $postValue->job_list->jobid;
                        $wValue['worksheetid'] = $postValue->worksheetid;
                        $wValue['driver_name'] = $postValue->driver->name;
                        $wValue['job_list_id'] = $postValue->job_list_id;
                        $wValue['driver_id'] = $postValue->driver_id;
                        $wValue['client_id'] = $postValue->client_id;
                        $wValue['from_date'] = date('m-d-Y',strtotime($postValue->from_date));
                        $wValue['to_date'] = date('m-d-Y',strtotime($postValue->to_date));
                        $wValue['created'] = date('m-d-Y H:i:s',strtotime($postValue->created));
                        $wValue['worksheet_details'] = $postValue->worksheet_details;
                        $data[]=$wValue;
                    }
                }

                $message = 'List of worksheets.';
                $status = true;
                //$data = $postQuery;
                $this->set(compact('message','status','data'));
                $this->set('_serialize', ['message', 'status','data']);

            } else {
                $message = 'Client ID field is required.';
                $status = false;
                $this->set(compact('message','status'));
                $this->set('_serialize', ['message', 'status']);
            }

        } catch (Exception $e) {
            $message = 'Client not found';
            $status = false;
            $error = $e->getMessage();
            $this->set(compact('message','status','error'));
            $this->set('_serialize', ['message', 'status','error']);
        }
    }

    public function worksheetJobs()
    {
        $this->request->allowMethod(['get']);
        $status = false;
        $message = '';
        $totalCounts = 0;
        try {
            $this->loadModel('Worksheets');
            $listArray = $this->Worksheets->find('all')->contain(['JobLists'])->toArray();
            if(empty($listArray)){
                $status = true;
                $message = 'Job not found.';
                $this->set(compact('status','message'));
                $this->set('_serialize', ['status','message']);
            }else{
                $job_list=[];                            
                $i=0; $uniquiArr=[];
                foreach ($listArray as $key => $listVal) {
                    if (in_array($listVal->job_list_id, $uniquiArr)) {
                        continue;
                    }
                    $job_list[$i]['id'] = $listVal->job_list_id;
                    $job_list[$i]['name'] = $listVal->job_list->jobid.' - '.$listVal->job_list->job_title;
                    $uniquiArr[]=$listVal->job_list_id;
                    $i++;
                }
                $status = true;
                $message = count($job_list)." job found";
                $this->set(compact('status','message','job_list'));
                $this->set('_serialize', ['status','message','job_list']);
            }
        } catch (Exception $e) {
            $message = 'Client not found';
            $status = false;
            $error = $e->getMessage();
            $this->set(compact('status','message','error'));
            $this->set('_serialize', ['status','message','error']);
        }
    }

    public function worksheetDrivers()
    {
        $this->request->allowMethod(['get']);
        $status = false;
        $message = '';
        $totalCounts = 0;
        try {
            $this->loadModel('Worksheets');
            $listArray = $this->Worksheets->find('all')->contain(['Drivers'])->toArray();
            if(empty($listArray)){
                $status = true;
                $message = 'Driver not found.';
                $this->set(compact('status','message'));
                $this->set('_serialize', ['status','message']);
            }else{
                $driver_list=[];                            
                $i=0; $uniquiArr=[];
                foreach ($listArray as $key => $listVal) {
                    if (in_array($listVal->driver_id, $uniquiArr)) {
                        continue;
                    }
                    $driver_list[$i]['id'] = $listVal->driver_id;
                    $driver_list[$i]['name'] = $listVal->driver->name;
                    $uniquiArr[] = $listVal->driver_id;
                    $i++;
                }
                $status = true;
                $message = count($driver_list)." driver found";
                $this->set(compact('status','message','driver_list'));
                $this->set('_serialize', ['status','message','driver_list']);
            }
        } catch (Exception $e) {
            $message = 'Client not found';
            $status = false;
            $error = $e->getMessage();
            $this->set(compact('status','message','error'));
            $this->set('_serialize', ['status','message','error']);
        }
    }

    public function createWorksheetJobs()
    {
        $this->request->allowMethod(['get']);
        $status = false;
        $message = '';
        $totalCounts = 0;
        try {
            $this->loadModel('JobLists');
            $jobs = $this->JobLists->find('all');
            $job_list=[];
            $i=0;
            foreach ($jobs as $key => $listVal) {
                $job_list[$i]['id'] = $listVal->id;
                $job_list[$i]['name'] = $listVal->jobid.' - '.$listVal->job_title;
                $i++;
            }
            $status = true;
            $message = count($job_list)." job found";
            $this->set(compact('status','message','job_list'));
            $this->set('_serialize', ['status','message','job_list']);
        } catch (Exception $e) {
            $message = 'Client not found';
            $status = false;
            $error = $e->getMessage();
            $this->set(compact('status','message','error'));
            $this->set('_serialize', ['status','message','error']);
        }
    }

    public function createWorksheetDrivers()
    {
        $this->request->allowMethod(['get']);
        $status = false;
        $message = '';
        try {
            $this->loadModel('AssignDrivers');
            $driverList = $this->AssignDrivers->find()
            ->contain(['Drivers'])
            ->where(['Drivers.role_id'=>'6','Drivers.screening'=>1,'AssignDrivers.status'=>'allocated'])->toArray();
            
            $driver_list=[];
            $i=0;

            foreach ($driverList as $key => $driverVal) {
                $driver_list[$i]['id'] = $driverVal->driver->id.'-'.$driverVal->id;
                $driver_list[$i]['name'] = $driverVal->driver->name;
                $i++;
            }
            $status = true;
            $message = count($driver_list)." job found";
            $this->set(compact('status','message','driver_list'));
            $this->set('_serialize', ['status','message','driver_list']);
        } catch (Exception $e) {
            $message = 'Client not found';
            $status = false;
            $error = $e->getMessage();
            $this->set(compact('status','message','error'));
            $this->set('_serialize', ['status','message','error']);
        }
    }

    public function createWorksheet()
    {
        try {
            if ($this->request->is('post')) {
                $rdata = $this->request->getData();
                $rdata = $this->Sanitize->clean($rdata);
                $client_id = isset($rdata['client_id'])?$rdata['client_id']:'';
                $search_condition = array();                
                if (!empty($client_id) && is_numeric($client_id)) {
                    $this->loadModel('Worksheets');
                    $this->loadModel('AssignDrivers');
                    $dateRange=[];
                    $jobId = isset($rdata['job_id'])?$rdata['job_id']:'';
                    $driverString = isset($rdata['driver_id'])?$rdata['driver_id']:'';
                    $fromDate = isset($rdata['from_date'])?$rdata['from_date']:'';
                    $toDate = isset($rdata['to_date'])?$rdata['to_date']:'';
                    $driverArr = explode('-', $driverString);
                    $driverId=$assignId=$fromValidDate=$toValidDate='';
                    if (!empty($driverArr)) {
                        $driverId = $driverArr[0];
                        $assignId = $driverArr[1];
                    }                    
                    if ($jobId && $driverId && $assignId) {
                        if (!empty($fromDate)) {
                            $fromValidDate = $this->validateDate($fromDate);
                        }
                        if ($fromValidDate) {
                            if (!empty($toDate)) {
                                $toValidDate = $this->validateDate($toDate);
                            }
                            if ($toValidDate) {
                                // Check if already worksheet generated
                                $generatedSheet = $this->Worksheets->find('all')
                                    ->where(['job_list_id'=>$jobId,'driver_id'=>$driverId,'client_id'=>$client_id])
                                    ->andWhere(function($exp) use($fromDate) {
                                        $exp->lte('Worksheets.from_date', $fromDate);
                                        $exp->gte('Worksheets.to_date', $fromDate);
                                        return $exp;
                                    })->toArray();
                                if (!empty($generatedSheet)) {
                                    $message = 'You have already generated worksheet for this date.';
                                    $status = false;
                                    $this->set(compact('message','status'));
                                    $this->set('_serialize', ['message', 'status']);
                                } else {
                                    $data['job_id']=$jobId;
                                    $data['driver_id']=$driverId;
                                    $data['client_id']=$client_id;
                                    $data['assign_id']=$assignId;
                                    $data['from_date']=$fromDate;
                                    $data['to_date']=$toDate;

                                    $dateRange = $this->getDatesFromRange($fromDate,$toDate);
                                    $data['date_range']=$dateRange;

                                    $status = true;
                                    $message = "Select working days.";
                                    $this->set(compact('status','message','data'));
                                    $this->set('_serialize', ['status','message','data']);
                                }                                
                            } else {
                                $message = 'Invalid to date.';
                                $status = false;
                                $this->set(compact('message','status'));
                                $this->set('_serialize', ['message', 'status']);
                            }                            
                        } else {
                            $message = 'Invalid from date.';
                            $status = false;
                            $this->set(compact('message','status'));
                            $this->set('_serialize', ['message', 'status']);
                        }                        
                    } else {
                        $message = 'Job ID or Driver Id is missing.';
                        $status = false;
                        $this->set(compact('message','status'));
                        $this->set('_serialize', ['message', 'status']);
                    }
                } else {
                    $message = 'Client ID field is required.';
                    $status = false;
                    $this->set(compact('message','status'));
                    $this->set('_serialize', ['message', 'status']);
                }
            }
        } catch (Exception $e) {
            $message = 'Somthing went wrong.';
            $status = false;
            $error = $e->getMessage();
            $this->set(compact('message','status','error'));
            $this->set('_serialize', ['message', 'status','error']);
        }
    }

    public function submitWorksheet()
    {
        try {
            $this->loadModel('Worksheets');
            $lastVal = $this->Worksheets->find()->select('id')->last();
            $lastId = isset($lastVal->id) && !empty($lastVal->id) ? ($lastVal->id+1) : 1;
            $worksheet = $this->Worksheets->newEntity();
            if($this->request->is('post')){
                $data = $this->request->getData();
                $data = $this->Sanitize->clean($data);
                $assignId = isset($data['assign_id'])?$data['assign_id']:'';
                $jobId = isset($data['job_id'])?$data['job_id']:'';
                $driverId = isset($data['driver_id'])?$data['driver_id']:'';
                $fromDate = isset($data['from_date'])?$data['from_date']:'';
                $toDate = isset($data['to_date'])?$data['to_date']:'';
                if (!empty($assignId) && !empty($jobId) && !empty($driverId) && !empty($fromDate) && !empty($toDate)) {
                    $work_detail = [];
                    if (isset($data['work_detail'])) {
                        $work_detail = $data['work_detail'];
                        unset($data['work_detail']);
                    }
                    $data['assign_driver_id'] = $assignId;
                    $data['job_list_id'] = $jobId;
                    $data['driver_id'] = $driverId;
                    $data['from_date'] = $fromDate;
                    $data['to_date'] = $toDate;
                    $data['remarks'] = $data['remarks'];
                    $worksheetId = "WS".date('y').'-'.str_pad($lastId,5,'00000',STR_PAD_LEFT);
                    $data['worksheetid'] = $worksheetId;
                    $worksheet = $this->Worksheets->patchEntity($worksheet, $data);
                    if ($this->Worksheets->save($worksheet)) {
                        $worksheet_id = $worksheet->id;
                        if (!empty($work_detail)) {
                            $this->loadModel('WorksheetDetails');
                            foreach ($work_detail as $key => $_workVal) {
                                if (empty($_workVal['worked'])) {
                                    $work_detail[$key]['worked']='no';
                                } else {
                                    $work_detail[$key]['worked']='yes';
                                }
                                $work_detail[$key]['work_date'] = $_workVal['work_date'];
                                $work_detail[$key]['worksheet_id'] = $worksheet_id;
                            }
                            $workDate  = $this->WorksheetDetails->newEntity();
                            $workDate  = $this->WorksheetDetails->patchEntities($workDate, $work_detail);
                            $workDates = $this->WorksheetDetails->saveMany($workDate);
                        }
                        $message = 'Worksheet has been created successfully.';
                        $status = true;
                        $this->set(compact('message','status'));
                        $this->set('_serialize', ['message', 'status']);
                    } else {
                        $message = 'Worksheet could not be created. Please, try again.';
                        $status = true;
                        $error = $worksheet->getErrors();
                        $this->set(compact('message','status','error'));
                        $this->set('_serialize', ['message', 'status','error']);
                    }
                } else {
                    $message = 'All parameter is required.';
                    $status = false;
                    $this->set(compact('message','status'));
                    $this->set('_serialize', ['message', 'status']);
                }
            }
        } catch (Exception $e) {
            $message = 'Somthing went wrong.';
            $status = false;
            $error = $e->getMessage();
            $this->set(compact('message','status','error'));
            $this->set('_serialize', ['message', 'status','error']);
        }
    }

    function validateDate($date)
    {
        if (preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",$date)) {
            return true;
        } else {
            return false;
        }
    }

    function getDatesFromRange($start, $end, $format = 'Y-m-d') 
    {
        $array = array();
        $interval = new \DateInterval('P1D');
        $realEnd = new \DateTime($end); 
        $realEnd->add($interval);
        $period = new \DatePeriod(new \DateTime($start), $interval, $realEnd);
        $i=0;
        foreach($period as $date) {
            $array[$i]['value'] = $date->format($format);
            $array[$i]['label'] = $date->format($format) .' ('.$date->format('l').')';
            $i++;    
        }
        return $array; 
    }

    public function invoices()
    {
        try {
            $this->loadModel('Worksheets');
            $search_condition = array();
            if (!empty($this->request->getQuery('jobid'))) {
                $jobid = trim($this->request->getQuery('jobid'));
                $search_condition[] = "JobLists.jobid like '%" . $jobid . "%'";
            }
            if (!empty($this->request->getQuery('driver_id'))) {
                $driverId = trim($this->request->getQuery('driver_id'));
                $search_condition[] = "Worksheets.driver_id = '" . $driverId . "'";
            }
            if (!empty($this->request->getQuery('worksheetid'))) {
                $worksheetid = trim($this->request->getQuery('worksheetid'));
                $search_condition[] = "Worksheets.worksheetid = '" . $worksheetid . "'";
            }
            if(!empty($search_condition)){
                $searchString = implode(" AND ",$search_condition);
            } else {
                $searchString = '';
            }
            $postQuery = $this->Worksheets->find('all')
                ->contain(['JobLists','Drivers'])
                ->where([$searchString,'invoice_number !='=>''])->order(['Worksheets.id'=>'desc'])
                ->toArray();
            $fileBaseUrl = Router::Url('/files/invoices/',true);
            $data=[];
            if (!empty($postQuery)) {
                foreach ($postQuery as $key => $value) {
                    $rValue = [];
                    $rValue['id']=$value->id;
                    $rValue['jobid']=$value->job_list->jobid;
                    $rValue['worksheetid']=$value->worksheetid;
                    $rValue['driver_name']=$value->driver->name;
                    $rValue['from_date']=date('m-d-Y',strtotime($value->from_date)) ;
                    $rValue['to_date']=date('m-d-Y',strtotime($value->to_date)) ;
                    $rValue['client_status']=ucfirst($value->client_status);
                    $rValue['invoice']=$fileBaseUrl.$value->invoice_name;
                    $rValue['invoice_number']=$value->invoice_number;
                    $data[] = $rValue;
                }
            }

            $message = 'List of invoices.';
            $status = true;
            //$data = $postQuery;
            $this->set(compact('message','status','data'));
            $this->set('_serialize', ['message', 'status','data']);

        } catch (Exception $e) {
            $message = 'Somthing went wrong.';
            $status = false;
            $error = $e->getMessage();
            $this->set(compact('status','message','error'));
            $this->set('_serialize', ['status','message','error']);
        }
    }

    public function invoicePaid()
    {
        $this->request->allowMethod(['patch', 'post', 'put']);
        try {            
            if ($this->request->is(['patch', 'post', 'put'])) {
                $data = $this->request->getData();
                $data = $this->Sanitize->clean($data);
                $worksheet_id = isset($data['worksheet_id'])?$data['worksheet_id']:'';
                $this->loadModel('Worksheets');
                if(!empty($worksheet_id) && is_numeric($worksheet_id)){
                    $worksheetArr = $this->Worksheets->findById($worksheet_id)->first();
                    if (empty($worksheetArr)) {
                        $message = 'Invalid worksheet Id.';
                        $status = false;
                        $this->set(compact('message','status'));
                        $this->set('_serialize', ['message', 'status']);
                    } else {
                        $newRequest = $this->Worksheets->get($worksheet_id);
                        $newRequest = $this->Worksheets->patchEntity($newRequest, $data);
                        $newRequest->client_status = $data['client_status'];
                        if ($this->Worksheets->save($newRequest)) {
                            $message = 'Your status has been changed.';
                            $status = true;
                            $this->set(compact('message','status'));
                            $this->set('_serialize', ['message', 'status']);
                        } else {
                            $message = 'Your status could not be changed. Please, try again.';
                            $status = true;
                            $error = $newRequest->getErrors();
                            $this->set(compact('message','status','error'));
                            $this->set('_serialize', ['message', 'status','error']);
                        }
                    }
                } else {
                    $message = 'Worksheet Id is required.';
                    $status = false;
                    $this->set(compact('message','status'));
                    $this->set('_serialize', ['message','status']);
                }
            }
        } catch (Exception $e) {
            $message = 'Somthing went wrong.';
            $status = false;
            $error = $e->getMessage();
            $this->set(compact('message','status','error'));
            $this->set('_serialize', ['message', 'status','error']);
        }
    }

    public function legalPolicy()
    {
        try {
            $this->loadModel('LegalPolicies');
            $policyData = $this->LegalPolicies->find()->where(['for_whom'=>'client','status'=>1])->first();
            if (empty($policyData)) {
                $message = 'Legal policy not found.';
                $status = true;
                $this->set(compact('message','status'));
                $this->set('_serialize', ['message', 'status']);
            } else {
                $message = 'Legal policy information.';
                $status = true;
                $dataArr['id'] = $policyData->id;
                $dataArr['title'] = $policyData->title;
                $dataArr['description'] = $policyData->description;
                $dataArr['for_whom'] = $policyData->for_whom;
                $baseUrl = Router::Url('/files/legalpolicy/',true);
                $dataArr['policy_document_first'] = $baseUrl.$policyData->user_id.'/'.$policyData->policy_document_fir;
                $dataArr['policy_document_second'] = $baseUrl.$policyData->user_id.'/'.$policyData->policy_document_sec;
                $dataArr['status'] = !empty($policyData->status)?'Active':'Inactive';
                $dataArr['created'] = $policyData->created;

                $data = $dataArr;
                $this->set(compact('message','status','data'));
                $this->set('_serialize', ['message', 'status','data']);
            }            
        } catch (Exception $e) {
            $message = 'Somthing went wrong.';
            $status = false;
            $error = $e->getMessage();
            $this->set(compact('message','status','error'));
            $this->set('_serialize', ['message', 'status','error']);
        }
    }

    public function uploadLegalPolicy()
    {
        try {
            $this->loadModel('LegalPolicies'); 
            $this->loadModel('LegalPolicyStatus');
            
            if ($this->request->is(['patch', 'post', 'put'])) {
                $data = $this->request->getData();
                $data = $this->Sanitize->clean($data);
                $client_id = isset($data['client_id'])?$data['client_id']:'';
                if (!empty($client_id) && is_numeric($client_id)) {
                    $policyStatusData = $this->LegalPolicyStatus->find()->where(['user_id'=>$client_id])->first();
                    if (empty($policyStatusData)) {
                        $policyStatus = $this->LegalPolicyStatus->newEntity();
                    } else {
                        $policyStatus = $this->LegalPolicyStatus->get($policyStatusData->id);
                    }
                    $policyStatus = $this->LegalPolicyStatus->patchEntity($policyStatus, $data);
                    $policyStatus->user_id = $client_id;
                    $policyStatus->status = 'pending';
                    if (isset($data['policy_document_first']) && !empty($data['policy_document_first'])) {
                        if($data['policy_document_first']['name']!=''){
                            $legalDoc1 = $this->uploadFiles('legalpolicy', $data['policy_document_first'],$client_id);
                            $policyStatus->policy_document = $legalDoc1['filename'];
                        }
                    }
                    if (isset($data['policy_document_second']) && !empty($data['policy_document_second'])) {
                        if($data['policy_document_second']['name']!=''){
                            $legalDoc2 = $this->uploadFiles('legalpolicy', $data['policy_document_second'],$client_id);
                            $policyStatus->policy_document_sec = $legalDoc2['filename'];
                        }
                    }
                    if ($this->LegalPolicyStatus->save($policyStatus)) {
                        $message = 'Legal policy has been updated successfully.';
                        $status = true;
                        $this->set(compact('message','status'));
                        $this->set('_serialize', ['message', 'status']);
                    } else {
                        $message = 'Legal policy could not be updated. Please, try again.';
                        $status = false;
                        $this->set(compact('message','status'));
                        $this->set('_serialize', ['message', 'status']);
                    }
                } else {
                    $message = 'Client id can not be null.';
                    $status = false;
                    $this->set(compact('message','status'));
                    $this->set('_serialize', ['message', 'status']);
                }                
            }
        } catch (Exception $e) {
            $message = 'Somthing went wrong.';
            $status = false;
            $error = $e->getMessage();
            $this->set(compact('message','status','error'));
            $this->set('_serialize', ['message', 'status','error']);
        }
        
    }

    public function dashboard()
    {
        $this->request->allowMethod(['get']);
        $status = false;
        $message = '';
        try {
            $search_condition = array();
            $client_id='';
            if (!empty($this->request->getQuery('client_id'))) {
              $client_id = trim($this->request->getQuery('client_id'));
            }
            if (!empty($client_id) && is_numeric($client_id)) {
                $this->loadModel('Worksheets');
                $this->loadModel('JobLists');
                // Get total job
                $totalJob = $this->JobLists->find()->where(['JobLists.client_id'=>$client_id])->count();
                // Total Driver Hired
                $totalDriverHired = $this->Worksheets->find('all')->where(['client_id'=>$client_id])->count();
                // Total Paid Invoices
                $totalPaidInvoices = $this->Worksheets->find('all')->where(['client_status'=>'paid'])->count();
                // Total Pending Invoices
                $totalPendingInvoices = $this->Worksheets->find('all')->where(['client_status'=>'pending'])->count();
                // Total Paid Invoices Amount
                $paidInvoicesAmount = $this->getPaidInvoicesAmount($client_id);
                // Pending Invoices Amount
                $pendingInvoicesAmount = $this->getPendingInvoicesAmount($client_id);

                $status = true;
                $message = "Dashboard data";
                $data = [
                    'total_job_post' => $totalJob,
                    'total_driver_hired' => $totalDriverHired,
                    'total_paid_invoices' => $totalPaidInvoices,
                    'total_pending_invoices' => $totalPendingInvoices,
                    'paid_invoices_amount' => $paidInvoicesAmount,
                    'pending_invoices_amount' => $pendingInvoicesAmount
                ];
                $this->set(compact('status','message','data'));
                $this->set('_serialize', ['status','message','data']);
            } else {
                $message = 'Client ID field is required.';
                $status = false;
                $this->set(compact('message','status'));
                $this->set('_serialize', ['message', 'status']);
            }            
        } catch (Exception $e) {
            $message = 'Client not found';
            $status = false;
            $error = $e->getMessage();
            $this->set(compact('status','message','error'));
            $this->set('_serialize', ['status','message','error']);
        }
    }

    public function getPendingInvoicesAmount($clientId)
    {
        $this->loadModel('Worksheets');
        $worksheetData = $this->Worksheets->find('all')
          ->contain(['AssignDrivers','WorksheetDetails'=>function($q){
              $q->select(['worksheet_id','dayscount'=> $q->func()->count('*')])->where(['WorksheetDetails.worked'=>'yes'])->group(['worksheet_id']);
              return $q;
            }
          ])
          ->where(['Worksheets.client_id'=>$clientId,'client_status'=>'pending'])->toArray();

        $income = 0;
        if (!empty($worksheetData)) {
          foreach ($worksheetData as $key => $wvalue) {
            $hireRate = $wvalue->assign_driver->hire_rate;
            $totalDays = 0;
            if (isset($wvalue->worksheet_details) && !empty($wvalue->worksheet_details)) {
              foreach ($wvalue->worksheet_details as $key => $detailValue) {
                $totalDays = $totalDays+$detailValue->dayscount;
              }
            }
            $income = $income+($hireRate*$totalDays);
          }
        }
        return $income;
    }

    public function getPaidInvoicesAmount($clientId)
    {
        $this->loadModel('Worksheets');
        $worksheetData = $this->Worksheets->find('all')
            ->contain(['AssignDrivers','WorksheetDetails'=>function($q){
                $q->select(['worksheet_id','dayscount'=> $q->func()->count('*')])->where(['WorksheetDetails.worked'=>'yes'])->group(['worksheet_id']);
                return $q;
                }
            ])
            ->where(['Worksheets.client_id'=>$clientId,'client_status'=>'paid'])->toArray();

        $income = 0;
        if (!empty($worksheetData)) {
            foreach ($worksheetData as $key => $wvalue) {
                $hireRate = $wvalue->assign_driver->hire_rate;
                $totalDays = 0;
                if (isset($wvalue->worksheet_details) && !empty($wvalue->worksheet_details)) {
                    foreach ($wvalue->worksheet_details as $key => $detailValue) {
                        $totalDays = $totalDays+$detailValue->dayscount;
                    }
                }
                $income = $income+($hireRate*$totalDays);
            }
        }
        return $income;
    }

}