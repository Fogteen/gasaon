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
       $cate = $this->Category->find('all');
        $this->set('mostview', $mostview);
        $this->set('cate', $cate);
        $this->set('mostdown', $mostdown);
    }
}