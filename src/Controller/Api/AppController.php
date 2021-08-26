<?php
namespace App\Controller\Api;

use Cake\Controller\Controller;
use Cake\Event\Event;

class AppController extends Controller
{
    public function initialize()
    {
        parent::initialize();

        $this->viewBuilder()->autoLayout(false);
        $this->loadComponent('RequestHandler');
        $this->loadComponent('Email');
        $this->loadComponent('Auth', [
            'storage' => 'Memory',
            'authenticate' => [
                'Form' => [
                    'scope' => ['Users.status' => 1]
                ],
                'ADmad/JwtAuth.Jwt' => [
                    'parameter' => 'token',
                    'userModel' => 'Users',
                    'fields' => [
                        'username' => 'id'
                    ],
                    'queryDatasource' => true
                ]
            ],
            'unauthorizedRedirect' => false,
            'checkAuthIn' => 'Controller.initialize'
        ]);
    }

    public function beforeRender(Event $event)
    {
        $_ext = 'json';
        if (in_array($this->response->getType(), ['application/json', 'application/xml'])) {
            $_ext = ($this->response->getType() == 'application/json') ? "json" : "xml";
        } else if (in_array($this->request->getParam('_ext'), ['json', 'xml'])) {
            $_ext = $this->request->getParam('_ext');
        }
        $this->RequestHandler->renderAs($this, $_ext);

        if (!array_key_exists('_serialize', $this->viewVars) &&
            in_array($this->response->getType(), ['application/json', 'application/xml'])
        ) {
            $this->set('_serialize', true);
        }
    }

    /***
     * @param $folder
     * @param $file
     * @param $itemId
     *
     */
    public function uploadFiles($folder, $file, $itemId = null) {
        $folder_url = UPLOAD_FILE.$folder;
        $rel_url = $folder;
        if(!is_dir($folder_url)) {
            mkdir($folder_url);
        }
        if($itemId) {
            $folder_url = UPLOAD_FILE.$folder.'/'.$itemId;
            $rel_url = $folder.'/'.$itemId;
            if(!is_dir($folder_url)) {
                mkdir($folder_url);
            }
        }
        // list of permitted file types, this is only images but documents can be added
        $permitted = array('image/gif','image/jpeg','image/pjpeg','image/png','application/pdf','application/x-download','application/msword','application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'application/vnd.ms-powerpoint','application/vnd.ms-excel', 'application/vnd.openxmlformats-officedocument.presentationml.slideshow', 'application/vnd.openxmlformats-officedocument.presentationml.presentation','text/plain','application/zip','application/x-rar','application/x-rar-compressed','application/octet-stream','application/x-zip-compressed', 'multipart/x-zip','application/octet-stream','application/vnd.openxmlformats-officedocument.spreadsheetml.sheet','application/vnd.openxmlformats-officedocument.presentationml.presentation','video/mp4','video/ogg','video/3gp','video/mov');
        
        $filename = str_replace(array('\\','/',':','*','?','"','<','>','|','%20'),' ',$file['name']);
        $filename = str_replace(' ', '-', $filename);
        $filetempname = $file['tmp_name'];
        $finfo      = new \finfo(FILEINFO_MIME);
        $fres       = $finfo->file($filetempname);        
        $infoArr    = explode(';',$fres);        
        $invalidfile = substr_count($filename, ".");        
        if ($invalidfile>1) {
            $result['errors'] = "$filename cannot be uploaded. Invalid File. e.g. double dot.";
            return $result;
        } else if(!in_array($infoArr[0], $permitted)){
            $result['errors'] = "$filename cannot be uploaded. $infoArr[0] is not allowed.";
            return $result;
        } else if($infoArr[0] != $file['type']) {
            $result['errors'] = "$filename cannot be uploaded. Select correct file type.";
            return $result;
        } else if($file['error'] == 0) {
            switch($file['error']) {
                case 0:
                    if(!file_exists($folder_url.'/'.$filename)) {
                        $full_url = $folder_url.'/'.$filename;
                        $url = $rel_url.'/'.$filename;
                        $fileName = $filename;
                        $success = move_uploaded_file($file['tmp_name'], $full_url);
                    } else {
                        ini_set('date.timezone', 'Asia/Kolkata');
                        $now = date('Y-m-d-His');
                        $length     = 5;
                        $characters = '0123456789abcdefghijklmnopqrstuvwxyz';
                        $str_length = substr(str_shuffle($characters), 0, $length); 
                        $full_url = $folder_url.'/'.$now."-".$str_length."-".$filename;
                        $url = $rel_url.'/'.$now."-".$str_length."-".$filename;
                        $fileName = $now."-".$str_length."-".$filename;
                        $success = move_uploaded_file($file['tmp_name'], $full_url);
                    }
                    if($success) {
                        $result = [
                            'filename'=>$fileName,
                            'url'=> $url,
                            'type'=>$infoArr[0],
                            'size'=>$file['size']
                        ];
                    } else {
                        $result['errors'] = "Error uploaded $filename. Please try again.";
                    }
                    break;
                case 3:
                    $result['errors'] = "Error uploading $filename. Please try again.";
                    break;
                default:
                    $result['errors'] = "System error uploading $filename. Contact webmaster.";
                    break;
            }
        } elseif($file['error'] == 4) {
            $result['nofiles'] = "No file Selected";
        }else {
            $result['errors'] = "$filename cannot be uploaded. Only Image is allowed.";
        }
        return $result;
    }

}