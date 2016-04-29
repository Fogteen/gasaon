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
                <div class="panel-heading"><h3>Danh sách thành viên</h3></div>
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
                            <?php foreach ($ls as $user){ ?>
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
                                    <?php echo $this->Html->link(__('View'), array('action' => 'view', $user['User']['id'])); ?>
                                    <?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $user['User']['id'])); ?>
                                    <?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $user['User']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $user['User']['id']))); ?>
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