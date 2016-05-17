<div class="row detail">
    <div class="large-12 columns">
        <div>
            <h4 style="float:left;margin-bottom: 20px;color:grey">Tìm kiếm</h4>
        <?php if (empty($ebooks)) { ?>
            <h4 style="font-size: 20px;text-align:center;margin-bottom: 20px;padding-top:20px;color:grey">Không tìm thấy kết quả nào với từ khóa "<?php echo $this->Session->read('search')?>"</h4>
        </div>
        <?php } else { ?>
        <ul class="ebview small-block-grid-2 medium-block-grid-3 large-block-grid-4">
            <?php foreach ($ebooks as $ebook) { ?>
                <li>
                    <?php $image = $this->Html->image('../files/' . $ebook['Ebook']['user_id'] . '/' . $ebook['Ebook']['picture'], array('class' => 'card'));
                    echo $this->Html->link($image, array('controller' => 'ebooks', 'action' => 'view', $ebook['Ebook']['id']), array('escape' => false)) ?>
                    <br>
                    <?php echo $ebook['Ebook']['title'] ?>
                </li>
            <?php } ?>
        </ul>
        <?php } ?>
    </div>

    <?php if (count($ebooks) < $count)echo $this->element('Frontend/paginate')?>
</div>