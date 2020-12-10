<?php $__env->startSection('content'); ?>
    
    
    
    
    
    
    
    
    

    <section class="inner_all">
        <div class="container">
            <div class="bar_inner">
                <div class="bar_inner_left">
                    <?php $__currentLoopData = $table; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="item_documents">
                            <div class="item_documents_left">
                                <span class="date_ban"><?php echo app('translator')->getFromJson('blog.register_date'); ?>: <?php echo e($value->r_date); ?> | <?php echo app('translator')->getFromJson('blog.number'); ?>: <?php echo e($value->r_number); ?> </span>
                                <a href="<?php echo e(URL(App::getLocale().'/doc/'.$value->doc_category_id.'/'.$value->group)); ?>"><?php echo e($value->title); ?></a>
                                <p><?php echo app('translator')->getFromJson('blog.register_date'); ?>: <?php echo e($value->r_date); ?> | <?php echo app('translator')->getFromJson('blog.number'); ?>: <?php echo e($value->r_number); ?></p>
                            </div>
                            <div class="item_documents_right">
                                <?php if($value->file_type == 'docx' ||  $value->file_type == 'doc'): ?>
                                <a href="<?php echo e(URL(App::getLocale().'/downloads?type=doc&id='.$value->id)); ?>">
                                    <img src="<?php echo e(asset('project_gca/images/word.svg')); ?>" alt="">
                                </a>
                                <?php elseif($value->file_type == 'pdf'): ?>
                                    <a href="<?php echo e(URL(App::getLocale().'/downloads?type=doc&id='.$value->id)); ?>">
                                        <img src="<?php echo e(asset('project_gca/images/pdf.svg')); ?>" alt="">
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php echo e($table->links()); ?>


                        <div class="text_center">
                            <?php echo e($table->links()); ?>

                        </div>
                </div>
                <div class="bar_inner_right">
                    <div class="bar_inner_events event_bord">
                        <h3><?php echo app('translator')->getFromJson('blog.docs'); ?></h3>
                        <?php $__currentLoopData = $newscat; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                            <a href="<?php echo e(URL(App::getLocale().'/doc/'.$value->group)); ?>" class="news_item">
                                
                                <div>
                                    
                                    <p><?php echo e($value->category_name); ?></p>
                                </div>
                            </a>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <hr>
                        <h3><?php echo app('translator')->getFromJson('blog.events'); ?></h3>
                        <?php $__currentLoopData = $events; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <a href="<?php echo e(URL(App::getLocale().'/event/'.$value->event_category_id.'/'.$value->group)); ?>" class="news_item">
                                <img src="<?php echo e(URL(App::getLocale().'/downloads?type=event&id='.$value->group)); ?>" alt="">
                                <div>
                                    <span><?php echo e(\Carbon\Carbon::parse($value->created_at)->format('d.m.Y')); ?></span>
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
<?php echo $__env->make('gca.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\OpenServer\domains\gca\resources\views/gca/docs.blade.php ENDPATH**/ ?>