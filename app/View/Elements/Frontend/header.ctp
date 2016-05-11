<!DOCTYPE html>
<html>
<head>
    <?php echo $this->Html->charset("utf-8"); ?>
    <title>
        <?php echo $this->fetch('title'); ?>
    </title>
    <?php
    echo $this->Html->meta('icon');

    echo $this->Html->css(array('normalize','cake','foundation.min','foundation-icons/foundation-icons', 'custom', 'dropzone', 'rateit', 'chat-style'));

    echo $this->Html->script(array('vendor/jquery', 'jquery.pusherchat', 'jquery.playSound', 'foundation/foundation', 'foundation/foundation.topbar', 'foundation/foundation.reveal', 'foundation/foundation.dropdown', 'foundation/foundation.tab', 'app', 'dropzone', 'pusher.min', 'rateit.min'));

    ?>
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <meta property="og:url" content="http://localhost/gasaon/ebooks/view/"/>
    <meta property="og:type" content="website"/>
    <meta property="og:title" content="Your Website Title"/>
    <meta property="og:description" content="Your description"/>
    <meta property="og:image" content="http://www.your-domain.com/path/image.jpg"/>
    <meta property="fb:admins" content="{787320918045296}"/>
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
                                    <div class="small-9 columns">
                                        <input type="text" style="height: 32px">
                                    </div>
                                    <div class="small-3 columns">
                                        <a href="#" class="alert button fi-magnifying-glass"></a>
                                    </div>
                                </div>
                            </form>
                        </li>
                    </ul>
                    <ul class="right">
                        <li><?= $this->Html->link(__(' Tải lên'), array('controller' => 'ebooks', 'action' => 'upload'),array('class' => 'upload button success fi-upload')) ?></li>
                        <li class="account"><a data-dropdown="drop1" aria-controls="drop1" aria-expanded="false">
                                <?php
                                if (strpos($account['User']['picture'], "graph.facebook.com") !== false)
                                    echo $this->Html->image('https://' . $account['User']['picture']);
                                else
                                    echo $this->Html->image('../files/user/picture/' . $account['User']['picture_dir'] . '/thumb_' . $account['User']['picture'])
                                ?>
                            </a>
                        </li>
                    </ul>
                    <ul id="drop1" class="tiny f-dropdown" data-dropdown-content aria-hidden="true" tabindex="-1">
                        <li><?= $this->Html->link(__('Thông báo(' . count($nofi) . ')'), array('controller' => 'users', 'action' => 'nofi'), array('data-reveal-id' => 'nofication', 'id' => 'nofi')) ?></li>
                        <br>
                        <li><?= $this->Html->link(__('Tài khoản'), array('controller' => 'users', 'action' => 'edit', $account['User']['id'])) ?></li>
                        <br>
                        <li><?= $this->Html->link(__('Kho sách'), array('controller' => 'ebooks', 'action' => 'index')) ?></li>
                        <br>
                        <li><?= $this->Html->link(__('Đăng xuất'), array('controller' => 'users', 'action' => 'logout')) ?></li>
                    </ul>
                </section>
            </nav>
        </div>
        <ul class="breadcrumbs">
            <li><a href="#">Home</a></li>
            <li><a href="#">Features</a></li>
            <li class="unavailable"><a href="#">Gene Splicing</a></li>
            <li class="current"><a href="#">Cloning</a></li>
        </ul>
        <div id="nofication" class="reveal-modal" data-reveal aria-labelledby="modalTitle" aria-hidden="true"
             role="dialog">
            <div class="form">
            </div>
            <!-- /form -->
            <a class="close-reveal-modal" aria-label="Close">&#215;</a>
        </div>

    </div>
    <div id="content">