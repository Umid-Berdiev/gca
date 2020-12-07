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
            <form class="form" role="form" enctype="multipart/form-data" method="post" action="<?php echo e(URL('/admin/users/update')); ?>">
                <div class="card-body tab-content">
                    <div class="form-group">
                        <select class="form-control"  id="select1" name="categories">
                            <?php if($user->status == 1): ?>
                            <option value="1" selected>Administrator</option>
                                <option value="2" >Author</option>
                            <?php elseif($user->status == 2): ?>
                                <option value="1" >Administrator</option>
                            <option value="2" selected>Author</option>
                                <?php endif; ?>

                        </select>
                        <label for="select1">Role</label>
                    </div>

                    <div class="tab-pane active" id="">
                        <div class="form" role="form">
                            <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                            <input type="hidden" name="id" value="<?php echo e($user->id); ?>">
                            <div class="form-group floating-label">
                                <input type="text" name="name" value="<?php echo e($user->name); ?>" class="form-control" id="regular2">
                                <label for="regular2">Name</label>
                            </div>
                            <div class="form-group floating-label">
                                <input type="password" name="password"  class="form-control" id="regular2">
                                <label for="regular2">new password</label>
                            </div>
                            <div class="form-group floating-label">
                                <input type="password" name="confirm_password"  class="form-control" id="regular2">
                                <label for="regular2">confirm password</label>
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

<?php echo $__env->make("admin.layout.template", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\OpenServer\domains\gca\resources\views\admin\users_edit.blade.php ENDPATH**/ ?>