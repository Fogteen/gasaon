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
    <?php echo $this->Html->charset("utf-8"); ?>
    <title>
        <?php echo $this->fetch('title'); ?>
    </title>
    <?php
    echo $this->Html->meta('icon');

    echo $this->Html->css(array('normalize', 'foundation.min', 'custom', 'dropzone'));

    echo $this->Html->script(array('vendor/jquery', 'foundation/foundation', 'foundation/foundation.topbar', 'foundation/foundation.reveal', 'foundation/foundation.dropdown', 'foundation/foundation.tab', 'app', 'dropzone'));

    echo $this->fetch('meta');
    echo $this->fetch('css');
    echo $this->fetch('script');
    ?>
    <meta property="og:url"           content="http://localhost/gasaon/ebooks/view/" />
    <meta property="og:type"          content="website" />
    <meta property="og:title"         content="Your Website Title" />
    <meta property="og:description"   content="Your description" />
    <meta property="og:image"         content="http://www.your-domain.com/path/image.jpg" />
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
                        <li><?= $this->Html->link(__('Upload'), array('controller' => 'ebooks', 'action' => 'upload')) ?></li>
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
                        <li><?= $this->Html->link(__('Nofication('.count($nofi).')'), array('controller' => 'users', 'action' => 'nofi'),array('data-reveal-id' => 'nofication', 'id' => 'nofi')) ?></li>
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

        <?php echo $this->Flash->render(); ?>

        <?php echo $this->fetch('content'); ?>
    </div>
    <div id="footer">
        <footer class="footer">
            <div class="row">
                <div class="small-12 columns">
                    <p class="slogan">Gác Sách</p>
                    <p class="links">
                        <a href="#">Home</a>
                        <a href="#">Ebook</a>
                        <a href="#">User</a>
                        <a href="#">About</a>
                        <a href="#">Contact</a>
                    </p>
                    <p class="copywrite">Copywrite © 2016</p>
                </div>
            </div>
        </footer>
    </div>
</div>
<script>
    $(document).foundation();
    $(document).ready(function () {
        $('#nofi').click(function () {
            $.ajax({
                url: '<?php echo BASE_PATH?>users/nofi',
                type: 'POST',
                cache: false,
                success: function (data) {
                    console.log(data);
                    $.each(data, function(key,value){
                        $('div.form').append('<p class='+key+'>'+value.Nofication.content+'<br></p>');
                        $('p.'+key).append('<button class=yes'+key+'>Có</button><button class=no'+key+'>Không</button><hr>');
                        $('button.yes'+key).click(function () {
                            $.ajax({
                                url: '<?php echo BASE_PATH?>users/nofiup',
                                type: 'POST',
                                cache: false,
                                data: {status:value.Nofication.status+1 ,id: value.Nofication.id,request_id:value.Nofication.request_id,ebook_id:value.Nofication.ebook_id},
                                success: function () {
                                    $('p.'+key).remove();
                                },
                                error: function () {
                                    alert('Có lỗi xảy ra');
                                }
                            });
                        });
                    });
                },
                error: function () {
                    alert('Có lỗi xảy ra');
                }
            });
        });
    });
</script>
</body>
</html>