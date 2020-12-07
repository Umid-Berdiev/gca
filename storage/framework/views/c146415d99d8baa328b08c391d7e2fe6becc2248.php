<?php $menus= DB::table("menumakers")
    ->where("language_id","=",\App\Http\Controllers\NewsController::getlangid())
    ->where("parent_id","=",0)
    ->get();
$tenders = App\tender::take(3)->where('title','<>','')->where('language_id','=',\App\Http\Controllers\SearchController::languages())->orderBy('id','desc')->get();
?>




<?php $__env->startSection('left_sidebar_menu'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content_div'); ?>
<div class="container-fluid" id="page_content" style="background-color: #F5F5F5">
  <div class="container">
    <?php $__env->stopSection(); ?>
    <div class="row">
      <?php $__env->startSection('nowosti'); ?>
      <ul>
        <li><a href="<?php echo e(URL(App::getLocale()."/")); ?>"><span class="sr-only">(current)</span><span
              class="glyphicon glyphicon-home"></span></a></li>
        <?php $__currentLoopData = $menus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php $modelsx = DB::table("menumakers")
				                               ->where("language_id","=",\App\Http\Controllers\NewsController::getlangid())
				                               ->where("parent_id","=",$value->group)
				                               ->get(); ?>
        <?php if(count($modelsx) >0): ?>
        <li>
          <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button"
            aria-haspopup="true" aria-expanded="false">
            <span class="title"><?php echo e($value->menu_name); ?></span><span class="caret"></span>
          </a>
          <!--start submenu -->
          <ul>
            <?php $__currentLoopData = $modelsx; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $valuex): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php $modelsxs = DB::table("menumakers")
								                                ->where("language_id","=",\App\Http\Controllers\NewsController::getlangid())
								                                ->where("parent_id","=",$valuex->group)
								                                ->get(); ?>
            <?php if(count($modelsxs) >0): ?>

            <li>
              <a href="javascript:void(0);" tabindex="-1" class="dropdown-toggle" data-toggle="dropdown">
                <span class="title"><?php echo e($valuex->menu_name); ?></span>
              </a>

              <ul>
                <?php $__currentLoopData = $modelsxs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $valuexx): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li><a href="<?php if($valuexx->type ==" 1"): ?> <?php echo e(URL(App::getLocale()."/".$valuexx->link)); ?>

                    <?php elseif($valuexx->type =="2"): ?>
                    <?php echo e(URL(App::getLocale()."/posts/".$valuexx->alias_category_id)); ?>

                    <?php elseif($valuexx->type =="3"): ?>
                    <?php   $pages= DB::table("pages")
													                              ->where("language_id","=",\App\Http\Controllers\NewsController::getlangid())
													                              ->where("page_group_id","=",$valuexx->alias_category_id)
													                              ->first(); ?>
                    <?php echo e(URL(App::getLocale()."/page/".$pages->page_category_group_id."/".$pages->page_group_id)); ?>

                    <?php elseif($valuexx->type =="4"): ?>
                    <?php echo e(URL(App::getLocale()."/doc/".$valuexx->alias_category_id)); ?>

                    <?php elseif($valuexx->type =="5"): ?>
                    <?php echo e(URL(App::getLocale()."/event/".$valuexx->alias_category_id)); ?>

                    <?php elseif($valuexx->type =="6"): ?>
                    <?php echo e(URL(App::getLocale()."/tender/".$valuexx->alias_category_id)); ?>

                    <?php elseif($valuexx->type =="7"): ?>
                    <?php elseif($valuexx->type =="8"): ?>
                    <?php endif; ?>"><span class="title"><?php echo e($valuexx->menu_name); ?></span></a></li>
                <li role="separator" class="divider"></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </ul>
            </li>
            <?php else: ?>
            <li><a href="<?php if($valuex->type ==" 1"): ?> <?php echo e(URL(App::getLocale().$valuex->link)); ?> <?php elseif($valuex->type
                =="2"): ?>
                <?php echo e(URL(App::getLocale()."/posts/".$valuex->alias_category_id)); ?>

                <?php elseif($valuex->type =="3"): ?>
                <?php   $pages= DB::table("pages")
										                              ->where("language_id","=",\App\Http\Controllers\NewsController::getlangid())
										                              ->where("page_group_id","=",$valuex->alias_category_id)
										                              ->first(); ?>
                <?php echo e(URL(App::getLocale()."/page/".$pages->page_category_group_id."/".$pages->page_group_id)); ?>

                <?php elseif($valuex->type =="4"): ?>
                <?php echo e(URL(App::getLocale()."/doc/".$valuex->alias_category_id)); ?>

                <?php elseif($valuex->type =="5"): ?>
                <?php echo e(URL(App::getLocale()."/event/".$valuex->alias_category_id)); ?>

                <?php elseif($valuex->type =="6"): ?>
                <?php echo e(URL(App::getLocale()."/tender/".$valuex->alias_category_id)); ?>

                <?php elseif($valuex->type =="7"): ?>
                <?php echo e(URL(App::getLocale()."/video/".$valuex->alias_category_id)); ?>

                <?php elseif($valuex->type =="8"): ?>
                <?php echo e(URL(App::getLocale()."/photo/".$valuex->alias_category_id)); ?>

                <?php endif; ?>"><span class="title"><?php echo e($valuex->menu_name); ?></span></a></li>
            <li role="separator" class="divider"></li>

            <?php endif; ?>

            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

          </ul>
          <!--end /submenu -->
        </li>

        <?php else: ?>
        <li><a href="<?php if($value->type ==" 1"): ?> <?php echo e(URL(App::getLocale().$value->link)); ?> <?php elseif($value->type =="2"): ?>
            <?php echo e(URL(App::getLocale()."/posts/".$value->alias_category_id)); ?>

            <?php elseif($value->type =="3"): ?>
            <?php   $pages= DB::table("pages")
						                              ->where("language_id","=",\App\Http\Controllers\NewsController::getlangid())
						                              ->where("page_group_id","=",$value->alias_category_id)
						                              ->first();?>
            <?php echo e(URL(App::getLocale()."/page/".$pages->page_category_group_id."/$pages->page_group_id")); ?>

            <?php elseif($value->type =="4"): ?>
            <?php echo e(URL(App::getLocale()."/doc/".$value->alias_category_id)); ?>

            <?php elseif($value->type =="5"): ?>
            <?php echo e(URL(App::getLocale()."/event/".$value->alias_category_id)); ?>

            <?php elseif($value->type =="6"): ?>
            <?php echo e(URL(App::getLocale()."/tender/".$value->alias_category_id)); ?>

            <?php elseif($value->type =="7"): ?>
            <?php echo e(URL(App::getLocale()."/video/".$value->alias_category_id)); ?>

            <?php elseif($value->type =="8"): ?>
            <?php echo e(URL(App::getLocale()."/photo/".$value->alias_category_id)); ?>

            <?php endif; ?>"><span class="title"><?php echo e($value->menu_name); ?></span></a></li>
        <li role="separator" class="divider"></li>
        <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>



      </ul>

      <?php $__env->stopSection(); ?>

      <?php $__env->startSection('statistika'); ?>
      <?php $__env->stopSection(); ?>
    </div>
    <?php $__env->startSection('nav_page'); ?>
    <div class="col-md-3" style="padding-top: 50px;">
      <div class="col menu-item-structure">
        <div class="col" style="background-color: #3075ff; padding: 5px 15px; color: #fff">

        </div>
        <div class="list-group">

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
<?php echo $__env->make('layout.defualt', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\OpenServer\domains\gca\resources\views\map.blade.php ENDPATH**/ ?>