<div class="row add">
    <div class="large-12 columns">
        <?php
        $ebook = $this->Session->read('data');
        for ($i = 1;$i <= count($ebook);$i++){ ?>
        <div class="row">
            <div class="medium-12 columns">
                <p>File <?php echo $i ?> của <?php echo count($ebook) ?> | <srong><?php echo $ebook[$i]['name'] ?></srong> | Thêm thông tin</p>
            </div>
        </div>
        <div class="row">
            <div class="small-4 large-2 columns">
                <?php echo $this->Html->image('../Ebook/'.$ebook[$i]['id'].'/'.$ebook[$i]['pic']); ?>
            </div>
            <div class="large-5 columns">
                <section>
                    <div class="column">
                        <?php echo $this->Form->create('Ebook', array('type' => 'file')) ?>
                        <?php echo $this->Form->input('Ebook.' . $i . '.title', array('value' => pathinfo($ebook[$i]['name'],PATHINFO_FILENAME))) ?>
                        <?php echo $this->Form->input('Ebook.' . $i . '.des') ?>
                    </div>
                </section>
            </div>
            <div class="large-5 columns">
                <section>
                    <div class="column">
                        <?php echo $this->Form->input('Ebook.' . $i . '.author') ?>
                        <?php echo $this->Form->input('Ebook.' . $i . '.categories_id', array('type' => 'select', 'options' => $ebook[$i]['list'])) ?>
                        <?php echo $this->Form->label('Ebook.' . $i . '.publish') ?>
                        <?php echo $this->Form->radio('Ebook.' . $i . '.publish',array(1 => 'Yes',0 => 'No'),array('legend' => false)) ?>
                    </div>
                </section>
            </div>
        </div>
        <?php } ?>
        <?php
        $option1 = array(
            'label'=>'Lưu thông tin',
            'div'=> false,
            'class' => 'button success',
            'style' => 'float:right'
        );
        echo $this->Html->link('Hủy',array('action'=>'upload'), array('class'=>'button','style' => 'float:right;margin-left:5px'));
        echo $this->Form->end($option1);
         ?>
    </div>
</div>