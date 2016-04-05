<div class="row collapse">
    <div class="large-12 columns">
        <h1><?php echo $ebook['Ebook']['title'] ?></h1>
        <div class="row">
            <div class="small-4 large-2 columns">
                <?php echo $this->Form->create('Ebook', array('type' => 'file')) ?>
                <?php echo $this->Html->image('../files/' . $ebook['Ebook']['user_id'] . '/' . $ebook['Ebook']['picture']); ?>
                <?php echo $this->Form->input('Ebook.picture', array('type' => 'file')) ?>
            </div>
            <div class="large-5 columns">
                <section>
                    <div class="column">
                        <?php echo $this->Form->input('Ebook.file', array('type' => 'hidden')) ?>
                        <?php echo $this->Form->input('Ebook.user_id', array('type' => 'hidden')) ?>
                        <?php echo $this->Form->input('Ebook.title') ?>
                        <?php echo $this->Form->input('Ebook.des') ?>
                    </div>
                </section>
            </div>
            <div class="large-5 columns">
                <section>
                    <div class="column">
                        <?php echo $this->Form->input('Ebook.author') ?>
                        <?php echo $this->Form->input('Ebook.categories_id', array('type' => 'select', 'options' => $categories)) ?>
                        <?php echo $this->Form->label('Ebook.publish') ?>
                        <?php echo $this->Form->radio('Ebook.publish', array(1 => 'Yes', 0 => 'No'), array('legend' => false)) ?>
                    </div>
                </section>
            </div>
        </div>
        <?php echo $this->Form->end('Save') ?>
    </div>
</div>