<?php $__env->startSection("content"); ?>

    <div class="col-md-12" style="background-color: white;padding: 25px;">
        <div class="col-md-12">
            <table class="table table-condensed no-margin">
                <thead>
                <tr>
                    <td width="80px">№</td>
                    <td width="80px">name</td>
                    <td width="80px">prefix</td>
                    <td width="80px">title</td>
                    <td width="80px">phone</td>
                    <td width="80px">address</td>
                    <td width="80px">wep</td>
                    <td width="80px"></td>
                </tr>
                </thead>
                <tbody>
                <?php $__currentLoopData = $gcainfos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($key+1); ?></td>
                        <td><?php echo e($item->name); ?></td>
                        <td><?php echo e($item->prefix); ?></td>
                        <td><?php echo e($item->title); ?></td>
                        <td><?php echo e($item->phone); ?></td>
                        <td><?php echo e($item->address); ?></td>
                        <td><?php echo e($item->wep); ?></td>
                        <td>
                            <span><a href="<?php echo e(route('gca.info.edit',$item->id)); ?>"><i class="fa fa-edit"></i></a></span>


                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make("admin.layout.template", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\OpenServer\domains\gca\resources\views/admin/gcainfo.blade.php ENDPATH**/ ?>