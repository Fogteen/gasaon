<div class="row results">
    <div class="large-6 columns">
        <h3>Kho sách (<?php echo count($ebooks) ?>)</h3>
    </div>
    <div class="large-6 columns">
        <div class="row">
            <?php echo $this->Form->create('', array('url' => array('action' => 'search'))) ?>
            <div class="small-12 large-8 columns">
                <?php echo $this->Form->text('ebsearch'); ?>
            </div>
            <div class="small-12 large-4 columns">
                <?php echo $this->Form->button('Tìm kiếm', array('class' => 'primary', 'type' => 'submit')) ?>
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
                    <?php echo $this->Html->link('Edit', array('action' => 'edit', $ebook['Ebook']['id'])) ?>
                    <?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $ebook['Ebook']['id']), array('confirm' => __('Are you sure you want to delete?'))); ?>
                    <h6>
                        <small> Publish about <?php echo $this->Time->timeAgoInWords(
                                $ebook['Ebook']['created'],
                                array('format' => 'F jS, Y',
                                    'end' => '+1 year',
                                    'accuracy' => array('minute' => 'minute'))) ?></small>
                    </h6>
                </div>
            </div>
            <hr>
        <?php } ?>
    </div>
</div>
<p>
    <?php
    echo $this->Paginator->counter(array(
        'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
    ));
    ?>    </p>
<div class="paging">
    <?php
    echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
    echo $this->Paginator->numbers(array('separator' => ''));
    echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
    ?>
</div>