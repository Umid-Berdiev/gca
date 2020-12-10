<?php $__env->startSection('content'); ?>
<?php $__env->startSection('main_top_layout'); ?>
    <section class="main_top_layout" style="background-image: url(<?php echo e(asset('gca/images/main.jpg')); ?>);">
        <div class="container">
            <h2>
                <span><?php echo app('translator')->getFromJson('blog.photo'); ?></span>
            </h2>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<section class="news_inner media_section">
    <div class="container">
        <div class="row for_med">
            <?php $__currentLoopData = $table; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-sm-3 col-4">
                <a href="<?php echo e(URL(App::getLocale()."/photo/".$value->group."/all")); ?>" class="over" >
                    <img src="<?php echo e(URL(App::getLocale().'/downloads?type=photo&id='.$value->group)); ?>">
                    <svg width="40" height="36" viewBox="0 0 40 36" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M24.24 4L27.9 8H36V32H4V8H12.1L15.76 4H24.24ZM26 0H14L10.34 4H4C1.8 4 0 5.8 0 8V32C0 34.2 1.8 36 4 36H36C38.2 36 40 34.2 40 32V8C40 5.8 38.2 4 36 4H29.66L26 0ZM20 14C23.3 14 26 16.7 26 20C26 23.3 23.3 26 20 26C16.7 26 14 23.3 14 20C14 16.7 16.7 14 20 14ZM20 10C14.48 10 10 14.48 10 20C10 25.52 14.48 30 20 30C25.52 30 30 25.52 30 20C30 14.48 25.52 10 20 10Z" fill="white" />
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
<?php echo $__env->make('gca.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\OpenServer\domains\gca\resources\views/gca/media.blade.php ENDPATH**/ ?>