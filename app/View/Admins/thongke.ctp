<?php if (!empty($xem)) {?>
    <!-- start: Content -->
    <div id="content">
        <div class="panel box-shadow-none content-header">
            <div class="panel-body">
                <div class="col-md-12">
                    <h3 class="animated fadeInLeft">Thống kê</h3>
                </div>
            </div>
        </div>
        <div class="col-md-12 top-20 padding-0">
            <div class="col-md-12">
                <div class="panel">
                    <div class="panel-heading"><h3>Top sách xem nhiều</h3></div>
                    <div class="panel-body">
                        <div class="responsive-table">
                            <table id="datatables-example" class="table table-striped table-bordered" width="100%" cellspacing="0">
                                <thead>
                                <tr>
                                    <th>Tiêu đề</th>
                                    <th>Hình bìa</th>
                                    <th>Tác giả</th>
                                    <th>Hành động</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($xem as $ebook){ ?>
                                    <tr>
                                        <td><?php echo $ebook['Ebook']['title'] ?></td>
                                        <td>
                                            <?php echo $this->Html->image('../files/' . $ebook['Ebook']['user_id'] . '/' . $ebook['Ebook']['picture']) ?>
                                        </td>
                                        <td><?php echo $ebook['Ebook']['author'] ?></td>

                                        <td>
                                            <?php echo $this->Html->link('', array('action' => 'view', $ebook['Ebook']['id']), array('class' => 'fa-eye fa btn btn-success','title' => 'Xem')); ?>
                                            <?php echo $this->Html->link('', array('action' => 'editbook', $ebook['Ebook']['id']), array('class' => 'fa-pencil fa btn btn-info','title' => 'Chỉnh sửa')); ?>
                                            <?php echo $this->Form->postLink('', array('action' => 'deletebook', $ebook['Ebook']['id']), array('confirm' => __('Bạn chắc chắn muốn xóa người dùng #%s?', $ebook['Ebook']['id']),'class' => 'fa-trash fa btn btn-danger', 'title' => 'Xóa')); ?>
                                        </td>
                                    </tr>
                                <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end: content -->
<?php } elseif (!empty($tai)) {?>
    <!-- start: Content -->
    <div id="content">
        <div class="panel box-shadow-none content-header">
            <div class="panel-body">
                <div class="col-md-12">
                    <h3 class="animated fadeInLeft">Thống kê</h3>
                </div>
            </div>
        </div>
        <div class="col-md-12 top-20 padding-0">
            <div class="col-md-12">
                <div class="panel">
                    <div class="panel-heading"><h3>Top sách xem nhiều</h3></div>
                    <div class="panel-body">
                        <div class="responsive-table">
                            <table id="datatables-example" class="table table-striped table-bordered" width="100%" cellspacing="0">
                                <thead>
                                <tr>
                                    <th>Tiêu đề</th>
                                    <th>Hình bìa</th>
                                    <th>Tác giả</th>
                                    <th>Hành động</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($tai as $ebook){ ?>
                                    <tr>
                                        <td><?php echo $ebook['Ebook']['title'] ?></td>
                                        <td>
                                            <?php echo $this->Html->image('../files/' . $ebook['Ebook']['user_id'] . '/' . $ebook['Ebook']['picture']) ?>
                                        </td>
                                        <td><?php echo $ebook['Ebook']['author'] ?></td>

                                        <td>
                                            <?php echo $this->Html->link('', array('action' => 'view', $ebook['Ebook']['id']), array('class' => 'fa-eye fa btn btn-success','title' => 'Xem')); ?>
                                            <?php echo $this->Html->link('', array('action' => 'editbook', $ebook['Ebook']['id']), array('class' => 'fa-pencil fa btn btn-info','title' => 'Chỉnh sửa')); ?>
                                            <?php echo $this->Form->postLink('', array('action' => 'deletebook', $ebook['Ebook']['id']), array('confirm' => __('Bạn chắc chắn muốn xóa người dùng #%s?', $ebook['Ebook']['id']),'class' => 'fa-trash fa btn btn-danger', 'title' => 'Xóa')); ?>
                                        </td>
                                    </tr>
                                <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end: content -->
<?php } elseif (!empty($tv)) {?>
    <!-- start: Content -->
    <div id="content">
        <div class="panel box-shadow-none content-header">
            <div class="panel-body">
                <div class="col-md-12">
                    <h3 class="animated fadeInLeft">Thống kê</h3>
                </div>
            </div>
        </div>
        <div class="col-md-12 top-20 padding-0">
            <div class="col-md-12">
                <div class="panel">
                    <div class="panel-heading"><h3>Top thành viên tải sách lên</h3></div>
                    <div class="panel-body">
                        <div class="responsive-table">
                            <table id="datatables-example" class="table table-striped table-bordered" width="100%" cellspacing="0">
                                <thead>
                                <tr>
                                    <th>Tên tài khoản</th>
                                    <th>Email</th>
                                    <th>Hình đại diện</th>
                                    <th>Loại tài khoản</th>
                                    <th>Hành động</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($tv as $user){ ?>
                                    <tr>
                                        <td><?php echo $user['User']['username'] ?></td>
                                        <td><?php echo $user['User']['email'] ?></td>
                                        <td>
                                            <?php
                                            if (strpos($user['User']['picture'], "graph.facebook.com") !== false)
                                                echo $this->Html->image('https://' . $user['User']['picture']);
                                            else
                                                echo $this->Html->image('../files/user/picture/' . $user['User']['picture_dir'] . '/thumb_' . $user['User']['picture']);
                                            ?>
                                        </td>
                                        <td><?php echo $user['User']['role']==0? 'User' : 'Admin'; ?></td>
                                        <td>
                                            <?php echo $this->Html->link('', array('action' => 'view', $user['User']['id']), array('class' => 'fa-eye fa btn btn-success','title' => 'Xem')); ?>
                                            <?php echo $this->Html->link('', array('action' => 'edit', $user['User']['id']), array('class' => 'fa-pencil fa btn btn-info','title' => 'Chỉnh sửa')); ?>
                                            <?php echo $this->Form->postLink('', array('action' => 'delete', $user['User']['id']), array('confirm' => __('Bạn chắc chắn muốn xóa người dùng #%s?', $user['User']['id']),'class' => 'fa-trash fa btn btn-danger', 'title' => 'Xóa')); ?>
                                        </td>
                                    </tr>
                                <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end: content -->
<?php } ?>
