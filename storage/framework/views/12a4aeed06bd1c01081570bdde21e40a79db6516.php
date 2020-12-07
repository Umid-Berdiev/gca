<?php $__env->startSection("content"); ?>

    <div class="col-md-12" style="background-color: white;padding: 25px;">
        <div class="col-md-12">
            <div class="form-group">
                 <form action="<?php echo e(URL('admin/menu/edits')); ?>" method="get">
                    <div class="input-group">
                        <div class="form-group floating-label">

                            <select class="form-control" name="id">

                                <option value="null">---</option>
                                <?php $__currentLoopData = $menues; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $keyone=>$value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php $modelsx = DB::table("menumakers")
                                        ->where("language_id","=",\App\Http\Controllers\NewsController::getlangid())
                                        ->where("parent_id","=",$value->group)
                                        ->orderBy("orders")->get(); ?>
                                    <?php if(count($modelsx) >0): ?>

                                        <option value="<?php echo e($value->group); ?>"><?php echo e($keyone+1); ?>)<?php echo e($value->menu_name); ?></option>

                                        <ul>
                                            <?php $__currentLoopData = $modelsx; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $keytwo=>$valuex): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php $modelsxs = DB::table("menumakers")
                                                    ->where("language_id","=",\App\Http\Controllers\NewsController::getlangid())
                                                    ->where("parent_id","=",$valuex->group)
                                                    ->orderBy("orders")->get(); ?>
                                                <?php if(count($modelsxs) >0): ?>

                                                    <option value="<?php echo e($valuex->group); ?>"><?php echo e(($keyone+1).".".($keytwo+1)); ?>)  <?php echo e($valuex->menu_name); ?></option>

                                                    <?php $__currentLoopData = $modelsxs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $keythree=>$valuexx): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($valuexx->group); ?>"><?php echo e(($keyone+1).".".($keytwo+1).".".($keythree+1)); ?>)   <?php echo e($valuexx->menu_name); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                                <?php else: ?>
                                                    <option value="<?php echo e($valuex->group); ?>"><?php echo e(($keyone+1).".".($keytwo+1)); ?>)  <?php echo e($valuex->menu_name); ?></option>
                                                <?php endif; ?>

                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>



                                            <?php else: ?>
                                                <option value="<?php echo e($value->group); ?>"><?php echo e($keyone+1); ?>)<?php echo e($value->menu_name); ?></option>
                                    <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


                            </select>
                            <label for="regular2">type</label>
                        </div>
                        <div class="input-group-btn">
                            <button class="btn btn-default" type="submit">EDIT</button>
                        </div>

                    </div>
                </form>
            </div>

            <div class="row">
                <table class="table">
                    <thead>
                    <tr>
                    <td>№</td>
                    <td>Названия</td>
                    <td>Позитьсия</td>
                    </tr>
                    </thead>

                    <?php $__currentLoopData = $menues; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $keyone=>$value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php $modelsx = DB::table("menumakers")
                            ->where("language_id","=",\App\Http\Controllers\NewsController::getlangid())
                            ->where("parent_id","=",$value->group)
                            ->orderBy("orders")->get(); ?>
                            <?php if(count($modelsx) >0): ?>

                                <tr>
                                    <td><?php echo e($keyone+1); ?></td>
                                    <td><?php echo e($value->menu_name); ?> | <?php echo e($value->orders); ?></td>
                                    <td>
                                        <span><a href="<?php echo e(URL( "/admin/menuchange?id=".$value->group."&p=up")); ?>"> <i class="fa fa-arrow-circle-o-up btn btn-primary"></i></a></span>
                                        <span><a href="<?php echo e(URL( "/admin/menuchange?id=".$value->group."&p=down")); ?>"> <i class="fa fa-arrow-circle-o-down btn btn-warning"></i></a></span>
                                        <span><a onclick="return confirm('Are you sure you want to delete this thing into the database?')" href="<?php echo e(URL( "/admin/menudelete?id=".$value->group)); ?>"> <i class="fa fa-recycle btn btn-danger"></i></a></span>
                                    </td>
                                </tr>

                                <?php $__currentLoopData = $modelsx; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $keytwo=>$valuex): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php $modelsxs = DB::table("menumakers")
                                        ->where("language_id","=",\App\Http\Controllers\NewsController::getlangid())
                                        ->where("parent_id","=",$valuex->group)
                                        ->orderBy("orders")->get(); ?>
                                    <?php if(count($modelsxs) >0): ?>

                                            <tr>
                                                <td><?php echo e($keytwo+1); ?></td>
                                                <td style="padding-left: 25px;"><span style="background-color: #e1fcff">-<?php echo e($valuex->menu_name); ?> | <?php echo e($valuex->orders); ?></span></td>
                                                <td>
                                                    <span><a href="<?php echo e(URL( "/admin/menuchange?id=".$valuex->group."&p=up")); ?>"> <i class="fa fa-arrow-circle-o-up btn btn-primary"></i></a></span>
                                                    <span><a href="<?php echo e(URL( "/admin/menuchange?id=".$valuex->group."&p=down")); ?>"> <i class="fa fa-arrow-circle-o-down btn btn-warning"></i></a></span>
                                                    <span><a onclick="return confirm('Are you sure you want to delete this thing into the database?')" href="<?php echo e(URL( "/admin/menudelete?id=".$valuex->group)); ?>"> <i class="fa fa-recycle btn btn-danger"></i></a></span>

                                                </td>
                                            </tr>

                                            <?php $__currentLoopData = $modelsxs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $keythree=>$valuexx): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td><?php echo e($keythree+1); ?></td>
                                                    <td style="padding-left: 50px;"><span style="background-color: #daf9d1">--<?php echo e($valuexx->menu_name); ?> | <?php echo e($valuexx->orders); ?></span></td>
                                                    <td>
                                                        <span><a href="<?php echo e(URL("/admin/menuchange?id=".$valuexx->group."&p=up")); ?>"> <i class="fa fa-arrow-circle-o-up btn btn-primary"></i></a></span>
                                                        <span><a href="<?php echo e(URL("/admin/menuchange?id=".$valuexx->group."&p=down")); ?>"> <i class="fa fa-arrow-circle-o-down btn btn-warning"></i></a></span>
                                                        <span><a onclick="return confirm('Are you sure you want to delete this thing into the database?')" href="<?php echo e(URL( "/admin/menudelete?id=".$valuexx->group)); ?>"> <i class="fa fa-recycle btn btn-danger"></i></a></span>

                                                    </td>
                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                        <?php else: ?>
                                            <tr>
                                                <td><?php echo e($keytwo+1); ?></td>
                                                <td style="padding-left: 25px;"><span style="background-color: #e1fcff">-<?php echo e($valuex->menu_name); ?> | <?php echo e($valuex->orders); ?></span></td>
                                                <td>
                                                    <span><a href="<?php echo e(URL("/admin/menuchange?id=".$valuex->group."&p=up")); ?>"> <i class="fa fa-arrow-circle-o-up btn btn-primary"></i></a></span>
                                                    <span><a href="<?php echo e(URL("/admin/menuchange?id=".$valuex->group."&p=down")); ?>"> <i class="fa fa-arrow-circle-o-down btn btn-warning"></i></a></span>
                                                    <span><a onclick="return confirm('Are you sure you want to delete this thing into the database?')" href="<?php echo e(URL( "/admin/menudelete?id=".$valuex->group)); ?>"> <i class="fa fa-recycle btn btn-danger"></i></a></span>

                                                </td>
                                            </tr>
                                        <?php endif; ?>

                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            <?php else: ?>

                                <tr>
                                    <td><?php echo e($keyone+1); ?></td>
                                    <td><?php echo e($value->menu_name); ?> | <?php echo e($value->orders); ?></td>
                                    <td>
                                        <span><a href="<?php echo e(URL("/admin/menuchange?id=".$value->group."&p=up")); ?>"> <i class="fa fa-arrow-circle-o-up btn btn-primary"></i></a></span>
                                        <span><a href="<?php echo e(URL("/admin/menuchange?id=".$value->group."&p=down")); ?>"> <i class="fa fa-arrow-circle-o-down btn btn-warning"></i></a></span>
                                        <span><a onclick="return confirm('Are you sure you want to delete this thing into the database?')" href="<?php echo e(URL( "/admin/menudelete?id=".$value->group)); ?>"> <i class="fa fa-recycle btn btn-danger"></i></a></span>

                                    </td>
                                </tr>

                             <?php endif; ?>
                     <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </table>
            </div>

        </div>
    </div>

<?php $__env->stopSection(); ?>



<?php echo $__env->make("admin.layout.template", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\OpenServer\domains\gca\resources\views/admin/menuedit.blade.php ENDPATH**/ ?>