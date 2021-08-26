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

class DriversController extends AppController
{
	public $dateFormat = 'Y-m-d';
    public $dateFormatFull = 'Y-m-d H:i:s';

    public function initialize()
    {
        parent::initialize();
        $this->loadModel('Users');
        $this->loadComponent('Sanitize');
        $this->loadComponent('Email');

        $this->Auth->allow(['login','registration','validateOtp']);
    }

    public function beforeFilter(Event $event) {
        parent::beforeFilter($event); 
    }

    public function uploadDocuments()
    {
        $this->request->allowMethod(['patch', 'post', 'put']);
        try {
            if ($this->request->is(['patch', 'post', 'put'])) {
                $data = $this->request->getData();
                $data = $this->Sanitize->clean($data);
                //pr($data); die;
                $user_id = isset($data['user_id'])?trim($data['user_id']):'';
                $file_type = isset($data['file_type'])?trim($data['file_type']):'';                
                $user_file = isset($data['user_file'])?$data['user_file']:array();

                if (!empty($user_id) && is_numeric($user_id) && !empty($file_type) && !empty($user_file)) {
                    if($user_file['name']!=''){                    
                        $profileBaseUrl = Router::Url('/files/',true);
                        $allowed = array('pdf','docx','doc');
                        $ext = pathinfo($user_file['name'], PATHINFO_EXTENSION);
                        if (in_array($ext, $allowed)) {
                            $this->loadModel('UserProfiles');
                            $UserExist = $this->Users->findById($user_id)->first();
                            if (!empty($UserExist)) {
                                $profileData = $this->UserProfiles->find()->where(['user_id'=>$user_id])->first();
                                if (empty($profileData)) {
                                    $profile = $this->UserProfiles->newEntity();
                                } else {
                                    $profile = $this->UserProfiles->get($profileData->id);
                                }
                                switch ($file_type) {
                                    case 'cv':
                                        $userFiles = $this->uploadFiles('profiles/'.$user_id, $user_file,'cv');
                                        if (isset($userFiles['errors']) && !empty($userFiles['errors'])) {
                                            $message = $userFiles['errors'];
                                            $status = false;
                                            $this->set(compact('message','status'));
                                            $this->set('_serialize', ['message', 'status']);
                                        } else {                                    
                                            $profile->user_cv = $userFiles['filename'];
                                            $profile->user_id = $user_id;
                                            if ($this->UserProfiles->save($profile)) {
                                                $message = 'Your CV has been uploaded successfully.';
                                                $status = true;
                                                $data = [
                                                    'user_id'=>$user_id,
                                                    'photo_file_name'=>$userFiles['filename'],
                                                    'photo_url'=>$userFiles['url'],
                                                    'photo_full_url'=>$profileBaseUrl.$userFiles['url']
                                                ];
                                                $this->set(compact('message','status','data'));
                                                $this->set('_serialize', ['message', 'status','data']);
                                            } else {
                                                $message = 'Your CV could not be uploaded. Please try again';
                                                $status = false;
                                                $this->set(compact('message','status'));
                                                $this->set('_serialize', ['message', 'status']);
                                            }
                                        }
                                        break;
                                    case 'dl':
                                        $userFiles = $this->uploadFiles('profiles/'.$user_id, $user_file,'dl');
                                        if (isset($userFiles['errors']) && !empty($userFiles['errors'])) {
                                            $message = $userFiles['errors'];
                                            $status = false;
                                            $this->set(compact('message','status'));
                                            $this->set('_serialize', ['message', 'status']);
                                        } else {
                                            $profile->driving_license = $userFiles['filename'];
                                            $profile->user_id = $user_id;
                                            if ($this->UserProfiles->save($profile)) {
                                                $message = 'Your driving license has been uploaded successfully.';
                                                $status = true;
                                                $data = [
                                                    'user_id'=>$user_id,
                                                    'photo_file_name'=>$userFiles['filename'],
                                                    'photo_url'=>$userFiles['url'],
                                                    'photo_full_url'=>$profileBaseUrl.$userFiles['url']
                                                ];
                                                $this->set(compact('message','status','data'));
                                                $this->set('_serialize', ['message', 'status','data']);
                                            } else {
                                                $message = 'Your driving license could not be uploaded. Please try again';
                                                $status = false;
                                                $this->set(compact('message','status'));
                                                $this->set('_serialize', ['message', 'status']);
                                            }
                                        }
                                        break;

                                    case 'dl2':
                                        $userFiles = $this->uploadFiles('profiles/'.$user_id, $user_file,'dl');
                                        if (isset($userFiles['errors']) && !empty($userFiles['errors'])) {
                                            $message = $userFiles['errors'];
                                            $status = false;
                                            $this->set(compact('message','status'));
                                            $this->set('_serialize', ['message', 'status']);
                                        } else {
                                            $profile->driving_license_back = $userFiles['filename'];
                                            $profile->user_id = $user_id;
                                            if ($this->UserProfiles->save($profile)) {
                                                $message = 'Your driving license has been uploaded successfully.';
                                                $status = true;
                                                $data = [
                                                    'user_id'=>$user_id,
                                                    'photo_file_name'=>$userFiles['filename'],
                                                    'photo_url'=>$userFiles['url'],
                                                    'photo_full_url'=>$profileBaseUrl.$userFiles['url']
                                                ];
                                                $this->set(compact('message','status','data'));
                                                $this->set('_serialize', ['message', 'status','data']);
                                            } else {
                                                $message = 'Your driving license could not be uploaded. Please try again';
                                                $status = false;
                                                $this->set(compact('message','status'));
                                                $this->set('_serialize', ['message', 'status']);
                                            }
                                        }
                                        break;

                                    case 'nin':
                                        $userFiles = $this->uploadFiles('profiles/'.$user_id, $user_file,'nin');
                                        if (isset($userFiles['errors']) && !empty($userFiles['errors'])) {
                                            $message = $userFiles['errors'];
                                            $status = false;
                                            $this->set(compact('message','status'));
                                            $this->set('_serialize', ['message', 'status']);
                                        } else {
                                            $profile->national_insurance_number = $userFiles['filename'];
                                            $profile->user_id = $user_id;
                                            if ($this->UserProfiles->save($profile)) {
                                                $message = 'National insurance number has been uploaded successfully.';
                                                $status = true;
                                                $data = [
                                                    'user_id'=>$user_id,
                                                    'photo_file_name'=>$userFiles['filename'],
                                                    'photo_url'=>$userFiles['url'],
                                                    'photo_full_url'=>$profileBaseUrl.$userFiles['url']
                                                ];
                                                $this->set(compact('message','status','data'));
                                                $this->set('_serialize', ['message', 'status','data']);
                                            } else {
                                                $message = 'National insurance number could not be uploaded. Please try again';
                                                $status = false;
                                                $this->set(compact('message','status'));
                                                $this->set('_serialize', ['message', 'status']);
                                            }
                                        }
                                        break;

                                    case 'dbs':
                                        $userFiles = $this->uploadFiles('profiles/'.$user_id, $user_file,'dbs');
                                        if (isset($userFiles['errors']) && !empty($userFiles['errors'])) {
                                            $message = $userFiles['errors'];
                                            $status = false;
                                            $this->set(compact('message','status'));
                                            $this->set('_serialize', ['message', 'status']);
                                        } else {
                                            $profile->dbs_copy = $userFiles['filename'];
                                            $profile->user_id = $user_id;
                                            if ($this->UserProfiles->save($profile)) {
                                                $message = 'Your DBS copy has been uploaded successfully.';
                                                $status = true;
                                                $data = [
                                                    'user_id'=>$user_id,
                                                    'photo_file_name'=>$userFiles['filename'],
                                                    'photo_url'=>$userFiles['url'],
                                                    'photo_full_url'=>$profileBaseUrl.$userFiles['url']
                                                ];
                                                $this->set(compact('message','status','data'));
                                                $this->set('_serialize', ['message', 'status','data']);
                                            } else {
                                                $message = 'Your DBS copy could not be uploaded. Please try again';
                                                $status = false;
                                                $this->set(compact('message','status'));
                                                $this->set('_serialize', ['message', 'status']);
                                            }
                                        }
                                        break;

                                    case 'address':
                                        $userFiles = $this->uploadFiles('profiles/'.$user_id, $user_file,'address');
                                        if (isset($userFiles['errors']) && !empty($userFiles['errors'])) {
                                            $message = $userFiles['errors'];
                                            $status = false;
                                            $this->set(compact('message','status'));
                                            $this->set('_serialize', ['message', 'status']);
                                        } else {
                                            $profile->address_proof = $userFiles['filename'];
                                            $profile->user_id = $user_id;
                                            if ($this->UserProfiles->save($profile)) {
                                                $message = 'Your address proof has been uploaded successfully.';
                                                $status = true;
                                                $data = [
                                                    'user_id'=>$user_id,
                                                    'photo_file_name'=>$userFiles['filename'],
                                                    'photo_url'=>$userFiles['url'],
                                                    'photo_full_url'=>$profileBaseUrl.$userFiles['url']
                                                ];
                                                $this->set(compact('message','status','data'));
                                                $this->set('_serialize', ['message', 'status','data']);
                                            } else {
                                                $message = 'Your address proof could not be uploaded. Please try again';
                                                $status = false;
                                                $this->set(compact('message','status'));
                                                $this->set('_serialize', ['message', 'status']);
                                            }
                                        }
                                        break;

                                    case 'passport':
                                        $userFiles = $this->uploadFiles('profiles/'.$user_id, $user_file,'passport');
                                        if (isset($userFiles['errors']) && !empty($userFiles['errors'])) {
                                            $message = $userFiles['errors'];
                                            $status = false;
                                            $this->set(compact('message','status'));
                                            $this->set('_serialize', ['message', 'status']);
                                        } else {
                                            $profile->passport_copy = $userFiles['filename'];
                                            $profile->user_id = $user_id;
                                            if ($this->UserProfiles->save($profile)) {
                                                $message = 'Your passport has been uploaded successfully.';
                                                $status = true;
                                                $data = [
                                                    'user_id'=>$user_id,
                                                    'photo_file_name'=>$userFiles['filename'],
                                                    'photo_url'=>$userFiles['url'],
                                                    'photo_full_url'=>$profileBaseUrl.$userFiles['url']
                                                ];
                                                $this->set(compact('message','status','data'));
                                                $this->set('_serialize', ['message', 'status','data']);
                                            } else {
                                                $message = 'Your passport could not be uploaded. Please try again';
                                                $status = false;
                                                $this->set(compact('message','status'));
                                                $this->set('_serialize', ['message', 'status']);
                                            }
                                        }
                                        break;

                                    case 'passport2':
                                        $userFiles = $this->uploadFiles('profiles/'.$user_id, $user_file,'passport');
                                        if (isset($userFiles['errors']) && !empty($userFiles['errors'])) {
                                            $message = $userFiles['errors'];
                                            $status = false;
                                            $this->set(compact('message','status'));
                                            $this->set('_serialize', ['message', 'status']);
                                        } else {
                                            $profile->passport_copy_back = $userFiles['filename'];
                                            $profile->user_id = $user_id;
                                            if ($this->UserProfiles->save($profile)) {
                                                $message = 'Your passport has been uploaded successfully.';
                                                $status = true;
                                                $data = [
                                                    'user_id'=>$user_id,
                                                    'photo_file_name'=>$userFiles['filename'],
                                                    'photo_url'=>$userFiles['url'],
                                                    'photo_full_url'=>$profileBaseUrl.$userFiles['url']
                                                ];
                                                $this->set(compact('message','status','data'));
                                                $this->set('_serialize', ['message', 'status','data']);
                                            } else {
                                                $message = 'Your passport could not be uploaded. Please try again';
                                                $status = false;
                                                $this->set(compact('message','status'));
                                                $this->set('_serialize', ['message', 'status']);
                                            }
                                        }
                                        break;

                                    case 'dvla':
                                        $userFiles = $this->uploadFiles('profiles/'.$user_id, $user_file,'dvla');
                                        if (isset($userFiles['errors']) && !empty($userFiles['errors'])) {
                                            $message = $userFiles['errors'];
                                            $status = false;
                                            $this->set(compact('message','status'));
                                            $this->set('_serialize', ['message', 'status']);
                                        } else {
                                            $profile->dvla_document = $userFiles['filename'];
                                            $profile->user_id = $user_id;
                                            if ($this->UserProfiles->save($profile)) {
                                                $message = 'Your DVLA has been uploaded successfully.';
                                                $status = true;
                                                $data = [
                                                    'user_id'=>$user_id,
                                                    'photo_file_name'=>$userFiles['filename'],
                                                    'photo_url'=>$userFiles['url'],
                                                    'photo_full_url'=>$profileBaseUrl.$userFiles['url']
                                                ];
                                                $this->set(compact('message','status','data'));
                                                $this->set('_serialize', ['message', 'status','data']);
                                            } else {
                                                $message = 'Your DVLA could not be uploaded. Please try again';
                                                $status = false;
                                                $this->set(compact('message','status'));
                                                $this->set('_serialize', ['message', 'status']);
                                            }
                                        }
                                        break;

                                    default:
                                        $message = 'File type is not define.';
                                        $status = false;
                                        $this->set(compact('message','status'));
                                        $this->set('_serialize', ['message', 'status']);
                                        break;
                                }                                
                            } else {
                                $message = 'User does not exist!';
                                $status = false;
                                $this->set(compact('message','status'));
                                $this->set('_serialize', ['message', 'status']);
                            } 
                        } else {
                            $message = 'File extension not allowed.';                                
                            $status = false;
                            $this->set(compact('message','status'));
                            $this->set('_serialize', ['message', 'status']);
                        }
                    } else {                        
                        $message = 'Please select file.';
                        $status = false;
                        $this->set(compact('message','status'));
                        $this->set('_serialize', ['message', 'status']);
                    }
                } else {
                    $message = 'User Id or file or file type is missing.';
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

    public function worksheets()
    {
        $this->request->allowMethod(['get']);
        try {
            $this->loadModel('Worksheets');            
            $search_condition = array();
            $driver_id='';
            if (!empty($this->request->getQuery('driver_id'))) {
              $driver_id = trim($this->request->getQuery('driver_id'));
            }
            if (!empty($driver_id) && is_numeric($driver_id)) {
                $search_condition = array();
                if (!empty($this->request->getQuery('job_list_id'))) {
                    $jobListId = trim($this->request->getQuery('job_list_id'));
                    $search_condition[] = "Worksheets.job_list_id = '" . $jobListId . "'";
                }
                if(!empty($search_condition)){
                    $searchString = implode(" AND ",$search_condition);
                } else {
                    $searchString = '';
                }
                $postQuery = $this->Worksheets->find('all')
                    ->contain(['JobLists','Clients','WorksheetDetails'])
                    ->where([$searchString,'Worksheets.driver_id'=>$driver_id])
                    ->order(['Worksheets.id'=>'desc'])
                    ->toArray();

                $data=[];
                if (!empty($postQuery)) {
                    foreach ($postQuery as $key => $value) {
                        $rValue=[];
                        $rValue['id']=$value->id;
                        $rValue['worksheetid']=$value->worksheetid;
                        $rValue['driver_id']=$value->driver_id;
                        $rValue['from_date']=date('m-d-Y',strtotime($value->from_date));
                        $rValue['to_date']=date('m-d-Y',strtotime($value->to_date));
                        $rValue['client_name']=$value->client->name;
                        $rValue['job_list']=$value->job_list->jobid;
                        $link = Router::Url(['prefix'=>false,'controller'=>'Worksheets','action'=>'paySlip',base64_encode($value->id)], ['fullBase' => true]);
                        $rValue['payslip']=$link;
                        $rValue['worksheet_details']=$value->worksheet_details;
                        $data[]=$rValue;
                    }
                }
                $message = 'List of worksheets.';
                $status = true;
                $this->set(compact('message','status','data'));
                $this->set('_serialize', ['message', 'status','data']);
            } else {
                $message = 'Driver ID field is required.';
                $status = false;
                $this->set(compact('message','status'));
                $this->set('_serialize', ['message', 'status']);
            }
        } catch (Exception $e) {
            $message = 'Somthing went wrong.';
            $status = false;
            $error = $e->getMessage();
            $this->set(compact('message','status','error'));
            $this->set('_serialize', ['message', 'status','error']);
        }
    }

    public function recruitments()
    {
        $this->request->allowMethod(['get']);
        try {
            $this->loadModel('Worksheets');
            $driver_id='';
            if (!empty($this->request->getQuery('driver_id'))) {
              $driver_id = trim($this->request->getQuery('driver_id'));
            }
            if (!empty($driver_id) && is_numeric($driver_id)) {
                $search_condition = array();
                if (!empty($this->request->getQuery('job_list_id'))) {
                    $jobListId = trim($this->request->getQuery('job_list_id'));
                    $search_condition[] = "Worksheets.job_list_id = '" . $jobListId . "'";
                }
                if (!empty($this->request->getQuery('client_id'))) {
                    $clientId = trim($this->request->getQuery('client_id'));
                    $search_condition[] = "Worksheets.client_id = '" . $clientId . "'";
                }
                if(!empty($search_condition)){
                    $searchString = implode(" AND ",$search_condition);
                } else {
                    $searchString = '';
                }
                $postQuery = $this->Worksheets->find('all')
                    ->contain(['JobLists','Clients.UserProfiles','AssignDrivers'])
                    ->where([$searchString,'Worksheets.driver_id'=>$driver_id,'AssignDrivers.status'=>'allocated'])
                    ->order(['Worksheets.id'=>'desc'])
                    ->toArray();

                $message = 'List of recruitment information.';
                $status = true;
                $data = $postQuery;
                $this->set(compact('message','status','data'));
                $this->set('_serialize', ['message', 'status','data']);

            } else {
                $message = 'Driver ID field is required.';
                $status = false;
                $this->set(compact('message','status'));
                $this->set('_serialize', ['message', 'status']);
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
            $policyData = $this->LegalPolicies->find()->where(['for_whom'=>'driver','status'=>1])->first();
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
                $driver_id = isset($data['driver_id'])?$data['driver_id']:'';
                if (!empty($driver_id) && is_numeric($driver_id)) {
                    $policyStatusData = $this->LegalPolicyStatus->find()->where(['user_id'=>$driver_id])->first();
                    if (empty($policyStatusData)) {
                        $policyStatus = $this->LegalPolicyStatus->newEntity();
                    } else {
                        $policyStatus = $this->LegalPolicyStatus->get($policyStatusData->id);
                    }
                    $policyStatus = $this->LegalPolicyStatus->patchEntity($policyStatus, $data);
                    $policyStatus->user_id = $driver_id;
                    $policyStatus->status = 'pending';
                    if (isset($data['policy_document_first']) && !empty($data['policy_document_first'])) {
                        if($data['policy_document_first']['name']!=''){
                            $legalDoc1 = $this->uploadFiles('legalpolicy', $data['policy_document_first'],$driver_id);
                            $policyStatus->policy_document = $legalDoc1['filename'];
                        }
                    }
                    if (isset($data['policy_document_second']) && !empty($data['policy_document_second'])) {
                        if($data['policy_document_second']['name']!=''){
                            $legalDoc2 = $this->uploadFiles('legalpolicy', $data['policy_document_second'],$driver_id);
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
                    $message = 'Driver id can not be null.';
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
        $driver_id='';
        if (!empty($this->request->getQuery('driver_id'))) {
          $driver_id = trim($this->request->getQuery('driver_id'));
        }
        if (!empty($driver_id) && is_numeric($driver_id)) {
            $this->loadModel('Worksheets');
            $this->loadModel('AssignDrivers');
            // Get Total Income
            $totalIncome = $this->getDriverTotalIncome($driver_id);
            // Get total hired by client
            $totalHired = $this->AssignDrivers->find('all')->contain(['JobLists'])->where(['AssignDrivers.driver_id'=>$driver_id,'AssignDrivers.status IN'=>['allocated','unallocated'] ])->count();
            // Total worksheet
            $totalWorksheet = $this->Worksheets->find('all')->where(['Worksheets.driver_id'=>$driver_id])->count();

            $status = true;
            $message = "Driver dashboard data";
            $data = [
                'total_income' => $totalIncome,
                'total_hired_client' => $totalHired,
                'total_worksheets' => $totalWorksheet
            ];
            $this->set(compact('status','message','data'));
            $this->set('_serialize', ['status','message','data']);
        } else {
            $message = 'Driver ID field is required.';
            $status = false;
            $this->set(compact('message','status'));
            $this->set('_serialize', ['message', 'status']);
        }            
    } catch (Exception $e) {
        $message = 'Driver not found';
        $status = false;
        $error = $e->getMessage();
        $this->set(compact('status','message','error'));
        $this->set('_serialize', ['status','message','error']);
    }
  }

  public function getDriverTotalIncome($driver_id)
  {
    $this->loadModel('Worksheets');
    $worksheetData = $this->Worksheets->find('all')
      ->contain(['AssignDrivers','WorksheetDetails'=>function($q){
          $q->select(['worksheet_id','dayscount'=> $q->func()->count('*')])->where(['WorksheetDetails.worked'=>'yes'])->group(['worksheet_id']);
          return $q;
        }
      ])
      ->where(['Worksheets.driver_id'=>$driver_id])->toArray();

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