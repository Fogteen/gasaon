<div class="row des">
    <div class="small-12 large-12 columns">
        <h2>Tải lên và chia sẻ cùng mọi người</h2>
    </div>
    </div>
<div class="row upload">
    <div class="small-12 large-12 columns">

        <?php
        echo $this->Form->create(array('url' => array('controller' => 'ebooks', 'action' => 'upload'), 'class' => 'dropzone',
            'id' => 'my-dropzone'));
        ?>
        <div class="fallback">
            <input name="file" type="file" multiple=""/>
        </div>
        <?php
        echo $this->Form->button('Submit', array('class' => 'success button'));
        echo $this->Form->end();
        ?>
    </div>
</div>
