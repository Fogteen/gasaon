<div class="row results">
    <div class="large-6 columns">
        <h3>Kho sách</h3>
    </div>
    <div class="large-6 columns">
        <div class="row">
            <?php echo $this->Form->create('Ebook', array('url' => array('controller'=>'ebooks','action' => 'search'))) ?>
            <div class="small-12 large-8 columns">
                <?php echo $this->Form->text('ebsearch'); ?>
            </div>
            <div class="small-12 large-4 columns">
                <?php echo $this->Form->button('Tìm kiếm', array('class' => 'tiny primary', 'type' => 'submit')) ?>
            </div>
            <?php echo $this->Form->end() ?>
        </div>
    </div>
</div>
<div class="search-results">
    <div class="row">
        <?php foreach ($ebooks as $ebook) { ?>
            <div class="row item">
                <div class="small-3 large-2 columns">
                    <?php echo $this->Html->image('../files/' . $ebook['Ebook']['user_id'] . '/' . $ebook['Ebook']['picture']) ?>
                </div>
                <div class="small-9 large-8 columns">
                    <h5><?php echo $this->Html->link($ebook['Ebook']['title'], array('action' => 'view', $ebook['Ebook']['id'])) ?></h5>
                    <h6>Tác giả: <?php echo $ebook['Ebook']['author'] ?></h6>
                    <h6>Thể loại: <?php echo $ebook['Category']['name'] ?></h6>
                    <h6>Mô tả: <?php echo $ebook['Ebook']['des'] ?></h6>
                </div>
                <div class="small-9 large-2 columns">
                    <?php echo $this->Html->link('', array('action' => 'edit', $ebook['Ebook']['id']), array('class'=>'button success tiny fi-wrench', 'title'=>'Chỉnh sửa')) ?>
                    <?php echo $this->Form->postLink('', array('action' => 'delete', $ebook['Ebook']['id']), array('confirm' => __('Bạn chắc chắn muốn xóa?'), 'class'=> 'button alert tiny fi-trash', 'title'=>'Xóa')); ?>
                    <h6>
                        <?php $str_search = array (
                            "hours",
                            "days",
                            "weeks",
                            "months",
                            "years",
                            "hour",
                            "day",
                            "week",
                            "month",
                            "year",
                            "ago",
                        );
                        $str_replace = array (
                            "giờ",
                            "ngày",
                            "tuần",
                            "tháng",
                            "năm",
                            "giờ",
                            "ngày",
                            "tuần",
                            "tháng",
                            "năm",
                            "trước",
                        );
                        ?>
                        <small> Tải lên từ <?php echo str_replace( $str_search, $str_replace,$this->Time->timeAgoInWords(
                                $ebook['Ebook']['created'],
                                array('format' => 'F jS, Y',
                                    'end' => '+1 year',
                                    'accuracy' => array('minute' => 'minute')))) ?></small>
                    </h6>
                </div>
            </div>
            <hr>
        <?php } ?>
        <?php if (count($ebooks) < count($account['Ebook']))echo $this->element('Frontend/paginate') ?>
    </div>
</div>
