<?php $__env->startSection('left_sidebar_menu'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content_div'); ?>
    <div class="container-fluid" id="page_content"  style="background-color: #F5F5F5">
        <div class="container">
            <?php $__env->stopSection(); ?>
            <div class="row">
                <?php $__env->startSection('nowosti'); ?>
                    <div class="page-content">
                        <div>
                            <ol class="breadcrumb h6">
                                <li><a href="<?php echo e(URL(App::getLocale().'/')); ?>" title="<?php echo app('translator')->getFromJson('blog.bosh'); ?>"><?php echo app('translator')->getFromJson('blog.bosh'); ?></a></li>
                                <li><a href="<?php echo e(URL(App::getLocale().'/video/')); ?>" title="<?php echo app('translator')->getFromJson('blog.video'); ?>"><?php echo app('translator')->getFromJson('blog.video'); ?></a></li>

                            </ol>
                        </div>
                    </div>

                    <div class="page-header row section-to-print">
                        <div class="col-md-9">
                            <h4><b><?php echo app('translator')->getFromJson('blog.video'); ?></b></h4>
                        </div>
                        <div class="col-md-3 hidden-xs hidden-sm" style="padding-top: 11px;">
                            <a class="page-print-link" target="_self" ><span class="glyphicon glyphicon-print"></span> Чоп этиш </a>
                            <a class="rss-link pull-right" href="<?php echo e(URL(\Illuminate\Support\Facades\App::getLocale().'/rss/video')); ?>"><img src="<?php echo e(URL('/images/Feed-icon.svg.png')); ?>" alt="" width="20" height="20"> RSS</a>
                        </div>
                    </div>
                    <br>
                    <div class="row" id="print_all" >
                        <?php $__currentLoopData = $table; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="col-md-6">
                                <h4><b><?php echo e($value->title); ?></b></h4>
                                <h4><span class="label label-primary"><?php echo e($value->created_at); ?></span></h4>
                                <div class="embed-responsive embed-responsive-16by9">
                                    <a href="<?php echo e(URL(App::getLocale()."/video/".$value->group."/all")); ?>" class=""> <img src="<?php echo e(URL(App::getLocale().'/downloads?type=video&id='.$value->group)); ?>" alt="" width="100%" height="250"></a>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        <?php echo e($table->links()); ?>

                    </div>


                <?php $__env->stopSection(); ?>

                <?php $__env->startSection('statistika'); ?>
                <?php $__env->stopSection(); ?>
            </div>
            <?php $__env->startSection('nav_page'); ?>
                <div class="col-md-3" style="padding-top: 50px;">
                    <div class="col menu-item-structure">
                        <div class="col" style="background-color: #3075ff; padding: 5px 15px; color: #fff">
                            <h4><?php echo app('translator')->getFromJson('blog.video'); ?></h4>
                        </div>
                        <div class="list-group">
                            <?php $__currentLoopData = $newscat; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <a href="<?php echo e(URL(App::getLocale().'/video/'.$value->group)); ?>" class="list-group-item"><?php echo e($value->title); ?></a>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>





                        </div>
                    </div>
                </div>
            <?php $__env->stopSection(); ?>
        </div>
    </div>
<?php $__env->startSection('tender'); ?>

    <?php $__currentLoopData = $tenders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$tender): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="row">
            <div class="col-xs-4" style="padding-top: 10px">
                <a href="<?php echo e(URL(App::getLocale().'/tender/'.$tender->tender_category_id."/".$tender->group)); ?>"><img class="img-responsive center-block" src="<?php echo e(URL(App::getLocale().'/downloads?type=tenders&id='.$tender->group)); ?>" alt=""></a>
            </div>
            <div class="col-xs-8">
                <a href="<?php echo e(URL(App::getLocale().'/tender/'.$tender->tender_category_id."/".$tender->group)); ?>"><h6><?php echo e($tender->title); ?></h6></a>
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        <?php $__env->stopSection(); ?>
        <?php $__env->startSection('regional_uprav'); ?>
        <?php $__env->stopSection(); ?>
        <?php $__env->startSection('poleznaya-info'); ?>
        <?php $__env->stopSection(); ?>
        <?php $__env->startSection('video_foto_baner'); ?>
        <?php $__env->stopSection(); ?>
        </div>
<?php echo $__env->make('layout.defualt', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\OpenServer\domains\gca\resources\views\video.blade.php ENDPATH**/ ?>