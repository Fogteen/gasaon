</div>
<div id="footer">
    <footer class="footer">
        <div class="row">
            <div class="small-12 columns">
                <p class="slogan">Gác Sách Online</p>
                <p class="links">
                    <a href="#">Trang chủ</a>
                    <a href="#">Thông tin</a>
                    <a href="#">Liên hệ</a>
                </p>
                <p class="copywrite">Copyright © 2016</p>
            </div>
        </div>
    </footer>
</div>
</div>
<div id="pusherChat">
    <div id="membersContent">
        <span id="expand"><span class="close">&#x25BC;</span><span class="open">&#x25B2;</span></span>
        <h2><span id="count">0</span> online</h2>
        <div class="scroll">
            <div id="members-list"></div>
        </div>
    </div>
    <!-- chat box template -->

    <div id="templateChatBox">
        <div class="pusherChatBox">
                <span class="state">
                    <span class="pencil">
                        <?php echo $this->Html->image('../img/pencil.gif') ?>
                    </span>
                    <span class="quote">
                        <?php echo $this->Html->image('../img/quote.gif') ?>
                    </span>
                </span>

            <span class="expand"><span class="close">&#x25BC;</span><span class="open">&#x25B2;</span></span>
            <span class="closeBox">x</span>
            <h2><a href="#" title="go to profile"><img src="" class="imgFriend"/></a> <span class="userName"></span>
            </h2>

            <div class="slider">
                <div class="logMsg">
                    <div class="msgTxt">
                    </div>
                </div>
                <form method="post" name="#123">
                    <textarea name="msg" rows="3"></textarea>

                    <input type="hidden" name="from" class="from"/>

                    <input type="hidden" name="to" class="to"/>

                    <input type="hidden" name="typing" class="typing" value="false"/>
                </form>
            </div>
        </div>
    </div>
    <!-- chat box template end -->
    <div class="chatBoxWrap">
        <div class="chatBoxslide"></div>
        <span id="slideLeft"> <img src="/img/../img/quote.gif"/>&#x25C0;</span>
        <span id="slideRight">&#x25B6; <img src="/img/../img/quote.gif"/></span>
    </div>
</div>
</div>
<script>
    $(document).foundation();
    $(document).ready(function () {
        $('#nofi').on('click', function () {
            if ($('div.form').html() != '') $('div.form').html('');
            $.ajax({
                url: '<?php echo $this->Html->url(array('controller' => 'users', 'action' => 'nofi')) ?>',
                type: 'POST',
                cache: false,
                success: function (data) {
                    console.log(data);
                    $.each(data, function (key, value) {
                        $('div.form').append('<p class=' + key + '>' + value.Nofication.content + '<br></p>');
                        if (value.Nofication.status == 0)
                            $('p.' + key).append('<button class=yes' + key + '>Đồng ý</button><button class=no' + key + '>Từ chối</button><hr>');
                        else
                            $('p.' + key).append('<button class=yes' + key + '>OK</button><button class=no' + key + '>Bỏ qua</button><hr>');
                        $('button.yes' + key).click(function () {
                            $.ajax({
                                url: '<?php echo $this->Html->url(array('controller' => 'users', 'action' => 'nofiup')) ?>',
                                type: 'POST',
                                cache: false,
                                data: {
                                    status: value.Nofication.status + 1,
                                    id: value.Nofication.id,
                                    request_id: value.Nofication.request_id,
                                    ebook_id: value.Nofication.ebook_id
                                },
                                success: function () {
                                    $('p.' + key).remove();
                                    if ($('div.form').html() == '') $("#nofication").foundation('reveal', 'close');
                                },
                                error: function () {
                                    alert('Có lỗi xảy ra');
                                }
                            });
                        });
                        $('button.no' + key).click(function () {
                            $.ajax({
                                url: '<?php echo $this->Html->url(array('controller' => 'users', 'action' => 'nofidel')) ?>',
                                type: 'POST',
                                cache: false,
                                data: {
                                    id: value.Nofication.id
                                },
                                success: function () {
                                    $('p.' + key).remove();
                                    if ($('div.form').html() == '') $("#nofication").foundation('reveal', 'close');
                                },
                                error: function () {
                                    alert('Có lỗi xảy ra');
                                }
                            });
                        });
                    });
                    if ($('div.form').html() == '') $('div.form').html('<h5>Không có thông báo mới!</h5>');
                },
                error: function () {
                    alert('Có lỗi xảy ra');
                }
            });
        });
        var pusher = new Pusher('ea2f5e5013baa43a541f');
        var myChannel = pusher.subscribe('request_channel');
        var id = <?php echo $account['User']['id']?>;
        myChannel.bind('send_event', function (data) {
            if (data.user_id == id) {
                toastr.success(data.user_send + ' vừa gửi cho bạn yêu cầu về cuốn sách ' + data.title);
                setTimeout("window.location.reload();", 2000);
            }
        });
        myChannel.bind('send_friend_event', function (data) {
            if (data.user_id == id) {
                toastr.success(data.user_send + ' vừa gửi yêu cầu kết bạn.');
                setTimeout("window.location.reload();", 2000);
            }
        });
        myChannel.bind('rei_event', function (data) {
            if (data.user_id == id) {
                toastr.success('Yêu cầu về cuốn sách ' + data.title + ' đã được chấp nhận');
                setTimeout("window.location.reload();", 2000);
            }
        });
        myChannel.bind('rei_friend_event', function (data) {
            if (data.user_id == id) {
                toastr.success(data.user_send + ' đã chấp nhận yêu cầu kết bạn.');
                setTimeout("window.location.reload();", 2000);
            }
        });

        $.fn.pusherChat({
            'pusherKey': 'ea2f5e5013baa43a541f',  // required : open an account on http://pusher.com/ to get one
            'authPath': '<?php echo $this->Html->url(array('controller' => 'users', 'action' => 'chatauth')) ?>', // required : path to authentication scripts more info at http://pusher.com/docs/authenticating_users
            'friendsList': '<?php echo $this->Html->url(array('controller' => 'users', 'action' => 'frlist')) ?>', // required : path to friends list json
            'serverPath': '<?php echo $this->Html->url(array('controller' => 'users', 'action' => 'chat')) ?>', // required : path to server
            'getMess': '<?php echo $this->Html->url(array('controller' => 'users', 'action' => 'getmess')) ?>'
        });

        $(window).scroll(function () {
            if ($(this).scrollTop() > 100) {
                $('#scroll').fadeIn();
            } else {
                $('#scroll').fadeOut();
            }
        });
        $('#scroll').click(function () {
            $("html, body").animate({scrollTop: 0}, 600);
            return false;
        });

    });
</script>
</body>
</html>