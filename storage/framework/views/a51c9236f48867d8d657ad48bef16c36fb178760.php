<?php $__env->startSection('content'); ?>
<?php $__env->startSection('main_top_layout'); ?>
    <section class="main_top_layout" style="background-image: url(<?php echo e(asset('gca/images/main.jpg')); ?>);">
        <div class="container">
            <h2>
                <span><?php echo app('translator')->getFromJson('blog.callback'); ?></span>
            </h2>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<section class="contact_inner">
    <div class="container">
        <h2 class="title"><?php echo app('translator')->getFromJson('blog.map_point'); ?></h2>
        <div id="map"><iframe src="https://yandex.ru/map-widget/v1/?um=constructor%3A458036ea9a31a6999429075e1efd9d7f6ebd5b2b42325b43324932b42c5889b5&amp;source=constructor" width="1105" height="500" frameborder="0"></iframe></div>
        <?php if($errors->any()): ?>
            <div class="alert alert-danger">
                <ul>
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($error); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        <?php endif; ?>
        <?php if(session()->has('message')): ?>
            <div class="alert alert-success">
                <p><?php echo e(session()->get('message')); ?></p>
            </div>
        <?php endif; ?>
        <form action="<?php echo e(URL('/contact_post')); ?>" method="post">
            <?php echo e(csrf_field()); ?>

            <h3><?php echo app('translator')->getFromJson('blog.callback'); ?></h3>

            <div class="contact_socials">
                <div class="">
                    <svg width="8" height="8" viewBox="0 0 8 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M3.38433 4.61486C4.17608 5.40595 5.09337 6.16304 5.45599 5.8005C5.97465 5.28194 6.29475 4.82989 7.43911 5.74949C8.58298 6.6686 7.7042 7.28167 7.20154 7.78372C6.62136 8.36379 4.45867 7.81473 2.321 5.67798C0.183822 3.54074 -0.363852 1.37849 0.216832 0.798424C0.719491 0.295367 1.32968 -0.582733 2.24897 0.560897C3.16876 1.70453 2.71712 2.02456 2.19746 2.54362C1.83634 2.90617 2.59308 3.82327 3.38433 4.61486Z" fill="#2DA37D"></path>
                    </svg>
                    <span><?php echo app('translator')->getFromJson('blog.phone'); ?>: </span>
                    <a href="tel:+998 71 241 40 48">
                        +998 71 241 40 48
                    </a>
                </div>
                <div class="">
                    <svg width="10" height="8" viewBox="0 0 10 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M9 0H1C0.45 0 0.005 0.45 0.005 1L0 7C0 7.55 0.45 8 1 8H9C9.55 8 10 7.55 10 7V1C10 0.45 9.55 0 9 0ZM9 2L5 4.5L1 2V1L5 3.5L9 1V2Z" fill="#2DA37D"></path>
                    </svg>
                    <span><?php echo app('translator')->getFromJson('blog.email'); ?>: </span>
                    <a href="mailto:info@giz.de">
                        info@giz.de
                    </a>
                </div>
                <div class="">
                    <svg width="7" height="10" viewBox="0 0 7 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M3.12695 0C1.39962 0 0 1.394 0 3.1207C0 6.10632 3.12695 10 3.12695 10C3.12695 10 6.25391 6.10569 6.25391 3.1207C6.25391 1.39462 4.85428 0 3.12695 0ZM3.12695 4.8474C2.67912 4.8474 2.24963 4.6695 1.93297 4.35284C1.6163 4.03617 1.4384 3.60668 1.4384 3.15885C1.4384 2.71102 1.6163 2.28153 1.93297 1.96486C2.24963 1.64819 2.67912 1.47029 3.12695 1.47029C3.57479 1.47029 4.00428 1.64819 4.32094 1.96486C4.63761 2.28153 4.81551 2.71102 4.81551 3.15885C4.81551 3.60668 4.63761 4.03617 4.32094 4.35284C4.00428 4.6695 3.57479 4.8474 3.12695 4.8474Z" fill="#2DA37D"></path>
                    </svg>
                    <span><?php echo app('translator')->getFromJson('blog.address'); ?>:</span>
                    <a href="" onclick="return false;">
                        <?php echo app('translator')->getFromJson('blog.address'); ?>
                    </a>
                </div>
            </div>

            <div class="form-group">
                <label for="exampleInputName"><?php echo app('translator')->getFromJson('blog.full_name'); ?></label>
                <input class="form-control" name="fio" type="text" id="exampleInputName">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1"><?php echo app('translator')->getFromJson('blog.email'); ?></label>
                <input class="form-control" name="email" type="email" id="exampleInputEmail1">
            </div>
            <div class="form-group">
                <label for="exampleInputTel"><?php echo app('translator')->getFromJson('blog.phone_number'); ?></label>
                <input class="form-control" name="phone" type="tel" id="exampleInputTel">
            </div>
            <div class="form-group">
                <label for="exampleInputTel"><?php echo app('translator')->getFromJson('blog.message_text'); ?></label>
                <textarea class="form-control" name="comment"></textarea>
            </div>
            <button type="submit" class="btn link_template"><?php echo app('translator')->getFromJson('blog.form_btn_send'); ?></button>
        </form>
    </div>
</section>



















<?php $__env->stopSection(); ?>
<?php echo $__env->make('gca.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\OpenServer\domains\gca\resources\views\gca\contact.blade.php ENDPATH**/ ?>