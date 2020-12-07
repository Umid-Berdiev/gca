<?php $menus= DB::table("menumakers")
    ->where("language_id","=",\App\Http\Controllers\NewsController::getlangid())
    ->where("parent_id","=",0)
    ->orderBy('orders','ASC')
    ->get(); ?>
<nav class="navbar navbar-default">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li><a href="<?php echo e(URL(App::getLocale()."/")); ?>"><span class="sr-only">(current)</span><span class="glyphicon glyphicon-home"></span></a></li>
                <?php $__currentLoopData = $menus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php $modelsx = DB::table("menumakers")
                        ->where("language_id","=",\App\Http\Controllers\NewsController::getlangid())
                        ->where("parent_id","=",$value->group)
                        ->orderBy('orders','ASC')
                        ->get(); ?>
                    <?php if(count($modelsx) >0): ?>
                        <li class="dropdown">
                            <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                <span class="title"><?php echo e($value->menu_name); ?></span><span class="caret"></span>
                            </a>
                            <!--start submenu -->
                            <ul class="dropdown-menu">
                                <?php $__currentLoopData = $modelsx; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $valuex): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php $modelsxs = DB::table("menumakers")
                                        ->where("language_id","=",\App\Http\Controllers\NewsController::getlangid())
                                        ->where("parent_id","=",$valuex->group)
                                        ->orderBy('orders','ASC')
                                        ->get(); ?>
                                    <?php if(count($modelsxs) >0): ?>

                                        <li class="dropdown-submenu">
                                            <a href="javascript:void(0);" tabindex="-1" class="dropdown-toggle" data-toggle="dropdown">
                                                <span class="title"><?php echo e($valuex->menu_name); ?></span>
                                            </a>

                                            <ul class="dropdown-menu">
                                                <?php $__currentLoopData = $modelsxs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $valuexx): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
												
                                                    <li><a href="<?php if($valuexx->type =="1"): ?>
                                                        <?php if(strpos($valuexx->link, "http") ===true): ?>
                                    <?php echo e($valuexx->link); ?>

							<?php else: ?>       <?php echo e(URL(App::getLocale().$valuexx->link)); ?>     <?php endif; ?>
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
								<li role="separator" class="divider"></li>
                                    <?php else: ?>
                                        <li><a href="<?php if($valuex->type =="1"): ?>
											<?php 
$mystring = $valuex->link; $findme = 'http'; $pos = strpos($mystring, $findme);
    if ($pos === false) {
        
		  echo URL(App::getLocale().$valuex->link);
    }
    else {
     echo $valuex->link;
	
    }
												  ?>
											
                                            
                                            <?php elseif($valuex->type =="2"): ?>
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

                            </ul><!--end /submenu -->
                        </li>

                    <?php else: ?>
                        <li><a href="<?php if($value->type =="1"): ?>
							<?php if(strpos($valuex->link, "http") === true): ?>
                                    <?php echo e($value->link); ?>

							<?php else: ?>       <?php echo e(URL(App::getLocale().$value->link)); ?>     <?php endif; ?>
                            <?php elseif($value->type =="2"): ?>
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
            <div class="search-form hidden-xs">
                <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown dropdown-search-form">
                        <a href="#" title="Қидириш" class="search-form dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-expanded="false">
                            <span class="glyphicon glyphicon-search"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li aria-labelledby="dropdownMenu1" role="presentation">
                                <form action="<?php echo e(URL(App::getLocale().'/search')); ?>" class="navbar-form" style="width: max-content;">
                                    <div class="form-group">
                                        <label for="exampleInputName2" class="sr-only"><?php echo app('translator')->getFromJson('blog.search'); ?></label>
                                        <input type="text" name="search" autocomplete="off" class="form-control" id="exampleInputName2" placeholder="<?php echo app('translator')->getFromJson('blog.search-placeholder'); ?>" maxlength="50">
                                    </div>
                                    <input type="submit" class="btn btn-default" value="<?php echo app('translator')->getFromJson('blog.search'); ?>">
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>

        </div>
    </div>
</nav><?php /**PATH D:\OpenServer\domains\gca\resources\views\layout\menu.blade.php ENDPATH**/ ?>