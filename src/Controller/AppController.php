<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;

require_once(ROOT . DS . 'vendor' . DS . "setasign" . DS . "fpdf/fpdf.php");
require_once(ROOT . DS . 'vendor' . DS . "setasign" . DS . "fpdi/fpdi.php");


use Cake\Cache\Cache;
use Cake\Controller\Controller;
use Cake\Core\Configure;
use Cake\Event\Event;
use Cake\Routing\Router;
use Cake\Utility\Hash;
use App\View\Helper\SilverFormHelper;
use Cake\View\View;
use finfo;
use FPDI;
use Cake\Filesystem\Folder;

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link https://book.cakephp.org/3.0/en/controllers.html#the-app-controller
 */
class PDF extends FPDI {
    protected $_tplIdx;
    public function Header()
    {
        $this->SetY(0);
    }

    public function Footer(){
        $this->SetY(0);
    }
}


class AppController extends Controller
{
    public $isDevice = false;
    
    public $languages;
    
    public $SilverForm;
    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * e.g. `$this->loadComponent('Security');`
     *
     * @return void
     */ 
    public function initialize()
    {
        parent::initialize();

        $this->loadComponent('RequestHandler', [
            'enableBeforeRedirect' => false,
        ]);
        $this->loadComponent('Email');
        $this->loadComponent('Sanitize');
        $this->loadComponent('Flash', ['clear' => true]);
        $this->loadComponent('Paginator');
        $this->loadComponent('Csrf');
        $this->loadComponent('Auth', [
            /*'authenticate' => [
                'Form' => ['userModel' => 'Users',
                    'fields' => [
                        'username' => ['email','username'],
                        'password' => 'password'
                    ]
                ]
            ],*/
            'loginAction' => [
                'controller' => 'Users',
                'action' => 'login'
            ],
            'loginRedirect' => [
                'controller' => 'Dashboard',
                'action' => 'index'
            ],
            'logoutRedirect' => [
                'controller' => 'Users',
                'action' => 'login'
            ],
             // If unauthorized, return them to page they were just on
            'unauthorizedRedirect' => $this->referer(),

            'authorize'            => 'Controller',
            'flash'                => [
                'element' => 'error',
            ],
        ]);

        /*
         * Enable the following component for recommended CakePHP security settings.
         * see https://book.cakephp.org/3.0/en/controllers/components/security.html
         */
        //$this->loadComponent('Security');
        //$this->loadComponent('Csrf');       
    }

    public function beforeFilter(Event $event)
    {
        $routePattern = $this->request->getParam('_matchedRoute');
        if(preg_match('/^(\/)webapi/',$routePattern)) {
            $this->Auth->allow();
            $this->isDevice = true;
            $this->getEventManager()->off($this->Csrf);
        }
        
        $userArray = $this->Auth->user();
        $this->set('userArray',$userArray);
        if($this->isDevice) {
            $language = 'en';
            if ($this->request->getData('language')) {
                $language = $this->request->getData('language');
            } else if ($this->request->getQuery('language')) {
                $language = $this->request->getQuery('language');
            }
            if(isset($language)) {
                $this->request = $this->request->withParam('language', $language);
            }
        }
        $params = $this->request->getAttribute('params');
        //Get and Set Language
        $this->languages = Cache::read('site-language', 'languages');
        $langUrls        = [];
        if ($this->languages !== false) {
            $langParams = $params;
            unset($langParams['pass']);
            unset($langParams['_matchedRoute']);
            unset($langParams['_csrfToken']);
            $dLang = '';
            foreach ($this->languages as $language) {
                $culture                = $language['culture'];
                $langParams['language'] = $culture;
                $langUrls[$culture]     = Router::url($langParams, ['_full' => true]);
                if ($language['is_default'] == 1) {
                    $dLang = $culture;
                }
            }
            if (!isset($params['language']) && !empty($dLang) && isset($langUrls[$dLang])) {
                return $this->redirect($langUrls[$dLang]);
            }
            Configure::write('CurrentLanguageUrls', $langUrls);
        }

        $language = (isset($params['language'])) ? $params['language'] : '';
        $this->request->withParam('language', $language);

        //Get Language
        if ($this->languages !== false) {
            $setLanguages = Hash::combine($this->languages, '{n}.culture', '{n}');
            if (isset($setLanguages[$language])) {
                Configure::write('language', $setLanguages[$language]);
            }
        }
        $this->SilverForm = new SilverFormHelper(new View());

        parent::beforeFilter($event);
    }

    public function beforeRender(Event $event)
    {
        $this->set('Configure', new Configure);
        $this->set('languages', $this->languages);
        
        if($this->isDevice) {
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
        } else {
            $this->viewBuilder()->setClassName('App');
        }
    }

    public function isAuthorized($user = null)
    {
        //return (bool) ($user['role_id'] === 1);
        return true;
    }

    public function getCurrentLanguage($value='')
    {
        return new Configure;
    }

    
    /***
     * @param $folder
     * @param $file
     * @param $itemId
     *
     */
    public function uploadFiles($folder, $file, $itemId = null) 
    {
        $folder_url = UPLOAD_FILE.$folder;
        $rel_url = $folder;
        $folderObj = new Folder();
        if(!is_dir($folder_url)) {            
            $folderObj->create($folder_url);
        }
        if($itemId) {
            $folder_url = UPLOAD_FILE.$folder.'/'.$itemId;
            $rel_url = $folder.'/'.$itemId;
            if(!is_dir($folder_url)) {
                $folderObj->create($folder_url);
            }
        }
        // list of permitted file types, this is only images but documents can be added
        $permitted = array('image/gif','image/jpeg','image/pjpeg','image/png','application/pdf','application/x-download','application/msword','application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'application/vnd.ms-powerpoint','application/vnd.ms-excel', 'application/vnd.openxmlformats-officedocument.presentationml.slideshow', 'application/vnd.openxmlformats-officedocument.presentationml.presentation','text/plain','application/zip','application/x-rar','application/x-rar-compressed','application/octet-stream','application/x-zip-compressed', 'multipart/x-zip','application/octet-stream','application/vnd.openxmlformats-officedocument.spreadsheetml.sheet','application/vnd.openxmlformats-officedocument.presentationml.presentation','video/mp4','video/ogg','video/3gp','video/mov','video/quicktime');
        
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
