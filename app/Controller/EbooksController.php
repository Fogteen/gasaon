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

    public function index()
    {
        $this->paginate = array('limit' => 5);
        $this->set('ebooks', $this->paginate('Ebook'));
    }

    public function view($id = null)
    {

        $this->set('ebook', $this->Ebook->findById($id));
    }

    public function add()
    {
        $data = $this->Session->read('data');
        $count = count($data);
        if ($this->request->is('post')) {
            for ($i = 1; $i <= $count; $i++) {
                $this->request->data['Ebook'][$i]['user_id'] = $this->Auth->user('id');
                $this->request->data['Ebook'][$i]['picture'] = $data[$i]['pic'];
                $this->request->data['Ebook'][$i]['file'] = $data[$i]['name'];
            }
            if ($this->Ebook->saveMany($this->request->data['Ebook'])) {
                $folder = new Folder($data[1]['path']);
                $newPath = WWW_ROOT.'files/'.$this->Auth->user('id');
                if (!file_exists($newPath)) mkdir($newPath);
                $folder->move($newPath);
                $this->Session->delete('data');
                $this->Flash->success(__('Thêm thành công'));
                return $this->redirect(array('action' => 'index'));
            }
            else {
                $this->Flash->error(
                    __('Xảy ra lỗi')
                );
                for ($i=1;$i<$count;$i++){
                    unlink($data[$i]['path'].'/'.$data[$i]['name']);
                    unlink($data[$i]['path'].'/'.$data[$i]['pic']);
                }
                $this->Session->delete('data');
            }
        }

    }

    public function upload()
    {
        $ds = DIRECTORY_SEPARATOR;  //1
        $storeFolder = 'Ebook/'.$this->Auth->user('id');   //2
        if (!file_exists($storeFolder)) mkdir(WWW_ROOT.$storeFolder);
        if ($this->Session->check('data')) {
            $folder = new Folder($storeFolder);
            $folder->delete();
            mkdir(WWW_ROOT.$storeFolder);
            $this->Session->delete('data');
        }
        if (!empty($_FILES)) {
            $tempFile = $_FILES['file']['tmp_name'];          //3

            $targetPath = WWW_ROOT . $storeFolder . $ds;  //4

            $targetFile = $targetPath . $_FILES['file']['name'];  //5

            move_uploaded_file($tempFile, $targetFile); //6
        }
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
                if (pathinfo($pdf, PATHINFO_EXTENSION) !== 'pdf') {
                    $this->callapi($pdf,$storeFolder,$message);
                    debug($message);exit;
                    ?>
                    <script>
                        alert('<?php echo $message ?>');
                    </script>
<?php
                    $pdf = WWW_ROOT.$storeFolder.$ds.$file_name.'.pdf';
                }
                $pdf = $pdf.'[0]';
                exec("convert $pdf -background white -alpha off -resize 200 " .WWW_ROOT.$storeFolder.$ds.'thumb_'."$file_name.jpg");
                $data[$i-1]['name'] = $files[$i];
                $data[$i-1]['path'] = WWW_ROOT.$storeFolder.$ds;
                $data[$i-1]['pic'] = 'thumb_'.$file_name.'.jpg';
                $data[$i-1]['id'] = $this->Auth->user('id');
                $data[$i-1]['list'] = $this->Ebook->Category->find('list');
//                debug($this->Ebook->Category->find('list'));exit;
            }
            $this->Session->write('data',$data);
            return $this->redirect(array('controller'=>'ebooks','action' => 'add'));
        }
    }

    public function edit($id = null) {
        if (!$this->Ebook->exists($id)) {
            throw new NotFoundException(__('Invalid ebook'));
        }
        if ($this->request->is(array('post', 'put'))) {
            $this->Ebook->id = $id;
            if ($this->Ebook->save($this->request->data)) {
                $this->Flash->success(__('The ebook has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Flash->error(__('The ebook could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('Ebook.' . $this->Ebook->primaryKey => $id));
            $this->request->data = $this->Ebook->find('first', $options);
            $this->set('ebook',$this->request->data);
//            debug($this->request->data);exit;
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
        if (!$this->Ebook->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        if ($this->Ebook->delete()) {
            unlink(WWW_ROOT.'files/'.$this->Auth->user('id').'/'.$data['Ebook']['file']);
            unlink(WWW_ROOT.'files/'.$this->Auth->user('id').'/'.$data['Ebook']['picture']);
            $this->Flash->success(__('Xóa thành công'));
            return $this->redirect(array('action' => 'index'));
        }
        $this->Flash->error(__('Xảy ra lỗi'));
        return $this->redirect(array('action' => 'index'));
    }

    //Delete file upload when click delete
    public function deleteup()
    {
        $this->autoRender = false;
        unlink(WWW_ROOT.'Ebook/'.$this->Auth->user('id').'/'.$this->data['name']);
    }

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

    function callapi($fileToConvert, $pathToSaveOutputFile, &$message)
    {
        try
        {
            $fileName =pathinfo($fileToConvert, PATHINFO_FILENAME);
            $postdata =  array('OutputFileName' => $fileName.'.pdf', 'ApiKey' => 115863787, 'File'=>'@'.$fileToConvert);
            $ch = curl_init("http://do.convertapi.com/word2pdf");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_HEADER, 1);
            curl_setopt($ch, CURLOPT_POST, 1);
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
                $fp = fopen($pathToSaveOutputFile.$fileName.'.pdf', "wbx");

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
}