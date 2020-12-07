<?php $__env->startSection("content"); ?>

    <div class="card-body" style="background-color: white">
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
            <form class="form" role="form" enctype="multipart/form-data" method="post" action="<?php echo e(route('pages_store')); ?>">
                <div class="card-body tab-content">
                    <div class="form-group floating-label">
                        <input type="file"  name="photos" class="form-control" accept="image/*">
                    </div>
                    <div class="form-group">
                        <select class="form-control"  id="select1" name="categories">
                            <?php $__currentLoopData = $page_categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key =>$categories): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($categories->category_group_id); ?>">
                                <?php echo e($categories->category_name); ?>

                            </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <label for="select1">Categories</label>
                    </div>
                    <?php $__currentLoopData = $languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key =>$language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($key == 0): ?>
                            <div class="tab-pane active" id="<?php echo e($language->id); ?>">
                                <div class="form" role="form">
                                    <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                                    <input type="hidden" name="language_id[]" value="<?php echo e($language->id); ?>">
                                    <div class="form-group floating-label">
                                        <input type="text" name="title[]" class="form-control" id="regular2">
                                        <label for="regular2">Title</label>
                                    </div>
                                    <div class="form-group floating-label">
                                        <input type="text" name="description[]" class="form-control" id="regular2">
                                        <label for="regular2">Description</label>
                                    </div>

                                    <div class="form-group floating-label">
                                        <textarea  name="content[]" class="form-control" id="regular2">
                                        </textarea>
                                    </div>

                                </div>
                            </div>
                        <?php else: ?>
                            <div class="tab-pane" id="<?php echo e($language->id); ?>">
                                <div class="form" role="form">
                                    <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                                    <input type="hidden" name="language_id[]" value="<?php echo e($language->id); ?>">
                                    <div class="form-group floating-label">
                                        <input type="text" name="title[]" class="form-control" id="regular2">
                                        <label for="regular2">Title</label>
                                    </div>
                                    <div class="form-group floating-label">
                                        <input type="text" name="description[]" class="form-control" id="regular2">
                                        <label for="regular2">Description</label>
                                    </div>
                                    <div class="form-group">
                                        <textarea  name="content[]" >
                                        </textarea>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    <div class="card-actionbar-row">
                        <button type="submit" class="btn btn-flat btn-primary ink-reaction">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div><!--end .table-responsive -->



<?php $__env->stopSection(); ?>

<?php echo $__env->make("admin.layout.template", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\OpenServer\domains\gca\resources\views\admin\pages_add.blade.php ENDPATH**/ ?>