<?php
/**
 * Created by PhpStorm.
 * User: hoang
 * Date: 15/03/2016
 * Time: 14:05
 */

class HomesController extends AppController {
    public $uses = array('User', 'Ebook', 'Viewer', 'Downloader', 'Category');

    public function index() {
        $mostview = $this->Viewer->find('all', array(
            'order' => 'count(Viewer.book) DESC',
            'group' => 'Viewer.book',
            'limit' => 10
        ));
        $mostdown = $this->Downloader->find('all', array(
            'order' => 'count(Downloader.book) DESC',
            'group' => 'Downloader.book',
            'limit' => 10
        ));
        $cate = $this->Category->find('all', array(
           'limit' => 3
        ));
        $this->set('mostview', $mostview);
        $this->set('cate', $cate);
        $this->set('mostdown', $mostdown);
    }

    public function view($id = null) {
        $cate = $this->Category->findById($id);
        if (empty($cate)) {
            $this->Flash->error(__("Không tìm thấy dữ liệu"));
            return $this->redirect(array('controller' => 'homes'));
        } else {
            $this->paginate = array(
                'conditions' => array(
                    'Ebook.categories_id' => $id
                ),
                'limit' => 12
            ); //Phân trang với 5 item
            $this->set('cate', $cate);
            $this->set('ebooks', $this->paginate('Ebook'));
        }
    }

    public function search(){
        if ($this->request->is('post')) {
            $this->Session->write('search', $this->request->data['Ebook']['ebsearch']);
        }
        $this->paginate = array('limit' => 8);//phân trang 10 item
        $this->set('ebooks', $this->paginate('Ebook',array('Ebook.title LIKE' =>'%'.$this->Session->read('search').'%' )));
        $this->set('count', $this->Ebook->find('count',array(
            'conditions'=> array(
                'Ebook.title LIKE' =>'%'.$this->Session->read('search').'%'
            )
        )));
    }
}