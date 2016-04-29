<div id="fb-root"></div>
<script>
    $(document).ready(function() {
        (function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s); js.id = id;
            js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.6&appId=1044940168912905";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
    });
    </script>
<div class="row view">
    <div class="large-9 columns">
        <object
            data="<?php
            if (empty($account) || $ebook['Ebook']['user_id'] !== $account['User']['id'] && (empty($request) || $request['Request']['status'] != 3))
                echo $this->webroot . 'files/' . $ebook['Ebook']['user_id'] . '/pre_' . pathinfo($ebook['Ebook']['file'], PATHINFO_FILENAME) . '.pdf';
            else
                echo $this->webroot . 'files/' . $ebook['Ebook']['user_id'] . '/' . pathinfo($ebook['Ebook']['file'], PATHINFO_FILENAME) . '.pdf' ?>"
            type="application/pdf" width="100%" height="800px">

            <p>It appears you don't have a PDF plugin for this browser.</p>

        </object>
    </div>
    <div class="large-3 columns">
        <h5><?php echo $ebook['Ebook']['title'] ?></h5>
        <span><?php echo $this->Time->format(
                    'F j, Y',
                    $ebook['Ebook']['created']) . " by " .
                $this->Html->link($ebook['User']['username'], array('controller' => 'users', 'action' => 'view', $ebook['Ebook']['user_id'])) ?></span>
        <hr>
        <input type="range" value="<?php echo $ebook['Ebook']['rating']?>" step="1" id="backing">
        <div class="rateit" data-rateit-backingfld="#backing" data-rateit-resetable="false"  data-rateit-ispreset="true"
             data-rateit-min="0" data-rateit-max="10">
        </div>(<?php echo count($allrate)?> lượt)
        <hr>
        <span> Views: xxx</span>
        <hr>
        <div class="fb-share-button" data-href="<?php echo $ebook['Ebook']['id']?>" data-layout="button_count"></div>
        <hr>
        <h5> Description</h5>
        <span><?php echo $ebook['Ebook']['des'] ?></span><br>
        <span> Categories: <?php echo $ebook['Category']['name'] ?></span><br>
        <span> Author: <?php echo $ebook['Ebook']['author'] ?></span><br>
        <hr>
        <?php
        if (empty($account)) {
        }
        elseif ($ebook['Ebook']['user_id'] !== $account['User']['id']){
            if (empty($request))
                echo $this->Form->button("Request", array('id' => 'btnrequest'));
            elseif ($request['Request']['status'] != 3)
                echo $this->Form->button("Requesting", array('type' => 'disable'));
            else {
                echo $this->Form->create("", array('url' => array('action' => 'download', base64_encode($ebook['Ebook']['id']))));
                echo $this->Form->button("Download");
                echo $this->Form->end();
            }
        }
        else {
            echo $this->Form->create("", array('url' => array('action' => 'download', base64_encode($ebook['Ebook']['id']))));
            echo $this->Form->button("Download");
            echo $this->Form->end();
        }
        ?>
    </div>

</div>
<div class="row comment">
    <div class="fb-comments" data-href="http://localhost/gasaon/ebooks/view/<?php echo $ebook['Ebook']['id']?>" data-width="700" data-numposts="5"></div>
</div>
<script>
    $(document).ready(function () {
        $('#btnrequest').click(function () {
            $.ajax({
                url: '../request',
                type: 'POST',
                cache: false,
                data: {ebook_id:<?php echo $ebook['Ebook']['id']?>, user_id:<?php echo $account['User']['id']?>},
                success: function (string) {
                    toastr.success("Đã gửi yêu cầu!")
                    $('#btnrequest').html('Requesting');
                },
                error: function () {
                    alert('Có lỗi xảy ra');
                }
            });
        });

        var rating = <?php echo $ebook['Ebook']['rating']?>;
        var count = <?php if (empty($allrate)) echo 0; else echo count($allrate) ?>;
        $('.rateit').rateit('readonly', <?php if (empty($rate)) echo 'false'; else echo 'true' ?>);
        $('.rateit').bind('rated', function(){
            var value = $('.rateit').rateit('value');
            console.log(value);
            $.ajax({
                url: '../rate',
                type: 'POST',
                data: {rate:value, user_id:<?php echo $account['User']['id']?>,
                    ebook_id:<?php echo $ebook['Ebook']['id']?>, rating:parseFloat((rating*count + value)/(count+1))},
                success: function (string) {
                    toastr.success("Bình chọn thành công!");
                },
                error: function () {
                    toastr.error("Có lỗi xảy ra!")
                }
            });
        });
    });
</script>