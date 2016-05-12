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
    echo $this->Html->css(array('normalize', 'foundation.min', 'custom', 'form','rateit'));
    echo $this->Html->script(array('vendor/jquery.min', 'foundation/foundation', 'foundation/foundation.topbar', 'foundation/foundation.reveal','rateit.min','app'));

    echo $this->fetch('meta');
    echo $this->fetch('css');
    echo $this->fetch('script');
    ?>
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <meta property="og:url" content="<?php echo('http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);?>"/>
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
                        <h1><a href="#">GaSaOn</a></h1>
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
                                <li><a href="#">Khoa Học</a></li>
                                <li class=""><a href="#">Công Nghệ Thông Tin</a></li>
                                <li><a href="#">Kinh Tế</a></li>
                            </ul>
                        </li>
                        <li class="has-dropdown">
                            <a href="#">THỂ LOẠI</a>
                            <ul class="dropdown">
                                <li><a href="#">Khoa Học</a></li>
                                <li class=""><a href="#">Công Nghệ Thông Tin</a></li>
                                <li><a href="#">Kinh Tế</a></li>
                            </ul>
                        </li>
                        <li class="has-form">
                            <form>
                                <div class="row collapse">
                                    <div class="small-7 columns">
                                        <input type="text">
                                    </div>
                                    <div class="small-5 columns">
                                        <a href="#" class="alert button fi-page-search">Tìm kiếm</a>
                                    </div>
                                </div>
                            </form>
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
                                    <?php echo $this->Form->input('password', array('label'=>'Mật khẩu')) ?>
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
                                    <?php echo $this->Form->input('username',array('label'=>'Tên tài khoản')) ?>
                                </div>

                                <div class="field-wrap">
                                    <?php echo $this->Form->input('email') ?>
                                </div>

                                <div class="field-wrap">
                                    <?php echo $this->Form->input('password',array('label'=>'Mật khẩu')) ?>
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
        <ul class="breadcrumbs">
            <li><a href="#">Home</a></li>
            <li><a href="#">Features</a></li>
            <li class="unavailable"><a href="#">Gene Splicing</a></li>
            <li class="current"><a href="#">Cloning</a></li>
        </ul>
    </div>
    <div id="content">