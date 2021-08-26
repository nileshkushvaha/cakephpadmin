<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Core\Configure;
use Cake\Event\Event;
use Cake\Mailer\Email;
use Cake\Routing\Router;
use Cake\Network\Exception\NotFoundException;
use Cake\View\Exception\MissingTemplateException;

/**
 * OnlineEnquiry Controller
 *
 * @property \App\Model\Table\OnlineEnquiryTable $OnlineEnquiry
 *
 * @method \App\Model\Entity\OnlineEnquiry[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class FeedbackController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        $this->viewBuilder()->setLayout('frontend');
        $this->Auth->allow(['index','captcha']);        
        $this->loadComponent('CakephpCaptcha.Captcha');
    }

    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
    }

    /**
     * Page method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->loadModel('Complaints');
        $complaint = $this->Complaints->newEntity();
        if ($this->request->is('post')) {
            $data       = $this->request->getData();
            $errors = array();
            $captcha = $this->Captcha->check($data['captcha']);
            if (empty($captcha)) {
                $errors['captcha']['_empty'] = 'Invalid captcha. Please try again.';
            }
            if (empty($errors)) {                
                $complaint->created = date('Y-m-d H:i:s');
                $complaint          = $this->Complaints->patchEntity($complaint, $data);
                if ($this->Complaints->save($complaint)) {
                    $referenceNumber = "STARTUP/G/".date('Y')."/".date('m')."/".date('d')."/".str_pad($complaint['id'],8, '00000', STR_PAD_LEFT);
                    $queryUpdate = $this->Complaints->query();
                    $queryUpdate->update()
                        ->set(['reference_number' => $referenceNumber])
                        ->where(['id' => $complaint['id']])
                        ->execute();

                    $nemail = new Email('default');
                    $nemail->template('complaint');
                    $nemail->emailFormat('html');
                    $nemail->viewVars(['referenceNumber' => $referenceNumber]);
                    $nemail->viewVars(['emailData' => $complaint]);
                    $nemail->viewVars(['email' => $complaint['email_id']]);
                    $nemail->viewVars(['base_url' => Router::url('/', true)]);
                    $status = $nemail->to($complaint['email_id'])
                        //->addTo(WEBSUPPORT)
                        ->subject('Startup Haryana : Feedback')
                        ->send();
                    $adminEmail = new Email('default');
                    $adminEmail->template('complaint');
                    $adminEmail->emailFormat('html');
                    $adminEmail->viewVars(['referenceNumber' => $referenceNumber]);
                    $adminEmail->viewVars(['emailData' => $complaint]);
                    $adminEmail->viewVars(['email' => 'complaints@startup.in']);
                    $adminEmail->viewVars(['base_url' => Router::url('/', true)]);
                    $status = $adminEmail->to('complaints@startup.in')
                        ->subject('Startup Haryana : New Feedback')
                        ->send();
                    $this->Flash->success(__('The online enquiry has been submitted.'));

                    return $this->redirect(['action' => 'index']);
                }
                $this->Flash->error(__('The online enquiry could not be submitted. Please, try again.'));
            } else {
                $this->Flash->error(__('Invalid captcha. Please, try again.'));
            }
        }
        $this->set(compact('complaint'));
    }

    public function captcha()
    {
        $this->autoRender = false;
        echo $this->Captcha->image(5);
    }
}