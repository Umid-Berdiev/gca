<?php $__env->startSection("content"); ?>

    <div class="card-body" style="background-color: white">

        <?php if($errors->any()): ?>
            <div class="alert alert-danger">
                <ul>
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($error); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        <?php endif; ?>
        <div class="col-md-12">
            <div class="card-head">
                <ul class="nav nav-tabs" data-toggle="tabs">
                    <?php $__currentLoopData = $languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key =>$language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($key == 0): ?>
                            <li class="active"><a href="#<?php echo e($language->id); ?>"><?php echo e($language->language_name); ?></a></li>
                        <?php else: ?>
                            <li><a href="#<?php echo e($language->id); ?>"><?php echo e($language->language_name); ?></a></li>
                        <?php endif; ?>

                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
            <form class="form" role="form" enctype="multipart/form-data" method="post" action="<?php echo e(URL("/admin/raxbariyat/store")); ?>">
                <div class="card-body tab-content">
                    <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                    <?php $__currentLoopData = $languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key =>$language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($key == 0): ?>
                            <div class="tab-pane active" id="<?php echo e($language->id); ?>">
                                <div class="form" role="form">
                                    <input type="hidden" name="language_id[]" value="<?php echo e($language->id); ?>">
                                    <div class="form-group floating-label">
                                        <input type="text" name="fio[]" class="form-control" id="regular2">
                                        <label for="regular2">fio</label>
                                    </div>
                                    <div class="form-group floating-label">
                                        <input type="text" name="major[]" class="form-control" id="regular2">
                                        <label for="regular2">major</label>
                                    </div>

                                    <div class="form-group floating-label">
                                        <input type="text" name="qabul[]" class="form-control" id="regular2">
                                        <label for="regular2">qabul</label>
                                    </div>
                                    <h4>Short</h4>
                                    <div class="form-group floating-label">
                                        <textarea  name="short[]" class="form-control" id="regular2"></textarea>
                                    </div>
                                    <h4>Vazifalar</h4>
                                    <div class="form-group floating-label">
                                        <textarea  name="vazifa[]" class="form-control" id="regular2"></textarea>
                                    </div>


                                </div>
                            </div>
                        <?php else: ?>
                            <div class="tab-pane" id="<?php echo e($language->id); ?>">
                                <div class="form" role="form">
                                    <input type="hidden" name="language_id[]" value="<?php echo e($language->id); ?>">
                                    <div class="form-group floating-label">
                                        <input type="text" name="fio[]" class="form-control" id="regular2">
                                        <label for="regular2">fio</label>
                                    </div>
                                    <div class="form-group floating-label">
                                        <input type="text" name="major[]" class="form-control" id="regular2">
                                        <label for="regular2">major</label>
                                    </div>

                                    <div class="form-group floating-label">
                                        <input type="text" name="qabul[]" class="form-control" id="regular2">
                                        <label for="regular2">qabul</label>
                                    </div>
                                    <h4>Short</h4>
                                    <div class="form-group floating-label">
                                        <textarea  name="short[]" class="form-control" id="regular2"></textarea>
                                    </div>
                                    <h4>Vazifalar</h4>
                                    <div class="form-group floating-label">
                                        <textarea  name="vazifa[]" class="form-control" id="regular2"></textarea>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <div class="form-group floating-label">
                            <input type="text" name="tel" class="form-control" id="regular2">
                            <label for="regular2">tel</label>
                        </div>
                        <div class="form-group floating-label">
                            <input type="text" name="faks" class="form-control" id="regular2">
                            <label for="regular2">faks</label>
                        </div>
                        <div class="form-group floating-label">
                            <input type="email" name="email" class="form-control" id="regular2">
                            <label for="regular2">email</label>
                        </div>

                        <div class="form-group floating-label">
                            <input type="file" name="cover" class="form-control" id="regular2">
                            <label for="regular2">cover</label>
                        </div>
                    <div class="card-actionbar-row">
                        <button type="submit" class="btn btn-flat btn-primary ink-reaction">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div><!--end .table-responsive -->



<?php $__env->stopSection(); ?>

<?php echo $__env->make("admin.layout.template", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\OpenServer\domains\gca\resources\views\admin\raxbariyat_add.blade.php ENDPATH**/ ?>