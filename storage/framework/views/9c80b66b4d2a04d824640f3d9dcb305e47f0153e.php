<?php
$tenders = \App\tender::take(3)->where('title', '<>', '')->where('language_id', '=', \App\Http\Controllers\SearchController::languages())->orderBy('id', 'desc')->get();
?>
<?php $__env->startSection('left_sidebar_menu'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content_div'); ?>
<div class="container-fluid" id="page_content" style="background-color: #F5F5F5">
  <div class="container">
    <?php $__env->stopSection(); ?>
    <div class="row">
      <?php $__env->startSection('nowosti'); ?>
      <div class="page-content">
        <div>
          <ol class="breadcrumb h6">
            <li><a href="<?php echo e(URL(App::getLocale().'/')); ?>" title="<?php echo app('translator')->getFromJson('blog.bosh'); ?>"><?php echo app('translator')->getFromJson('blog.bosh'); ?></a></li>
            <li><a href="<?php echo e(URL(App::getLocale().'/posts/'.$news->category_group_id)); ?>"
                title="<?php echo e($news->title); ?>"><?php echo e($curcat->category_name); ?></a></li>
          </ol>
        </div>
      </div>

      <div class="page-header row">
        <div class="col-md-9">
          <h4><b><?php echo e($news->title); ?></b></h4>
        </div>
        <div class="col-md-3 hidden-xs hidden-sm" style="padding-top: 11px;">
          <a class="page-print-link" style="cursor:pointer;" target="_self"><span
              class="glyphicon glyphicon-print"></span> <?php echo app('translator')->getFromJson('blog.print_button'); ?></a>
        </div>
      </div>
      <br>

      <div class="item" id="print_all">
        <div class="row section-to-print">
          <?php $date = date_create($news->datetime) ?>

          <div class="row" style="margin-top: 10px; margin-bottom: 10px">
            <div class="col-md-6">
              <h4><span class="label label-primary"> <?php echo e(date_format($date,"d.m.Y H:i")); ?> </span>
              </h4>
            </div>
            <div class="col-md-6" style="margin-top: 10px;padding-right: 50px">
              <span class="pull-right"><span class="glyphicon glyphicon-eye-open"></span> <?php echo app('translator')->getFromJson('blog.viewcount'); ?>:
                <?php echo e($news->viewcount); ?></span>
            </div>
          </div>
          <div class="row" style="margin-top: 10px; margin-bottom: 10px">
            <div class="col-md-12 col-sm-12">
              <br><img class="img-responsive" style="width: 90%!important;"
                src="<?php echo e(URL(App::getLocale().'/downloads?type=post&id='.$news->group)); ?>">
            </div>
          </div>

          </br>
          <div class="col-md-10 col-sm-10">
            <?php echo $news->content; ?>

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
          <h4><?php echo app('translator')->getFromJson('blog.news'); ?></h4>
        </div>
        <div class="list-group">
          <?php $__currentLoopData = $news_in; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <?php if($value->group == $news->group): ?>
          <a href="<?php echo e(URL(App::getLocale().'/posts/'.$value->category_group_id .'/'.$value->group)); ?>"
            class="list-group-item active"><?php echo e($value->title); ?></a>
          <?php else: ?>
          <a href="<?php echo e(URL(App::getLocale().'/posts/'.$value->category_group_id.'/'.$value->group)); ?>"
            class="list-group-item"><?php echo e($value->title); ?></a>
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
    <a href="<?php echo e(URL(App::getLocale().'/tender/'.$tender->tender_category_id."/".$tender->group)); ?>"><img
        class="img-responsive center-block" src="<?php echo e(URL(App::getLocale().'/downloads?type=tenders&id='.$tender->group)); ?>"
        alt=""></a>
  </div>
  <div class="col-xs-8">
    <a href="<?php echo e(URL(App::getLocale().'/tender/'.$tender->tender_category_id."/".$tender->group)); ?>">
      <h6><?php echo e($tender->title); ?></h6>
    </a>
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
<?php echo $__env->make('layout.defualt', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\OpenServer\domains\gca\resources\views\newsin.blade.php ENDPATH**/ ?>