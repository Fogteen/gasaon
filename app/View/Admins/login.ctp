<body id="mimin" class="dashboard form-signin-wrapper">

<div class="container">

    <?php
    echo $this->Form->create('User', array('class' => 'form-signin'));
    ?>
        <div class="panel periodic-login">
            <div class="panel-body text-center">
                <h1 class="atomic-symbol">Gs</h1>
                <p class="element-name">Đăng nhập</p>
                <i class="icons icon-arrow-down"></i>
                <div class="form-group form-animate-text" style="margin-top:40px !important;">
                    <?php
                    echo $this->Form->input('username',array('class'=>'form-text','label'=>false,'div'=>false, 'required' => true));
                    ?>
                    <span class="bar"></span>
                    <label>Tên tài khoản</label>
                </div>
                <div class="form-group form-animate-text" style="margin-top:40px !important;">
                    <?php
                    echo $this->Form->input('password',array('class'=>'form-text','label'=>false,'div'=>false, 'required' => true));
                    ?>
                    <span class="bar"></span>
                    <label>Mật khẩu</label>
                </div>
                <?php
                $options = array(
                    'label' => 'Đăng nhập',
                    'div' => false,
                    'class' => 'btn col-md-12'
                );
                echo $this->Form->end($options);
                ?>
            </div>
        </div>
    </form>

</div>
