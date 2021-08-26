<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Core\Configure;
use Cake\Event\Event;
use Cake\I18n\Time;
use Cake\Network\Exception\NotFoundException;
use Cake\View\Exception\MissingTemplateException;

/**
 * Galleries Controller
 *
 */
class GalleriesController extends AppController {

    public function initialize() {
        parent::initialize();
        $this->viewBuilder()->setLayout('frontend');
        $this->Auth->allow(['index', 'videos', 'photos']);
    }

    public function beforeFilter(Event $event) {
        parent::beforeFilter($event);
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index() {
        
    }

    public function videos() {
        $this->set('title', 'Video Gallery');
        $this->loadModel('VideoGalleries');
        $search_condition = array();
        if($this->request->is('post')) {
            if (!empty($this->request->data['title'])) {
                $title1 = trim($this->request->data['title']);
                $this->set('title1', $title1);
                $search_condition[] = "VideoGalleries.title like '%" . $title1 . "%'";
            }            
            if (!empty($this->request->data['gallery_category_id'])) {
                $gallery_category_id = trim($this->request->data['gallery_category_id']);
                $this->set('gallery_category_id', $gallery_category_id);
                $search_condition[] = "VideoGalleries.gallery_category_id like '%" . $gallery_category_id . "%'";
            }            
            if (!empty($this->request->data['fromdate'])) {
                $date_from = Time::parse($this->request->data['fromdate']);                 
                $start_date = $date_from->i18nFormat('yyyy-MM-dd HH:mm:ss'); 
                $this->set('fromdate', $start_date);
                $search_condition[] = "DATE(VideoGalleries.created) >= '" . $start_date . "'";
            }            
            if (!empty($this->request->data['todate'])) {                
                $date_to = Time::parse($this->request->data['todate']);              
                $date_to = $date_to->i18nFormat('yyyy-MM-dd HH:mm:ss');
                $this->set('todate', $date_to);                
                $search_condition[] = "DATE(VideoGalleries.created) <= '" . $date_to . "'";
            }            
        }
        $searchString = implode(' AND ', $search_condition);
        $gal_photos = $this->VideoGalleries->find('all', ['conditions' => [$searchString,'status'=>1]]);
        $galleryCategories = $this->VideoGalleries->VideoCategories->find('list', ['limit' => 200]);
		$this->paginate = ['limit' => 12];
        $gal_photos = $this->paginate($gal_photos);
        $this->set(compact('gal_photos','galleryCategories'));        
    }

    public function photos() {
        $this->set('title', 'Photo Gallery');
        $this->loadModel('Galleries');
        $search_condition = array();        
        if($this->request->is('post')) {
            if (!empty($this->request->data['title'])) {
                $title1 = trim($this->request->data['title']);
                $this->set('title1', $title1);
                $search_condition[] = "Galleries.title like '%" . $title1 . "%'";
            }
            if (!empty($this->request->data['gallery_category_id'])) {
                $gallery_category_id = trim($this->request->data['gallery_category_id']);
                $this->set('gallery_category_id', $gallery_category_id);
                $search_condition[] = "Galleries.gallery_category_id like '%" . $gallery_category_id . "%'";
            }                        
            if (!empty($this->request->data['fromdate'])) {
                $date_from = Time::parse($this->request->data['fromdate']);                 
                $start_date = $date_from->i18nFormat('yyyy-MM-dd HH:mm:ss'); 
                $this->set('fromdate', $start_date);
                $search_condition[] = "DATE(Galleries.created) >= '" . $start_date . "'";
            }            
            if (!empty($this->request->data['todate'])) {                
                $date_to = Time::parse($this->request->data['todate']);              
                $date_to = $date_to->i18nFormat('yyyy-MM-dd HH:mm:ss');
                $this->set('todate', $date_to);                
                $search_condition[] = "DATE(Galleries.created) <= '" . $date_to . "'";
            }
        }
        $searchString = implode(' AND ', $search_condition);        
        $gal_photos = $this->Galleries->find('all', ['conditions' => [$searchString,'status'=>1]]);
        $galleryCategories = $this->Galleries->GalleryCategories->find('list', ['limit' => 200]);
        $this->set('galleryCategories', $galleryCategories);
		$this->paginate = ['limit' => 12];
        $gal_photos = $this->paginate($gal_photos);
        $this->set('gal_photos', $gal_photos);
    }

}
