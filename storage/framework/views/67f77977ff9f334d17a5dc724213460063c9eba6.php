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
            <?php $__currentLoopData = $table; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $values): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-sm-3 col-4">
                    <video height="250" width="100%" controls>
                        <source src="<?php echo e(URL(App::getLocale().'/downloads?type=videoin&id='.$values->id)); ?>" type="video/mp4">

                        Your browser does not support the video tag.
                    </video>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        </div>
        <div class="text_center">
            <?php echo e($table->links()); ?>

        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('gca.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\OpenServer\domains\gca\resources\views\gca\videoin.blade.php ENDPATH**/ ?>