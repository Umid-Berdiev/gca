<?php $__env->startSection("content"); ?>

    <div class="card-body" style="background-color: white">
        <div class="col-md-12">
            <?php if($errors->any()): ?>
                <div class="alert alert-danger">
                    <ul>
                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><?php echo e($error); ?></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            <?php endif; ?>
            <form class="form" role="form" enctype="multipart/form-data" method="post" action="<?php echo e(URL('/admin/users/profile_update')); ?>">
                <div class="card-body tab-content">
                    <div class="tab-pane active" id="">
                        <div class="form" role="form">
                            <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                            <div class="form-group floating-label">
                                <input type="text" name="name" value="<?php echo e($user->name); ?>" class="form-control" id="regular2">
                                <label for="regular2">Name</label>
                            </div>
                            <div class="form-group floating-label">
                                <input type="password" name="old_password" class="form-control" id="regular2">
                                <label for="regular2">old password</label>
                            </div>
                            <div class="form-group floating-label">
                                <input type="password" name="new_password" class="form-control" id="regular2">
                                <label for="regular2">new password</label>
                            </div>
                            <div class="form-group floating-label">
                                <input type="password" name="confirm_password" class="form-control" id="regular2">
                                <label for="regular2">confirm new password</label>
                            </div>


                        </div>
                    </div>


                    <div class="card-actionbar-row">
                        <button type="submit" class="btn btn-flat btn-primary ink-reaction">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div><!--end .table-responsive -->



<?php $__env->stopSection(); ?>

<?php echo $__env->make("admin.layout.template", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\OpenServer\domains\gca\resources\views\admin\profile.blade.php ENDPATH**/ ?>