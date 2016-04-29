<!DOCTYPE html>
<html>
<head>
    <?php echo $this->Html->charset("utf-8"); ?>
    <title>
        <?php echo $this->fetch('title'); ?>
    </title>
    <?php
    echo $this->Html->meta('icon');

    echo $this->Html->css(array('normalize','cake','foundation.min', 'custom', 'dropzone', 'rateit', 'chat-style',));

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
                        <li><?= $this->Html->link(__('Upload'), array('controller' => 'ebooks', 'action' => 'upload'),array('class' => 'upload')) ?></li>
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
                        <li><?= $this->Html->link(__('Nofication(' . count($nofi) . ')'), array('controller' => 'users', 'action' => 'nofi'), array('data-reveal-id' => 'nofication', 'id' => 'nofi')) ?></li>
                        <br>
                        <li><?= $this->Html->link(__('Profile'), array('controller' => 'users', 'action' => 'edit', $account['User']['id'])) ?></li>
                        <br>
                        <li><?= $this->Html->link(__('Store'), array('controller' => 'ebooks', 'action' => 'index')) ?></li>
                        <br>
                        <li><?= $this->Html->link(__('Logout'), array('controller' => 'users', 'action' => 'logout')) ?></li>
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