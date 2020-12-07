<?php $__env->startSection('left_sidebar_menu'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content_div'); ?>
    <div class="container-fluid" id="page_content"  style="background-color: #F5F5F5">
        <div class="container">
            <?php $__env->stopSection(); ?>
            <div class="row section-to-print">
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
                            <h4><b><?php echo app('translator')->getFromJson('blog.entity_form_block_header'); ?></b></h4>
                        </div>
                        <div class="col-md-3 hidden-xs hidden-sm" style="padding-top: 11px;">
                            <a class="page-print-link" target="_self" ><span class="glyphicon glyphicon-print"></span> <?php echo app('translator')->getFromJson('blog.print_button'); ?> </a>
                        </div>
                    </div>
                    <div class="col" style="padding-top: 25px;">
                        <div class="col-md-12">
                            <div class="row" id="print_all">
                                <div class="col-sm-6">
                                    
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
                                                    <p><?php echo app('translator')->getFromJson('blog.application_received_message'); ?> <span><?php echo e(session()->get('message')); ?></span></p>
                                                </div>
                                            <?php endif; ?>
                                        <form action="<?php echo e(URL('send_post')); ?>" method="post">
                                            <?php echo e(csrf_field()); ?>

                                            <div class="form-group">
                                                <label for=""><?php echo app('translator')->getFromJson('blog.full_name'); ?><span class="required">*</span>:</label>
                                                <input type="text" value="<?php echo e(old('fio')); ?>"  name="fio" title="" placeholder="<?php echo app('translator')->getFromJson('blog.full_name_placeholder'); ?>" class="form-control" id="">
                                            </div>
                                            <div class="form-group">
                                                <label for=""><?php echo app('translator')->getFromJson('blog.date_of_birth'); ?> <span class="required">*</span>:</label>
                                                <input type="text" value="<?php echo e(old('birth')); ?>"  name="birth" title="" placeholder="<?php echo app('translator')->getFromJson('blog.date_of_birth_placeholder'); ?>" class="form-control" id="">
                                            </div>
                                            <div class="form-group">
                                                <label for=""><?php echo app('translator')->getFromJson('blog.passport_details'); ?> <span class="required">*</span>:</label>
                                                <input type="text" value="<?php echo e(old('passport')); ?>"  name="passport" title="" placeholder="<?php echo app('translator')->getFromJson('blog.passport_details_placeholder'); ?>" class="form-control" id="">
                                            </div>
                                            <div class="form-group">
                                                <label for=""><?php echo app('translator')->getFromJson('blog.address'); ?> <span class="required">*</span>:</label>
                                                <textarea resize="no" name="adress" cols="25" rows="5" title="" placeholder="<?php echo app('translator')->getFromJson('blog.address_placeholder'); ?>" class="form-control textarea" id=""><?php echo e(old('adress')); ?></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for=""><?php echo app('translator')->getFromJson('blog.zip_code'); ?>:</label>
                                                <input type="text" value="<?php echo e(old('index')); ?>"  name="index" title="" placeholder="<?php echo app('translator')->getFromJson('blog.zip_code_placeholder'); ?>" class="form-control" id="">
                                            </div>

                                            <div class="form-group">
                                                <label for=""><?php echo app('translator')->getFromJson('blog.email'); ?> <span class="required">*</span>:</label>
                                                <input type="email" value="<?php echo e(old('email')); ?>"  name="email" title="" placeholder="<?php echo app('translator')->getFromJson('blog.email_placeholder'); ?>" class="form-control" id="">
                                            </div>
                                            <div class="form-group">
                                                <label for=""><?php echo app('translator')->getFromJson('blog.phone_number'); ?></label>
                                                <input type="text" value="<?php echo e(old('phone_number')); ?>"  name="phone_number" title="" placeholder="<?php echo app('translator')->getFromJson('blog.phone_number_placeholder'); ?> " class="form-control" id="">
                                            </div>
                                            <div class="form-group">
                                                <label for=""><?php echo app('translator')->getFromJson('blog.entity_type'); ?> <span class="required">*</span>:</label>
                                                <select name="object_type" class="form-control select" id="">
                                                    <option value="Жисмоний шахс"><?php echo app('translator')->getFromJson('blog.physical_entities_submitted'); ?></option>
                                                    <option value="Юридик шахс"><?php echo app('translator')->getFromJson('blog.legal_entities_submitted'); ?></option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for=""><?php echo app('translator')->getFromJson('blog.message_content'); ?> <span class="required">*</span>:</label>
                                                <textarea resize="no" name="comment" cols="25" rows="5" title="" placeholder="<?php echo app('translator')->getFromJson('blog.message_content'); ?>" class="form-control textarea" id=""><?php echo e(old('comment')); ?></textarea>
                                            </div>
                                           <!-- <div class="form-group forspam">
                                                <label for="">Спамга қарши код <span class="required">*</span>:</label><br>
                                                <img src="images/captcha.jpg" width="150" height="40" class="captcha-image" alt="CAPTCHA" id="">&nbsp;
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

                                <div class="col-sm-6">
                                    <div class="">
                                        <div class="page-header">
                                            <h4><b><?php echo app('translator')->getFromJson('blog.application_statistics_banner_header'); ?></b></h4>
                                        </div>
                                        <br/>
                                        <div class="col-xs-12 info-request">
                                            <div class="col-md-2"></div>
                                            <div class="col-md-8">
                                                <h4 class="text-center"><?php echo app('translator')->getFromJson('blog.submitted_applications_number'); ?></h4>
                                                <p class="text-center"><?php echo app('translator')->getFromJson('blog.period'); ?> <?php echo e($last_month1); ?> - <?php echo e($now1); ?></p>
                                            </div>
                                            <div class="col-md-2"></div>
                                            <div class="clearfix"></div>
                                            <p><?php echo app('translator')->getFromJson('blog.submitted_applications_number'); ?>: <span class=""><?php echo e($all); ?></span></p>
                                            <p><?php echo app('translator')->getFromJson('blog.physical_entities_submitted'); ?>: <span class=""><?php echo e($fiz); ?></span></p>
                                            <p><?php echo app('translator')->getFromJson('blog.legal_entities_submitted'); ?>: <span class=""><?php echo e($yur); ?></span></p>
                                            <p><?php echo app('translator')->getFromJson('blog.applications_in_process'); ?>: <span class=""><?php echo e($worked); ?></span></p>
                                            <p><?php echo app('translator')->getFromJson('blog.applications_completed'); ?>: <span class=""><?php echo e($finished); ?></span></p>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                    <br>
                                    <div class="check-status">
                                        <div class="page-header">
                                            <h4><b><?php echo app('translator')->getFromJson('blog.application_status_check_header'); ?></b></h4>
                                        </div><br>
                                        <div class="">
                                            <p><?php echo app('translator')->getFromJson('blog.application_status_check_message'); ?></p>
                                        </div>
                                        <p><?php echo app('translator')->getFromJson('blog.application_reg_number'); ?>:</p>
                                        <form class="form-inline" action="<?php echo e(URL('/check')); ?>" method="POST">
                                            <?php echo e(csrf_field()); ?>

                                            <input type="text"  class="form-control" id="aplication-id" placeholder="<?php echo app('translator')->getFromJson('blog.application_reg_number_placeholder'); ?>" name="aplication_id">
                                            <button type="submit" class="btn btn-primary pull-right"><?php echo app('translator')->getFromJson('blog.btn_check_status'); ?></button>
                                        </form>

                                    </div>
                                    <br>
                                    <?php if(session()->has('check')): ?>
                                        <div class="alert alert-success">
                                            <h5 class="text-center"><?php echo app('translator')->getFromJson('blog.application_status_info'); ?></h5><br>
                                            <p><?php echo app('translator')->getFromJson('blog.application_reg_number'); ?>: <span><?php echo e(session()->get('check')->unique_number); ?></span></p>
                                            <p><?php echo app('translator')->getFromJson('blog.application_date_submitted'); ?>: <span><?php echo e(session()->get('check')->created_at); ?></span></p>
                                            <?php switch(session()->get('check')->status):
                                                case (0): ?>
                                            <p><?php echo app('translator')->getFromJson('blog.application_status'); ?>: <span><?php echo app('translator')->getFromJson('blog.application_status_new'); ?></span></p>
                                                <?php break; ?>
                                                <?php case (1): ?>
                                                <p><?php echo app('translator')->getFromJson('blog.application_status'); ?>: <span><?php echo app('translator')->getFromJson('blog.application_status_in_process'); ?></span></p>
                                                <?php break; ?>
                                                <?php case (2): ?>
                                                <p><?php echo app('translator')->getFromJson('blog.application_status'); ?>: <span><?php echo app('translator')->getFromJson('blog.application_status_in_review'); ?></span></p>
                                                <?php break; ?>
                                                <?php case (3): ?>
                                                <p><?php echo app('translator')->getFromJson('blog.application_status'); ?>: <span><?php echo app('translator')->getFromJson('blog.application_status_replied'); ?></span></p>
                                                <?php break; ?>
                                            <?php endswitch; ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
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
                            Жисмоний ва юридик шахслар мурожаатлари
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

<?php echo $__env->make('layout.defualt', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\OpenServer\domains\gca\resources\views\send_doc.blade.php ENDPATH**/ ?>