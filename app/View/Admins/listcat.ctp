<!-- start: Content -->
<div id="content">
    <div class="panel box-shadow-none content-header">
        <div class="panel-body">
            <div class="col-md-12">
                <h3 class="animated fadeInLeft">Quản lý danh mục</h3>
            </div>
        </div>
    </div>
    <div class="col-md-12 top-20 padding-0">
        <div class="col-md-12">
            <div class="panel">
                <div class="panel-heading"><h3>Danh sách dánh mục</h3></div>
                <div class="panel-body">
                    <div class="responsive-table">
                        <table id="datatables-example" class="table table-striped table-bordered" width="100%" cellspacing="0">
                            <thead>
                            <tr>
                                <th>Tên danh mục</th>
                                <th>Mô tả</th>
                                <th>Số lượng sách</th>
                                <th>Hành động</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($ls as $cat){ ?>
                                <tr>
                                    <td><?php echo $cat['Category']['name'] ?></td>
                                    <td><?php echo $cat['Category']['des'] ?></td>
                                    <td><?php echo count($cat['Ebook']) ?></td>
                                    <td>
                                        <?php echo $this->Html->link('', array('action' => 'viewcat', $cat['Category']['id']), array('class' => 'fa-eye fa btn btn-success','title' => 'Xem')); ?>
                                        <?php echo $this->Html->link('', array('action' => 'editcat', $cat['Category']['id']), array('class' => 'fa-pencil fa btn btn-info','title' => 'Chỉnh sửa')); ?>
                                        <?php echo $this->Form->postLink('', array('action' => 'deletecat', $cat['Category']['id']), array('confirm' => __('Bạn chắc chắn muốn xóa người dùng #%s?', $cat['Category']['id']),'class' => 'fa-trash fa btn btn-danger', 'title' => 'Xóa')); ?>
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