<?php
/**
 * Created by PhpStorm.
 * Ebook: hoang
 * Date: 21/03/2016
 * Time: 09:27
 */
App::uses('AppController', 'Controller');
App::uses('Folder', 'Utility');
App::uses('File', 'Utility');

class EbooksController extends AppController
{
    public $uses = array('User', 'Ebook', 'Viewer', 'Downloader');


    //thêm lượt xem
    function viewing($id = null) {
        $online_session_id = $this->Session->id();

        if (empty($online_session_id)) return ;

        $viewer = $this->Viewer->find('first', array(
            'conditions' => array(
                'Viewer.book' => $id,
                'Viewer.client' => $online_session_id
            )));

        if (empty($viewer) || $viewer == false) {
            $viewer_new = $this->Viewer->create();
            $viewer_new['client'] = $online_session_id;
            $viewer_new['book'] = $id;
            $this->Viewer->save($viewer_new);
        }
    }

    //thêm lượt tải
    function downloading($id = null) {
        $dl_session_id = $this->Session->id();

        if (empty($dl_session_id)) return ;

        $downloader = $this->Downloader->find('first', array(
            'conditions' => array(
                'Downloader.book' => $id,
                'Downloader.client' => $dl_session_id,
                'Downloader.user' => $this->Auth->user('id')
            )));

        if (empty($downloader) || $downloader == false) {
            $downloader_new = $this->Downloader->create();
            $downloader_new['client'] = $dl_session_id;
            $downloader_new['book'] = $id;
            $downloader_new['user'] = $this->Auth->user('id');
            $this->Downloader->save($downloader_new);
        }
    }
    //trang index
    public function index()
    {
        $this->paginate = array('limit' => 2);//phân trang 10 item
        $this->set('ebooks', $this->paginate('Ebook', array(
                'Ebook.user_id' => $this->Auth->user('id')
            )));
    }

    public function view($id = null)
    {
        $ebook = $this->Ebook->findById($id);
        $this->viewing($id);
        $view = $this->Viewer->find('count', array(
            'conditions' => array(
                'Viewer.book' => $id
            )
        ));
        $down = $this->Downloader->find('count', array(
            'conditions' => array(
                'Downloader.book' => $id
            )
        ));
        $request = $this->Ebook->Request->find('first',array(
            'conditions' => array(
                'Request.user_id' => $this->Auth->user('id'),
                'Request.ebook_id' => $id
            )
        ));
        $rate = $this->Ebook->Rating->find('first', array(
            'conditions' => array(
                'Rating.user_id' => $this->Auth->user('id'),
                'Rating.ebook_id' => $id
            )
        ));
        $allrate = $this->Ebook->Rating->find('all', array(
            'conditions' => array(
                'Rating.ebook_id' => $id
            )
        ));
        $sameuser = $this->Ebook->find('all', array(
            'conditions' => array(
                'Ebook.user_id' => $ebook['User']['id']
            ),
            'limit' => 5
        ));
        $relate = $this->Ebook->find('all', array(
            'conditions' => array(
                'Ebook.categories_id' => $ebook['Ebook']['categories_id']
            ),
            'limit' => 5
        ));
        if (empty($ebook)) {
            $this->Flash->error(__("Không tìm thấy dữ liệu"));
            return $this->redirect(array('action' => 'index'));
        } else {
            $this->set('ebook', $ebook);
            $this->set('request', $request);
            $this->set('rate', $rate);
            $this->set('allrate', $allrate);
            $this->set('view', $view);
            $this->set('down', $down);
            $this->set('sameuser', $sameuser);
            $this->set('relate', $relate);
        }
    }

    //thêm thông tin và lưu vào csdl
    public function add()
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
            return $this->redirect(array('controller'=>'ebooks','action' => 'add'));
        }
    }

    public function edit($id = null) {
        if (empty($this->Ebook->findById($id))) {
            $this->Flash->error(__("Không tìm thấy dữ liệu"));
            return $this->redirect(array('action' => 'index'));
        }
        elseif ($this->request->is(array('post', 'put'))) {
            $this->Ebook->id = $id;
            $olddata = $this->Ebook->read(null,$id);

            if($this->request->data['Ebook']['picture']['name']!= "")
            $this->request->data['Ebook']['picture']['name'] = 'thumb_'.$this->request->data['Ebook']['picture']['name'];
            if ($this->Ebook->save($this->request->data)) {
                if(file_exists(WWW_ROOT."files/".$olddata['Ebook']['user_id']."/".$olddata['Ebook']['picture']) && $this->request->data['Ebook']['picture']['name']!= "")
                unlink(WWW_ROOT."files/".$olddata['Ebook']['user_id']."/".$olddata['Ebook']['picture']);
                $folder = new Folder(WWW_ROOT."files/ebook/picture/".$id);
                $file = new File(WWW_ROOT."files/ebook/picture/".$id."/thumb_".$this->request->data['Ebook']['picture']['name']);
                if ($file->exists()) {
                    $dir = new Folder(WWW_ROOT.'files/'.$olddata['Ebook']['user_id'], true);
                    $file->copy($dir->path . DS .$this->request->data['Ebook']['picture']['name'] );
                }
                $folder->delete();
                $this->Flash->success(__('Chỉnh sửa thành công'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Flash->error(__('The ebook could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('Ebook.' . $this->Ebook->primaryKey => $id));
            $this->request->data = $this->Ebook->find('first', $options);
            $this->set('ebook',$this->request->data);
        }
        $users = $this->Ebook->User->find('list');
        $categories = $this->Ebook->Category->find('list');
        $this->set(compact('users', 'categories'));
    }

    public function delete($id = null)
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
                return $this->redirect(array('action' => 'index'));
            }
        }
        $this->Flash->error(__('Xảy ra lỗi'));
        return $this->redirect(array('action' => 'index'));
    }

    //Xử lý delete trên dropzone js
    public function deleteup()
    {
        $this->autoRender = false;
        unlink(WWW_ROOT.'Ebook/'.$this->Auth->user('id').'/'.$this->utf8convert($this->data['name']));
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

    public function search(){
        if ($this->request->is('post')) {
            $this->Session->write('search', $this->request->data['Ebook']['ebsearch']);
        }
        $this->paginate = array('limit' => 2);//phân trang 10 item
        $this->set('ebooks', $this->paginate('Ebook',array('Ebook.title LIKE' =>'%'.$this->Session->read('search').'%' )));
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

    public function requestdel(){
        $this->layout = false;
        $this->autoRender = false;
        $user_id = $this->request->data['user_id'];
        $ebook_id = $this->request->data['ebook_id'];
        $rq = $this->Ebook->Request->find('first',array(
            'conditions' => array(
                'Request.user_id' => $user_id,
                'Request.ebook_id' => $ebook_id
            )
        ));
        if ($user_id != 0 && $ebook_id != 0) {
            $this->Ebook->Request->delete($rq['Request']['id']);
            $this->Ebook->Nofication->deleteAll(array(
                'Nofication.request_id' => $rq['Request']['id']
            ));
        }
        return;
    }

    public function request(){
        $this->layout = false;
        $this->autoRender = false;
        $ebook_id = $this->request->data['ebook_id'];
        $user_id = $this->request->data['user_id'];
        $this->Ebook->Request->create();
        $this->Ebook->Request->save(array(
            'ebook_id' => $ebook_id,
            'user_id' => $user_id
        ));
        $book = $this->Ebook->read(null,$ebook_id);
        $user = $this->Ebook->User->read(null,$user_id);
        $this->Ebook->User->Nofication->create();
        $this->Ebook->User->Nofication->save(array(
            'user_id' => $book['Ebook']['user_id'],
            'ebook_id' => $ebook_id,
            'request_id' => $this->Ebook->Request->id,
            'content' => 'Bạn nhận được một yêu cầu từ '. $user['User']['username'] . ' về cuốn sách ' . $book['Ebook']['title'] . ' của bạn.'
        ));
        $pusher = new Pusher('ea2f5e5013baa43a541f', 'bd3a393da392412204cf', '197077');

        // trigger on _channel' an event called '_event' with this payload:

        $data = array(
            'user_id' => $book['Ebook']['user_id'],
            'title' => $book['Ebook']['title'],
            'user_send' =>  $user['User']['username']
        );
        $pusher->trigger('request_channel', 'send_event', $data);
    }

    public function download($id = null){
        $this->layout = false;
        $this->autoRender = false;
        $data = $this->Ebook->find('first',array(
            'conditions' => array(
            'Ebook.id' => base64_decode($id)
            )
        ));
        if (!empty($data)) {
            $this->response->file(
                WWW_ROOT . 'files/' . $data['Ebook']['user_id'] . '/' . $data['Ebook']['file'],
                array(
                    'download' => true,
                    'name' => $data['Ebook']['file']
                )
            );
            $this->downloading(base64_decode($id));
            return $this->response;
        }
        else {
            $this->Flash->error("Xảy ra lỗi");
            return $this->redirect(array('action'=>'view',$id));
        }
    }

    public function rate(){
        $this->layout = false;
        $this->autoRender = false;
        $ebook_id = $this->request->data['ebook_id'];
        $user_id = $this->request->data['user_id'];
        $rate = $this->request->data['rate'];
        $rating = $this->request->data['rating'];
        $this->Ebook->Rating->create();
        $this->Ebook->Rating->save(array(
                'user_id' => $user_id,
                'ebook_id' => $ebook_id,
                'value' => $rate
        ));
        $this->Ebook->updateAll(
            array('Ebook.rating' => $rating),
            array('Ebook.id' => $ebook_id)
        );
        return;
    }

    public function isAuthorized($user)
    {
        // Chỉ cho phép edit ebooks của chính mình
        if (in_array($this->action, array('edit'))) {
            $book = $this->Ebook->findById((int)$this->request->params['pass'][0]);
            $userId = $book['Ebook']['user_id'];
            if ($userId == $this->Auth->user('id')) {
                return true;
            } else {
                $this->Flash->error(__('Bạn không có quyền truy cập'));
                return $this->redirect(array('action' => 'index'));
            }
        }

        return parent::isAuthorized($user);
    }
}