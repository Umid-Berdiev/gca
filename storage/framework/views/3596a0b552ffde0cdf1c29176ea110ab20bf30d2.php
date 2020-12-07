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
                                <li><a href="<?php echo e(URL(App::getLocale().'/tender/'.$curcat->group)); ?>"><?php echo e($curcat->category_name); ?></a></li>
                            </ol>
                        </div>
                    </div>

                    <div class="page-header row">
                        <div class="col-md-9">
                            <h4><b><?php echo e($curcat->category_name); ?></b></h4>
                        </div>
                        <div class="col-md-3 hidden-xs hidden-sm" style="padding-top: 11px;">
                            <a class="page-print-link" target="_self" ><span class="glyphicon glyphicon-print"></span> Чоп этиш </a>
                            <a class="rss-link pull-right" href="<?php echo e(URL(\Illuminate\Support\Facades\App::getLocale().'/rss/tender')); ?>"><img src="<?php echo e(URL('/images/Feed-icon.svg.png')); ?>" alt="" width="20" height="20"> RSS</a>
                        </div>
                    </div>
                    <br>
                    <div class="col-sm-12">
                        <?php if($errors->any()): ?>
                            <div class="alert alert-danger">
                                <ul>
                                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li><?php echo e($error); ?></li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            </div>
                        <?php endif; ?>
                        <div class="tenders-filter">
                            <form action="<?php echo e(URL(App::getLocale().'/tenders/filter')); ?>" method="get" name="tenders_archive_filter">
                                <input type="hidden" name="cutcat" value="<?php echo e($curcat->group); ?>">
                                <table width="100%" class="text-center">
                                    <tbody>
                                    <tr>
                                        <td>
                                            <div class="form-group">
                                                <select class="form-control" name="status" id="sel1">
                                                    <?php if(Request::has('status')): ?>
                                                        <?php if(Request::get('status') == 1): ?>
                                                        <option value="0">Муддати ўтмаганлар</option>
                                                        <option value="1" selected>Муддати ўтганлар</option>
                                                            <?php else: ?>
                                                            <option value="0" selected>Муддати ўтмаганлар</option>
                                                            <option value="1" >Муддати ўтганлар</option>
                                                            <?php endif; ?>
                                                    <?php else: ?>
                                                    <option value="0">Муддати ўтмаганлар</option>
                                                    <option value="1">Муддати ўтганлар</option>
                                                    <?php endif; ?>
                                                </select>
                                            </div>
                                        </td>
                                        <td> Муддат: </td>

                                        <td>
                                            <input type="date" id="" name="start" value="<?php if(Request::has('start') && !empty(Request::get('start')) ): ?><?php echo e(date("Y-m-d",strtotime(Request::get('start')))); ?><?php endif; ?>" class="input-text form-control" autocomplete="off"><img src="#" alt="" class="" onclick="#" onmouseover="" onmouseout="" border="0"></td>
                                        <td> дан </td>
                                        <td>
                                            <input type="date" id="" name="finish" value="<?php if(Request::has('finish') && !empty(Request::get('finish'))): ?><?php echo e(date("Y-m-d",strtotime(Request::get('finish')))); ?><?php endif; ?>" class="input-text form-control" autocomplete="off"><img src="" alt="" class="calendar-icon" onclick="" onmouseover="" onmouseout="" border="0"></td>
                                        <td> гача </td>
                                        <td><input type="submit" class="btn btn-warning" value="Чиқариш"></td>
                                        <td><a href="<?php echo e(URL(App::getLocale().'/tender/'.$curcat->group)); ?>"  name="clear"  class="btn btn-warning">Тозалаш</a></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </form>
                        </div>
                    </div>
                    <div class="tenders-list" id="print_all">
                        <?php $__currentLoopData = $table; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="item">
                            <div class="row section-to-print">
                                <div class="col-md-3 col-sm-4">
                                    <br/><a href="#"><img class="img-responsive" src="<?php echo e(URL(App::getLocale().'/downloads?type=tenders&id='.$value->group)); ?>"></a>
                                </div>
                                <div class="col-md-9 col-sm-8">
                                    <h4><a href="<?php echo e(URL(App::getLocale().'/tender/'.$curcat->group.'/'.$value->group)); ?>"><?php echo e($value->title); ?></a></h4>
                                    <h5><span class="label label-primary"> <?php echo e($value->created_at); ?> </span></h5>
                                    <p style="text-align: justify;"><?php echo $value->description; ?> </p>
                                    <div class="row">
                                        <div class="col-sm-5"><p><a href="#">Соҳа:</a> <?php echo e($value->category_name); ?></p></div>
                                        <div class="col-sm-5"><p><a href="#">Чоп этиш санаси:</a><?php echo e($value->deadline); ?> </p></div>
                                    </div>
                                </div>
                            </div><!-- .row -->
                        </div><!-- .item -->
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php echo e($table->appends(['cutcat'=>Request::get('cutcat'),'status'=>Request::get('status'),'start'=>Request::get('start'),'finish'=>Request::get('finish')])->links()); ?>

                    </div>



                <?php $__env->stopSection(); ?>

                <?php $__env->startSection('statistika'); ?>
                <?php $__env->stopSection(); ?>
            </div>
            <?php $__env->startSection('nav_page'); ?>
                <div class="col-md-3" style="padding-top: 50px;">
                    <div class="col menu-item-structure">
                        <div class="col" style="background-color: #3075ff; padding: 5px 15px; color: #fff">
                            <h4>Тендер</h4>
                        </div>
                        <div class="list-group">
                            <?php $__currentLoopData = $newscat; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($curcat->group == $value->group): ?>
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
<?php echo $__env->make('layout.defualt', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\OpenServer\domains\gca\resources\views\tender.blade.php ENDPATH**/ ?>