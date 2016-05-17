<!DOCTYPE html>
<html>
<head>
    <?php echo $this->Html->charset("utf-8"); ?>
    <title>
        <?php echo $this->fetch('title'); ?>
    </title>
    <?php
    echo $this->Html->meta('icon');

    echo $this->Html->css(array('normalize', 'cake', 'foundation.min', 'foundation-icons/foundation-icons', 'custom', 'dropzone', 'rateit', 'chat-style'));

    echo $this->Html->script(array('vendor/jquery', 'jquery.pusherchat', 'jquery.playSound', 'foundation/foundation', 'foundation/foundation.topbar', 'foundation/foundation.reveal', 'foundation/foundation.dropdown', 'foundation/foundation.tab', 'foundation/foundation.orbit', 'plugins/jquery.validate.min', 'app', 'dropzone', 'pusher.min', 'rateit.min'));

    ?>
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <meta property="og:url"
          content="http://localhost<?php echo('http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']); ?>"/>
    <meta property="og:type" content="website"/>
    <meta property="og:title" content="Your Website Title"/>
    <meta property="og:description" content="Your description"/>
    <meta property="og:image" content="http://www.your-domain.com/path/image.jpg"/>
</head>
<body>
<a href="javascript:void(0);" id="scroll" title="Scroll to Top" style="display: none;">Top<span></span></a>
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
                        <li><?= $this->Html->link(__(' Tải lên'), array('controller' => 'ebooks', 'action' => 'upload'), array('class' => 'upload button success fi-upload')) ?></li>
                        <li class="account"><a data-dropdown="drop1" aria-controls="drop1" aria-expanded="false">
                                <?php
                                if (strpos($account['User']['picture'], "graph.facebook.com") !== false)
                                    echo $this->Html->image('https://' . $account['User']['picture'], array('style' => 'width:50px;height:50px'));
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
        <div id="nofication" class="reveal-modal" data-reveal aria-labelledby="modalTitle" aria-hidden="true"
             role="dialog">
            <div class="form">
            </div>
            <!-- /form -->
            <a class="close-reveal-modal" aria-label="Close">&#215;</a>
        </div>

    </div>
    <div id="content">