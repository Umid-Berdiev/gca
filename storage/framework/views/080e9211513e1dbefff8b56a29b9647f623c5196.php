<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <!-- <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon"> -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="<?php echo e(asset('project_gca/font/stylesheet.css')); ?>">
    <link href="<?php echo e(asset('project_gca/css/datepicker.css')); ?>" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="<?php echo e(asset('project_gca/css/jquery.fancybox.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('project_gca/css/bootstrap.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('project_gca/css/swiper.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('project_gca/css/style.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('project_gca/css/media.css')); ?>">
    <script src="<?php echo e(asset('project_gca/js/vue.js')); ?>"></script>
    <script src="<?php echo e(asset('project_gca/js/axios.min.js')); ?>"></script>

    <title>GSA</title>
</head>

<body>
<header>
    <div class="hdr_top">
        <div class="container">
            <div class="hdr_top_main">
                <div class="phone_top right_border">
                    <svg width="8" height="8" viewBox="0 0 8 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M3.38433 4.61486C4.17608 5.40595 5.09337 6.16304 5.45599 5.8005C5.97465 5.28194 6.29475 4.82989 7.43911 5.74949C8.58298 6.6686 7.7042 7.28167 7.20154 7.78372C6.62136 8.36379 4.45867 7.81473 2.321 5.67798C0.183822 3.54074 -0.363852 1.37849 0.216832 0.798424C0.719491 0.295367 1.32968 -0.582733 2.24897 0.560897C3.16876 1.70453 2.71712 2.02456 2.19746 2.54362C1.83634 2.90617 2.59308 3.82327 3.38433 4.61486Z"
                              fill="#2DA37D"></path>
                    </svg>
                    <span><?php echo app('translator')->getFromJson('blog.phone'); ?>: </span>
                    <a href="tel:+998 71 241 40 48">
                        +998 71 241 40 48
                    </a>
                </div>
                <div class="mail_top right_border">
                    <svg width="10" height="8" viewBox="0 0 10 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M9 0H1C0.45 0 0.005 0.45 0.005 1L0 7C0 7.55 0.45 8 1 8H9C9.55 8 10 7.55 10 7V1C10 0.45 9.55 0 9 0ZM9 2L5 4.5L1 2V1L5 3.5L9 1V2Z"
                              fill="#2DA37D"></path>
                    </svg>
                    <span><?php echo app('translator')->getFromJson('blog.email'); ?>: </span>
                    <a href="mailto:info@giz.de">
                        info@giz.de
                    </a>
                </div>
                <div class="address_top right_border">
                    <svg width="7" height="10" viewBox="0 0 7 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M3.12695 0C1.39962 0 0 1.394 0 3.1207C0 6.10632 3.12695 10 3.12695 10C3.12695 10 6.25391 6.10569 6.25391 3.1207C6.25391 1.39462 4.85428 0 3.12695 0ZM3.12695 4.8474C2.67912 4.8474 2.24963 4.6695 1.93297 4.35284C1.6163 4.03617 1.4384 3.60668 1.4384 3.15885C1.4384 2.71102 1.6163 2.28153 1.93297 1.96486C2.24963 1.64819 2.67912 1.47029 3.12695 1.47029C3.57479 1.47029 4.00428 1.64819 4.32094 1.96486C4.63761 2.28153 4.81551 2.71102 4.81551 3.15885C4.81551 3.60668 4.63761 4.03617 4.32094 4.35284C4.00428 4.6695 3.57479 4.8474 3.12695 4.8474Z"
                              fill="#2DA37D"></path>
                    </svg>
                    <span><?php echo app('translator')->getFromJson('blog.visit'); ?>:</span>
                    <a href="" onclick="return false;">
                        <?php echo app('translator')->getFromJson('blog.vizit_text'); ?>
                    </a>
                </div>
                <div class="language_top right_border">
                    <p>
                        <svg width="10" height="10" viewBox="0 0 10 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M4.995 0C2.235 0 0 2.24 0 5C0 7.76 2.235 10 4.995 10C7.76 10 10 7.76 10 5C10 2.24 7.76 0 4.995 0ZM8.46 3H6.985C6.82851 2.38073 6.59679 1.78295 6.295 1.22C7.20706 1.534 7.97558 2.16586 8.46 3ZM5 1.02C5.415 1.62 5.74 2.285 5.955 3H4.045C4.26 2.285 4.585 1.62 5 1.02ZM1.13 6C1.05 5.68 1 5.345 1 5C1 4.655 1.05 4.32 1.13 4H2.82C2.78 4.33 2.75 4.66 2.75 5C2.75 5.34 2.78 5.67 2.82 6H1.13ZM1.54 7H3.015C3.175 7.625 3.405 8.225 3.705 8.78C2.79198 8.46772 2.02292 7.83541 1.54 7ZM3.015 3H1.54C2.02292 2.16459 2.79198 1.53228 3.705 1.22C3.40321 1.78295 3.17149 2.38073 3.015 3ZM5 8.98C4.585 8.38 4.26 7.715 4.045 7H5.955C5.74 7.715 5.415 8.38 5 8.98ZM6.17 6H3.83C3.785 5.67 3.75 5.34 3.75 5C3.75 4.66 3.785 4.325 3.83 4H6.17C6.215 4.325 6.25 4.66 6.25 5C6.25 5.34 6.215 5.67 6.17 6ZM6.295 8.78C6.595 8.225 6.825 7.625 6.985 7H8.46C7.97558 7.83414 7.20706 8.466 6.295 8.78ZM7.18 6C7.22 5.67 7.25 5.34 7.25 5C7.25 4.66 7.22 4.33 7.18 4H8.87C8.95 4.32 9 4.655 9 5C9 5.345 8.95 5.68 8.87 6H7.18Z"
                                  fill="#2DA37D"/>
                        </svg>
                        <?php $curlang =  \App\language::where('language_prefix',App::getLocale())->first() ?>
                        <?php echo e($curlang->language_name); ?>

                    </p>
                    <div class="body_language" style="z-index: 999999!important;">
                        <?php $__currentLoopData = \App\language::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <a href="<?php echo e(str_replace("/".App::getLocale(),"/".$language->language_prefix,URL::current())); ?>"
                               class="<?php echo e(App::getLocale() ?  $language->language_prefix : 'active'); ?>"><?php echo e($language->language_name); ?></a>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
                <div class="socials">
                    <a href="https://twitter.com/GreenCentralAs1">
                        <svg width="15" height="13" viewBox="0 0 15 13" xmlns="http://www.w3.org/2000/svg">
                            <path d="M13.4589 3.03633C13.4689 3.16991 13.4689 3.30272 13.4689 3.43553C13.4689 7.5 10.3753 12.1835 4.72166 12.1835C2.97985 12.1835 1.36169 11.679 0 10.8027C0.247303 10.831 0.485447 10.8409 0.742673 10.8409C2.1265 10.8442 3.47113 10.3815 4.55984 9.52727C3.91824 9.51566 3.29629 9.30398 2.78081 8.92179C2.26534 8.5396 1.88209 8.00598 1.68456 7.39543C1.87462 7.42367 2.06544 7.44275 2.26542 7.44275C2.54096 7.44275 2.81803 7.40459 3.07526 7.33818C2.37896 7.1976 1.75285 6.82018 1.30339 6.27011C0.853931 5.72004 0.608864 5.03128 0.609862 4.32093V4.28277C1.01974 4.51099 1.49527 4.65372 1.99903 4.67281C1.57701 4.39237 1.23096 4.01182 0.991761 3.56513C0.752564 3.11843 0.627656 2.61947 0.62818 2.11276C0.62818 1.54183 0.780073 1.01822 1.04646 0.561775C1.819 1.51208 2.78254 2.28951 3.87467 2.84372C4.9668 3.39794 6.16316 3.71658 7.38627 3.77901C7.33895 3.55002 7.30994 3.31264 7.30994 3.0745C7.30974 2.67069 7.38913 2.27081 7.54357 1.8977C7.698 1.52459 7.92446 1.18559 8.20999 0.900052C8.49553 0.614519 8.83454 0.388061 9.20764 0.233624C9.58075 0.0791871 9.98063 -0.000200269 10.3844 3.79399e-07C11.2698 3.79399e-07 12.069 0.370955 12.6308 0.970894C13.3191 0.837791 13.9791 0.586522 14.5817 0.228221C14.3523 0.938695 13.8717 1.54114 13.23 1.92271C13.8404 1.85308 14.437 1.69254 15 1.44642C14.5795 2.05941 14.0585 2.59695 13.4589 3.03633Z"></path>
                        </svg>
                    </a>
                    
                    
                    
                    
                    
                    <a href="https://www.facebook.com/GreenCentralAsia/">
                        <svg width="13" height="13" viewBox="0 0 13 13" xmlns="http://www.w3.org/2000/svg">
                            <path d="M0.723125 0H12.285C12.6831 0 13 0.316875 13 0.715V12.285C13 12.675 12.6831 13 12.285 13H8.97V7.9625H10.66L10.9119 6.00438H8.97V4.75312C8.97 4.18437 9.1325 3.79437 9.945 3.79437H10.985V2.03938C10.8063 2.015 10.1888 1.96625 9.47375 1.96625C7.97062 1.96625 6.94688 2.87625 6.94688 4.55813V6.00438H5.24875V7.9625H6.94688V13H0.723125C0.53274 13 0.350031 12.9249 0.21465 12.7911C0.0792686 12.6572 0.00213916 12.4754 0 12.285V0.715C0 0.316875 0.325 0 0.723125 0Z"></path>
                        </svg>
                    </a>
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <?php $__env->startSection('top_menu'); ?>
            <?php echo $__env->make('gca.blocks.menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php echo $__env->yieldSection(); ?>

    </div>
</header>
<?php echo $__env->yieldContent('swiper'); ?>
<?php echo $__env->yieldContent('logotypes'); ?>

<?php echo $__env->yieldContent('main_top_layout'); ?>

<?php echo $__env->yieldContent('content'); ?>



<?php echo $__env->yieldContent('recent_programms'); ?>


<?php echo $__env->yieldContent('wish'); ?>


<?php echo $__env->yieldContent('report'); ?>

<?php echo $__env->yieldContent('map_section'); ?>

<?php echo $__env->yieldContent('statistics'); ?>

<?php echo $__env->yieldContent('calendars'); ?>

<?php echo $__env->yieldContent('media_section'); ?>

<?php echo $__env->yieldContent('news_section'); ?>

<?php echo $__env->make('gca.blocks.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<!-- <script src="js/all.min.js"></script> -->
<script src="<?php echo e(asset('project_gca/js/jquery.min.js')); ?>"></script>
<script src="<?php echo e(asset('project_gca/js/swiper.min.js')); ?>"></script>
<script src="<?php echo e(asset('project_gca/js/bootstrap.min.js')); ?>"></script>
<script src="<?php echo e(asset('project_gca/js/bootstrap-datepicker.js')); ?>"></script>
<script src="<?php echo e(asset('project_gca/js/jquery.fancybox.min.js')); ?>"></script>
<script src="https://cdn.amcharts.com/lib/4/core.js"></script>
<script src="https://cdn.amcharts.com/lib/4/maps.js"></script>
<script src="https://cdn.amcharts.com/lib/4/geodata/worldLow.js"></script>
<script src="https://cdn.amcharts.com/lib/4/themes/animated.js"></script>
<script src="<?php echo e(asset('project_gca/js/main.js')); ?>"></script>
<script type="text/javascript">
    var disabledDays = ["2020-11-27"];

    $('#datepicker').datepicker({
        "setDate": new Date(),
        format: 'yyyy-m-d',
        "autoclose": true,


        beforeShowDay: function (date) {
            var today = new Date();
            var today_formatted = today.getFullYear() + '-' + (today.getMonth() + 1) + '-' + ('0' + today.getDate()).slice(-2);
            var user_busy_days = <?php echo json_encode($eventDates ?? null, 15, 512) ?>;

            calender_date = date.getFullYear() + '-' + (date.getMonth() + 1) + '-' + ('0' + date.getDate()).slice(-2);

            var search_index = $.inArray(calender_date, user_busy_days);

            if (search_index > -1) {
                return {classes: 'active', tooltip: 'User available on this day.'};
            } else {
                return {classes: '', tooltip: 'User not available on this day.'};
            }

        }
    });

    $('#datepicker').on('changeDate', function () {
        $('#my_hidden_input').val(
            $('#datepicker').datepicker('getFormattedDate')
        );

        console.log($('#my_hidden_input').val());

        window.location.href = "<?php echo e(URL(App::getLocale().'/event/1603263686')); ?>?date=" + $('#my_hidden_input').val()
    });


    $('[data-fancybox="images"]').fancybox({
        // infobar : false,
        // animationEffect: "zoom",
        loop: true,
        buttons: [
            'slideShow',
            'fullScreen',
            'thumbs',
            // 'share',
            // 'download',
            // 'zoom',
            'close'
        ]
    });
</script>

<?php echo $__env->yieldContent('scripts'); ?>
</body>

</html><?php /**PATH D:\OpenServer\domains\gca\resources\views/gca/layout.blade.php ENDPATH**/ ?>