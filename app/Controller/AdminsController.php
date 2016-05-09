<?php
/**
 * Created by PhpStorm.
 * User: hoang
 * Date: 27/04/2016
 * Time: 15:46
 */
App::uses('AppController', 'Controller');

class AdminsController extends AppController {

    public $uses = array('User','Ebook','Category');

    public $components = array(
        'Auth' => array(
            'authenticate' => array(
                'Form' => array(
                    'passwordHasher' => 'Blowfish',
                    'fields' => array('username' => 'username'),
                    'userModel' => 'User'
                )
            ),
            'authorize' => array('Controller')
        )
    );

    public function beforeFilter() {
        $this->Auth->allow('login');
        if (!empty($this->Auth->user()) && $this->Auth->user('role') != 1) {
            $this->Flash->warning('Bạn không có quyền truy cập trang quản trị!');
            $this->redirect(array('controller'=>'homes')) ;
            return ;
        }
        parent::beforeFilter();
    }

    public function index()
    {
        $this->paginate = array('limit' => 1); //Phân trang với 5 item
        $this->set('admins', $this->paginate('User'));
    }

    public function login()
    {
        if($this->Auth->user('role') == 1) return $this->redirect(array('action' => 'home'));
        if ($this->request->is('post')) {
            if ($this->Auth->login()) {
                if ($this->Auth->user('role')==0) {
                    $this->Session->destroy();
                    $this->Flash->error(__('Hãy sử dụng tài khoản quản trị viên!'));
                }
                return $this->redirect(array('action' => 'home'));
            }
            $this->Flash->error(__('Tài khoản hoặc mật khẩu không đúng. Hãy thử lại!'));
        }
    }

    public  function home() {
        //$this->Session->write('account', $this->Auth->user());
    }

    public function adduser()
    {
        if ($this->request->is('post')) {
            $this->User->create();
            if ($this->User->save($this->request->data)) {
                $this->Flash->success(__('Thêm tài khoản thành công'));
                return $this->redirect(array('action' => 'login'));
            }
            $this->Flash->error(
                __('Xảy ra lỗi')
            );
        }
    }

    public function listuser() {
        $list_user = $this->User->find('all',array(
           'order' => array('User.role DESC')
        ));
        $this->set('ls',$list_user);
    }

    public function listbook() {
        $list_book = $this->Ebook->find('all',array(
            'order' => array('Ebook.created DESC')
        ));
        $this->set('ls',$list_book);
    }

    public function view($id = null)
    {
        $user = $this->User->findById($id);
        if (empty($user)) {
            $this->Flash->error(__("Không tìm thấy dữ liệu"));
            return $this->redirect(array('action' => 'listuser'));
        } else {
            $this->set('admin', $user);
        }
    }

    public function edit($id = null)
    {
        $user = $this->User->findById($id);
        if (empty($user)) {
            $this->Flash->error(__("Không tìm thấy dữ liệu"));
            return $this->redirect(array('action' => 'index'));
        }
        elseif ($this->request->is('post') || $this->request->is('put')) {
            $this->User->id = $id;
            if ($this->User->save($this->request->data)) {
                unlink(WWW_ROOT.'files/user/picture/'.$user['User']['picture_dir'].'/'.$user['User']['picture']);
                unlink(WWW_ROOT.'files/user/picture/'.$user['User']['picture_dir'].'/thumb_'.$user['User']['picture']);
                $this->Flash->success(__('Cập nhật thành công'));
                return $this->redirect(array('action' => 'listuser'));
            }
            $this->Flash->error(
                __('Đã xảy ra lỗi')
            );
        } else {
            $this->request->data = $user;
            unset($this->request->data['User']['password']);
            $this->set('user', $this->request->data);
        }
    }

    public function deleteuser($id = null)
    {
        // Prior to 2.5 use
        // $this->request->onlyAllow('post');

        $this->request->allowMethod('post');

        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        if ($this->User->delete()) {
            $this->Flash->success(__('Xóa thành công'));
            return $this->redirect(array('action' => 'index'));
        }
        $this->Flash->error(__('Xảy ra lỗi'));
        return $this->redirect(array('action' => 'index'));
    }

    public function deletebook($id = null)
    {

        $this->request->allowMethod('post');

        $this->Ebook->id = $id;
        $data = $this->Ebook->read(null, $id);
        if (empty($this->Ebook->findById($id))) {
            $this->Flash->error(__("Không tìm thấy dữ liệu"));
            return $this->redirect(array('action' => 'index'));
        }
        elseif ($this->Ebook->delete()) {
            if (file_exists(WWW_ROOT . 'files/' . $data['Ebook']['user_id'] . '/' . $data['Ebook']['file'])) {
                unlink(WWW_ROOT . 'files/' . $data['Ebook']['user_id'] . '/' . $data['Ebook']['file']);
                if (pathinfo($data['Ebook']['file'], PATHINFO_EXTENSION) != 'pdf') {
                    unlink(WWW_ROOT . 'files/' . $data['Ebook']['user_id'] . '/' . pathinfo($data['Ebook']['file'], PATHINFO_FILENAME) . '.pdf');
                }
                unlink(WWW_ROOT . 'files/' . $data['Ebook']['user_id'] . '/pre_' . pathinfo($data['Ebook']['file'], PATHINFO_FILENAME) . '.pdf');
                unlink(WWW_ROOT . 'files/' . $data['Ebook']['user_id'] . '/' . $data['Ebook']['picture']);
                $this->Flash->success(__('Xóa thành công'));
                return $this->redirect(array('action' => 'listbook'));
            }
        }
        $this->Flash->error(__('Xảy ra lỗi'));
        return $this->redirect(array('action' => 'listbook'));
    }

    //thêm thông tin và lưu vào csdl
    public function addbook()
    {
        $data = $this->Session->read('data');//Lấy thông tin từ session
        $count = count($data);
        if ($this->request->is('post')) {
            for ($i = 1; $i <= $count; $i++) {
                $this->request->data['Ebook'][$i]['user_id'] = $this->Auth->user('id');
                $this->request->data['Ebook'][$i]['picture'] = $data[$i]['pic'];
                $this->request->data['Ebook'][$i]['file'] = $data[$i]['name'];
            }
            if ($this->Ebook->saveMany($this->request->data['Ebook'])) {//Lưu nhiều dữ liệu
                $folder = new Folder($data[1]['path']);
                $newPath = WWW_ROOT.'files/'.$this->Auth->user('id');
                if (!file_exists($newPath)) mkdir($newPath);
                $folder->move($newPath);
                $this->Session->delete('data');//Nếu lưu thành công, xóa session
                $this->Flash->success(__('Thêm thành công'));
                return $this->redirect(array('action' => 'index'));
            }
            else {
                $this->Flash->error(
                    __('Xảy ra lỗi')
                );
                for ($i=1;$i<$count;$i++){ //xảy ra lỗi, xáo các file đã upload
                    unlink($data[$i]['path'].'/'.$data[$i]['name']);
                    unlink($data[$i]['path'].'/'.$data[$i]['pic']);
                }
                $this->Session->delete('data');
            }
        }

    }

    //Chuyển chuỗi có dấu sang không dấu
    public function utf8convert($str) {
        if(!$str) return false;
        $utf8 = array(
            'a'=>'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ|Á|À|Ả|Ã|Ạ|Ă|Ắ|Ặ|Ằ|Ẳ|Ẵ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',
            'd'=>'đ|Đ',
            'e'=>'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ|É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',
            'i'=>'í|ì|ỉ|ĩ|ị|Í|Ì|Ỉ|Ĩ|Ị',
            'o'=>'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ|Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',
            'u'=>'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự|Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',
            'y'=>'ý|ỳ|ỷ|ỹ|ỵ|Ý|Ỳ|Ỷ|Ỹ|Ỵ',
            '-'=>' '
        );
        foreach($utf8 as $ascii=>$uni) $str = preg_replace("/($uni)/i",$ascii,$str);
        return $str;
    }

    //Upload file lên thư mục tạm
    public function upload() {
        $ds = DIRECTORY_SEPARATOR;  //1
        $storeFolder = 'Ebook/'.$this->Auth->user('id');   //2
        if (!file_exists($storeFolder)) mkdir(WWW_ROOT.$storeFolder);
        if ($this->Session->check('data')) {
            $folder = new Folder($storeFolder);
            $folder->delete();
            mkdir(WWW_ROOT.$storeFolder);
            $this->Session->delete('data');
        }
        //Kiểm tra người dùng đã chọn file
        if (!empty($_FILES)) {
            $tempFile = $_FILES['file']['tmp_name'];          //3

            $targetPath = WWW_ROOT . $storeFolder . $ds;  //4

            $filename = $this->utf8convert($_FILES['file']['name']);

            $targetFile = $targetPath .$filename;  //5

            move_uploaded_file($tempFile, $targetFile); //6
        }
        //Kiểm tra khi nhấn Submit
        elseif ($this->request->is('post')) {
            $files = scandir($storeFolder);
            $count = count($files);
            if ($count<=2){
                $this->Flash->error("Hãy chọn file trước khi Submit");
                return $this->redirect(array('action' => 'upload'));
            }
            for ($i=2; $i < $count; $i++) {
                $pdf = WWW_ROOT.$storeFolder.$ds.$files[$i];
                $file_name = pathinfo($pdf, PATHINFO_FILENAME);
                //Nếu định dạng file không phải pdf thì convert
                if (in_array(pathinfo($pdf, PATHINFO_EXTENSION), array('doc','docx'))) {
                    $this->callapi($pdf,$storeFolder,$message,"Word2Pdf");
                    $pdf = WWW_ROOT.$storeFolder.$ds.$file_name.'.pdf';
                }
                elseif (in_array(pathinfo($pdf, PATHINFO_EXTENSION), array('ppt','pptx'))) {
                    $this->callapi($pdf,$storeFolder,$message,"PowerPoint2Pdf");
                    $pdf = WWW_ROOT.$storeFolder.$ds.$file_name.'.pdf';
                }
                //tạo file xem trước với dữ liệu 5 trang
                exec("pdftk $pdf cat 1-5 output ".WWW_ROOT.$storeFolder.$ds.'pre_'.$file_name.'.pdf'."");
                $pdf = $pdf.'[0]';
                //tạo hình ảnh xem trước cho file
                exec("convert $pdf -background white -alpha off -resize 200 " .WWW_ROOT.$storeFolder.$ds.'thumb_'."$file_name.jpg");
                $data[$i-1]['name'] = iconv("cp1258", "utf-8", $files[$i]);
                $data[$i-1]['path'] = WWW_ROOT.$storeFolder.$ds;
                $data[$i-1]['pic'] = 'thumb_'.pathinfo($data[$i-1]['name'],PATHINFO_FILENAME).'.jpg';
                $data[$i-1]['id'] = $this->Auth->user('id');
                $data[$i-1]['list'] = $this->Ebook->Category->find('list');
            }
            $this->Session->write('data',$data);
            return $this->redirect(array('controller'=>'admins','action' => 'addbook'));
        }
    }

    function ParseHeader($header='')
    {
        $resArr = array();
        $headerArr = explode("\n",$header);
        foreach ($headerArr as $key => $value) {
            $tmpArr=explode(": ",$value);
            if (count($tmpArr)<1) continue;
            $resArr = array_merge($resArr, array($tmpArr[0] => count($tmpArr) < 2 ? "" : $tmpArr[1]));
        }
        return $resArr;
    }

    function callapi($fileToConvert, $pathToSaveOutputFile, &$message, $type)
    {
        try
        {
            $fileName =pathinfo($fileToConvert, PATHINFO_FILENAME);
            $postdata =  array('OutputFileName' => $fileName.'.pdf', 'ApiKey' => '115863787', 'File' => "@".$fileToConvert);
            $ch = curl_init("http://do.convertapi.com/".$type);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_HEADER, 1);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_SAFE_UPLOAD, false);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
            $result = curl_exec($ch);
            $headers = curl_getinfo($ch);

            $header=$this->ParseHeader(substr($result,0,$headers["header_size"]));
            $body=substr($result, $headers["header_size"]);

            curl_close($ch);
            if ( 0 < $headers['http_code'] && $headers['http_code'] < 400 )
            {
                // Check for Result = true

                if (in_array('Result',array_keys($header)) ?  !$header['Result']=="True" : true)
                {
                    $message = "Something went wrong with request, did not reach ConvertApi service.<br />";
                    return false;
                }
                // Check content type
                if ($headers['content_type']<>"application/pdf")
                {
                    $message = "Exception Message : returned content is not PDF file.<br />";
                    return false;
                }
                $fp = fopen($pathToSaveOutputFile.'/'.$fileName.'.pdf', "wbx");

                fwrite($fp, $body);

                $message = "The conversion was successful! The word file $fileToConvert converted to PDF and saved at $pathToSaveOutputFile$fileName";
                return true;
            }
            else
            {
                $message = "Exception Message : ".$result .".<br />Status Code :".$headers['http_code'].".<br />";
                return false;
            }
        }
        catch (Exception $e)
        {
            $message = "Exception Message :".$e.Message."</br>";
            return false;
        }
    }

    //Kiểm tra thư mục tạm có file hay không
    public function check()
    {
        $this->layout = false;
        $this->autoRender = false;
        $ds = DIRECTORY_SEPARATOR;  //1
        $storeFolder = 'Ebook/' . $this->Auth->user('id');   //2
        if (!file_exists($storeFolder)) mkdir(WWW_ROOT . $storeFolder);
        $result  = array();

        $files = scandir($storeFolder);                 //1
        if ( false!==$files ) {
            foreach ( $files as $file ) {
                if ( '.'!=$file && '..'!=$file) {       //2
                    $obj['name'] = $file;
                    $obj['size'] = filesize($storeFolder.$ds.$file);
                    $obj['id'] = $this->Auth->user('id');
                    $result[] = $obj;
                }
            }
        }
        return new CakeResponse(array('body' => json_encode($result),'type'=>'json'));
    }
}