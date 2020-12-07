<?php $__env->startSection("content"); ?>

    <div class="col-md-12" style="background-color: white;padding: 25px;">
        <div class="col-md-12">
            <div class="form-group">
                <p><button type="button" class="btn ink-reaction btn-floating-action btn-lg btn-primary" onclick="window.location.href='<?php echo e(URL("/admin/statistica/create")); ?>'"><i class="fa fa-plus"></i></button></p>
            </div>
            <table class="table table-condensed no-margin">
                <thead>
                <tr>
                    <td width="80px">№</td>
                    <td width="80px">name</td>
                    <td width="80px">photo_url</td>
                    <td width="80px"></td>
                </tr>
                </thead>
                <tbody>
                <?php $__currentLoopData = $statistica; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $stat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($key+1); ?></td>

                        <td><?php echo e($stat->name); ?></td>
                        <td><img class="img-responsive" width="100" src="<?php echo e(URL(App::getLocale().'/downloads?type=statistica&id='.$stat->id)); ?>"></td>
                        <td>
                            <span><a onclick="return confirm('Are you sure you want to delete this thing into the database?')" href="<?php echo e(URL('/admin/statistica/destroy?id='.$stat->group)); ?>"><i class="fa fa-remove"></i></a></span>

                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
            <?php echo e($statistica->links()); ?>

        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make("admin.layout.template", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\OpenServer\domains\gca\resources\views/admin/statistica.blade.php ENDPATH**/ ?>