<?php $__env->startSection("content"); ?>

    <div class="card-body" style="background-color: white">
        <div class="col-md-12">

            <form class="form" role="form" enctype="multipart/form-data" method="post"
                  action="<?php echo e(route('gca.info.update')); ?>">

                <div class="form" role="form">
                    <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                    <input type="hidden" name="id" value="<?php echo e($gca->id); ?>">

                    <div class="form-group floating-label">
                        <input type="text" name="name" value="<?php echo e($gca->name); ?>"
                               class="form-control" id="regular2">
                        <label for="regular2">name</label>
                    </div>
                    <div class="form-group floating-label">
                        <input type="text" name="prefix" value="<?php echo e($gca->prefix); ?>"
                               class="form-control" id="regular2">
                        <label for="regular2">prefix</label>
                    </div>
                    <div class="form-group floating-label">
                        <input type="text" name="title" value="<?php echo e($gca->title); ?>"
                               class="form-control" id="regular2">
                        <label for="regular2">title</label>
                    </div>
                    <div class="form-group floating-label">
                        <input type="text" name="phone" value="<?php echo e($gca->phone); ?>"
                               class="form-control" id="regular2">
                        <label for="regular2">phone</label>
                    </div>
                    <div class="form-group floating-label">
                        <input type="text" name="address" value="<?php echo e($gca->address); ?>"
                               class="form-control" id="regular2">
                        <label for="regular2">address</label>
                    </div>
                    <div class="form-group floating-label">
                        <input type="text" name="wep" value="<?php echo e($gca->wep); ?>"
                               class="form-control" id="regular2">
                        <label for="regular2">wep</label>
                    </div>
                    <div class="form-group floating-label">
                        <input type="text" name="email" value="<?php echo e($gca->email); ?>"
                               class="form-control" id="regular2">
                        <label for="regular2">email</label>
                    </div>

                </div>
                <div class="card-actionbar-row">
                    <button type="submit" class="btn btn-flat btn-primary ink-reaction">Update</button>
                </div>
            </form>


        </div>
    </div><!--end .table-responsive -->



<?php $__env->stopSection(); ?>

<?php echo $__env->make("admin.layout.template", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\OpenServer\domains\gca\resources\views\admin\gcainfo_edit.blade.php ENDPATH**/ ?>