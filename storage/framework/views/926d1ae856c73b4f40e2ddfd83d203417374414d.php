<?php $__env->startSection('content'); ?>
    
    
    
    
    
    
    
    
    

    <section class="inner_all">
        <div class="container">
            <div class="bar_inner">
                <div class="bar_inner_left">
                    <div class="text_layout">
                        
                        <h1><?php echo e($table->title); ?></h1>
                        <div class="row">
                            <?php if($table->r_number != null): ?>
                                <div class="col-md-5"><h6><?php echo app('translator')->getFromJson('blog.register_date'); ?>: <?php echo e($table->r_date); ?>

                                        | <?php echo app('translator')->getFromJson('blog.number'); ?>: <?php echo e($table->r_number); ?> </h6></div>
                            <?php endif; ?>
                            <div class="col-md-7">
                                <?php if($table->link  != null): ?>
                                    <div class="col-md-4"><h6><a href="<?php echo e(URL($table->link)); ?>"><img
                                                        src="<?php echo e(URL('/images/lexuz.png')); ?>" alt="" width="42"
                                                        height="15"> Lex.uz да ўқиш</a></h6></div>
                                <?php endif; ?>
                                <?php if($table->file_type == 'docx' ||  $table->file_type == 'doc'): ?>
                                    <div class="col-md-4"><h6><a
                                                    href="<?php echo e(URL(App::getLocale().'/downloads?type=doc&id='.$table->id)); ?>"><img
                                                        src="<?php echo e(URL('/images/msword.jpg')); ?>" alt="" width="15"
                                                        height="15"> <?php echo app('translator')->getFromJson('blog.download'); ?>
                                                (<?php echo e(round($table->file_size/1024)); ?> KB)</a></h6></div>
                                <?php elseif($table->file_type == 'pdf'): ?>
                                    <div class="col-md-4"><h6><a
                                                    href="<?php echo e(URL(App::getLocale().'/downloads?type=doc&id='.$table->id)); ?>"><img
                                                        src="<?php echo e(URL('/images/pdf_image.jpg')); ?>" alt="" width="15"
                                                        height="15"> <?php echo app('translator')->getFromJson('blog.download'); ?>
                                                (<?php echo e(round($table->file_size/1024)); ?> KB)</a></h6></div>
                                <?php endif; ?>
                            </div>
                        </div>
                        
                        <?php echo $table->description; ?>

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
<?php echo $__env->make('gca.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\OpenServer\domains\gca\resources\views/gca/doc.blade.php ENDPATH**/ ?>