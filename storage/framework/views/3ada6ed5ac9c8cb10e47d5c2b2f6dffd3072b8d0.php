<?php $__env->startSection("content"); ?>

    <div class="col-md-12" style="background-color: white;padding: 25px;">
        <div class="col-md-12">
            <div class="form-group">
                <p><button type="button" class="btn ink-reaction btn-floating-action btn-lg btn-primary" onclick="window.location.href='<?php echo e(URL("/admin/tender/create")); ?>'"><i class="fa fa-plus"></i></button></p>
                <form action="<?php echo e(URL('admin/tender')); ?>" method="get">
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
                    <td width="80px">title</td>
                    <td width="80px">deadline</td>
                    <td width="80px">Held</td>
                    <td width="80px">category_name</td>

                    <td width="80px"></td>
                </tr>
                </thead>
                <tbody>
                <?php $__currentLoopData = $table; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $page): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($key+1); ?></td>

                        <td><?php echo e($page->title); ?></td>
                        <td><?php echo e($page->deadline); ?></td>
                        <td><?php echo e($page->received); ?></td>
                        <td><?php echo e($page->category_name); ?></td>
                        <td>
                            <span><a href="<?php echo e(URL('/admin/tender/edit?id='.$page->group)); ?>"><i class="fa fa-edit"></i></a></span>
                            <span><a onclick="return confirm('Are you sure you want to delete this thing into the database?')" href="<?php echo e(URL('/admin/tender/delete?id='.$page->group)); ?>"><i class="fa fa-remove"></i></a></span>

                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
            <?php echo e($table->links()); ?>

        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make("admin.layout.template", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\OpenServer\domains\gca\resources\views\admin\tender.blade.php ENDPATH**/ ?>