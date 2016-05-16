<?php
echo $this->Html->script(array('jquery.min', 'jquery.ui.min', 'bootstrap.min', 'plugins/moment.min', 'plugins/icheck.min', 'plugins/jquery.nicescroll', 'plugins/chart.min', 'plugins/jquery.validate.min', 'plugins/jquery.datatables.min', 'plugins/datatables.bootstrap.min', 'dropzone', 'main'));
?>
<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<!-- start: Javascript -->
<script type="text/javascript">
    <?php  if ($this->action == 'home') { ?>
    (function (jQuery) {

        // start: Chart =============

        Chart.defaults.global.pointHitDetectionRadius = 1;
        Chart.defaults.global.customTooltips = function (tooltip) {

            var tooltipEl = $('#chartjs-tooltip');

            if (!tooltip) {
                tooltipEl.css({
                    opacity: 0
                });
                return;
            }

            tooltipEl.removeClass('above below');
            tooltipEl.addClass(tooltip.yAlign);

            var innerHtml = '';
            if (undefined !== tooltip.labels && tooltip.labels.length) {
                for (var i = tooltip.labels.length - 1; i >= 0; i--) {
                    innerHtml += [
                        '<div class="chartjs-tooltip-section">',
                        '   <span class="chartjs-tooltip-key" style="background-color:' + tooltip.legendColors[i].fill + '"></span>',
                        '   <span class="chartjs-tooltip-value">' + tooltip.labels[i] + '</span>',
                        '</div>'
                    ].join('');
                }
                tooltipEl.html(innerHtml);
            }

            tooltipEl.css({
                opacity: 1,
                left: tooltip.chart.canvas.offsetLeft + tooltip.x + 'px',
                top: tooltip.chart.canvas.offsetTop + tooltip.y + 'px',
                fontFamily: tooltip.fontFamily,
                fontSize: tooltip.fontSize,
                fontStyle: tooltip.fontStyle
            });
        };
        var randomScalingFactor = function () {
            return Math.round(Math.random() * 100);
        };


        window.onload = function () {
            user = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
            book = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
            $.ajax({
                async: true,
                url: '<?php echo $this->Html->url(array('controller' => 'admins', 'action' => 'tkuser')) ?>',
                type: 'GET',
                cache: false,
                success: function (data) {
                    $.each(data, function (key, value) {
                        console.log(value);
                        user[value[0].th - 1] = value[0].sl;
                        renderUser(user);
                    });

                },
                error: function () {
                    alert('Có lỗi xảy ra');
                }
            });
            $.ajax({
                async: true,
                url: '<?php echo $this->Html->url(array('controller' => 'admins', 'action' => 'tkbook')) ?>',
                type: 'GET',
                cache: false,
                success: function (data) {
                    $.each(data, function (key, value) {
                        book[value[0].th - 1] = value[0].sl;
                        renderBook(book);
                    });

                },
                error: function () {
                    alert('Có lỗi xảy ra');
                }
            });
            var renderUser = function(user) {
                var lineChartData = {
                    labels: ["Tháng 1", "Tháng 2", "Tháng 3", "Tháng 4", "Tháng 5", "Tháng 6", "Tháng 7", "Tháng 8", "Tháng 9", "Tháng 10", "Tháng 11", "Tháng 12"],
                    datasets: [{
                        label: "My First dataset",
                        fillColor: "rgba(21,186,103,0.4)",
                        strokeColor: "rgba(220,220,220,1)",
                        pointColor: "rgba(66,69,67,0.3)",
                        pointStrokeColor: "#fff",
                        pointHighlightFill: "#fff",
                        pointHighlightStroke: "rgba(220,220,220,1)",
                        data: user
                    }]
                };
                var ctx2 = $(".line-chart")[0].getContext("2d");
                window.myLine = new Chart(ctx2).Line(lineChartData, {
                    responsive: true,
                    showTooltips: true,
                    multiTooltipTemplate: "<%= value %>",
                    maintainAspectRatio: false
                });
            };

            var renderBook = function(book) {
                var barChartData = {
                    labels: ["Tháng 1", "Tháng 2", "Tháng 3", "Tháng 4", "Tháng 5", "Tháng 6", "Tháng 7", "Tháng 8", "Tháng 9", "Tháng 10", "Tháng 11", "Tháng 12"],
                    datasets: [
                        {
                            label: "My Second dataset",
                            fillColor: "rgba(21,113,186,0.5)",
                            strokeColor: "rgba(151,187,205,0.8)",
                            highlightFill: "rgba(21,113,186,0.2)",
                            highlightStroke: "rgba(21,113,186,0.2)",
                            data: book
                        }
                    ]
                };
                var ctx3 = $(".bar-chart")[0].getContext("2d");
                window.myLine = new Chart(ctx3).Bar(barChartData, {
                    responsive: true,
                    showTooltips: true
                });
            }




        };

        //  end:  Chart =============


    })(jQuery);

    <?php } ?>

    <?php  if ($this->action == 'add'){?>
    $(document).ready(function () {

        $("#signupForm").validate({
            errorElement: "em",
            errorPlacement: function (error, element) {
                $(element.parent("div").addClass("form-animate-error"));
                error.appendTo(element.parent("div"));
            },
            success: function (label) {
                $(label.parent("div").removeClass("form-animate-error"));
            },
            rules: {
                'data[User][username]': {
                    required: true,
                    minlength: 6
                },
                'data[User][password]': {
                    required: true,
                    minlength: 6
                },
                'data[User][confirm_password]': {
                    required: true,
                    minlength: 6,
                    equalTo: "#validate_password"
                },
                'data[User][email]': {
                    required: true,
                    email: true
                },
                'data[User][role]': {
                    required: true
                }
            },
            messages: {
                'data[User][role]': "Hãy chọn loại tài khoản",
                'data[User][username]': {
                    required: "Hãy nhập tên tài khoản",
                    minlength: "Tên tài khoản phải có ít nhất 6 kí tự"
                },
                'data[User][password]': {
                    required: "Hãy nhập vào mật khẩu",
                    minlength: "Mật khẩu phải có ít nhất 6 kí tự"
                },
                'data[User][confirm_password]': {
                    required: "Hãy nhập lại mật khẩu",
                    minlength: "Mật khẩu phải có ít nhất 6 kí tự",
                    equalTo: "Hãy nhập mật khẩu giống ở trên"
                },
                'data[User][email]': {
                    required: "Hãy nhập địa chỉ email",
                    email: "Địa chỉ email không hợp lệ"
                }
            }
        });

    });

    $(document).ready(function () {
        $('input').iCheck({
            checkboxClass: 'icheckbox_flat-aero',
            radioClass: 'iradio_flat-aero'
        });
    });
    <?php } ?>

    <?php  if ($this->action == 'listuser' || $this->action == 'listbook'){?>
    $(document).ready(function () {
        $('#datatables-example').DataTable();
    });
    <?php } ?>

</script>
<!-- end: Javascript -->

</body>
</html>
