<!-- start: content -->
<div id="content">
    <div class="panel">
        <div class="panel-body">
            <div class="col-md-12 col-sm-12">
                <h3 class="animated fadeInLeft">Quản lý thành viên</h3>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="col-md-12 panel">
            <div class="col-md-12 panel-heading">
                <h4>Thêm thành viên</h4>
            </div>
            <div class="col-md-12 panel-body" style="padding-bottom:30px;">
                <div class="col-md-12">
                    <?php
                    echo $this->Form->create('User',array('type'=>'file','id'=>'signupForm'));
                    ?>
                        <div class="col-md-6">
                            <div class="form-group form-animate-text" style="margin-top:40px !important;">
                                <?php
                                echo $this->Form->input('username',array('id'=>'validate_username','class'=>'form-text','label'=>false,'div'=>false, 'required' => true));
                                ?>
                                <span class="bar"></span>
                                <label>Tên tài khoản</label>
                            </div>

                            <div class="form-group form-animate-text" style="margin-top:40px !important;">
                                <?php
                                echo $this->Form->input('email',array('id'=>'validate_email','class'=>'form-text','label'=>false,'div'=>false, 'required' => true));
                                ?>
                                <span class="bar"></span>
                                <label>Email</label>
                            </div>

                            <div class="form-group form-animate-text" style="margin-top:40px !important;">
                                <?php
                                    echo $this->Form->input('role', array('id'=>'validate_type','type' => 'select','label'=>false,'div'=>false, 'options' => array(0=>'Thành viên',1=>'Quản trị viên'),'empty'=>'Chọn loại tài khoản'));
                                ?>
                                <span class="bar"></span>
                            </div>


                        </div>

                        <div class="col-md-6">

                            <div class="form-group form-animate-text" style="margin-top:40px !important;">
                                <?php
                                echo $this->Form->input('password',array('id'=>'validate_password','class'=>'form-text','label'=>false,'div'=>false, 'required' => true));
                                ?>
                                <span class="bar"></span>
                                <label>Mật khẩu</label>
                            </div>

                            <div class="form-group form-animate-text" style="margin-top:40px !important;">
                                <?php
                                echo $this->Form->input('confirm_password',array('type'=>'password','id'=>'validate_confirm_password','class'=>'form-text','label'=>false,'div'=>false, 'required' => true));
                                ?>
                                <span class="bar"></span>
                                <label>Xác nhận mật khẩu</label>
                            </div>

                            <div class="form-group form-animate-text" style="margin-top:40px !important;">
                                <?php
                                    echo $this->Form->input('picture',array('type' => 'file','label'=>false,'div'=>false));
                                    echo $this->Form->input('picture_dir',array('type' => 'hidden'));
                                ?>
                            </div>


                        </div>
                        <div class="col-md-12">
                            <input class="submit btn btn-danger" type="submit" value="Submit">
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
<!-- end: content -->
</div>
