<!-- start: content -->
<div id="content">
    <div class="panel">
        <div class="panel-body">
            <div class="col-md-12 col-sm-12">
                <h3 class="animated fadeInLeft">Customer Service</h3>
            </div>
        </div>
    </div>

    <div class="col-md-12" style="padding:20px;">
        <div class="col-md-12 padding-0">
            <div class="col-md-8 padding-0">
                <div class="col-md-12 padding-0">
                    <div class="col-md-6">
                        <div class="panel box-v1">
                            <div class="panel-heading bg-white border-none">
                                <div class="col-md-6 col-sm-6 col-xs-6 text-left padding-0">
                                    <h4 class="text-left">Thành viên</h4>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-6 text-right">
                                    <h4>
                                        <span class="icon-user icons icon text-right"></span>
                                    </h4>
                                </div>
                            </div>
                            <div class="panel-body text-center">
                                <h1>51181,320</h1>
                                <p>Thành viên kích hoạt</p>
                                <hr/>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="panel box-v1">
                            <div class="panel-heading bg-white border-none">
                                <div class="col-md-6 col-sm-6 col-xs-6 text-left padding-0">
                                    <h4 class="text-left">Sách</h4>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-6 text-right">
                                    <h4>
                                        <span class="icon-book-open icons icon text-right"></span>
                                    </h4>
                                </div>
                            </div>
                            <div class="panel-body text-center">
                                <h1>51181,320</h1>
                                <p>Sách đã tải lên</p>
                                <hr/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="col-md-12 padding-0">
                    <div class="panel box-v2">
                        <div class="panel-heading padding-0">
                            <img src="../img/bg2.jpg" class="box-v2-cover img-responsive"/>
                            <div class="box-v2-detail">
                                <?php
                                if (strpos($account['User']['picture'], "graph.facebook.com") !== false)
                                    echo $this->Html->image('https://' . $account['User']['picture'], array('alt'=>'user name','class'=>'img-responsive'));
                                else
                                    echo $this->Html->image('../files/user/picture/' . $account['User']['picture_dir'] . '/thumb_' . $account['User']['picture'],array('alt'=>'user name','class'=>'img-responsive'))
                                ?>
                                <h4><?php echo $account['User']['username'] ?></h4>
                            </div>
                        </div>
                        <div class="panel-body">
                            <div class="col-md-12 padding-0 text-center">
                                <div class="col-md-6 col-sm-6 col-xs-12 padding-0">
                                    <h3>2.000</h3>
                                    <p>Bạn bè</p>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12 padding-0">
                                    <h3>4.320</h3>
                                    <p>Sách</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-12 card-wrap padding-0">
            <div class="col-md-6">
                <div class="panel">
                    <div class="panel-heading bg-white border-none" style="padding:20px;">
                        <div class="col-md-6 col-sm-6 col-sm-12 text-left">
                            <h4>Line Chart</h4>
                        </div>
                    </div>
                    <div class="panel-body" style="padding-bottom:50px;">
                        <div id="canvas-holder1">
                            <canvas class="line-chart" style="margin-top:30px;height:200px;"></canvas>
                        </div>
                        <div class="col-md-12" style="padding-top:20px;">
                            <div class="col-md-4 col-sm-4 col-xs-6 text-center">
                                <h2 style="line-height:.4;">$100.21</h2>
                                <small>Total Laba</small>
                            </div>
                            <div class="col-md-4 col-sm-4 col-xs-6 text-center">
                                <h2 style="line-height:.4;">2000</h2>
                                <small>Total Barang</small>
                            </div>
                            <div class="col-md-4 col-sm-4 col-xs-12 text-center">
                                <h2 style="line-height:.4;">$291.1</h2>
                                <small>Total Pengeluaran</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="panel">
                    <div class="panel-heading bg-white border-none" style="padding:20px;">
                        <div class="col-md-6 col-sm-6 col-sm-12 text-left">
                            <h4>Orders</h4>
                        </div>
                    </div>
                    <div class="panel-body" style="padding-bottom:50px;">
                        <div id="canvas-holder1">
                            <canvas class="bar-chart"></canvas>
                        </div>
                        <div class="col-md-12 padding-0">
                            <div class="col-md-4 col-sm-4 hidden-xs" style="padding-top:20px;">
                                <canvas class="doughnut-chart2"></canvas>
                            </div>
                            <div class="col-md-8 col-sm-8 col-xs-12">
                                <h4>Progress Produksi barang</h4>
                                <p>Sed hendrerit. Curabitur blandit mollis lacus. Duis leo. Sed libero.fusce commodo
                                    aliquam arcu..</p>
                                <div class="progress progress-mini">
                                    <div class="progress-bar" role="progressbar" aria-valuenow="80" aria-valuemin="0"
                                         aria-valuemax="100" style="width: 80%;">
                                        <span class="sr-only">60% Complete</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end: content -->


<!-- start: right menu -->
<div id="right-menu">
    <ul class="nav nav-tabs">
        <li class="active">
            <a data-toggle="tab" href="#right-menu-user">
                <span class="fa fa-comment-o fa-2x"></span>
            </a>
        </li>
        <li>
            <a data-toggle="tab" href="#right-menu-notif">
                <span class="fa fa-bell-o fa-2x"></span>
            </a>
        </li>
    </ul>

    <div class="tab-content">
        <div id="right-menu-user" class="tab-pane fade in active">
            <div class="search col-md-12">
                <input type="text" placeholder="search.."/>
            </div>
            <div class="user col-md-12">
                <ul class="nav nav-list">
                    <li class="online">
                        <img src="../img/avatar.jpg" alt="user name">
                        <div class="name">
                            <h5><b>Bill Gates</b></h5>
                            <p>Hi there.?</p>
                        </div>
                        <div class="gadget">
                            <span class="fa  fa-mobile-phone fa-2x"></span>
                        </div>
                        <div class="dot"></div>
                    </li>
                    <li class="away">
                        <img src="../img/avatar.jpg" alt="user name">
                        <div class="name">
                            <h5><b>Bill Gates</b></h5>
                            <p>Hi there.?</p>
                        </div>
                        <div class="gadget">
                            <span class="fa  fa-desktop"></span>
                        </div>
                        <div class="dot"></div>
                    </li>
                    <li class="offline">
                        <img src="../img/avatar.jpg" alt="user name">
                        <div class="name">
                            <h5><b>Bill Gates</b></h5>
                            <p>Hi there.?</p>
                        </div>
                        <div class="dot"></div>
                    </li>
                    <li class="offline">
                        <img src="../img/avatar.jpg" alt="user name">
                        <div class="name">
                            <h5><b>Bill Gates</b></h5>
                            <p>Hi there.?</p>
                        </div>
                        <div class="dot"></div>
                    </li>
                    <li class="online">
                        <img src="../img/avatar.jpg" alt="user name">
                        <div class="name">
                            <h5><b>Bill Gates</b></h5>
                            <p>Hi there.?</p>
                        </div>
                        <div class="gadget">
                            <span class="fa  fa-mobile-phone fa-2x"></span>
                        </div>
                        <div class="dot"></div>
                    </li>
                    <li class="offline">
                        <img src="../img/avatar.jpg" alt="user name">
                        <div class="name">
                            <h5><b>Bill Gates</b></h5>
                            <p>Hi there.?</p>
                        </div>
                        <div class="dot"></div>
                    </li>
                    <li class="online">
                        <img src="../img/avatar.jpg" alt="user name">
                        <div class="name">
                            <h5><b>Bill Gates</b></h5>
                            <p>Hi there.?</p>
                        </div>
                        <div class="gadget">
                            <span class="fa  fa-mobile-phone fa-2x"></span>
                        </div>
                        <div class="dot"></div>
                    </li>
                    <li class="offline">
                        <img src="../img/avatar.jpg" alt="user name">
                        <div class="name">
                            <h5><b>Bill Gates</b></h5>
                            <p>Hi there.?</p>
                        </div>
                        <div class="dot"></div>
                    </li>
                    <li class="offline">
                        <img src="../img/avatar.jpg" alt="user name">
                        <div class="name">
                            <h5><b>Bill Gates</b></h5>
                            <p>Hi there.?</p>
                        </div>
                        <div class="dot"></div>
                    </li>
                    <li class="online">
                        <img src="../img/avatar.jpg" alt="user name">
                        <div class="name">
                            <h5><b>Bill Gates</b></h5>
                            <p>Hi there.?</p>
                        </div>
                        <div class="gadget">
                            <span class="fa  fa-mobile-phone fa-2x"></span>
                        </div>
                        <div class="dot"></div>
                    </li>
                    <li class="online">
                        <img src="../img/avatar.jpg" alt="user name">
                        <div class="name">
                            <h5><b>Bill Gates</b></h5>
                            <p>Hi there.?</p>
                        </div>
                        <div class="gadget">
                            <span class="fa  fa-mobile-phone fa-2x"></span>
                        </div>
                        <div class="dot"></div>
                    </li>

                </ul>
            </div>
            <!-- Chatbox -->
            <div class="col-md-12 chatbox">
                <div class="col-md-12">
                    <a href="#" class="close-chat">X</a><h4>Akihiko Avaron</h4>
                </div>
                <div class="chat-area">
                    <div class="chat-area-content">
                        <div class="msg_container_base">
                            <div class="row msg_container send">
                                <div class="col-md-9 col-xs-9 bubble">
                                    <div class="messages msg_sent">
                                        <p>that mongodb thing looks good, huh?
                                            tiny master db, and huge document store</p>
                                        <time datetime="2009-11-13T20:00">Timothy • 51 min</time>
                                    </div>
                                </div>
                                <div class="col-md-3 col-xs-3 avatar">
                                    <img src="../img/avatar.jpg" class=" img-responsive " alt="user name">
                                </div>
                            </div>

                            <div class="row msg_container receive">
                                <div class="col-md-3 col-xs-3 avatar">
                                    <img src="../img/avatar.jpg" class=" img-responsive " alt="user name">
                                </div>
                                <div class="col-md-9 col-xs-9 bubble">
                                    <div class="messages msg_receive">
                                        <p>that mongodb thing looks good, huh?
                                            tiny master db, and huge document store</p>
                                        <time datetime="2009-11-13T20:00">Timothy • 51 min</time>
                                    </div>
                                </div>
                            </div>

                            <div class="row msg_container send">
                                <div class="col-md-9 col-xs-9 bubble">
                                    <div class="messages msg_sent">
                                        <p>that mongodb thing looks good, huh?
                                            tiny master db, and huge document store</p>
                                        <time datetime="2009-11-13T20:00">Timothy • 51 min</time>
                                    </div>
                                </div>
                                <div class="col-md-3 col-xs-3 avatar">
                                    <img src="../img/avatar.jpg" class=" img-responsive " alt="user name">
                                </div>
                            </div>

                            <div class="row msg_container receive">
                                <div class="col-md-3 col-xs-3 avatar">
                                    <img src="../img/avatar.jpg" class=" img-responsive " alt="user name">
                                </div>
                                <div class="col-md-9 col-xs-9 bubble">
                                    <div class="messages msg_receive">
                                        <p>that mongodb thing looks good, huh?
                                            tiny master db, and huge document store</p>
                                        <time datetime="2009-11-13T20:00">Timothy • 51 min</time>
                                    </div>
                                </div>
                            </div>

                            <div class="row msg_container send">
                                <div class="col-md-9 col-xs-9 bubble">
                                    <div class="messages msg_sent">
                                        <p>that mongodb thing looks good, huh?
                                            tiny master db, and huge document store</p>
                                        <time datetime="2009-11-13T20:00">Timothy • 51 min</time>
                                    </div>
                                </div>
                                <div class="col-md-3 col-xs-3 avatar">
                                    <img src="../img/avatar.jpg" class=" img-responsive " alt="user name">
                                </div>
                            </div>

                            <div class="row msg_container receive">
                                <div class="col-md-3 col-xs-3 avatar">
                                    <img src="../img/avatar.jpg" class=" img-responsive " alt="user name">
                                </div>
                                <div class="col-md-9 col-xs-9 bubble">
                                    <div class="messages msg_receive">
                                        <p>that mongodb thing looks good, huh?
                                            tiny master db, and huge document store</p>
                                        <time datetime="2009-11-13T20:00">Timothy • 51 min</time>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="chat-input">
                    <textarea placeholder="type your message here.."></textarea>
                </div>
                <div class="user-list">
                    <ul>
                        <li class="online">
                            <a href="" data-toggle="tooltip" data-placement="left" title="Akihiko avaron">
                                <div class="user-avatar"><img src="../img/avatar.jpg" alt="user name"></div>
                                <div class="dot"></div>
                            </a>
                        </li>
                        <li class="offline">
                            <a href="" data-toggle="tooltip" data-placement="left" title="Akihiko avaron">
                                <img src="../img/avatar.jpg" alt="user name">
                                <div class="dot"></div>
                            </a>
                        </li>
                        <li class="away">
                            <a href="" data-toggle="tooltip" data-placement="left" title="Akihiko avaron">
                                <img src="../img/avatar.jpg" alt="user name">
                                <div class="dot"></div>
                            </a>
                        </li>
                        <li class="online">
                            <a href="" data-toggle="tooltip" data-placement="left" title="Akihiko avaron">
                                <img src="../img/avatar.jpg" alt="user name">
                                <div class="dot"></div>
                            </a>
                        </li>
                        <li class="offline">
                            <a href="" data-toggle="tooltip" data-placement="left" title="Akihiko avaron">
                                <img src="../img/avatar.jpg" alt="user name">
                                <div class="dot"></div>
                            </a>
                        </li>
                        <li class="away">
                            <a href="" data-toggle="tooltip" data-placement="left" title="Akihiko avaron">
                                <img src="../img/avatar.jpg" alt="user name">
                                <div class="dot"></div>
                            </a>
                        </li>
                        <li class="offline">
                            <a href="" data-toggle="tooltip" data-placement="left" title="Akihiko avaron">
                                <img src="../img/avatar.jpg" alt="user name">
                                <div class="dot"></div>
                            </a>
                        </li>
                        <li class="offline">
                            <a href="" data-toggle="tooltip" data-placement="left" title="Akihiko avaron">
                                <img src="../img/avatar.jpg" alt="user name">
                                <div class="dot"></div>
                            </a>
                        </li>
                        <li class="away">
                            <a href="" data-toggle="tooltip" data-placement="left" title="Akihiko avaron">
                                <img src="../img/avatar.jpg" alt="user name">
                                <div class="dot"></div>
                            </a>
                        </li>
                        <li class="online">
                            <a href="" data-toggle="tooltip" data-placement="left" title="Akihiko avaron">
                                <img src="../img/avatar.jpg" alt="user name">
                                <div class="dot"></div>
                            </a>
                        </li>
                        <li class="away">
                            <a href="" data-toggle="tooltip" data-placement="left" title="Akihiko avaron">
                                <img src="../img/avatar.jpg" alt="user name">
                                <div class="dot"></div>
                            </a>
                        </li>
                        <li class="away">
                            <a href="" data-toggle="tooltip" data-placement="left" title="Akihiko avaron">
                                <img src="../img/avatar.jpg" alt="user name">
                                <div class="dot"></div>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div id="right-menu-notif" class="tab-pane fade">

            <ul class="mini-timeline">
                <li class="mini-timeline-highlight">
                    <div class="mini-timeline-panel">
                        <h5 class="time">07:00</h5>
                        <p>Coding!!</p>
                    </div>
                </li>

                <li class="mini-timeline-highlight">
                    <div class="mini-timeline-panel">
                        <h5 class="time">09:00</h5>
                        <p>Playing The Games</p>
                    </div>
                </li>
                <li class="mini-timeline-highlight">
                    <div class="mini-timeline-panel">
                        <h5 class="time">12:00</h5>
                        <p>Meeting with <a href="#">Clients</a></p>
                    </div>
                </li>
                <li class="mini-timeline-highlight mini-timeline-warning">
                    <div class="mini-timeline-panel">
                        <h5 class="time">15:00</h5>
                        <p>Breakdown the Personal PC</p>
                    </div>
                </li>
                <li class="mini-timeline-highlight mini-timeline-info">
                    <div class="mini-timeline-panel">
                        <h5 class="time">15:00</h5>
                        <p>Checking Server!</p>
                    </div>
                </li>
                <li class="mini-timeline-highlight mini-timeline-success">
                    <div class="mini-timeline-panel">
                        <h5 class="time">16:01</h5>
                        <p>Hacking The public wifi</p>
                    </div>
                </li>
                <li class="mini-timeline-highlight mini-timeline-danger">
                    <div class="mini-timeline-panel">
                        <h5 class="time">21:00</h5>
                        <p>Sleep!</p>
                    </div>
                </li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
            </ul>

        </div>
    </div>
</div>
<!-- end: right menu -->

</div>
