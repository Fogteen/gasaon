</div>
<div id="footer">
    <footer class="footer">
        <div class="row">
            <div class="small-12 columns">
                <p class="slogan">Gác Sách</p>
                <p class="links">
                    <a href="#">Home</a>
                    <a href="#">Ebook</a>
                    <a href="#">User</a>
                    <a href="#">About</a>
                    <a href="#">Contact</a>
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
    });
</script>
</body>
</html>