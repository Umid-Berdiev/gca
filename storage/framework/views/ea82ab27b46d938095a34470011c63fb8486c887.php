<?php $__env->startSection('content'); ?>
    <?php $__env->startSection('main_top_layout'); ?>
    <section class="main_top_layout" style="background-image: url(<?php echo e(asset('gca/images/main.jpg')); ?>);">
        <div class="container">
            <h2>
                <span><?php echo $page->title; ?></span>
                <?php echo $page->description; ?>

            </h2>
        </div>
    </section>
    <?php $__env->stopSection(); ?>

        <section class="about_inner">
            <div class="container">
                <div class="text_layout">
                <?php echo $page->content; ?>

                </div>
            </div>
        </section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('gca.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\OpenServer\domains\gca\resources\views\gca\pages.blade.php ENDPATH**/ ?>