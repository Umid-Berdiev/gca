<?php $__env->startSection("content"); ?>


    <div class="card-body" style="background-color: white">
        <div class="table-responsive">
            <div class="card">

                <div class="card-body tab-content">






                                <form class="form-horizontal" role="form" method="post" action="<?php echo e(URL("admin/language/edit")); ?>">

                                    <input type="hidden" value="<?php echo e(csrf_token()); ?>" name="_token">
                                    <input type="hidden" value="<?php echo e($model->id); ?>" name="id">

                                    <div class="form-group">
                                        <label for="regular13" class="col-sm-2 control-label"><?php echo app('translator')->getFromJson("laguage.language_name"); ?></label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="language_name" value="<?php echo e($model->language_name); ?>" id="regular13"><div class="form-control-line"></div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="regular13" class="col-sm-2 control-label"><?php echo app('translator')->getFromJson("laguage.language_prefix"); ?></label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="language_prefix"  value="<?php echo e($model->language_prefix); ?>" id="regular13"><div class="form-control-line"></div>
                                        </div>
                                    </div>





                                    <div class="form-group">
                                        <button type="submit" class="btn btn-danger"><?php echo app('translator')->getFromJson('language.save'); ?></button>
                                    </div>

                                </form>


                </div>

            </div><!--end .card-body -->
        </div>
    </div><!--end .table-responsive -->



<?php $__env->stopSection(); ?>

<?php echo $__env->make("admin.layout.template", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\OpenServer\domains\gca\resources\views/admin/langedit.blade.php ENDPATH**/ ?>