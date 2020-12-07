<?php $__env->startSection('content'); ?>
    
    
    
    
    
    
    
    
    

    <section class="inner_all">
        <div class="container">
            <div class="bar_inner">
                <div class="bar_inner_left">
                    <div class="text_layout">
                        <span class="date_ban"><?php echo e(\Carbon\Carbon::parse($table->datestart)->format('d.m.Y')); ?> - <?php echo e(\Carbon\Carbon::parse($table->dateend)->format('d.m.Y')); ?> </span>
                        <h1><?php echo e($table->title); ?></h1>
                        <img src="<?php echo e(URL(App::getLocale().'/downloads?type=event&id='.$table->group)); ?>" alt="<?php echo e($table->title); ?>">
                        <?php echo $table->description; ?>

                        <?php echo $table->content; ?>

                    </div>
                </div>
                <div class="bar_inner_right">
                    <div class="bar_inner_events event_bord">
                        <h3><?php echo app('translator')->getFromJson('blog.events'); ?></h3>
                        <?php $__currentLoopData = $events; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <a href="<?php echo e(URL(App::getLocale().'/event/'.$value->event_category_id.'/'.$value->group)); ?>" class="news_item">
                                <img src="<?php echo e(URL(App::getLocale().'/downloads?type=event&id='.$value->group)); ?>" alt="">
                                <div>
                                    <span><?php echo e(\Carbon\Carbon::parse($table->datestart)->format('d.m.Y')); ?> - <?php echo e(\Carbon\Carbon::parse($table->dateend)->format('d.m.Y')); ?></span>
                                    <p><?php echo e($value->title); ?></p>
                                </div>
                            </a>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    </div>

                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('gca.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\OpenServer\domains\gca\resources\views\gca\eventin.blade.php ENDPATH**/ ?>