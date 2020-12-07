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

            <form class="form" role="form" enctype="multipart/form-data" method="post" action="<?php echo e(URL("/admin/murojat_update")); ?>">
                <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                <input type="hidden" name="id" value="<?php echo e($object->id); ?>">
                <div class="card-body tab-content">
                    <div class="form-group floating-label">
                        <input type="text" name="unique_number" disabled class="form-control" value="<?php echo e($object->unique_number); ?>" id="regular2">
                        <label for="regular2">unique_number</label>
                    </div>
                    <div class="form-group floating-label">
                        <input type="text" disabled class="form-control" value="<?php echo e($object->fio); ?>" id="regular2">
                        <label for="regular2">fio</label>
                    </div>
                    <div class="form-group floating-label">
                        <input type="text" disabled class="form-control" value="<?php echo e($object->email); ?>" id="regular2">
                        <label for="regular2">email</label>
                    </div>
                    <div class="form-group floating-label">
                        <input type="text"  disabled class="form-control" value="<?php echo e($object->phone_number); ?>" id="regular2">
                        <label for="regular2">phone_number</label>
                    </div>
                    <div class="form-group floating-label">
                        <input type="text"  disabled class="form-control" value="<?php echo e($object->passport); ?>" id="regular2">
                        <label for="regular2">Passport</label>
                    </div>
                    <div class="form-group floating-label">
                        <input type="text"  disabled class="form-control" value="<?php echo e($object->adress); ?>" id="regular2">
                        <label for="regular2">adress</label>
                    </div>
                    <div class="form-group floating-label">
                        <input type="text"  disabled class="form-control" value="<?php echo e($object->index); ?>" id="regular2">
                        <label for="regular2">index</label>
                    </div>
                    <div class="form-group floating-label">
                        <input type="text" disabled class="form-control" value="<?php echo e($object->object_type); ?>" id="regular2">
                        <label for="regular2">object_type</label>
                    </div>
                    <div class="form-group floating-label">
                        <input type="text"  disabled class="form-control" value="<?php echo e($object->birth); ?>" id="regular2">
                        <label for="regular2">birth</label>
                    </div>


                    <div class="form-group">
                        <select class="form-control"   id="select1" name="status">
                            <?php for($i=0;$i < 4;$i++): ?>
                                <?php switch($i):
                                    case (0): ?>
                                    <?php if($object->status == $i): ?>
                                        <option value="<?php echo e($i); ?>" selected>
                                            Янги мурожаат
                                        </option>
                                    <?php else: ?>
                                        <option value="<?php echo e($i); ?>">
                                            Янги мурожаат
                                        </option>
                                    <?php endif; ?>

                                    <?php break; ?>
                                    <?php case (1): ?>
                                    <?php if($object->status == $i): ?>
                                        <option value="<?php echo e($i); ?>" selected>
                                            Қайта ишланмоқда
                                        </option>
                                    <?php else: ?>
                                        <option value="<?php echo e($i); ?>">
                                            Қайта ишланмоқда
                                        </option>
                                    <?php endif; ?>
                                    <?php break; ?>
                                    <?php case (2): ?>
                                    <?php if($object->status == $i): ?>
                                        <option value="<?php echo e($i); ?>" selected>
                                            Кўриб чиқилмоқда
                                        </option>
                                    <?php else: ?>
                                        <option value="<?php echo e($i); ?>">
                                            Кўриб чиқилмоқда
                                        </option>
                                    <?php endif; ?>
                                    <?php break; ?>
                                    <?php case (3): ?>
                                    <?php if($object->status == $i): ?>
                                        <option value="<?php echo e($i); ?>" selected>
                                            Жавоб жўнатилди
                                        </option>
                                    <?php else: ?>
                                        <option value="<?php echo e($i); ?>">
                                            Жавоб жўнатилди
                                        </option>
                                    <?php endif; ?>
                                    <?php break; ?>
                                <?php endswitch; ?>
                            <?php endfor; ?>
                        </select>
                        <label for="select1">Categories</label>
                    </div>


                    <div class="form-group floating-label">
                        <textarea  name="comment" disabled class="form-control"  id="regular2"><?php echo e($object->comment); ?></textarea>
                    </div>





                    <div class="card-actionbar-row">
                        <button type="submit" class="btn btn-flat btn-primary ink-reaction">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div><!--end .table-responsive -->



<?php $__env->stopSection(); ?>

<?php echo $__env->make("admin.layout.template", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\OpenServer\domains\gca\resources\views\admin\murojat_edit.blade.php ENDPATH**/ ?>