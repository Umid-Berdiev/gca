<?php
$tender  = \App\tender::where('group','=',$table->group)->first();
$tender->viewcount +=1;
$tender->update();
?>


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
                                <li><a href="<?php echo e(URL(App::getLocale().'/tender/'.$curcat->group)); ?>"><?php echo e($curcat->category_name); ?></a></li>
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
                    <br>
                <div id="print_all">
                    <table class="table table-bordered table-responsive" id="tender-info-table">
                        <tbody>
                        <tr>
                            <td class="info">Соҳа:</td>
                            <td><i><?php echo e($table->category_name); ?></i></td>
                        </tr>
                        <tr>
                            <td class="info">Чоп этиш санаси:</td>
                            <td><i><?php echo e($table->created_at); ?></i></td>
                        </tr>
                        <tr>
                            <td class="info">Муддат:</td>
                            <td><i><?php echo e($table->deadline); ?></i></td>
                        </tr>
                        <tr>
                            <td class="info">Кўрилди:</td>
                            <td><i><?php echo e($table->viewcount); ?></i></td>
                        </tr>
                        </tbody>
                    </table>
                    <div class="clear-fix"></div>

                    <div class="item">
                        <div class="row">


                            <div class="col-md-10 col-sm-10">

                                <?php echo $table->description; ?>


                            </div>
                        </div><!-- .row -->
                    </div><!-- .item -->
                </div>



                <?php $__env->stopSection(); ?>

                <?php $__env->startSection('statistika'); ?>
                <?php $__env->stopSection(); ?>
            </div>
            <?php $__env->startSection('nav_page'); ?>
                <div class="col-md-3" style="padding-top: 50px;">
                    <div class="col menu-item-structure">
                        <div class="col" style="background-color: #3075ff; padding: 5px 15px; color: #fff">
                            <h4>Тердер</h4>
                        </div>
                        <div class="list-group">
                            <?php $__currentLoopData = $newscat; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($table->tender_category_id == $value->group): ?>
                                    <a href="<?php echo e(URL(App::getLocale().'/tender/'.$value->group)); ?>" class="list-group-item active"><?php echo e($value->category_name); ?></a>
                                <?php else: ?>
                                    <a href="<?php echo e(URL(App::getLocale().'/tender/'.$value->group)); ?>" class="list-group-item"><?php echo e($value->category_name); ?></a>
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
<?php echo $__env->make('layout.defualt', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\OpenServer\domains\gca\resources\views\tenderin.blade.php ENDPATH**/ ?>