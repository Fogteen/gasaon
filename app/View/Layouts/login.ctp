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
                        <li><a href="#">Upload</a></li>
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
                        <li><?= $this->Html->link(__('Profile'), array('controller' => 'users', 'action' => 'view', $account['User']['id'])) ?></li>
                        <br>
                        <li><a href="#">Store</a></li>
                        <br>
                        <li><?= $this->Html->link(__('Logout'), array('controller' => 'users', 'action' => 'logout')) ?></li>
                    </ul>
                </section>
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
</script>
</body>
</html>