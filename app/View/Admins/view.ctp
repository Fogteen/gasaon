<!-- start: Content -->
<div id="content">
    <div class="panel box-shadow-none content-header">
        <div class="panel-body">
            <div class="col-md-12">
                <h3 class="animated fadeInLeft">Quản lý thành viên</h3>
            </div>
        </div>
    </div>
    <div class="col-md-12 top-20 padding-0">
        <div class="col-md-12">
            <div class="panel">
                <div class="panel-heading"><h3>Thông tin thành viên</h3></div>
                <div class="panel-body">
                    <div class="admins view">
                        <table>
                            <tr>
                                <td class="bg-info col-md-3" style="text-align: right;color: white"><?php echo __('Tên tài khoản'); ?></td>
                                <td>
                                    <?php echo h($admin['User']['username']); ?>
                                    &nbsp;
                                </td>
                            </tr>
                            <tr>
                                <td class="bg-info col-md-3" style="text-align: right;color: white"><?php echo __('Email'); ?></td>
                                <td>
                                    <?php echo h($admin['User']['email']); ?>
                                    &nbsp;
                                </td>
                            </tr>
                            <tr>
                                <td class="bg-info col-md-3" style="text-align: right;color: white"><?php echo __('Hình đại diện'); ?></td>
                                <td>
                                    <?php
                                    if (strpos($admin['User']['picture'], "graph.facebook.com") !== false)
                                        echo $this->Html->image('https://' . $admin['User']['picture']);
                                    else
                                        echo $this->Html->image('../files/user/picture/' . $admin['User']['picture_dir'] . '/thumb_' . $admin['User']['picture']);
                                    ?>
                                    &nbsp;
                                </td>
                            </tr>
                            <tr>
                                <td class="bg-info col-md-3" style="text-align: right;color: white"><?php echo __('Loại tài khoản'); ?></td>
                                <td>
                                    <?php echo h($admin['User']['role']==1?'Admin':'User'); ?>
                                    &nbsp;
                                </td>
                            </tr>
                            <tr>
                                <td class="bg-info col-md-3" style="text-align: right;color: white"><?php echo __('Ngày tạo'); ?></td>
                                <td>
                                    <?php echo h($admin['User']['created']); ?>
                                    &nbsp;
                                </td>
                            </tr>
                            <tr>
                                <td class="bg-info col-md-3" style="text-align: right;color: white"><?php echo __('Chỉnh sửa lần cuối'); ?></td>
                                <td>
                                    <?php echo h($admin['User']['modified']); ?>
                                    &nbsp;
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
