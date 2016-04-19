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
                            echo $this->Html->image('../files/user/picture/' . $user['User']['picture_dir'] . '/thumb_' . $user['User']['picture'])
                        ?>
                    </div>
                    <div class="small-8 large-8 columns">
                        <h4><?= $user['User']['first_name'] . " " . $user['User']['last_name'] ?></h4>
                        <?php
                        if (empty($account) || $account['User']['id'] == $user['User']['id']) {
                        }
                        elseif (empty($status))
                            echo $this->Form->button("Add Friend", array('id' => 'btnaddfr'));
                        elseif ($status['Friend1']['status'] == 0 || $status['Friend1']['status'] == 2)
                            echo $this->Form->button("Requesting", array('type' => 'disable'));
                        elseif ($status['Friend1']['status'] == 1)
                            echo $this->Form->button("Friend", array('type' => 'disable'));
                        ?>
                    </div>
                    <div class="row" style="clear:both;">
                        <ul class="button-group even-2">
                            <li><a href="#" class="button"> Ebooks <span><?php echo count($user['Ebook']) ?> </span></a>
                            </li>
                            <li><a href="#" class="button"> Friends <span><?php echo count($friend) ?></span></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <ul class="ebview small-block-grid-1 medium-block-grid-3 large-block-grid-5">
            <?php foreach ($user['Ebook'] as $ebook) { ?>
                <li>
                    <?php $image = $this->Html->image('../files/' . $ebook['user_id'] . '/' . $ebook['picture']);
                    echo $this->Html->link($image, array('controller' => 'ebooks', 'action' => 'view', $ebook['id']), array('escape' => false)) ?>
                    <br>
                    <?php echo $ebook['title'] ?>
                </li>
            <?php } ?>
        </ul>
    </div>

</section>

<script>
    $(document).ready(function () {
        $('#btnaddfr').click(function () {
            $.ajax({
                url: '../addfriend',
                type: 'POST',
                cache: false,
                data: {user_one_id:<?php echo $account['User']['id']?>,user_two_id:<?php echo $user['User']['id']?>},
                success: function (string) {
                    toastr.success("Đã gửi yêu cầu!")
                    $('#btnaddfr').html('Requesting');
                },
                error: function () {
                    alert('Có lỗi xảy ra');
                }
            });
        });
    });
</script>
