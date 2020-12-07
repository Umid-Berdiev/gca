<?php $__env->startSection('content'); ?>
<?php $__env->startSection('main_top_layout'); ?>
    <section class="main_top_layout" style="background-image: url(<?php echo e(asset('gca/images/main.jpg')); ?>);">
        <div class="container">
            <h2>
                <span><?php echo app('translator')->getFromJson('blog.news'); ?></span>
            </h2>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<section class="news_inner">
    <div class="container">
        <div class="row">
            <?php $__currentLoopData = $news; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-sm-4">
                    <div class="cart_item_news"
                         style="background-image: url(<?php echo e(URL(App::getLocale().'/downloads?type=post&id='.$value->group)); ?>);width: 262px;height: 262px">
                        <div class="info_item_news">

                            
                            
                            
                            
                            
                            
                            
                            
                            <span>
                <svg width="11" height="11" viewBox="0 0 11 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M5.5 11C4.4122 11 3.34884 10.6774 2.44437 10.0731C1.5399 9.46874 0.834947 8.60975 0.418665 7.60476C0.00238306 6.59977 -0.106535 5.4939 0.105683 4.42701C0.317902 3.36011 0.841726 2.3801 1.61091 1.61091C2.3801 0.841726 3.36011 0.317902 4.42701 0.105683C5.4939 -0.106535 6.59977 0.00238306 7.60476 0.418665C8.60975 0.834947 9.46874 1.5399 10.0731 2.44437C10.6774 3.34884 11 4.4122 11 5.5C11 6.95869 10.4205 8.35764 9.38909 9.38909C8.35764 10.4205 6.95869 11 5.5 11ZM5.5 0.785717C4.5676 0.785717 3.65615 1.0622 2.88089 1.58022C2.10563 2.09823 1.50138 2.8345 1.14457 3.69592C0.787757 4.55735 0.694399 5.50523 0.8763 6.41971C1.0582 7.33419 1.50719 8.1742 2.1665 8.8335C2.8258 9.49281 3.66581 9.9418 4.58029 10.1237C5.49477 10.3056 6.44266 10.2122 7.30408 9.85543C8.1655 9.49862 8.90177 8.89438 9.41979 8.11912C9.9378 7.34386 10.2143 6.4324 10.2143 5.5C10.2143 4.2497 9.7176 3.0506 8.8335 2.1665C7.9494 1.2824 6.75031 0.785717 5.5 0.785717Z"
                        fill="white"></path>
                  <path d="M7.30319 7.85721L5.10712 5.66114V1.96436H5.89283V5.33507L7.85712 7.30328L7.30319 7.85721Z"
                        fill="white"></path>
                </svg>
                                <?php echo e(\Carbon\Carbon::parse($value->datetime)->format('d.m.y')); ?>

              </span>
                        </div>
                        <p class="text-white"><?php echo e($value->title); ?></p>
                        <a href="<?php echo e(URL(App::getLocale().'/posts/'.$curcat->group.'/'.$value->group)); ?>"
                           class="template_bord">
                            <svg width="9" height="5" viewBox="0 0 9 5" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M0.129118 4.42349C0.129118 4.26408 0.18491 4.13656 0.296493 4.04091L4.17003 0.167375C4.28162 0.0557915 4.40914 -2.00673e-07 4.5526 -1.94402e-07C4.69607 -1.88131e-07 4.83156 0.0557915 4.95909 0.167375L8.83262 4.04091C8.94421 4.1525 9 4.28799 9 4.4474C9 4.6068 8.94421 4.73432 8.83262 4.82997C8.72104 4.92561 8.59352 4.9814 8.45005 4.99734C8.30659 5.01328 8.17109 4.95749 8.04357 4.82997L4.5526 1.339L1.06164 4.82997C0.950053 4.94155 0.82253 4.99734 0.679065 4.99734C0.5356 4.99734 0.408076 4.94155 0.296493 4.82997C0.18491 4.71838 0.129118 4.58289 0.129118 4.42349Z"
                                      fill="white"></path>
                            </svg>
                        </a>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <div class="text_center">
            <nav aria-label="Page navigation example">
                    <?php echo e($news->appends(['cutcat'=>Request::get('cutcat'),'start'=>Request::get('start'),'finish'=>Request::get('finish')])->links()); ?>

            </nav>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('gca.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\OpenServer\domains\gca\resources\views\gca\posts.blade.php ENDPATH**/ ?>