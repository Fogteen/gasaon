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
                <div class="panel-heading"><h3>Thông tin danh mục</h3></div>
                <div class="panel-body">
                    <div class="admins view">
                        <table>
                            <tr>
                                <td class="bg-info col-md-3" style="text-align: right;color: white"><?php echo __('Tên tài khoản'); ?></td>
                                <td>
                                    <?php echo h($category['Category']['name']); ?>
                                    &nbsp;
                                </td>
                            </tr>
                            <tr>
                                <td class="bg-info col-md-3" style="text-align: right;color: white"><?php echo __('Email'); ?></td>
                                <td>
                                    <?php echo h($category['Category']['des']); ?>
                                    &nbsp;
                                </td>
                            </tr>
                            <tr>
                                <td class="bg-info col-md-3" style="text-align: right;color: white"><?php echo __('Số lượng sách'); ?></td>
                                <td>
                                    <?php echo count($category['Ebook']); ?>
                                    &nbsp;
                                </td>
                            </tr>
                            <tr>
                                <td class="bg-info col-md-3" style="text-align: right;color: white"><?php echo __('Ngày tạo'); ?></td>
                                <td>
                                    <?php echo h($category['Category']['created']); ?>
                                    &nbsp;
                                </td>
                            </tr>
                            <tr>
                                <td class="bg-info col-md-3" style="text-align: right;color: white"><?php echo __('Chỉnh sửa lần cuối'); ?></td>
                                <td>
                                    <?php echo h($category['Category']['modified']); ?>
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
