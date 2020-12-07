<?php $__env->startSection("content"); ?>

    <div class="col-md-12" style="background-color: white;padding: 25px;">
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
            <div class="form-group">
                <form action="<?php echo e(URL('/admin/murojat/search')); ?>" method="get">
                    <div class="input-group">
                        <div class="input-group-content">
                            <input type="text" class="form-control" name="search" placeholder="SEARCH" id="groupbutton9">
                            <label for="groupbutton9"></label>
                        </div>
                        <div class="input-group-btn">
                            <button class="btn btn-default" type="submit">Go!</button>
                        </div>

                    </div>
                </form>
            </div>
            <table class="table table-condensed no-margin">
                <thead>
                <tr>
                    <td width="80px">№</td>
                    <td width="80px">fio</td>
                    <td width="80px">email</td>
                    <td width="80px">Obeject Type</td>
                    <td width="80px">adress</td>
                    <td width="80px"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></td>
                </tr>
                </thead>
                <tbody>
                <?php $__currentLoopData = $objects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $object): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td width="80px"><?php echo e($key+1); ?></td>
                        <td width="80px"><?php echo e($object->fio); ?></td>
                        <td width="80px"><?php echo e($object->email); ?></td>
                        <td width="80px"><?php echo e($object->object_type); ?></td>
                        <td width="80px"><?php echo e($object->adress); ?></td>
                        <td width="80px"><a href="<?php echo e(URL('/admin/murojat/'.$object->id)); ?>"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a></td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
            <?php echo e($objects->links()); ?>

        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make("admin.layout.template", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\OpenServer\domains\gca\resources\views\admin\murojat.blade.php ENDPATH**/ ?>