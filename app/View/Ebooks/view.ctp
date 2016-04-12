<div id="fb-root"></div>
<script>
    $(document).ready(function() {
        $.getScript('//connect.facebook.net/en_US/sdk.js', function(){
            FB.init({
                appId: '{1044940168912905}',
                version: 'v2.5' // or v2.0, v2.1, v2.2, v2.3
            });
        });
        (function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s); js.id = id;
            js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.5&appId=1044940168912905";
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
                $this->Html->link($ebook['User']['first_name'], array('controller' => 'users', 'action' => 'view', $ebook['Ebook']['user_id'])) ?></span>
        <hr>
        <span> Views: xxx</span>
        <hr>
        <div class="fb-share-button" data-href="localhost/gasaon/ebooks/view/118" data-layout="button_count"></div>
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
<script>
    $(document).ready(function () {
        $('#btnrequest').click(function () {
            $.ajax({
                url: '../request',
                type: 'POST',
                cache: false,
                data: {ebook_id:<?php echo $ebook['Ebook']['id']?>, user_id:<?php echo $account['User']['id']?>},
                success: function (string) {
                    alert("Đã gửi yêu cầu!")
                    $('#btnrequest').html('Requesting');
                },
                error: function () {
                    alert('Có lỗi xảy ra');
                }
            });
        });

        $('#btndownload').click(function () {
            $.ajax({
                url: '../download',
                type: 'POST',
                cache: false,
                data: {ebook_id:<?php echo $ebook['Ebook']['id']?>},
                success: function (string) {
                    alert("Tải thành công!")
                },
                error: function () {
                    alert('Có lỗi xảy ra');
                }
            });
        });
    });
</script>