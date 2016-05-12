<div class="row add">
    <div class="large-12 columns">
        <h2><?php echo $ebook['Ebook']['title'] ?></h2>
        <div class="row">
            <div class="small-4 large-2 columns">
                <?php echo $this->Form->create('Ebook', array('type' => 'file')) ?>
                <?php echo $this->Html->image('../files/' . $ebook['Ebook']['user_id'] . '/' . $ebook['Ebook']['picture']); ?>
                <?php echo $this->Form->input('Ebook.picture', array('type' => 'file','label'=>'Hình bìa')) ?>
            </div>
            <div class="large-5 columns">
                <section>
                    <div class="column">
                        <?php echo $this->Form->input('Ebook.file', array('type' => 'hidden')) ?>
                        <?php echo $this->Form->input('Ebook.user_id', array('type' => 'hidden')) ?>
                        <?php echo $this->Form->input('Ebook.title',array('label'=>'Tiêu đề')) ?>
                        <?php echo $this->Form->input('Ebook.des',array('label'=>'Mô tả')) ?>
                    </div>
                </section>
            </div>
            <div class="large-5 columns">
                <section>
                    <div class="column">
                        <?php echo $this->Form->input('Ebook.author',array('label'=>'Tác giả')) ?>
                        <?php echo $this->Form->input('Ebook.categories_id', array('label'=>'Danh mục','type' => 'select', 'options' => $categories, 'empty'=>'Chọn danh mục')) ?>
                        <?php echo $this->Form->input('Ebook.publish', array('label'=>'Chia sẻ','type' => 'select', 'options' => array(1=>'Có', 0=>'Không'),'empty'=>'Chọn chế độ')) ?>
                    </div>
                </section>
            </div>
        </div>
        <?php $options = array(
            'label' => 'Lưu thông tin',
            'div' => false,
            'class' => 'button small success',
            'style' => 'float:right;'
        );
        echo $this->Form->end($options); ?>
    </div>
</div>