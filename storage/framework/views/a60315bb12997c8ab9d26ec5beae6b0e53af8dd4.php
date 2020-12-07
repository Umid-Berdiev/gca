<?php $__env->startSection('content'); ?>
<?php $__env->startSection('main_top_layout'); ?>
    <section class="main_top_layout" style="background-image: url(<?php echo e(asset('gca/images/main.jpg')); ?>);">
        <div class="container">
            <h2>
                <span><?php echo app('translator')->getFromJson('blog.video'); ?></span>

            </h2>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<section class="news_inner media_section">
    <div class="container">
        <div class="row for_med">
            <?php $__currentLoopData = $table; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-sm-3 col-4">
                    <a href="<?php echo e(URL(App::getLocale()."/video/".$value->group."/all")); ?>" class="over" >
                        <img src="<?php echo e(URL(App::getLocale().'/downloads?type=video&id='.$value->group)); ?>">
                        <svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M29 15C29 7.27083 22.7292 1 15 1C7.27083 1 1 7.27083 1 15C1 22.7292 7.27083 29 15 29C22.7292 29 29 22.7292 29 15Z" stroke="#fff" stroke-width="2" stroke-miterlimit="10"></path>
                            <path d="M12.107 20.7196L20.4523 15.6782C20.5686 15.6073 20.6648 15.5077 20.7315 15.3889C20.7982 15.2702 20.8332 15.1362 20.8332 15C20.8332 14.8638 20.7982 14.7299 20.7315 14.6111C20.6648 14.4924 20.5686 14.3928 20.4523 14.3219L12.107 9.28045C11.9874 9.20879 11.8509 9.17023 11.7114 9.16875C11.572 9.16726 11.4347 9.20289 11.3135 9.27198C11.1924 9.34108 11.0919 9.44115 11.0222 9.56194C10.9525 9.68272 10.9162 9.81986 10.917 9.95931V20.0408C10.9162 20.1802 10.9525 20.3174 11.0222 20.4381C11.0919 20.5589 11.1924 20.659 11.3135 20.7281C11.4347 20.7972 11.572 20.8328 11.7114 20.8313C11.8509 20.8298 11.9874 20.7913 12.107 20.7196Z" fill="#fff"></path>
                        </svg>
                    </a>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        </div>
        <div class="text_center">
            <?php echo e($table->links()); ?>

        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('gca.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\OpenServer\domains\gca\resources\views\gca\video.blade.php ENDPATH**/ ?>