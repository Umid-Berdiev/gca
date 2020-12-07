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
                            </ol>
                        </div>
                    </div>

                    <div class="page-header row">
                        <div class="col-md-9">
                            <h4><b><?php echo app('translator')->getFromJson('blog.resume_pagetitle'); ?></b></h4>
                        </div>
                        <div class="col-md-3 hidden-xs hidden-sm" style="padding-top: 11px;">
                            <a class="page-print-link pull-right" style="cursor:pointer;" target="_self" ><span class="glyphicon glyphicon-print"></span> <?php echo app('translator')->getFromJson('blog.print_button'); ?></a>
                        </div>
                    </div>
                    <div class="col" style="padding-top: 25px;">
                        <div class="text-left">
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
                                        <p>Мурожаатингиз қабул қилинди. Аризангизни руйхат рақами: <span> <?php echo e(session()->get('message')); ?></span></p>
                                    </div>
                                <?php endif; ?>
                            <form action="<?php echo e(URL('/cv_form_post')); ?>" method="post" enctype="multipart/form-data" >
                                <?php echo e(csrf_field()); ?>

                                <div class="form-group">
                                    <label for=""><?php echo app('translator')->getFromJson('blog.full_name'); ?><span class="required">*</span>:</label>
                                    <input type="text" value="<?php echo e(old('fio')); ?>" name="fio" title="" placeholder="<?php echo app('translator')->getFromJson('blog.full_name_placeholder'); ?>" class="form-control" id="">
                                </div>
                                <div class="form-group">
                                    <label for=""><?php echo app('translator')->getFromJson('blog.email'); ?> <span class="required">*</span>:</label>
                                    <input type="email" value="<?php echo e(old('email')); ?>" name="email" title="" placeholder="<?php echo app('translator')->getFromJson('blog.email_placeholder'); ?>" class="form-control" id="">
                                </div>
                                <div class="form-group">
                                    <label for=""><?php echo app('translator')->getFromJson('blog.phone_number'); ?></label>
                                    <input type="text" value="<?php echo e(old('phone')); ?>" name="phone" title="" placeholder="<?php echo app('translator')->getFromJson('blog.phone_number_placeholder'); ?>" class="form-control" id="">
                                </div>
                                <div class="form-group">
                                    <label for=""><?php echo app('translator')->getFromJson('blog.additional_message'); ?> <span class="required">*</span>:</label>
                                    <textarea resize="no" name="comment" cols="25" rows="5" title="" placeholder="<?php echo app('translator')->getFromJson('blog.additional_message_placeholder'); ?>" class="form-control textarea" id=""><?php echo e(old('comment')); ?></textarea>
                                </div>
                                <div class="form-group">
                                    <label for=""><?php echo app('translator')->getFromJson('blog.file_attachment'); ?></label>
                                    <input type="file" name="file">
                                </div>

                                <!--<div class="form-group forspam">
                                    <label for="">Спамга қарши код <span class="required">*</span>:</label><br>
                                    <img src="<?php echo e(URL('images/captcha.jpg')); ?>" width="150" height="40" class="captcha-image" alt="CAPTCHA" id="">&nbsp;
                                    <input type="text" class="" name="captcha_word" class="" value="" maxlength="5" placeholder="Расмдаги кодни киритинг"><br>
                                    <a href="#" class="" title="">Кодни ўзгартириш</a>
                                    <br>
                                </div>-->
                                <div class="form-group">
                                    <input type="submit" class="btn btn-primary col-md-6" value="<?php echo app('translator')->getFromJson('blog.form_btn_send'); ?>">
                                </div>
                                <div class="clearfix"></div><br>
                                <div class="alert alert-warning">
                                    <span class="required">*</span> <?php echo app('translator')->getFromJson('blog.required_fields_note'); ?>
                                </div><br>


                            </form>
                        </div>


                    </div>

                <?php $__env->stopSection(); ?>

                <?php $__env->startSection('statistika'); ?>
                <?php $__env->stopSection(); ?>
            </div>
            <?php $__env->startSection('nav_page'); ?>
                <div class="col-md-3" style="padding-top: 50px;">
                    <div class="col menu-item-structure">
                        <div class="col" style="background-color: #3075ff; padding: 5px 15px; color: #fff">
<?php echo app('translator')->getFromJson('blog.resume_pagetitle'); ?>
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

<?php echo $__env->make('layout.defualt', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\OpenServer\domains\gca\resources\views\cv_form.blade.php ENDPATH**/ ?>