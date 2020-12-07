<?php
$translate = DB::table("translate")->where("type","=","contact")->orderByDesc("id")->first();

$json =json_decode($translate->jsons);
$language_id = \App\Http\Controllers\SearchController::languages();
?>

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
                            <h4><b><?php echo e($json->title[$language_id-1]); ?></b></h4>
                        </div>
                        <div class="col-md-3 hidden-xs hidden-sm" style="padding-top: 11px;">
                            <a class="page-print-link" style="cursor:pointer;" target="_self" ><span class="glyphicon glyphicon-print"></span> <?php echo app('translator')->getFromJson('blog.print_button'); ?></a>
                        </div>
                    </div>
                    <div class="container-fluid" id="print_all">
                        <h4 style="text-align: justify"><?php echo e($json->description[$language_id-1]); ?></h4><br/>
                        <div class="table-responsive">
                            <table class="table table-bordered" style="max-width: 750px;">
                                <thead>
                                <tr class="info">
                                    <th width="150"><?php echo e($json->rahbar[$language_id-1]); ?></th>
                                    <th width="150"><?php echo e($json->lavozim[$language_id-1]); ?></th>
                                    <th width="200"><?php echo e($json->kun[$language_id-1]); ?></th>
                                    <th width="100"><?php echo e($json->soat[$language_id-1]); ?></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php if(isset($json->tb_one_uz)): ?>
                                <?php $__currentLoopData = $json->tb_one_uz; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <?php if($language_id-1==0): ?>
                                    <td><?php echo $json->tb_one_uz[$key] ?? null; ?></td>
                                    <td><?php echo $json->tb_two_uz[$key] ?? null; ?></td>
                                    <td><?php echo $json->tb_three_uz[$key] ?? null; ?></td>
                                    <td><?php echo $json->tb_four_uz[$key] ?? null; ?></td>
                                        <?php elseif($language_id-1==1): ?>
                                        <td><?php echo $json->tb_one_ru[$key] ?? null; ?></td>
                                        <td><?php echo $json->tb_two_ru[$key] ?? null; ?></td>
                                        <td><?php echo $json->tb_three_ru[$key] ?? null; ?></td>
                                        <td><?php echo $json->tb_four_ru[$key] ?? null; ?></td>
                                        <?php elseif($language_id-1==2): ?>
                                        <td><?php echo $json->tb_one_en[$key] ?? null; ?></td>
                                        <td><?php echo $json->tb_two_en[$key] ?? null; ?></td>
                                        <td><?php echo $json->tb_three_en[$key] ?? null; ?></td>
                                        <td><?php echo $json->tb_four_en[$key] ?? null; ?></td>
                                    <?php endif; ?>
                                </tr>
                                   <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="container-fluid text-left">
                        <div class="row" style="border-bottom: 1px solid blue">
                            <h4><b><?php echo e($json->map_target[$language_id-1]); ?></b></h4>
                        </div>
                        <div class="row">
                            <div class="col-sm-6"><br/>
                                <img class="img-responsive" src="<?php echo e(URL('images/googlemaps_july2016.jpg')); ?>" alt="" />
                            </div>
                            <div class="col-sm-6">
                                <div class="text-center">
                                    <h4><?php echo e($json->bottom_title[$language_id-1]); ?></h4>
                                </div><br/>
                                <?php if($language_id-1==0): ?>
                                    <div class="row">
                                        <div class="col-xs-2">
                                            <img class="img-responsive" src="<?php echo e(URL('images/loca.png')); ?>" alt="" />
                                        </div>
                                        <div class="col-xs-10">
                                            <p><?php echo $json->bottom_table_tb_one_uz[0]; ?></p>
                                        </div>
                                    </div><br/>
                                    <div class="row">
                                        <div class="col-xs-2">
                                            <img class="img-responsive" src="<?php echo e(URL('images/phone_icon.png')); ?>" alt="" />
                                        </div>
                                        <div class="col-xs-10">
                                            <p><?php echo $json->bottom_table_tb_two_uz[0]; ?><br>
                                                <?php echo $json->bottom_table_tb_three_uz[0]; ?></p>
                                        </div>
                                    </div><br/>
                                    <div class="row">
                                        <div class="col-xs-2">
                                            <img class="img-responsive" src="<?php echo e(URL('images/bus__654365.png')); ?>" alt="" />
                                        </div>
                                        <div class="col-xs-10">
                                            <p><?php echo $json->bottom_table_tb_four_uz[0]; ?></p>
                                        </div>
                                    </div>
                                <?php elseif($language_id-1==1): ?>

                                    <div class="row">
                                        <div class="col-xs-2">
                                            <img class="img-responsive" src="<?php echo e(URL('images/loca.png')); ?>" alt="" />
                                        </div>
                                        <div class="col-xs-10">
                                            <p><?php echo $json->bottom_table_tb_one_ru[0]; ?></p>
                                        </div>
                                    </div><br/>
                                    <div class="row">
                                        <div class="col-xs-2">
                                            <img class="img-responsive" src="<?php echo e(URL('images/phone_icon.png')); ?>" alt="" />
                                        </div>
                                        <div class="col-xs-10">
                                            <p><?php echo $json->bottom_table_tb_two_ru[0]; ?><br>
                                                <?php echo $json->bottom_table_tb_three_ru[0]; ?></p>
                                        </div>
                                    </div><br/>
                                    <div class="row">
                                        <div class="col-xs-2">
                                            <img class="img-responsive" src="<?php echo e(URL('images/bus__654365.png')); ?>" alt="" />
                                        </div>
                                        <div class="col-xs-10">
                                            <p><?php echo $json->bottom_table_tb_four_ru[0]; ?></p>
                                        </div>
                                    </div>
                                <?php elseif($language_id-1==2): ?>

                                    <div class="row">
                                        <div class="col-xs-2">
                                            <img class="img-responsive" src="<?php echo e(URL('images/loca.png')); ?>" alt="" />
                                        </div>
                                        <div class="col-xs-10">
                                            <p><?php echo $json->bottom_table_tb_one_en[0]; ?>}</p>
                                        </div>
                                    </div><br/>
                                    <div class="row">
                                        <div class="col-xs-2">
                                            <img class="img-responsive" src="<?php echo e(URL('images/phone_icon.png')); ?>" alt="" />
                                        </div>
                                        <div class="col-xs-10">
                                            <p><?php echo $json->bottom_table_tb_two_en[0]; ?><br>
                                                <?php echo $json->bottom_table_tb_three_en[0]; ?></p>
                                        </div>
                                    </div><br/>
                                    <div class="row">
                                        <div class="col-xs-2">
                                            <img class="img-responsive" src="<?php echo e(URL('images/bus__654365.png')); ?>" alt="" />
                                        </div>
                                        <div class="col-xs-10">
                                            <p><?php echo $json->bottom_table_tb_four_en[0]; ?></p>
                                        </div>
                                    </div>
                                <?php endif; ?>

                            </div>
                        </div>
                    </div><br/>
                    <div class="container-fluid text-left">
                        <div class="row" style="border-bottom: 1px solid blue">
                            <h4><b><?php echo app('translator')->getFromJson('blog.feedback'); ?></b></h4>
                        </div><br/>
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

                            <div class="form-group">
                                <label for=""><?php echo app('translator')->getFromJson('blog.full_name'); ?><span class="fio">*</span>:</label>
                                <input type="text" value="" name="fio" title="" placeholder="<?php echo app('translator')->getFromJson('blog.full_name_placeholder'); ?>" class="form-control" id="">
                            </div>
                            <div class="form-group">
                                <label for=""><?php echo app('translator')->getFromJson('blog.email'); ?> <span class="required">*</span>:</label>
                                <input type="email" value="" name="email" title="" placeholder="<?php echo app('translator')->getFromJson('blog.email_placeholder'); ?>" class="form-control" id="">
                            </div>
                            <div class="form-group">
                                <label for=""><?php echo app('translator')->getFromJson('blog.message_text'); ?><span class="required">*</span>:</label>
                                <textarea resize="no" name="comment" cols="25" rows="5" title="" placeholder="<?php echo app('translator')->getFromJson('blog.message_text_placeholder'); ?>" class="form-control textarea" id=""></textarea>
                            </div>
                            <!--<div class="form-group">
                                <label for="">Расмдаги кодни киритинг</label><br>
                                <img src="images/captcha.jpg" width="150" height="40" style="border: 1px solid #dcdcdc;" class="captcha-image" alt="CAPTCHA" id="">&nbsp;
                                <a href="#" class="" title="">Расмни ўзгартириш</a>
                                <input type="text" name="captcha_word" class="form-control" value="" maxlength="5">
                                <br>
                            </div>-->
                            <div class="form-group">
                                <input type="submit" class="btn btn-primary" value="<?php echo app('translator')->getFromJson('blog.form_btn_send'); ?>">
                            </div>
                            <div class="alert alert-warning">
                                <span class="required">*</span><?php echo app('translator')->getFromJson('blog.required_fields_note'); ?>
                            </div>

                        </form>
                    </div>

                <?php $__env->stopSection(); ?>

                <?php $__env->startSection('statistika'); ?>
                <?php $__env->stopSection(); ?>
            </div>
            <?php $__env->startSection('nav_page'); ?>
                <div class="col-md-3" style="padding-top: 50px;">
                    <div class="col menu-item-structure">

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

<?php echo $__env->make('layout.defualt', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\OpenServer\domains\gca\resources\views\contact.blade.php ENDPATH**/ ?>