<?php $menus = DB::table("menumakers")
    ->where("language_id", "=", \App\Http\Controllers\NewsController::getlangid())
    ->where("parent_id", "=", 0)
    ->orderBy('orders', 'ASC')
    ->get(); ?>
<div class="hdr_main">
    <a href="<?php echo e(URL(App::getLocale()."/")); ?>" class="logo">
        <img src="<?php echo e(asset('project_gca/images/logo.png')); ?>" alt="">
    </a>
    <ul class="ht_ul">



        <?php $__currentLoopData = $menus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php $modelsx = DB::table("menumakers")
                ->where("language_id", "=", \App\Http\Controllers\NewsController::getlangid())
                ->where("parent_id", "=", $value->group)
                ->orderBy('orders', 'ASC')
                ->get(); ?>
            <?php if(count($modelsx) >0): ?>
                <li class="sub_menu">
                    <a href="#">
                        <?php echo e($value->menu_name); ?>

                    </a>
                    <ul>
                        <?php $__currentLoopData = $modelsx; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $valuex): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php $modelsxs = DB::table("menumakers")
                                ->where("language_id", "=", \App\Http\Controllers\NewsController::getlangid())
                                ->where("parent_id", "=", $valuex->group)
                                ->orderBy('orders', 'ASC')
                                ->get(); ?>
                            <?php if(count($modelsxs) >0): ?>
                                <li class="sub_menu">
                                    <a href="#">
                                    <?php echo e($valuex->menu_name); ?>

                                    </a>

                                    <ul class="sub_menu">
                                        <?php $__currentLoopData = $modelsxs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $valuexx): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                            <li><a href="<?php if($valuexx->type =="1"): ?>
                                                <?php if(strpos($valuexx->link, "http") ===true): ?>
                                                <?php echo e($valuexx->link); ?>

                                                <?php else: ?>       <?php echo e(URL(App::getLocale().$valuexx->link)); ?>     <?php endif; ?>
                                                <?php elseif($valuexx->type =="2"): ?>
                                                <?php echo e(URL(App::getLocale()."/posts/".$valuexx->alias_category_id)); ?>

                                                <?php elseif($valuexx->type =="3"): ?>
                                                <?php   $pages = DB::table("pages")
                                                    ->where("language_id", "=", \App\Http\Controllers\NewsController::getlangid())
                                                    ->where("page_group_id", "=", $valuexx->alias_category_id)
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
                                                <?php endif; ?>"><?php echo e($valuexx->menu_name); ?></a></li>
                                            <li role="separator" class="divider"></li>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </ul>
                                </li>
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

                                        <?php endif; ?>"><?php echo e($valuex->menu_name); ?></a></li>
                                    <li role="separator" class="divider"></li>

                                <?php endif; ?>

                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
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

                        <?php endif; ?>">
                            <?php echo e($value->menu_name); ?></a></li>
                    <li role="separator" class="divider"></li>
                <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    </ul>
    <div class="form_header">
          <span class="togle_form_header">
            <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M18 17.0607L12.9703 12.0043C14.1727 10.5535 14.77 8.6952 14.6382 6.81548C14.5064 4.93576 13.6556 3.17905 12.2624 1.91024C10.8693 0.641423 9.04093 -0.041972 7.1571 0.00199741C5.27327 0.0459669 3.47878 0.813921 2.14635 2.14635C0.813921 3.47878 0.0459669 5.27327 0.00199741 7.1571C-0.041972 9.04093 0.641423 10.8693 1.91024 12.2624C3.17905 13.6556 4.93576 14.5064 6.81548 14.6382C8.6952 14.77 10.5535 14.1727 12.0043 12.9703L17.0607 18L18 17.0607ZM1.34525 7.34096C1.34525 6.15512 1.69689 4.99591 2.35571 4.00992C3.01452 3.02393 3.95093 2.25545 5.0465 1.80164C6.14207 1.34784 7.34761 1.22911 8.51066 1.46045C9.67372 1.6918 10.7421 2.26284 11.5806 3.10135C12.4191 3.93987 12.9901 5.0082 13.2215 6.17125C13.4528 7.33431 13.3341 8.53985 12.8803 9.63542C12.4265 10.731 11.658 11.6674 10.672 12.3262C9.68601 12.985 8.5268 13.3367 7.34096 13.3367C5.7508 13.3367 4.22576 12.705 3.10135 11.5806C1.97694 10.4562 1.34525 8.93112 1.34525 7.34096Z"
                    fill="#7B7A7E"/>
            </svg>
            <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M11.113 8.99744L17.5567 2.56866C17.8389 2.28647 17.9974 1.90375 17.9974 1.50468C17.9974 1.10562 17.8389 0.722895 17.5567 0.440712C17.2745 0.158529 16.8918 0 16.4928 0C16.0937 0 15.711 0.158529 15.4288 0.440712L9 6.88448L2.57121 0.440712C2.28903 0.158529 1.90631 -2.97328e-09 1.50724 0C1.10817 2.97328e-09 0.725452 0.158529 0.443269 0.440712C0.161086 0.722895 0.00255743 1.10562 0.00255743 1.50468C0.00255743 1.90375 0.161086 2.28647 0.443269 2.56866L6.88704 8.99744L0.443269 15.4262C0.302812 15.5655 0.191329 15.7313 0.115249 15.9139C0.0391699 16.0965 0 16.2924 0 16.4902C0 16.688 0.0391699 16.8839 0.115249 17.0665C0.191329 17.2491 0.302812 17.4149 0.443269 17.5542C0.582579 17.6946 0.74832 17.8061 0.930933 17.8822C1.11355 17.9583 1.30941 17.9974 1.50724 17.9974C1.70507 17.9974 1.90094 17.9583 2.08355 17.8822C2.26616 17.8061 2.4319 17.6946 2.57121 17.5542L9 11.1104L15.4288 17.5542C15.5681 17.6946 15.7338 17.8061 15.9165 17.8822C16.0991 17.9583 16.2949 17.9974 16.4928 17.9974C16.6906 17.9974 16.8865 17.9583 17.0691 17.8822C17.2517 17.8061 17.4174 17.6946 17.5567 17.5542C17.6972 17.4149 17.8087 17.2491 17.8848 17.0665C17.9608 16.8839 18 16.688 18 16.4902C18 16.2924 17.9608 16.0965 17.8848 15.9139C17.8087 15.7313 17.6972 15.5655 17.5567 15.4262L11.113 8.99744Z"
                    fill="#7B7A7E"/>
            </svg>
          </span>
        <form action="<?php echo e(URL(App::getLocale().'/search')); ?>" class="navbar-form" style="width: max-content;">

            <div class="form-group">
                <input type="text" name="search" placeholder="<?php echo app('translator')->getFromJson('blog.search'); ?>">
                <button type="submit">
                    <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M18 17.0607L12.9703 12.0043C14.1727 10.5535 14.77 8.6952 14.6382 6.81548C14.5064 4.93576 13.6556 3.17905 12.2624 1.91024C10.8693 0.641423 9.04093 -0.041972 7.1571 0.00199741C5.27327 0.0459669 3.47878 0.813921 2.14635 2.14635C0.813921 3.47878 0.0459669 5.27327 0.00199741 7.1571C-0.041972 9.04093 0.641423 10.8693 1.91024 12.2624C3.17905 13.6556 4.93576 14.5064 6.81548 14.6382C8.6952 14.77 10.5535 14.1727 12.0043 12.9703L17.0607 18L18 17.0607ZM1.34525 7.34096C1.34525 6.15512 1.69689 4.99591 2.35571 4.00992C3.01452 3.02393 3.95093 2.25545 5.0465 1.80164C6.14207 1.34784 7.34761 1.22911 8.51066 1.46045C9.67372 1.6918 10.7421 2.26284 11.5806 3.10135C12.4191 3.93987 12.9901 5.0082 13.2215 6.17125C13.4528 7.33431 13.3341 8.53985 12.8803 9.63542C12.4265 10.731 11.658 11.6674 10.672 12.3262C9.68601 12.985 8.5268 13.3367 7.34096 13.3367C5.7508 13.3367 4.22576 12.705 3.10135 11.5806C1.97694 10.4562 1.34525 8.93112 1.34525 7.34096Z"
                              fill="#fff"/>
                    </svg>
                </button>
            </div>
        </form>
    </div>
    <div class="hamburger">
        <svg viewBox="0 0 100 80" width="40" height="40">
            <rect width="100" height="10"></rect>
            <rect y="30" width="100" height="10"></rect>
            <rect y="60" width="100" height="10"></rect>
        </svg>
    </div>
</div><?php /**PATH D:\OpenServer\domains\gca\resources\views/gca/blocks/menu.blade.php ENDPATH**/ ?>