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
                <p class="copywrite">Copywrite © 2016</p>
            </div>
        </div>
    </footer>
</div>
</div>
<script>
    $(document).foundation();
    $(document).ready(function(){
        $('#res').click(function(){
            $('#login').foundation('reveal', 'open');
            $('.tab a').click();
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

        $('#UserEmail2').on('blur',function(){
            $.ajax({
                url: '<?php echo $this->Html->url(array('controller' => 'users', 'action' => 'checkemail')) ?>',
                type: 'POST',
                cache: false,
                data: {
                    email: $('#UserEmail2').val()
                },
                success: function (data) {
                    if (data == false) {
                        toastr.error('Email đã được sử dụng. Hãy dùng email khác');
                        $("#UserPassword2").attr("disabled", true);
                        $("#btnsi").attr("disabled", true);
                    }
                    else {
                        $("#btnsi").removeAttr("disabled");
                        $("#UserPassword2").removeAttr("disabled");
                    }
                }
            });
        });

        $('#UserUsername').on('blur',function(){
            $.ajax({
                url: '<?php echo $this->Html->url(array('controller' => 'users', 'action' => 'checkuser')) ?>',
                type: 'POST',
                cache: false,
                data: {
                    username: $('#UserUsername').val()
                },
                success: function (data) {
                    if (data == false) {
                        toastr.error('Tên tài khoản đã được sử dụng. Hãy chọn tên khác');
                        $("#UserEmail2").attr("disabled", true);
                        $("#UserPassword2").attr("disabled", true);
                        $("#btnsi").attr("disabled", true);
                    }
                    else {
                        $("#btnsi").removeAttr("disabled");
                        $("#UserEmail2").removeAttr("disabled");
                        $("#UserPassword2").removeAttr("disabled");
                    }
                }
            });
        });
    });
</script>
</body>
</html>