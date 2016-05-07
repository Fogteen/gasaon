<body id="mimin" class="dashboard">
<!-- start: Header -->
<nav class="navbar navbar-default header navbar-fixed-top">
    <div class="col-md-12 nav-wrapper">
        <div class="navbar-header" style="width:100%;">
            <div class="opener-left-menu is-open">
                <span class="top"></span>
                <span class="middle"></span>
                <span class="bottom"></span>
            </div>
            <?php echo $this->Html->link('GASAON', array('action'=>'home'),array('class' => 'navbar-brand'))?>
            <ul class="nav navbar-nav search-nav">
                <li>
                    <div class="search">
                        <span class="fa fa-search icon-search" style="font-size:23px;"></span>
                        <div class="form-group form-animate-text">
                            <input type="text" class="form-text" required>
                            <span class="bar"></span>
                            <label class="label-search">Gõ để  <b>Tìm kiếm</b> </label>
                        </div>
                    </div>
                </li>
            </ul>

            <ul class="nav navbar-nav navbar-right user-nav">
                <li class="user-name"><span><?php echo $account['User']['username']?></span></li>
                <li class="dropdown avatar-dropdown">
                    <?php
                    if (strpos($account['User']['picture'], "graph.facebook.com") !== false)
                        echo $this->Html->image('https://' . $account['User']['picture'], array('alt'=>'user name','class'=>'img-circle avatar', 'data-toggle'=>'dropdown'));
                    else
                        echo $this->Html->image('../files/user/picture/' . $account['User']['picture_dir'] . '/thumb_' . $account['User']['picture'],array('alt'=>'user name','class'=>'img-circle avatar', 'data-toggle'=>'dropdown'))
                    ?>
                    <ul class="dropdown-menu user-dropdown">
                        <li><a href="#"><span class="fa fa-user"></span> Thông tin cá nhân</a></li>
                        <li role="separator" class="divider"></li>
                        <li class="more">
                            <ul>
                                <li><a href=""><span class="fa fa-cogs"></span></a></li>
                                <li><a href=""><span class="fa fa-lock"></span></a></li>
                                <li><a href=""><span class="fa fa-power-off "></span></a></li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li ><a href="#" class="opener-right-menu"><span class="fa fa-coffee"></span></a></li>
            </ul>
        </div>
    </div>
</nav>
<!-- end: Header -->

<div class="container-fluid mimin-wrapper">

    <!-- start:Left Menu -->
    <div id="left-menu">
        <div class="sub-left-menu scroll">
            <ul class="nav nav-list">
                <li><div class="left-bg"></div></li>
                <li class="time">
                    <h1 class="animated fadeInLeft">21:00</h1>
                    <p class="animated fadeInRight">Sat,October 1st 2029</p>
                </li>
                <li class="active ripple">
                    <a href="home" class="nav-header"><span class="fa-home fa"></span> Trang chủ
                    </a>
                </li>
                <li class="ripple">
                    <a class="tree-toggle nav-header">
                        <span class="fa-book fa"></span> Quản lý sách
                        <span class="fa-angle-right fa right-arrow text-right"></span>
                    </a>
                    <ul class="nav nav-list tree">
                        <li><?php echo $this->Html->link('Thêm sách', array('action'=>'upload')) ?></li>
                        <li><?php echo $this->Html->link('Tất cả sách', array('action'=>'listbook')) ?></li>
                    </ul>
                </li>
                <li class="ripple">
                    <a class="tree-toggle nav-header">
                        <span class="fa-users fa"></span> Quản lý thành viên
                        <span class="fa-angle-right fa right-arrow text-right"></span>
                    </a>
                    <ul class="nav nav-list tree">
                        <li><?php echo $this->Html->link('Thêm thành viên', array('action'=>'adduser')) ?></li>
                        <li><?php echo $this->Html->link('Danh sách thành viên', array('action'=>'listuser')) ?></li>
                    </ul>
                </li>
                <li class="ripple">
                    <a class="tree-toggle nav-header">
                        <span class="fa-pie-chart fa"></span> Thống kê
                        <span class="fa-angle-right fa right-arrow text-right"></span>
                    </a>
                    <ul class="nav nav-list tree">
                        <li><a href="chartjs.html">Thêm quản trị viên</a></li>
                        <li><a href="morris.html">Danh sách thành viên</a></li>
                    </ul>
                </li>

            </ul>
        </div>
    </div>
    <!-- end: Left Menu -->