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
    public $uses = array('User', 'Ebook');

    //trang index
    public function index()
    {
        $this->paginate = array('limit' => 10);//phân trang 10 item
        $this->set('ebooks', $this->paginate('Ebook',array(
                'Ebook.user_id' => $this->Auth->user('id')
            )));
    }

    public function view($id = null)
    {
        $ebook = $this->Ebook->findById($id);
        $request = $this->Ebook->Request->find('first',array(
            'conditions' => array(
                'Request.user_id' => $this->Auth->user('id'),
                'Request.ebook_id' => $id
            )
        ));
        if (empty($ebook)) {
            $this->Flash->error(__("Không tìm thấy dữ liệu"));
            return $this->redirect(array('action' => 'index'));
        } else {
            $this->set('ebook', $ebook);
            $this->set('request', $request);
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

    public function upload() {//Upload file lên thư mục tạm
        $ds = DIRECTORY_SEPARATOR;  //1
        $storeFolder = 'Ebook/'.$this->Auth->user('id');   //2
        if (!file_exists($storeFolder)) mkdir(WWW_ROOT.$storeFolder);
        if ($this->Session->check('data')) {
            $folder = new Folder($storeFolder);
            $folder->delete();
            mkdir(WWW_ROOT.$storeFolder);
            $this->Session->delete('data');
        }
        if (!empty($_FILES)) {//Kiểm tra người dùng đã chọn file
            $tempFile = $_FILES['file']['tmp_name'];          //3

            $targetPath = WWW_ROOT . $storeFolder . $ds;  //4

            $targetFile = $targetPath .$_FILES['file']['name'];  //5

            move_uploaded_file($tempFile, $targetFile); //6
        }
        elseif ($this->request->is('post')) {//Kiểm tra khi nhấn Submit
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
                if (in_array(pathinfo($pdf, PATHINFO_EXTENSION), array('doc','docx','dot'))) {
                    debug($this->callapi($pdf,$storeFolder,$message,"Word2Pdf"));exit;
                    $pdf = WWW_ROOT.$storeFolder.$ds.$file_name.'.pdf';
                }
                elseif (in_array(pathinfo($pdf, PATHINFO_EXTENSION), array('ppt','pptx','pps','ppsx'))) {
                    $this->callapi($pdf,$storeFolder,$message,"PowerPoint2Pdf");
                    $pdf = WWW_ROOT.$storeFolder.$ds.$file_name.'.pdf';
                }
                //tạo file xem trước với dữ liệu 5 trang
                exec("pdftk $pdf cat 1-5 output ".WWW_ROOT.$storeFolder.$ds.'pre_'.$file_name.'.pdf'."");
                $pdf = $pdf.'[0]';
                //tạo hình ảnh xem trước cho file
                exec("convert $pdf -background white -alpha off -resize 200 " .WWW_ROOT.$storeFolder.$ds.'thumb_'."$file_name.jpg");
                $data[$i-1]['name'] = $files[$i];
                $data[$i-1]['path'] = WWW_ROOT.$storeFolder.$ds;
                $data[$i-1]['pic'] = 'thumb_'.$file_name.'.jpg';
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
            if($this->request->data['Ebook']['picture']['name']!== "")
            $this->request->data['Ebook']['picture']['name'] = 'thumb_'.$this->request->data['Ebook']['picture']['name'];
            if ($this->Ebook->save($this->request->data)) {
                if(file_exists(WWW_ROOT."files/".$olddata['Ebook']['user_id']."/".$olddata['Ebook']['picture']) && $this->request->data['Ebook']['picture']['name']!== "")
                unlink(WWW_ROOT."files/".$olddata['Ebook']['user_id']."/".$olddata['Ebook']['picture']);
                $folder = new Folder(WWW_ROOT."files/ebook/picture/".$id);
                $file = new File(WWW_ROOT."files/ebook/picture/".$id."/thumb_".$this->request->data['Ebook']['picture']['name']);
                if ($file->exists()) {
                    $dir = new Folder(WWW_ROOT.'files/'.$olddata['Ebook']['user_id'], true);
                    $file->copy($dir->path . DS .$this->request->data['Ebook']['picture']['name'] );
                }
                $folder->delete();
                $this->Flash->success(__('The ebook has been saved.'));
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
            unlink(WWW_ROOT.'files/'.$data['Ebook']['user_id'].'/'.$data['Ebook']['file']);
            if (pathinfo($data['Ebook']['file'], PATHINFO_EXTENSION)!= 'pdf'){
                unlink(WWW_ROOT.'files/'.$data['Ebook']['user_id'].'/'.pathinfo($data['Ebook']['file'], PATHINFO_FILENAME).'.pdf');
            }
            unlink(WWW_ROOT.'files/'.$data['Ebook']['user_id'].'/pre_'.pathinfo($data['Ebook']['file'], PATHINFO_FILENAME).'.pdf');
            unlink(WWW_ROOT.'files/'.$data['Ebook']['user_id'].'/'.$data['Ebook']['picture']);
            $this->Flash->success(__('Xóa thành công'));
            return $this->redirect(array('action' => 'index'));
        }
        $this->Flash->error(__('Xảy ra lỗi'));
        return $this->redirect(array('action' => 'index'));
    }

    //Xử lý delete trên dropzone js
    public function deleteup()
    {
        $this->autoRender = false;
        unlink(WWW_ROOT.'Ebook/'.$this->Auth->user('id').'/'.$this->data['name']);
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
            $ebooks = $this->Ebook->find('all', array(
                'conditions' => array('title LIKE' =>'%'.$this->request->data['Ebook']['ebsearch'].'%' )
            ));
            $this->set('ebooks',$ebooks);
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
            $ch = curl_init("https://do.convertapi.com/".$type);
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
            'content' => 'Bạn nhận được một yêu cầu từ '. $user['User']['first_name'] . ' về cuốn sách ' . $book['Ebook']['title'] . ' của bạn.'
        ));
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
            return $this->response;
        }
        else {
            $this->Flash->error("Xảy ra lỗi");
            return $this->redirect(array('action'=>'view',$id));
        }
    }
}