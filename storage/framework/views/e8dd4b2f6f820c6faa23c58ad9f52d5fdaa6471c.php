<?php $__env->startSection('left_sidebar_menu'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content_div'); ?>
    <div class="container-fluid" id="page_content"  style="background-color: #F5F5F5">
        <div class="container">
            <?php $__env->stopSection(); ?>
            <div class="row section-to-print">
                <?php $__env->startSection('nowosti'); ?>
                    <div class="page-content">
                        <div>
                            <ol class="breadcrumb h6">
                                <li><a href="<?php echo e(URL(App::getLocale().'/')); ?>" title="<?php echo app('translator')->getFromJson('blog.bosh'); ?>"><?php echo app('translator')->getFromJson('blog.bosh'); ?></a></li>
                            </ol>
                        </div>
                    </div>

                    <div class="page-header row">
                        <div class="col-md-9">
                            <h4><b>НАТИЖАЛАР:</b></h4>
                        </div>
                        <div class="col-md-3 hidden-xs hidden-sm" style="padding-top: 11px;">
                            <a class="page-print-link pull-right" target="_self" ><span class="glyphicon glyphicon-print"></span> Чоп этиш </a>
                        </div>
                    </div>
                    <div class="container-fluid" id="print_all">
                        <?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="item">
                                <div class="row">
                                    <div class="col-md-4 col-sm-4">
                                        <br><a href="<?php echo e(URL(App::getLocale().'/posts/'.$post->category_group_id.'/'.$post->group)); ?>"><img class="img-responsive" src="<?php echo e(URL(App::getLocale().'/downloads?type=post&id='.$post->group)); ?>"></a>
                                    </div>
                                    <div class="col-md-8 col-sm-8">
                                        <h4 style="padding-top: 15px;"><a href="<?php echo e(URL(App::getLocale().'/posts/'.$post->category_group_id.'/'.$post->group)); ?>"><?php echo e($post->title); ?></a></h4>
                                        <h4><span class="label label-primary"> <?php echo e($post->created_at); ?> </span></h4>
                                        <p style="text-align: justify;"></p><p><?php echo e($post->decription); ?>...
                                        </p>
                                    </div>
                                </div><!-- .row -->
                            </div><!-- .item -->
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php $__currentLoopData = $pages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="item">
                                    <div class="row">
                                        <div class="col-md-8 col-sm-8">
                                            <h4 style="padding-top: 15px;"><a href="<?php echo e(URL(App::getLocale().'/page/'.$post->page_category_group_id.'/'.$post->page_group_id)); ?>"><?php echo e($post->title); ?></a></h4>
                                            <h4><span class="label label-primary"> <?php echo e($post->created_at); ?> </span></h4>
                                            <p style="text-align: justify;"></p><p><?php echo e($post->description); ?>

                                            </p>
                                        </div>
                                    </div><!-- .row -->
                                </div><!-- .item -->
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>



                    </div>



                <?php $__env->stopSection(); ?>

                <?php $__env->startSection('statistika'); ?>
                <?php $__env->stopSection(); ?>
            </div>
            <?php $__env->startSection('nav_page'); ?>

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

<?php echo $__env->make('layout.defualt', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\OpenServer\domains\gca\resources\views\search.blade.php ENDPATH**/ ?>