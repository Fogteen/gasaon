<!DOCTYPE html>
<html>
<head>
    <?php echo $this->Html->charset('utf-8'); ?>
    <title>
        <?php echo $this->fetch('title'); ?>
    </title>
    <link href="/bookicon.ico" type="image/x-icon" rel="icon"/>
    <link href="/bookicon.ico" type="image/x-icon" rel="shortcut icon"/>
    <?php
    echo $this->Html->css(array('normalize', 'foundation.min', 'custom', 'form', 'rateit', 'dropzone'));
    echo $this->Html->script(array('vendor/jquery.min', 'foundation/foundation', 'foundation/foundation.topbar', 'foundation/foundation.reveal', 'foundation/foundation.orbit', 'rateit.min', 'dropzone', 'app'));

    echo $this->fetch('meta');
    echo $this->fetch('css');
    echo $this->fetch('script');
    ?>
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <meta property="og:url" content="<?php echo('http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']); ?>"/>
    <meta property="og:type" content="website"/>
    <meta property="og:title" content="Your Website Title"/>
    <meta property="og:description" content="Your description"/>
    <meta property="og:image" content="http://www.your-domain.com/path/image.jpg"/>
</head>
<body>
<a href="javascript:void(0);" id="scroll" title="Scroll to Top" style="display: none;"><span></span></a>
<div id="container">
    <div id="header">
        <div class="contain-to-grid sticky">
            <nav class="top-bar" data-topbar role="navigation">
                <ul class="title-area">
                    <li class="name">
                        <h1>
                            <a href="<?php echo $this->Html->url(array('controller' => 'homes', 'action' => 'index')) ?>">GaSaOn</a>
                        </h1>
                    </li>
                    <li class="toggle-topbar menu-icon">
                        <a href="#"><span></span></a>
                    </li>
                </ul>
                <section class="top-bar-section">
                    <ul class="left">
                        <li class="has-dropdown">
                            <a href="#">THỂ LOẠI</a>
                            <ul class="dropdown">
                                <?php foreach ($category as $id => $cat) { ?>
                                    <li>
                                        <a href="<?php echo $this->Html->url(array('controller' => 'homes', 'action' => 'view', $id)) ?>"><?php echo $cat ?></a>
                                    </li>
                                <?php } ?>
                            </ul>
                        </li>
                        <li class="has-form">
                            <?php echo $this->Form->create('Ebook', array('url' => array('controller' => 'homes', 'action' => 'search'))) ?>
                            <div class="row collapse">
                                <div class="small-8 columns">
                                    <?php echo $this->Form->text('ebsearch'); ?>
                                </div>
                                <div class="small-4 columns">
                                    <?php echo $this->Form->button('', array('class' => 'alert button fi-magnifying-glass', 'type' => 'submit')) ?>
                                </div>
                            </div>
                            <?php echo $this->Form->end() ?>
                        </li>
                    </ul>
                    <ul class="right">
                        <li><a href="#" class="button success" data-reveal-id="login">Đăng nhập</a></li>
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
                                <h1>CHÀO MỪNG QUAY TRỞ LẠI!</h1>

                                <?php echo $this->Form->create('User', array('url' => array('controller' => 'users', 'action' => 'login'))) ?>

                                <div class="field-wrap">
                                    <?php echo $this->Form->input('email') ?>
                                </div>

                                <div class="field-wrap">
                                    <?php echo $this->Form->input('password', array('label' => 'Mật khẩu')) ?>
                                </div>

                                <p class="forgot"><a href="#">Quên mật khẩu?</a></p>

                                <button class="button button-block"/>
                                Đăng nhập</button>

                                <?php echo $this->Form->end() ?>

                            </div>
                            <div id="signup">
                                <h1>ĐĂNG KÝ TÀI KHOẢN</h1>

                                <?php echo $this->Form->create('User', array('url' => array('controller' => 'users', 'action' => 'add'))) ?>


                                <div class="field-wrap">
                                    <?php echo $this->Form->input('username', array('label' => 'Tên tài khoản')) ?>
                                </div>

                                <div class="field-wrap">
                                    <?php echo $this->Form->input('email') ?>
                                </div>

                                <div class="field-wrap">
                                    <?php echo $this->Form->input('password', array('label' => 'Mật khẩu')) ?>
                                </div>
                                <button type="submit" class="button button-block"/>
                                Đăng ký</button>
                                <?php echo $this->Form->end() ?>
                                <h1>hoặc</h1>
                                <?php echo $this->Html->link('', array('controller' => 'users', 'action' => 'fblogin'), array('class' => 'button', 'style' => 'background-image:url(/img/../img/fblogin.png);background-size:cover;width:100%;height:110px')) ?>

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