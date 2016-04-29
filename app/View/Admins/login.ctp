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
                <label class="pull-left">
                    <input type="checkbox" class="icheck pull-left" name="checkbox1"/> Ghi nhớ đăng nhập
                </label>
                <?php
                $options = array(
                    'label' => 'Sign In',
                    'div' => false,
                    'class' => 'btn col-md-12'
                );
                echo $this->Form->end($options);
                ?>
            </div>
            <div class="text-center" style="padding:5px;">
                <?php
                echo $this->Html->link("Quên mật khẩu",array('action'=>'lostpass'));
                ?>
            </div>
        </div>
    </form>

</div>
