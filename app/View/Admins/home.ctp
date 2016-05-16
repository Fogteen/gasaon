<!-- start: content -->
<div id="content">
    <div class="panel">
        <div class="panel-body">
            <div class="col-md-12 col-sm-12">
                <h3 class="animated fadeInLeft">Trang quản trị</h3>
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
                                <h1><?php echo $usersum ?></h1>
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
                                <h1><?php echo $booksum ?></h1>
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
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-12 card-wrap padding-0">
            <div class="col-md-6">
                <div class="panel">
                    <div class="panel-heading bg-white border-none" style="padding:20px;">
                        <div class="col-md-6 col-sm-6 col-sm-12 text-left">
                            <h4>Thành viên</h4>
                        </div>
                    </div>
                    <div class="panel-body" style="padding-bottom:50px;">
                        <div id="canvas-holder1">
                            <canvas class="line-chart" style="margin-top:30px;height:200px;"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="panel">
                    <div class="panel-heading bg-white border-none" style="padding:20px;">
                        <div class="col-md-6 col-sm-6 col-sm-12 text-left">
                            <h4>Sách</h4><br><br>
                        </div>
                    </div>
                    <div class="panel-body" style="padding-bottom:50px;">
                        <div id="canvas-holder1">
                            <canvas class="bar-chart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end: content -->

</div>
