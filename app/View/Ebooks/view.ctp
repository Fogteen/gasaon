<div class="row view">
    <div class="large-9 columns">
        <object
            data="<?php echo $this->webroot . 'files/' . $ebook['Ebook']['user_id'] . '/pre_' . pathinfo($ebook['Ebook']['file'],PATHINFO_FILENAME).'.pdf' ?>"
            type="application/pdf" width="100%" height="800px">

            <p>It appears you don't have a PDF plugin for this browser.</p>

        </object>
    </div>
    <div class="large-3 columns">
        <h5><?php echo $ebook['Ebook']['title'] ?></h5>
        <span><?php echo $this->Time->format(
                'F j, Y',
                $ebook['Ebook']['created']) . " by " .
                $this->Html->link($ebook['User']['first_name'],array('controller'=>'users','action'=>'view',$ebook['Ebook']['user_id'])) ?></span>
        <hr>
        <span> Views: xxx</span>
        <hr>
        <h5> Description</h5>
        <span><?php echo $ebook['Ebook']['des'] ?></span><br>
        <span> Categories: <?php echo $ebook['Category']['name'] ?></span><br>
        <span> Author: <?php echo $ebook['Ebook']['author'] ?></span><br>
        <hr>
        <?php echo $this->Form->button("Download") ?>
    </div>

</div>