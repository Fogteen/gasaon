<div id="fb-root"></div>
<script>
    $(document).ready(function () {
        (function (d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s);
            js.id = id;
            js.src = "//connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.6&appId=1044940168912905";
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
            type="application/pdf" width="100%" height="550px">

            <p>Trình duyệt của bạn không hỗ trợ xem tập tin PDF.</p>

        </object>
    </div>
    <div class="large-3 columns">
        <h5><?php echo $ebook['Ebook']['title'] ?></h5>
        <span><?php echo $this->Time->format(
                    'F j, Y',
                    $ebook['Ebook']['created']) . " by " .
                $this->Html->link($ebook['User']['username'], array('controller' => 'users', 'action' => 'view', $ebook['Ebook']['user_id'])) ?></span>
        <hr>
        <h5>Đánh giá:(<?php echo count($allrate) ?> lượt)</h5>
        <input type="range" value="<?php echo $ebook['Ebook']['rating'] ?>" step="1" id="backing">
        <div class="rateit" data-rateit-backingfld="#backing" data-rateit-resetable="false" data-rateit-ispreset="true"
             data-rateit-min="0" data-rateit-max="10">
        </div>
        <hr>
        <h5>Chia sẻ</h5>
        <div class="fb-share-button" data-href="<?php echo $ebook['Ebook']['id'] ?>" data-layout="button_count"></div>
        <hr>
        <h5> Mô tả</h5>
        <span><?php echo $ebook['Ebook']['des'] ?></span><br>
        <span> Thể loại: <?php echo $ebook['Category']['name'] ?></span><br>
        <span> Tác giả: <?php echo $ebook['Ebook']['author'] ?></span><br>
        <span> Lượt xem: <?php echo $view ?></span><br>
        <span> Lượt tải: <?php echo $down ?></span><br>
        <hr>
        <?php
        if (empty($account)) {
        } elseif ($ebook['Ebook']['user_id'] !== $account['User']['id']) {
            if (empty($request))
                echo $this->Form->button(" Gửi yêu cầu", array('id' => 'btnrequest', 'class' => 'fi-mail'));
            elseif ($request['Request']['status'] != 3)
                echo $this->Form->button(" Hủy yêu cầu", array('id' => 'btncancle', 'type' => 'disable', 'class' => 'alert fi-info'));
            else {
                echo $this->Form->create("", array('url' => array('controller' => 'ebooks', 'action' => 'download', base64_encode($ebook['Ebook']['id']))));
                echo $this->Form->button(" Tải xuống", array('class' => 'success fi-download'));
                echo $this->Form->end();
            }
        } else {
            echo $this->Form->create("", array('url' => array('controller' => 'ebooks', 'action' => 'download', base64_encode($ebook['Ebook']['id']))));
            echo $this->Form->button(" Tải xuống", array('class' => 'success fi-download'));
            echo $this->Form->end();
        }
        ?>
    </div>

</div>
<div class="row sameuser" style=" margin-top: 40px;border-radius:10px;border: 2px solid #69708C;">
    <div class="large-12 columns">
        <div>
            <h4 style="float:left;margin-bottom: 20px;padding-top:20px;color:grey">CÙNG NGƯỜI TẢI LÊN</h4>
        </div>
            <ul class="example-orbit" data-orbit data-options="animation:slide;
                  pause_on_hover:true;
                  slide_number: false;
                  navigation_arrows:true;
                  bullets:false;
                  timer:false">
                <?php foreach ($sameuser as $key => $book) {
                    if ($key % 4 == 0) { ?>
                        <li>
                        <ul class="ebview small-block-grid-2 medium-block-grid-3 large-block-grid-4">
                        <li>
                            <?php $image = $this->Html->image('../files/' . $book['Ebook']['user_id'] . '/' . $book['Ebook']['picture'], array('class' => 'card'));
                            echo $this->Html->link($image, array('controller' => 'ebooks', 'action' => 'view', $book['Ebook']['id']), array('escape' => false)) ?>
                            <br>
                            <?php echo $book['Ebook']['title'] ?>
                        </li>
                    <?php } elseif ($key % 4 != 3) { ?>
                        <li>
                            <?php $image = $this->Html->image('../files/' . $book['Ebook']['user_id'] . '/' . $book['Ebook']['picture'], array('class' => 'card'));
                            echo $this->Html->link($image, array('controller' => 'ebooks', 'action' => 'view', $book['Ebook']['id']), array('escape' => false)) ?>
                            <br>
                            <?php echo $book['Ebook']['title'] ?>
                        </li>
                    <?php } else { ?>
                        <li>
                            <?php $image = $this->Html->image('../files/' . $book['Ebook']['user_id'] . '/' . $book['Ebook']['picture'], array('class' => 'card'));
                            echo $this->Html->link($image, array('controller' => 'ebooks', 'action' => 'view', $book['Ebook']['id']), array('escape' => false)) ?>
                            <br>
                            <?php echo $book['Ebook']['title'] ?>
                        </li>
                        </ul>
                    <?php } ?>
                    </li>
                <?php } ?>
            </ul>
    </div>
    <div class="large-12 columns">
        <div>
            <h4 style="float:left;margin-bottom: 20px;padding-top:20px;color:grey">CÓ THỂ BẠN MUỐN XEM</h4>
        </div>
            <ul class="example-orbit" data-orbit data-options="animation:slide;
                  pause_on_hover:true;
                  slide_number: false;
                  navigation_arrows:true;
                  bullets:false;
                  timer:false">
                <?php foreach ($relate as $key => $book) {
                    if ($key % 4 == 0) { ?>
                        <li>
                        <ul class="ebview small-block-grid-2 medium-block-grid-3 large-block-grid-4">
                        <li>
                            <?php $image = $this->Html->image('../files/' . $book['Ebook']['user_id'] . '/' . $book['Ebook']['picture'], array('class' => 'card'));
                            echo $this->Html->link($image, array('controller' => 'ebooks', 'action' => 'view', $book['Ebook']['id']), array('escape' => false)) ?>
                            <br>
                            <?php echo $book['Ebook']['title'] ?>
                        </li>
                    <?php } elseif ($key % 4 != 3) { ?>
                        <li>
                            <?php $image = $this->Html->image('../files/' . $book['Ebook']['user_id'] . '/' . $book['Ebook']['picture'], array('class' => 'card'));
                            echo $this->Html->link($image, array('controller' => 'ebooks', 'action' => 'view', $book['Ebook']['id']), array('escape' => false)) ?>
                            <br>
                            <?php echo $book['Ebook']['title'] ?>
                        </li>
                    <?php } else { ?>
                        <li>
                            <?php $image = $this->Html->image('../files/' . $book['Ebook']['user_id'] . '/' . $book['Ebook']['picture'], array('class' => 'card'));
                            echo $this->Html->link($image, array('controller' => 'ebooks', 'action' => 'view', $book['Ebook']['id']), array('escape' => false)) ?>
                            <br>
                            <?php echo $book['Ebook']['title'] ?>
                        </li>
                        </ul>
                    <?php } ?>
                    </li>
                <?php } ?>
            </ul>
    </div>
</div>
<div class="row comment" style="padding-left: 20px;margin-top: 60px;border-radius: 20px;background-color: lightcyan;width: 100%">
    <h3>Bình luận</h3>
    <div class="fb-comments" data-href="<?php echo('http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']); ?>"
         data-width="700" data-numposts="5"></div>
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
                    toastr.success("Đã gửi yêu cầu!");
                    $('#btnrequest').html(' Requesting');
                },
                error: function () {
                    alert('Có lỗi xảy ra');
                }
            });
        });

        $('#btncancle').click(function () {
            $.ajax({
                url: '../requestdel',
                type: 'POST',
                cache: false,
                data: {ebook_id:<?php echo $ebook['Ebook']['id']?>, user_id:<?php echo $account['User']['id']?>},
                success: function (string) {
                    toastr.success("Đã hủy yêu cầu!");
                    setTimeout("window.location.reload();", 2000);
                },
                error: function () {
                    alert('Có lỗi xảy ra');
                }
            });
        });

        var rating = <?php echo $ebook['Ebook']['rating']?>;
        var count = <?php if (empty($allrate)) echo 0; else echo count($allrate) ?>;
        $('.rateit').rateit('readonly', <?php if (empty($rate)) echo 'false'; else echo 'true' ?>);
        $('.rateit').bind('rated', function () {
            var value = $('.rateit').rateit('value');
            console.log(value);
            $.ajax({
                url: '../rate',
                type: 'POST',
                data: {
                    rate: value,
                    user_id:<?php echo $account['User']['id']?>,
                    ebook_id:<?php echo $ebook['Ebook']['id']?>,
                    rating: parseFloat((rating * count + value) / (count + 1))
                },
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