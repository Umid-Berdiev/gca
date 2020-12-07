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
                                <li><a href="<?php echo e(URL(App::getLocale().'/page/'.$page->page_category_group_id )); ?>" title="<?php echo e($page->category_name); ?>"><?php echo e($page->category_name); ?></a></li>
                                
                            </ol>
                        </div>
                    </div>

                    <div class="page-header row">
                        <div class="col-md-9">
                            <h4><b><?php echo e($page->title); ?></b></h4>
                        </div>
                        <div class="col-md-3 hidden-xs hidden-sm" style="padding-top: 11px;">
                            <a class="page-print-link" style="cursor:pointer;" target="_self" ><span class="glyphicon glyphicon-print"></span> <?php echo app('translator')->getFromJson('blog.print_button'); ?></a>
                        </div>
                    </div>
                    <div class="col" style="padding-top: 25px;" id="print_all">

                        <?php echo $page->content; ?>


                    </div>

                <?php $__env->stopSection(); ?>

                <?php $__env->startSection('statistika'); ?>
                <?php $__env->stopSection(); ?>
            </div>
            <?php $__env->startSection('nav_page'); ?>
                <div class="col-md-3" style="padding-top: 50px;">
                    <div class="col menu-item-structure">
                        <div class="col" style="background-color: #3075ff; padding: 5px 15px; color: #fff">
                            <h4><?php echo e($page->category_name); ?></h4>
                        </div>
                        <div class="list-group">
                            <?php $__currentLoopData = $page_categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($row->page_group_id == $page->page_group_id): ?>
                                    <a href="<?php echo e(url(App::getLocale().'/page/'.$row->page_category_group_id.'/'.$row->page_group_id)); ?>" class="list-group-item active">
                                        <?php echo e($row->title); ?></a>

                                <?php else: ?>
                                    <a href="<?php echo e(url(App::getLocale().'/page/'.$row->page_category_group_id.'/'.$row->page_group_id)); ?>" class="list-group-item"><?php echo e($row->title); ?></a>
                                <?php endif; ?>


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

<?php echo $__env->make('layout.defualt', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\OpenServer\domains\gca\resources\views\pages.blade.php ENDPATH**/ ?>