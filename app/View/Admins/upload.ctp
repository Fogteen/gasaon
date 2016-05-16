<!-- start: Content -->
<div id="content">
    <div class="panel box-shadow-none content-header">
        <div class="panel-body">
            <div class="col-md-12">
                <h3 class="animated fadeInLeft">Quản lý sách</h3>
            </div>
        </div>
    </div>
    <div class="col-md-12 top-20 padding-0">
        <div class="col-md-12">
            <div class="panel">
                <div class="panel-heading"><h3>Thêm sách</h3></div>
                <div class="panel-body">
                    <div class="row upload">
                        <div class="small-12 large-12 columns">

                            <?php
                            echo $this->Form->create(array('url' => array('controller' => 'admins', 'action' => 'upload'), 'class' => 'dropzone',
                                'id' => 'my-dropzone', 'charset'=>'utf-8'));
                            ?>
                            <div class="fallback">
                                <input name="file" type="file" multiple=""/>
                            </div>
                            <?php
                            echo $this->Form->button('Gửi', array('class' => 'btn btn-success'));
                            echo $this->Form->end();
                            ?>
                        </div>

                    </div>
            </div>
        </div>
    </div>
</div>
<!-- end: content -->