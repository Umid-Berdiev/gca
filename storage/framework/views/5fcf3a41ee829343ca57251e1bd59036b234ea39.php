<?php $__env->startSection('top-menu'); ?>
    <div class="top-menu">
        <?php echo $__env->make('layout.menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('suvfaoliati'); ?>
    <?php $__currentLoopData = $suv_xujaliks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <a href="<?php echo e(url(App::getLocale().'/page/'.$val->page_category_group_id.'/'.$val->page_group_id)); ?>" class="list-group-item"><img src="<?php echo e(URL(App::getLocale().'/downloads?type=page&id='.$val->page_group_id)); ?>" alt="" width="30" height="30" /><p><?php echo e($val->title); ?></p></a>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('newsblok'); ?>
    <br/>
    <div class="row" style="margin: 0">

        <?php if(count($posts) >= 2): ?>
    <?php for($i=0;$i< 2;$i++): ?>
    <div class="col-sm-6">
        <a href="<?php echo e(URL(App::getLocale().'/posts/'.$posts[$i]->category_group_id.'/'.$posts[$i]->group)); ?>"><img class="img-responsive"  src="<?php echo e(URL(App::getLocale().'/downloads?type=post&id='.$posts[$i]->group)); ?>" alt=""></a>
                      <h4><a href="<?php echo e(URL(App::getLocale().'/posts/'.$posts[$i]->category_group_id.'/'.$posts[$i]->group)); ?>"><?php echo e($posts[$i]->title); ?></a></h4>
                    <?php $date=date_create($posts[$i]->datetime) ?>
                      <h6><?php echo e(date_format($date,"d.m.Y H:i")); ?></h6>
    </div>
   <?php endfor; ?>
            <?php else: ?>

            <?php for($i=0;$i< count($posts);$i++): ?>
                <div class="col-sm-6">
                    <a href="<?php echo e(URL(App::getLocale().'/posts/'.$posts[$i]->category_group_id.'/'.$posts[$i]->group)); ?>"><img class="img-responsive"  src="<?php echo e(URL(App::getLocale().'/downloads?type=post&id='.$posts[$i]->group)); ?>" alt=""></a>
                    <h4><a href="<?php echo e(URL(App::getLocale().'/posts/'.$posts[$i]->category_group_id.'/'.$posts[$i]->group)); ?>"><?php echo e($posts[$i]->title); ?></a></h4>
                    <?php $date=date_create($posts[$i]->datetime) ?>
                    <h6><?php echo e(date_format($date,"d.m.Y H:i")); ?></h6>
                </div>
            <?php endfor; ?>
        <?php endif; ?>
    </div>
    <?php for($i=2;$i< count($posts);$i++): ?>

    <div class="row" style="margin: 0;">
        <div class="col-sm-4"><br/>
            <a href="<?php echo e(URL(App::getLocale().'/posts/'.$posts[$i]->category_group_id.'/'.$posts[$i]->group)); ?>">
                <img class="img-responsive" src="<?php echo e(URL(App::getLocale().'/downloads?type=post&id='.$posts[$i]->group)); ?>" alt="">
            </a>
        </div>
        <div class="col-sm-8">
            <h4><a href="<?php echo e(URL(App::getLocale().'/posts/'.$posts[$i]->category_group_id.'/'.$posts[$i]->group)); ?>"><?php echo e($posts[$i]->title); ?></a></h4>
            <?php $date=date_create($posts[$i]->datetime) ?>
            <h6><?php echo e(date_format($date,"d.m.Y | H:i")); ?></h6>
            <p><?php echo $posts[$i]->decription; ?></p>
        </div>
    </div>



    <?php endfor; ?>




<?php $__env->stopSection(); ?>

<?php $__env->startSection('sorovnoma'); ?>
    <?php $__env->stopSection(); ?>

<?php $__env->startSection('tender'); ?>

        <?php $__currentLoopData = $tenders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$tender): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="row">
        <div class="col-xs-4" style="padding-top: 10px">
            <a href="<?php echo e(URL(App::getLocale().'/tender/'.$tender->tender_category_id."/".$tender->group)); ?>"><img class="img-responsive center-block" src="<?php echo e(URL(App::getLocale().'/downloads?type=tenders&id='.$tender->group)); ?>" alt=""></a>
        </div>
        <div class="col-xs-8 force-margin">
            <a href="<?php echo e(URL(App::getLocale().'/tender/'.$tender->tender_category_id."/".$tender->group)); ?>"><h6><?php echo e($tender->title); ?></h6></a>
        </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    <?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.defualt', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\OpenServer\domains\gca\resources\views\index.blade.php ENDPATH**/ ?>