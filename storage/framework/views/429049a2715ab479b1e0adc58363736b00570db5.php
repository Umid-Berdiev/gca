<?php $__env->startSection("content"); ?>

<div class="card-body" style="background-color: white">
  <div class="col-md-12">
    <div class="card-head">
      <ul class="nav nav-tabs" data-toggle="tabs">
        <?php $__currentLoopData = $languages;
        $__env->addLoop($__currentLoopData);
        foreach ($__currentLoopData as $key => $language) : $__env->incrementLoopIndices();
          $loop = $__env->getLastLoop(); ?>
          <?php if ($key == 0) : ?>
            <li class="active"><a href="#<?php echo e($language->id); ?>"><?php echo e($language->language_name); ?></a></li>
          <?php else : ?>
            <li><a href="#<?php echo e($language->id); ?>"><?php echo e($language->language_name); ?></a></li>
          <?php endif; ?>

        <?php endforeach;
        $__env->popLoop();
        $loop = $__env->getLastLoop(); ?>
      </ul>
    </div>
    <form class="form" role="form" enctype="multipart/form-data" method="post" action="<?php echo e(URL("/admin/event/edit")); ?>">
      <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
      <input type="hidden" name="group" value="<?php echo e($grp_id); ?>">
      <div class="card-body tab-content">
        <?php $__currentLoopData = $languages;
        $__env->addLoop($__currentLoopData);
        foreach ($__currentLoopData as $key => $language) : $__env->incrementLoopIndices();
          $loop = $__env->getLastLoop(); ?>
          <?php if ($key == 0) : ?>

            <?php $__currentLoopData = $model;
            $__env->addLoop($__currentLoopData);
            foreach ($__currentLoopData as $val) : $__env->incrementLoopIndices();
              $loop = $__env->getLastLoop(); ?>

              <?php if ($val->language_id == $language->id) : ?>
                <div class="tab-pane active" id="<?php echo e($language->id); ?>">
                  <div class="form" role="form">

                    <input type="hidden" name="language_ids[]" value="<?php echo e($language->id); ?>">

                    <div class="form-group floating-label">
                      <select class="form-control" name="event_category_id">
                        <?php $__currentLoopData = $category;
                        $__env->addLoop($__currentLoopData);
                        foreach ($__currentLoopData as $value) : $__env->incrementLoopIndices();
                          $loop = $__env->getLastLoop(); ?>
                          <?php if ($val->event_category_id == $value->group) : ?>
                            <option value="<?php echo e($value->group); ?>" selected><?php echo e($value->category_name); ?></option>
                          <?php else : ?>
                            <option value="<?php echo e($value->group); ?>"><?php echo e($value->category_name); ?></option>
                          <?php endif; ?>
                        <?php endforeach;
                        $__env->popLoop();
                        $loop = $__env->getLastLoop(); ?>
                      </select>
                      <label for="post_category_id">Event category</label>
                    </div>
                    <div class="form-group floating-label">
                      <input type="text" name="titles[]" class="form-control" value="<?php echo e($val->title); ?>" id="regular2">
                      <label for="regular2">title</label>
                    </div>
                    <div class="form-group floating-label">
                      <input type="text" name="description[]" class="form-control" value="<?php echo e($val->description); ?>" id="regular2">
                      <label for="regular2">description</label>
                    </div>
                    <div class="form-group floating-label">
                      <textarea name="content[]" class="form-control" id="regular2"><?php echo e($val->content); ?></textarea>
                    </div>

                    <div class="form-group floating-label">
                      <input type="date" name="datestart" class="form-control" value="<?php echo e($val->datestart); ?>" id="regular2">
                      <label for="regular2">datestart</label>
                    </div>


                    <div class="form-group floating-label">
                      <input type="date" name="dateend" class="form-control" value="<?php echo e($val->dateend); ?>" id="regular2">
                      <label for="regular2">dateend</label>
                    </div>

                    <div class="form-group floating-label">
                      <input type="file" name="cover" class="form-control" id="regular2">
                      <label for="regular2">cover</label>
                    </div>


                    <div class="form-group floating-label">
                      <input type="text" name="organization[]" class="form-control" value="<?php echo e($val->organization); ?>" id="regular2">
                      <label for="regular2">organization</label>
                    </div>



                  </div>
                </div>
              <?php endif; ?>
            <?php endforeach;
            $__env->popLoop();
            $loop = $__env->getLastLoop(); ?>
          <?php else : ?>
            <?php $__currentLoopData = $model;
            $__env->addLoop($__currentLoopData);
            foreach ($__currentLoopData as $val) : $__env->incrementLoopIndices();
              $loop = $__env->getLastLoop(); ?>

              <?php if ($val->language_id == $language->id) : ?>
                <div class="tab-pane" id="<?php echo e($language->id); ?>">
                  <div class="form" role="form">

                    <input type="hidden" name="language_ids[]" value="<?php echo e($language->id); ?>">
                    <div class="form-group floating-label">
                      <input type="text" name="titles[]" class="form-control" value="<?php echo e($val->title); ?>" id="regular2">
                      <label for="regular2">title</label>
                    </div>
                    <div class="form-group floating-label">
                      <input type="text" name="description[]" class="form-control" value="<?php echo e($val->description); ?>" id="regular2">
                      <label for="regular2">description</label>
                    </div>
                    <div class="form-group floating-label">
                      <textarea name="content[]" class="form-control" id="regular2"><?php echo e($val->content); ?></textarea>
                      <label for="regular2">content</label>
                    </div>




                    <div class="form-group floating-label">
                      <input type="text" name="organization[]" class="form-control" value="<?php echo e($val->organization); ?>" id="regular2">
                      <label for="regular2">organization</label>
                    </div>
                  </div>
                </div>
              <?php endif; ?>
            <?php endforeach;
            $__env->popLoop();
            $loop = $__env->getLastLoop(); ?>
          <?php endif; ?>
        <?php endforeach;
        $__env->popLoop();
        $loop = $__env->getLastLoop(); ?>
        <div class="card-actionbar-row">
          <button type="submit" class="btn btn-flat btn-primary ink-reaction">Save</button>
        </div>
      </div>
    </form>
  </div>
</div>
<!--end .table-responsive -->



<?php $__env->stopSection(); ?>

<?php echo $__env->make("admin.layout.template", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\OpenServer\domains\gca\resources\views\admin\event_edit.blade.php ENDPATH**/ ?>