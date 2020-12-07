<?php $__env->startSection("content"); ?>

    <div class="col-md-12" style="background-color: white;padding: 25px;">
        <div class="col-md-12">
            <p><button type="button" class="btn ink-reaction btn-floating-action btn-lg btn-primary" onclick="window.location.href='<?php echo e(URL("/admin/language/create")); ?>'"><i class="fa fa-plus"></i></button></p>
            <div class="col-md-2">


         </div>
        <div class="col-md-12">
            <table class="table">
                <thead>
                <tr>
                    <td width="80px">№</td>
                    <td width="180px">Language name</td>
                    <td width="180px">Language prefix</td>

                    <td width="80px"> </td>
                </tr>
                </thead>
                <tbody>
                <?php for($i=0;$i<count($table);$i++): ?>
                    <tr>
                        <td><?php echo e($i+1); ?></td>
                        <td><?php echo e($table[$i]->language_name); ?></td>
                        <td><?php echo e($table[$i]->language_prefix); ?></td>

                        <td>
                            <span><a href="<?php echo e(URL("/admin/language/edit?id=".$table[$i]->id)); ?>"><i class="fa fa-edit"></i></a></span>
                            <span><a href="<?php echo e(URL("/admin/language/delete?id=".$table[$i]->id)); ?>" onclick="return confirm('Are you sure you want to delete this thing into the database?')"><i class="fa fa-remove"></i></a></span>

                        </td>
                    </tr>
                <?php endfor; ?>

                </tbody>
            </table>

            <?php echo e($table->links()); ?>

        </div>
    </div>

<?php $__env->stopSection(); ?>


<?php echo $__env->make("admin.layout.template", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\OpenServer\domains\gca\resources\views/admin/lang.blade.php ENDPATH**/ ?>