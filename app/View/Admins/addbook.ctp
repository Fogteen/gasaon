<!-- start: content -->
<div id="content">
    <div class="panel">
        <div class="panel-body">
            <div class="col-md-12 col-sm-12">
                <h3 class="animated fadeInLeft">Quản lý sách</h3>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="col-md-12 panel">
            <div class="col-md-12 panel-heading">
                <h4>Thêm thông tin sách</h4>
            </div>
            <div class="col-md-12 panel-body" style="padding-bottom:30px;">
                <div class="col-md-12">
                    <?php
                    $ebook = $this->Session->read('data');
                    for ($i = 1;$i <= count($ebook);$i++){ ?>
                    <p>File <?php echo $i ?> của <?php echo count($ebook) ?> | <srong><?php echo $ebook[$i]['name'] ?></srong> | Thêm thông tin</p>
                    <?php
                    echo $this->Form->create('Ebook',array('type'=>'file','id'=>'addbookForm'));
                    ?>
                    <div class="col-md-3">
                        <?php echo $this->Html->image('../Ebook/'.$ebook[$i]['id'].'/'.$ebook[$i]['pic']); ?>
                    </div>
                    <div class="col-md-5">
                        <div class="form-group form-animate-text" style="margin-top:40px !important;">
                            <?php
                            echo $this->Form->input('Ebook.'.$i.'.title',array('id'=>'validate_title','class'=>'form-text','label'=>false,'div'=>false, 'required' => true, 'value' => pathinfo($ebook[$i]['name'],PATHINFO_FILENAME)));
                            ?>
                            <span class="bar"></span>
                            <label>Tiêu đề</label>
                        </div>

                        <div class="form-group form-animate-text" style="margin-top:40px !important;">
                            <?php
                            echo $this->Form->input('Ebook.'.$i.'.des',array('id'=>'validate_des','class'=>'form-text','label'=>false,'div'=>false, 'required' => true));
                            ?>
                            <span class="bar"></span>
                            <label>Mô tả</label>
                        </div>


                    </div>

                    <div class="col-md-4">

                        <div class="form-group form-animate-text" style="margin-top:40px !important;">
                            <?php
                            echo $this->Form->input('Ebook.'.$i.'.author',array('id'=>'validate_password','class'=>'form-text','label'=>false,'div'=>false, 'required' => true));
                            ?>
                            <span class="bar"></span>
                            <label>Tác giả</label>
                        </div>

                        <div class="form-group form-animate-text" style="margin-top:40px !important;">
                            <?php
                            echo $this->Form->input('Ebook.'.$i.'.categories_id',array('type'=>'select','id'=>'validate_confirm_password','class'=>'form-text','label'=>false,'div'=>false, 'required' => true,'options' => $ebook[$i]['list']));
                            ?>
                            <span class="bar"></span>
                            <label>Thể loại</label>
                        </div>

                        <div class="form-group form-animate-text" style="margin-top:40px !important;">
                            <?php
                            echo $this->Form->input('Ebook.'.$i.'.publish',array('type'=>'select','id'=>'validate_confirm_password','class'=>'form-text','label'=>false,'div'=>false, 'required' => true, 'options' => array(0=>'Riêng tư',1=>'Mọi người'),'empty'=>'Chọn chế độ chia sẻ'));
                            ?>
                        </div>


                    </div>
                    <?php } ?>
                    <div class="col-md-12">
                        <input class="submit btn btn-danger" type="submit" value="Lưu thông tin">
                        <?php echo $this->Html->link('Quay lại', array('action'=>'upload'), array('class'=>'btn btn-primary')) ?>
                    </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
<!-- end: content -->
</div>
