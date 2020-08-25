<?php include APP_TROUTE.APP_THEME.'/footer'.APP_THEME_EXT; ?>
   <!-- Required jquery and libraries -->
    <script src="<?php echo APP_URL.APP_TROUTE.APP_THEME; ?>/assets/js/jquery-3.3.1.min.js"></script>
    <script src="<?php echo APP_URL.APP_TROUTE.APP_THEME; ?>/assets/js/popper.min.js"></script>
    <script src="<?php echo APP_URL.APP_TROUTE.APP_THEME; ?>/assets/vendor/bootstrap-4.4.1/js/bootstrap.min.js"></script>

    <!-- cookie css -->
    <script src="<?php echo APP_URL.APP_TROUTE.APP_THEME; ?>/assets/vendor/cookie/jquery.cookie.js"></script>

    <!-- Swiper slider  -->
    <script src="<?php echo APP_URL.APP_TROUTE.APP_THEME; ?>/assets/vendor/swiper/js/swiper.min.js"></script>

    <!-- date range picker -->
    <script src="<?php echo APP_URL.APP_TROUTE.APP_THEME; ?>/assets/vendor/daterangepicker-master/moment.min.js"></script>
    <script src="<?php echo APP_URL.APP_TROUTE.APP_THEME; ?>/assets/vendor/daterangepicker-master/daterangepicker.js"></script>

    <!-- Swiper slider  -->
    <script src="<?php echo APP_URL.APP_TROUTE.APP_THEME; ?>/assets/vendor/sparklines/jquery.sparkline.min.js"></script>

    <!-- Customized jquery file  -->
    <script src="<?php echo APP_URL.APP_TROUTE.APP_THEME; ?>/assets/js/main.js"></script>
    <script src="<?php echo APP_URL.APP_TROUTE.APP_THEME; ?>/assets/js/color-scheme-demo.js"></script>

    <script>
        "use strict"
        $(document).ready(function() {
            /* Swiper slider */
            var swiper = new Swiper('.swiper-categories', {
                slidesPerView: 'auto',
                spaceBetween: 0,
                pagination: false,
            });

            var swiper = new Swiper('.swiper-offers', {
                slidesPerView: 'auto',
                spaceBetween: 10,
                pagination: false,
            });

            /* swiper tavs  js */
            $('#recurring-tab[data-toggle="tab"]').on('shown.bs.tab', function(e) {
                var swiper = new Swiper('.swiper-container', {
                    effect: 'coverflow',
                    grabCursor: true,
                    centeredSlides: true,
                    slidesPerView: 'auto',
                    spaceBetween: 10,
                    coverflowEffect: {
                        rotate: 30,
                        stretch: 0,
                        depth: 80,
                        modifier: 1,
                        slideShadows: true,
                    }

                });

            });

            /* swiper tavs  js */
            $('#addexpense').on('shown.bs.modal', function(e) {
                $('.amount').focusin();

                /* calander picker */
                var start = moment().subtract(29, 'days');
                var end = moment();

                /* calander single  picker ends */
                $('.datepicker').daterangepicker({
                    singleDatePicker: true,
                    showDropdowns: true,
                    drops: 'up',
                    minYear: 1901
                }, function(start, end, label) {});

            });

            /* toast message */
            setTimeout(function() {
                $('.toast').toast('show')
            }, 2000);

            /* sparklines */
            $("#sparklines1").sparkline([5, 6, 7, 9, 9, 5, 3, 2, 2, 4, 6, 7, 5, 6, 7, 9, 9, 5, 3, 2, 2, 4, 6, 7], {
                type: 'bar',
                height: '20px',
                barWidth: 2,
                barColor: '#e0eaff'
            });

        });

    </script>
<!-- Build Scripts DO NOT REMOVE-->
<script src="<?php echo APP_URL; ?>core/js/jquery-3.4.1.min.js"></script>
<script src="<?php echo APP_URL; ?>core/js/app.js"></script>

</body>