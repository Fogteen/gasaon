<section class="hero">
    <div class="row bump">
        <div class="small-12 large-12 columns">
            <div class="row">
                <div class="profile-card">
                    <div class="small-4 large-4 columns">
                        <?php
                        if (strpos($user['User']['picture'], "graph.facebook.com") !== false)
                            echo $this->Html->image('https://' . $user['User']['picture']);
                        else
                            echo $this->Html->image('../files/user/picture/' . $user['User']['picture_dir'] . '/' . $user['User']['picture'])
                        ?>
                    </div>
                    <div class="small-8 large-8 columns">
                        <h4><?= $user['User']['username'] ?></h4>
                        <?php
                        if (empty($account) || $account['User']['id'] == $user['User']['id']) {
                        } elseif (empty($status))
                            echo $this->Form->button("Kết bạn", array('id' => 'btnaddfr', 'class' => 'friend'));
                        elseif ($status['Friend1']['status'] == 0 || $status['Friend1']['status'] == 2)
                            echo $this->Form->button("Đã gửi yêu cầu", array('type' => 'disable', 'class' => 'friend warning'));
                        elseif ($status['Friend1']['status'] == 1)
                            echo $this->Form->button("Hủy kết bạn", array('id' => 'btnunfr', 'class' => 'friend alert'));
                        ?>
                    </div>
                    <div class="row" style="clear:both;">
                        <ul class="button-group even-2">
                            <li><a href="#" class="button book"> Sách <span><?php echo count($user['Ebook']) ?> </span></a>
                            </li>
                            <li><a href="#" class="button friend"> Bạn bè <span><?php echo count($friend) ?></span></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row book">
        <div>
            <h4>TẤT CẢ SÁCH</h4>
        </div>
        <ul class="ebview small-block-grid-2 medium-block-grid-3 large-block-grid-5">
            <?php foreach ($user['Ebook'] as $ebook) { ?>
                <li>
                    <?php $image = $this->Html->image('../files/' . $ebook['user_id'] . '/' . $ebook['picture'],array('class'=>'card'));
                    echo $this->Html->link($image, array('controller' => 'ebooks', 'action' => 'view', $ebook['id']), array('escape' => false)) ?>
                    <br>
                    <?php echo $ebook['title'] ?>
                </li>
            <?php } ?>
        </ul>
    </div>

    <div class="row friend">
        <div>
        <h4>DANH SÁCH BẠN BÈ</h4>
        </div>
        <ul class="ebview small-block-grid-2 medium-block-grid-3 large-block-grid-5">
            <?php foreach ($friend as $fr) {
                if ($fr['Friend1']['user_one_id'] == $user['User']['id']) { ?>
                <li>
                    <?php $image = $this->Html->image('../files/user/picture/' . $fr['Friend1']['user_two_id'] . '/' . $fr['User2']['picture'], array('class'=>'card'));
                    echo $this->Html->link($image, array('controller' => 'users', 'action' => 'view', $fr['Friend1']['user_two_id']), array('escape' => false)) ?>
                    <br>
                    <?php echo $fr['User2']['username'] ?>
                </li>
            <?php }
            else { ?>
            <li>
                <?php $image = $this->Html->image('../files/user/picture/' . $fr['Friend1']['user_one_id'] . '/' . $fr['User1']['picture'],array('class'=>'card'));
                echo $this->Html->link($image, array('controller' => 'users', 'action' => 'view', $fr['Friend1']['user_one_id']), array('escape' => false)) ?>
                <br>
                <?php echo $fr['User1']['username'] ?>
            </li>
            <?php }} ?>
        </ul>
    </div>

</section>

<script>
    $(document).ready(function () {
        $('div.friend').hide();
        $('a.book').click(function(){
            $('div.friend').hide();
            $('div.book').show();
        });

        $('a.friend').click(function(){
            $('div.book').hide();
            $('div.friend').show();
        });

        <?php if (!empty($account)) { ?>
        $('#btnaddfr').click(function () {
            $.ajax({
                url: '../addfriend',
                type: 'POST',
                cache: false,
                data: {user_one_id:<?php echo $account['User']['id']?>, user_two_id:<?php echo $user['User']['id']?>},
                success: function (string) {
                    toastr.success("Đã gửi yêu cầu!")
                    $('#btnaddfr').html('Requesting');
                    $('#btnaddfr').prop('disabled', true);
                },
                error: function () {
                    toastr.error('Có lỗi xảy ra');
                }
            });
        });
        $('#btnunfr').click(function () {
            $.ajax({
                url: '../unfriend',
                type: 'POST',
                cache: false,
                data: {id:<?php if(empty($status)) echo 0; else echo $status['Friend1']['id'] ?>},
                success: function () {
                    toastr.success("Đã hủy kết bạn!");
                },
                error: function () {
                    toastr.error('Có lỗi xảy ra');
                }
            });
        });
        <?php } ?>
    });
</script>
