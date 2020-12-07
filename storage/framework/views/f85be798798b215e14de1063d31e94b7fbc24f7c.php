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
                                <li><a href="<?php echo e(URL(App::getLocale()."/event/".$curcat->group)); ?>"><?php echo e($curcat->category_name); ?></a></li>
                            </ol>
                        </div>
                    </div>

                    <div class="page-header row">
                        <div class="col-md-9">
                            <h4><b><?php echo e($table->title); ?></b></h4>
                        </div>
                        <div class="col-md-3 hidden-xs hidden-sm" style="padding-top: 11px;">
                            <a class="page-print-link" target="_self" ><span class="glyphicon glyphicon-print"></span> Чоп этиш </a>
                        </div>
                    </div>
                    <div class="item" id="print_all">
                        <div class="row section-to-print" style="width: 90%">
                            <p style="background-color: #FFF;"><img style="margin: 0 auto;width:90%" class="img-responsive" src="<?php echo e(URL(App::getLocale().'/downloads?type=event&id='.$table->group)); ?>" alt=""></p>
                            <div class="clearfix"></div>
                            <div class="col-sm-10">
                                <?php $date=date_create($table->created_at) ?>
                                <?php $date_start=date_create($table->datestart) ?>
                                <?php $date_finish=date_create($table->dateend) ?>
                                <div class="col-sm-4"><p class="small">Ташкилотчи: <span class="text-primary"><?php echo e($table->organization); ?></span></p></div>
                                <div class="col-sm-4"><p class="small">Бошланиш санаси: <span class="text-primary"><?php echo e(date_format($date_start,"d.m.Y")); ?></span></p></div>
                                <div class="col-sm-4"><p class="small">Тугаш санаси: <span class="text-primary"><?php echo e(date_format($date_finish,"d.m.Y")); ?></span></p></div>
                            </div>
                            <div class="clearfix"></div><br>
                            <div class="" >
                                <?php echo $table->description; ?>

                                <?php echo $table->content; ?>


                            </div>







                        </div><!-- .row -->
                    </div><!-- .item -->

                <?php $__env->stopSection(); ?>

                <?php $__env->startSection('statistika'); ?>
                <?php $__env->stopSection(); ?>
            </div>
            <?php $__env->startSection('nav_page'); ?>
                <div class="col-md-3" style="padding-top: 50px;">
                    <div class="col menu-item-structure">
                        <div class="col" style="background-color: #3075ff; padding: 5px 15px; color: #fff">
                            <h4><?php echo e($curcat->category_name); ?></h4>
                        </div>
                        <div class="list-group">
                            <?php $__currentLoopData = $newscat; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                    <a href="<?php echo e(URL(App::getLocale().'/event/'.$value->group)); ?>" class="list-group-item"><?php echo e($value->category_name); ?></a>
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
<?php echo $__env->make('layout.defualt', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\OpenServer\domains\gca\resources\views\eventin.blade.php ENDPATH**/ ?>