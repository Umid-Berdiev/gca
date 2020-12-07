<!doctype html>
<html lang="<?php echo e(app()->getLocale()); ?>">
<head>
     <title>BOOKS (QRBOOK.UZ)</title>

    <!-- BEGIN META -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords" content="your,keywords">
    <meta name="description" content="All book in qrcode">
    <!-- END META -->

    <!-- BEGIN STYLESHEETS -->

    <link rel="stylesheet" href="<?php echo e(URL::asset("frondend/css/font-awesome.min.css")); ?>">

    <link rel="stylesheet" href="<?php echo e(URL::asset("frondend/plugins/owl/owl.carousel.min.css")); ?>">

    <link rel="stylesheet" href="<?php echo e(URL::asset("frondend/css/bootstrap.min.css")); ?>">
    <link rel="stylesheet" href="<?php echo e(URL::asset("frondend/css/style.css")); ?>">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.5.17/vue.min.js"></script>



</head>
<body>

<?php echo $__env->make("admin.layout.fmenu", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<div class="wrapper">
    <?php echo $__env->make("admin.layout.fheader", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <section class="main" style="background-image:url(img/main.jpg)">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="main-box text-center">
                       <?php $__env->startSection("search"); ?>
                           <?php echo $__env->yieldSection(); ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="how-work">
        <div class="container">
            <div class="row m-b-100">
                <div class="col-lg-12">
                    <h1 class="text-center"><?php echo e(trans("home.work")); ?></h1>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 md-mb130 sm-mb-150">
                    <div class="how-work-item">
                        <h1 class="text-center"><?php echo e(trans("home.tagone")); ?></h1>
                        <div class="number">1.</div>
                    </div>
                </div>
                <div class="col-lg-4 md-mb130">
                    <div class="how-work-item">
                        <h1 class="text-center"><?php echo e(trans("home.tagtwo")); ?></h1>
                        <div class="number">2.</div>
                    </div>
                </div>
                <div class="col-lg-4 md-mb130">
                    <div class="how-work-item">
                        <h1 class="text-center dgit"><?php echo e(trans("home.tagthree")); ?></h1>
                        <div class="number">3.</div>
                    </div>
                </div>
            </div>
        </div>
    </section>



    <?php $__env->startSection("content"); ?>

        <?php echo $__env->yieldSection(); ?>
    <section class="search-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <h1><?php echo e(trans("home.contactme")); ?></h1>
                    <ul>
                        <li>
                            <h3 class="search-title">QRbook #1</h3>
                            <span>ул.Хамида Алимдана 42.Парк “ECO PARK”</span>
                        </li>
                        <li>
                            <h3 class="search-title">QRbook #2</h3>
                            <span>ул.Бабура 3 .Парк “Central Park”</span>
                        </li>
                        <li>
                            <h3 class="search-title">QRbook #3</h3>
                            <span>ул.Ахмад Дониш 3 .ТРЦ “MegaPlanet”</span>
                        </li>
                        <li>
                            <h3 class="search-title">QRbook #4</h3>
                            <span>ул.Мафтункули 3  .Парк “Anxor Lokomativ”</span>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-6">
                    <div id="map">
                        <script type="text/javascript" charset="utf-8" async src="https://api-maps.yandex.ru/services/constructor/1.0/js/?um=constructor%3A5610608c3cd9bd3966bac45c984440521507a1231a400e6e82bcc14c413c7b35&amp;width=576&amp;height=500&amp;lang=ru_RU&amp;scroll=true"></script>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php echo $__env->make("admin.layout.ffooter", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</div>

<script src="<?php echo e(URL::asset("frondend/js/jquery-2.2.3.min.js")); ?>"></script>
<script src="<?php echo e(URL::asset("frondend/qrcode.js")); ?>"></script>
<script src='<?php echo e(URL::asset("frondend/libs/bootstrap.min.js")); ?>'></script>

<script src='<?php echo e(URL::asset("frondend/plugins/owl/owl.carousel.min.js")); ?>'></script>

<script src="<?php echo e(URL::asset("frondend/js/common.js")); ?>"></script>

<script src="<?php echo e(URL::asset("frondend/js/general.js")); ?>"></script>

<?php $__env->startSection("script"); ?>
    <?php echo $__env->yieldSection(); ?>

</body>
</html>
<?php /**PATH D:\OpenServer\domains\gca\resources\views\admin\layout\frondend.blade.php ENDPATH**/ ?>