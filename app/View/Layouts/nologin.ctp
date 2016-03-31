<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

?>
<!DOCTYPE html>
<html>
<head>
    <?php echo $this->Html->charset(); ?>
    <title>
        <?php echo $this->fetch('title'); ?>
    </title>
    <?php
    echo $this->Html->meta('icon');

    echo $this->Html->css(array('normalize', 'foundation.min', 'app', 'custom', 'form'));


    echo $this->fetch('meta');
    echo $this->fetch('css');
    echo $this->fetch('script');
    ?>
</head>
<body>
<div id="container">
    <div id="header">
        <div class="contain-to-grid sticky">
            <nav class="top-bar" data-topbar role="navigation">
                <ul class="title-area">
                    <li class="name">
                        <h1><a href="#">GaSaOn</a></h1>
                    </li>
                    <li class="toggle-topbar menu-icon">
                        <a href="#"><span></span></a>
                    </li>
                </ul>
                <section class="top-bar-section">
                    <ul class="left">
                        <li class="has-form">
                            <form>
                                <div class="row collapse">
                                    <div class="small-7 columns">
                                        <input type="text">
                                    </div>
                                    <div class="small-5 columns">
                                        <a href="#" class="alert button">Tìm kiếm</a>
                                    </div>
                                </div>
                            </form>
                        </li>
                    </ul>
                    <ul class="right">
                        <li><a href="#" data-reveal-id="login">Đăng nhập</a></li>
                    </ul>
                </section>
                <div id="login" class="reveal-modal" data-reveal aria-labelledby="modalTitle" aria-hidden="true"
                     role="dialog">
                    <div class="form">

                        <ul class="tab-group">
                            <li class="tab active"><a href="#log">Đăng nhập</a></li>
                            <li class="tab"><a href="#signup">Đăng ký</a></li>
                        </ul>

                        <div class="tab-content">
                            <div id="log">
                                <h1>Chào Mừng Quay Trở Lại!</h1>

                                <?php echo $this->Form->create('User', array('url' => array('controller' => 'users', 'action' => 'login'))) ?>

                                <div class="field-wrap">
                                    <?php echo $this->Form->input('email') ?>
                                </div>

                                <div class="field-wrap">
                                    <?php echo $this->Form->input('password') ?>
                                </div>

                                <p class="forgot"><a href="#">Quên mật khẩu?</a></p>

                                <button class="button button-block"/>
                                Đăng nhập</button>

                                <?php echo $this->Form->end() ?>

                            </div>
                            <div id="signup">
                                <h1>Đăng ký tài khoản</h1>

                                <?php echo $this->Form->create('User', array('url' => array('controller' => 'users', 'action' => 'add'))) ?>

                                <div class="top-row">
                                    <div class="field-wrap">
                                        <?php echo $this->Form->input('first_name') ?>
                                    </div>

                                    <div class="field-wrap">
                                        <?php echo $this->Form->input('last_name') ?>
                                    </div>
                                </div>

                                <div class="field-wrap">
                                    <?php echo $this->Form->input('email') ?>
                                </div>

                                <div class="field-wrap">
                                    <?php echo $this->Form->input('password') ?>
                                </div>
                                <button type="submit" class="button button-block"/>
                                Đăng ký</button>

                                <?php echo $this->Form->end() ?>

                            </div>

                        </div>
                        <!-- tab-content -->

                    </div>
                    <!-- /form -->
                    <a class="close-reveal-modal" aria-label="Close">&#215;</a>
                </div>
            </nav>

        </div>
    </div>

    <div id="content">

        <?php echo $this->Flash->render(); ?>

        <?php echo $this->fetch('content'); ?>
    </div>
    <div id="footer">
        <footer class="footer">
            <div class="row">
                <div class="small-12 columns">
                    <p class="slogan">Finger-lickin' good</p>
                    <p class="links">
                        <a href="#">Home</a>
                        <a href="#">Blog</a>
                        <a href="#">Pricing</a>
                        <a href="#">About</a>
                        <a href="#">Faq</a>
                        <a href="#">Contact</a>
                    </p>
                    <p class="copywrite">Copywrite not copypwrite © 2015</p>
                </div>
            </div>
        </footer>
    </div>
</div>
<?php echo $this->Js->writeBuffer(); // By default scripts are cached, and we must explicitly print out the cache ?>
<?php echo $this->Html->script(array('vendor/jquery.min', 'foundation/foundation', 'foundation/foundation.topbar', 'foundation/foundation.reveal', 'app')); ?>
<script>
    $(document).foundation();
</script>
</body>
</html>