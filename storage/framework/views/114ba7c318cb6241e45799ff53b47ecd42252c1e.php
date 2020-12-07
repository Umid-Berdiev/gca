<?php $__env->startSection("content"); ?>

    <div class="col-md-12" style="background-color: white;padding: 25px;">
        <div class="col-md-12">
            <p><button type="button" class="btn ink-reaction btn-floating-action btn-lg btn-primary" onclick="window.location.href='<?php echo e(URL("/admin/users/create")); ?>'"><i class="fa fa-plus"></i></button></p>
            <div class="col-md-2">


            </div>
            <div class="col-md-12">
                <table class="table">
                    <thead>
                    <tr>
                        <td width="80px">№</td>
                        <td width="180px">Name</td>
                        <td width="180px">Login</td>
                        <td width="180px">Role</td>
                        <td width="80px"> </td>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                        <tr>
                            <td width="80px"><?php echo e($key+1); ?></td>
                            <td width="180px"><?php echo e($user->name); ?></td>
                            <td width="180px"><?php echo e($user->email); ?></td>
                            <?php switch($user->status):
                                case (1): ?>
                            <td width="180px">Administrator</td>
                            <?php break; ?>
                            <?php case (2): ?>
                            <td width="180px">Author</td>
                            <?php break; ?>
                            <?php endswitch; ?>
                            <td>
                                <span><a href="<?php echo e(URL('/admin/users/show?id='.$user->id)); ?>"><i class="fa fa-edit"></i></a></span>
                                <span onclick="return confirm('Are you sure you want to delete this thing into the database?')"><a href="<?php echo e(URL('/admin/users/delete?id='.$user->id)); ?>"><i class="fa fa-remove"></i></a></span>

                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


                    </tbody>
                </table>
                <?php echo e($users->links()); ?>



            </div>
        </div>

<?php $__env->stopSection(); ?>


<?php echo $__env->make("admin.layout.template", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\OpenServer\domains\gca\resources\views/admin/users.blade.php ENDPATH**/ ?>