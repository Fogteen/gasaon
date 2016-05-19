<!-- start: Content -->
<div id="content">
    <div class="panel box-shadow-none content-header">
        <div class="panel-body">
            <div class="col-md-12">
                <h3 class="animated fadeInLeft">Quản lý sách</h3>
            </div>
        </div>
    </div>
    <div class="col-md-12 top-20 padding-0">
        <div class="col-md-12">
            <div class="panel">
                <div class="panel-heading"><h3>Thông tin sách</h3></div>
                <div class="panel-body">
                    <div class="admins view">
                        <table>
                            <tr>
                                <td class="bg-info col-md-3" style="text-align: right;color: white"><?php echo __('Tiêu đề sách'); ?></td>
                                <td>
                                    <?php echo h($ebook['Ebook']['title']); ?>
                                    &nbsp;
                                </td>
                            </tr>
                            <tr>
                                <td class="bg-info col-md-3" style="text-align: right;color: white"><?php echo __('Mô tả'); ?></td>
                                <td>
                                    <?php echo h($ebook['Ebook']['des']); ?>
                                    &nbsp;
                                </td>
                            </tr>
                            <tr>
                                <td class="bg-info col-md-3" style="text-align: right;color: white"><?php echo __('Hình bìa'); ?></td>
                                <td>
                                    <?php echo $this->Html->image('../files/' . $ebook['Ebook']['user_id'] . '/' . $ebook['Ebook']['picture']) ?>
                                </td>
                            </tr>
                            <tr>
                                <td class="bg-info col-md-3" style="text-align: right;color: white"><?php echo __('Tác giả'); ?></td>
                                <td>
                                    <?php echo h($ebook['Ebook']['author']); ?>
                                    &nbsp;
                                </td>
                            </tr>
                            <tr>
                                <td class="bg-info col-md-3" style="text-align: right;color: white"><?php echo __('Thể loại'); ?></td>
                                <td>
                                    <?php echo h($ebook['Category']['name']); ?>
                                    &nbsp;
                                </td>
                            </tr>
                            <tr>
                                <td class="bg-info col-md-3" style="text-align: right;color: white"><?php echo __('Người tải lên'); ?></td>
                                <td>
                                    <?php echo h($ebook['User']['username']); ?>
                                    &nbsp;
                                </td>
                            </tr>
                            <tr>
                                <td class="bg-info col-md-3" style="text-align: right;color: white"><?php echo __('Ngày tạo'); ?></td>
                                <td>
                                    <?php echo h($ebook['Ebook']['created']); ?>
                                    &nbsp;
                                </td>
                            </tr>
                            <tr>
                                <td class="bg-info col-md-3" style="text-align: right;color: white"><?php echo __('Chỉnh sửa lần cuối'); ?></td>
                                <td>
                                    <?php echo h($ebook['Ebook']['modified']); ?>
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
