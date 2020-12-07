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
    <link rel="stylesheet" href="<?php echo e(URL::asset("frondend/plugins/starrr.css")); ?>">

    <link rel="stylesheet" href="<?php echo e(URL::asset("frondend/css/bootstrap.min.css")); ?>">
    <link rel="stylesheet" href="<?php echo e(URL::asset("frondend/css/style.css")); ?>">



    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>

    <![endif]-->
</head>
<body>


<?php echo $__env->make("admin.layout.fmenu", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<div class="wrapper">
    <?php echo $__env->make("admin.layout.fheader", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <div class="container">
           <?php $__env->startSection("content"); ?>
               <?php echo $__env->yieldSection(); ?>
        </div>

    <?php echo $__env->make("admin.layout.ffooter", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</div>

<script src="<?php echo e(URL::asset("frondend/js/jquery-2.2.3.min.js")); ?>"></script>
<script src='<?php echo e(URL::asset("frondend/libs/bootstrap.min.js")); ?>'></script>



<script src="<?php echo e(URL::asset("frondend/js/general.js")); ?>"></script>
<script src="<?php echo e(URL::asset("frondend/qrcode.js")); ?>"></script>
<script src='<?php echo e(URL::asset("frondend/plugins/starrr.js")); ?>'></script>

<script src="<?php echo e(URL::asset("frondend/js/general.js")); ?>"></script>

<script src='<?php echo e(URL::asset("frondend/js/common.js")); ?>'></script>

<script src='<?php echo e(URL::asset("frondend/js/star-settings.js")); ?>'></script>
<script type="text/javascript">
    <?php if(isset($typs)): ?>
    new QRCode(document.getElementById("qrcode"), {
        text: "<?php echo e(URL(App::getLocale()."/download?id=".$book->id ?? 0)); ?>",
        width: 128,
        height: 128,
        colorDark : "#000000",
        colorLight : "#ffffff",
        correctLevel : QRCode.CorrectLevel.H
    });
    <?php endif; ?>

</script>
</body>
</html>
<?php /**PATH D:\OpenServer\domains\gca\resources\views\admin\layout\ftemp.blade.php ENDPATH**/ ?>