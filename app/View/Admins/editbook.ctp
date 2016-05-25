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
                <h4>Chỉnh sửa thông tin sách</h4>
            </div>
            <div class="col-md-12 panel-body" style="padding-bottom:30px;">
                <div class="col-md-12">
                        <?php
                        echo $this->Form->create('Ebook',array('type'=>'file','id'=>'addbookForm'));
                        ?>
                        <div class="col-md-3">
                            <?php echo $this->Html->image('../files/' . $ebook['Ebook']['user_id'] . '/' . $ebook['Ebook']['picture']); ?>
                            <?php echo $this->Form->input('Ebook.picture', array('type' => 'file','label'=>'Hình bìa')) ?>
                        </div>
                        <div class="col-md-5">
                            <?php echo $this->Form->input('Ebook.file', array('type' => 'hidden')) ?>
                            <?php echo $this->Form->input('Ebook.user_id', array('type' => 'hidden')) ?>
                            <div class="form-group form-animate-text" style="margin-top:40px !important;">
                                <?php
                                echo $this->Form->input('Ebook.title',array('id'=>'validate_title','class'=>'form-text','label'=>false,'div'=>false, 'required' => true, 'value' => pathinfo($ebook['Ebook']['title'],PATHINFO_FILENAME)));
                                ?>
                                <span class="bar"></span>
                                <label>Tiêu đề</label>
                            </div>

                            <div class="form-group form-animate-text" style="margin-top:40px !important;">
                                <?php
                                echo $this->Form->input('Ebook.des',array('id'=>'validate_des','class'=>'form-text','label'=>false,'div'=>false, 'required' => true));
                                ?>
                                <span class="bar"></span>
                                <label>Mô tả</label>
                            </div>


                        </div>

                        <div class="col-md-4">

                            <div class="form-group form-animate-text" style="margin-top:40px !important;">
                                <?php
                                echo $this->Form->input('Ebook.author',array('id'=>'validate_password','class'=>'form-text','label'=>false,'div'=>false, 'required' => true));
                                ?>
                                <span class="bar"></span>
                                <label>Tác giả</label>
                            </div>

                            <div class="form-group form-animate-text" style="margin-top:40px !important;">
                                <?php
                                echo $this->Form->input('Ebook.categories_id',array('type'=>'select','id'=>'validate_confirm_password','class'=>'form-text','label'=>false,'div'=>false, 'required' => true,'options' => $categories));
                                ?>
                                <span class="bar"></span>
                                <label>Thể loại</label>
                            </div>

                            <div class="form-group form-animate-text" style="margin-top:40px !important;">
                                <?php
                                echo $this->Form->input('Ebook.publish',array('type'=>'select','id'=>'validate_confirm_password','class'=>'form-text','label'=>false,'div'=>false, 'required' => true, 'options' => array(0=>'Riêng tư',1=>'Mọi người'),'empty'=>'Chọn chế độ chia sẻ'));
                                ?>
                                <span class="bar"></span>
                                <label>Chia sẻ</label>
                            </div>


                        </div>
                    <div class="col-md-12">
                        <input class="submit btn btn-danger" type="submit" value="Lưu thông tin">
                        <?php echo $this->Html->link('Quay lại', array('action'=>'listbook'), array('class'=>'btn btn-primary')) ?>
                    </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
<!-- end: content -->
</div>
