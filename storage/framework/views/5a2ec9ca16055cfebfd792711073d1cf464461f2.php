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
                                <li><span><?php echo e($curcat->category_name); ?></span></li>
                            </ol>
                        </div>
                    </div>

                    <div class="page-header row">
                        <div class="col-md-9">
                            <h4><b><?php echo e($table->title); ?></b></h4>
                        </div>
                        <div class="col-md-3 hidden-xs hidden-sm" style="padding-top: 11px;">
                            <a class="page-print-link" style="cursor:pointer;" target="_self" ><span class="glyphicon glyphicon-print"></span> <?php echo app('translator')->getFromJson('blog.print_button'); ?></a>
                        </div>
                    </div>
                    <br>

                    <div class="item">
                        <div class="row" id="print_all">
                            <div class="file-box section-to-print">
                                
                                <div class="row">
                                    <?php if($table->r_number != null): ?>
                                    <div class="col-md-5"><h6><?php echo app('translator')->getFromJson('blog.register_date'); ?>: <?php echo e($table->r_date); ?> | <?php echo app('translator')->getFromJson('blog.number'); ?>: <?php echo e($table->r_number); ?> </h6></div>
                                    <?php endif; ?>
                                        <div class="col-md-7">
                                        <?php if($table->link  != null): ?>
                                            <div class="col-md-4"><h6><a href="<?php echo e(URL($table->link)); ?>"><img src="<?php echo e(URL('/images/lexuz.png')); ?>" alt="" width="42" height="15"> Lex.uz да ўқиш</a></h6></div>
                                        <?php endif; ?>
                                        <?php if($table->other_link  != null): ?>
                                            <div class="col-md-4"><h6><a href="<?php echo e(URL($table->other_link)); ?>"><img src="<?php echo e(URL('/images/icons8-internet-explorer-15.png')); ?>" alt="" width="15" height="15"> Сайтда ўқиш</a></h6></div>
                                        <?php endif; ?>
                                        <?php if($table->file_type == 'docx' ||  $table->file_type == 'doc'): ?>
                                            <div class="col-md-4"><h6><a href="<?php echo e(URL(App::getLocale().'/downloads?type=doc&id='.$table->id)); ?>"><img src="<?php echo e(URL('/images/msword.jpg')); ?>" alt="" width="15" height="15"> <?php echo app('translator')->getFromJson('blog.download'); ?> (<?php echo e(round($table->file_size/1024)); ?> KB)</a></h6></div>
                                        <?php elseif($table->file_type == 'pdf'): ?>
                                            <div class="col-md-4"><h6><a href="<?php echo e(URL(App::getLocale().'/downloads?type=doc&id='.$table->id)); ?>"><img src="<?php echo e(URL('/images/pdf_image.jpg')); ?>" alt="" width="15" height="15"> <?php echo app('translator')->getFromJson('blog.download'); ?> (<?php echo e(round($table->file_size/1024)); ?> KB)</a></h6></div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-10 col-sm-10">

                                <?php echo $table->description; ?>


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
                            <h4>ХУЖЖАТЛАР</h4>
                        </div>
                        <div class="list-group">
                            <?php $__currentLoopData = $newscat; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($table->doc_category_id == $value->group  ): ?>
                                <a href="<?php echo e(URL(App::getLocale().'/doc/'.$value->group)); ?>" class="list-group-item active"><?php echo e($value->category_name); ?></a>
                                <?php else: ?>
                                    <a href="<?php echo e(URL(App::getLocale().'/doc/'.$value->group)); ?>" class="list-group-item"><?php echo e($value->category_name); ?></a>
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

<?php echo $__env->make('layout.defualt', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\OpenServer\domains\gca\resources\views\docin.blade.php ENDPATH**/ ?>