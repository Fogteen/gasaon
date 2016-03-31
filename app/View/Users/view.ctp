
<section class="hero">
        <div class="row bump">
            <div class="small-12 large-12 columns">
                <div class="row">
                    <div class="profile-card">
                        <div class="small-4 large-4 columns">

                            <?php
                            if (strpos($user['User']['picture'],"graph.facebook.com") !== false)
                                echo $this->Html->image('https://'.$user['User']['picture']);
                            else
                                echo $this->Html->image('../files/user/picture/' . $user['User']['picture_dir'] . '/thumb_' . $user['User']['picture'])
                            ?>
                        </div>
                        <div class="small-8 large-8 columns">
                            <h4><?= $user['User']['first_name']." ".$user['User']['last_name']?><br><span>President of XPTO</span></h4>
                        </div>
                        <div class="row" style="clear:both;">
                            <ul class="button-group even-2">
                                <li><a href="#" class="button"> Ebooks <span>432 </span></a></li>
                                <li><a href="#" class="button"> Friends <span>432 </span></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

</section>
