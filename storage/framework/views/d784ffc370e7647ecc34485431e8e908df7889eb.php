<?php $__env->startSection("content"); ?>
    <?php if($errors->any()): ?>
        <div class="alert alert-danger">
            <ul>
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($error); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    <?php endif; ?>
    <div class="col-md-12" style="background-color: white;padding: 25px;">
        <div class="col-md-4">
            <ul id="main-menu" class="gui-controls">
                <li class="gui-folder expanded">
                    <a>
                        <div class="gui-icon"><i class="fa fa-folder-open fa-fw"></i></div>
                        <span class="title">Menu</span>
                    </a>
                    <!--start submenu -->
                    <ul>
                        <?php $__currentLoopData = $menues; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php $modelsx = DB::table("menumakers")
                                ->where("language_id","=",\App\Http\Controllers\NewsController::getlangid())
                                ->where("parent_id","=",$value->group)
                                ->get(); ?>
                            <?php if(count($modelsx) >0): ?>
                                <li class="gui-folder">
                                    <a href="javascript:void(0);">
                                        <span class="title"><?php echo e($value->menu_name); ?></span>
                                    </a>
                                    <!--start submenu -->
                                    <ul>
                                        <?php $__currentLoopData = $modelsx; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $valuex): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php $modelsxs = DB::table("menumakers")
                                                ->where("language_id","=",\App\Http\Controllers\NewsController::getlangid())
                                                ->where("parent_id","=",$valuex->group)
                                                ->get(); ?>
                                            <?php if(count($modelsxs) >0): ?>

                                                <li class="gui-folder">
                                                    <a href="javascript:void(0);">
                                                        <span class="title"><?php echo e($valuex->menu_name); ?></span>
                                                    </a>

                                                    <ul>
                                                        <?php $__currentLoopData = $modelsxs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $valuexx): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <li><a href="#"><span class="title"><?php echo e($valuexx->menu_name); ?></span></a></li>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </ul>
                                                </li>
                                            <?php else: ?>
                                                <li><a href="#"><span class="title"><?php echo e($valuex->menu_name); ?></span></a></li>
                                            <?php endif; ?>

                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                    </ul><!--end /submenu -->
                                </li>

                            <?php else: ?>
                                <li><a href="#"><span class="title"><?php echo e($value->menu_name); ?></span></a></li>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


                    </ul><!--end /submenu -->
                </li>
            </ul>



        </div>




        <div class="col-md-6">

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
                    <form class="form" role="form" enctype="multipart/form-data" method="post" action="<?php echo e(URL("/admin/menubuilder/edit")); ?>">

                        <div class="card-body tab-content">
                            <?php $__currentLoopData = $languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key =>$language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($key == 0): ?>

                                    <?php $__currentLoopData = $edit; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $valuesx): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if($valuesx->language_id == $language->id): ?>
                                    <div class="tab-pane active" id="<?php echo e($language->id); ?>">
                                        <div class="form" role="form">
                                            <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                                            <input type="hidden" name="grp_id" value="<?php echo e($grp_id); ?>">
                                            <input type="hidden" name="language_id[]" value="<?php echo e($language->id); ?>">
                                            <div class="form-group floating-label">
                                                <input type="text" name="menu_name[]" value="<?php echo e($valuesx->menu_name); ?>" class="form-control" id="regular2">
                                                <label for="regular2">menu_name</label>
                                            </div>
                                            <div class="form-group floating-label">

                                                <select class="form-control" name="parent_id">
                                                    <option value="0">---</option>


                                                    <?php $__currentLoopData = $menues; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $keyone=>$value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <?php $modelsx = DB::table("menumakers")
                                                            ->where("language_id","=",\App\Http\Controllers\NewsController::getlangid())
                                                            ->where("parent_id","=",$value->group)
                                                            ->get(); ?>
                                                        <?php if(count($modelsx) >0): ?>

                                                            <?php if($valuesx->parent_id == $value->group): ?>
                                                                    <option value="<?php echo e($value->group); ?>" selected><?php echo e($keyone+1); ?>)<?php echo e($value->menu_name); ?></option>

                                                                <?php else: ?>
                                                                    <option value="<?php echo e($value->group); ?>"><?php echo e($keyone+1); ?>)<?php echo e($value->menu_name); ?></option>

                                                                <?php endif; ?>
                                                                <ul>
                                                                    <?php $__currentLoopData = $modelsx; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $keytwo=>$valuex): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                        <?php $modelsxs = DB::table("menumakers")
                                                                            ->where("language_id","=",\App\Http\Controllers\NewsController::getlangid())
                                                                            ->where("parent_id","=",$valuex->group)
                                                                            ->get(); ?>
                                                                        <?php if(count($modelsxs) >0): ?>

                                                                                <?php if($valuesx->parent_id == $valuex->group): ?>
                                                                                <option value="<?php echo e($valuex->group); ?>" selected><?php echo e(($keyone+1).".".($keytwo+1)); ?>)  <?php echo e($valuex->menu_name); ?></option>
                                                                                    <?php else: ?>
                                                                                    <option value="<?php echo e($valuex->group); ?>"><?php echo e(($keyone+1).".".($keytwo+1)); ?>)  <?php echo e($valuex->menu_name); ?></option>

                                                                                <?php endif; ?>
                                                                                    <?php $__currentLoopData = $modelsxs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $keythree=>$valuexx): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                                        <?php if($valuesx->parent_id == $valuexx->group): ?>
                                                                                    <option value="<?php echo e($valuexx->group); ?>"><?php echo e(($keyone+1).".".($keytwo+1).".".($keythree+1)); ?>)   <?php echo e($valuexx->menu_name); ?></option>
                                                                                    <?php else: ?>
                                                                                            <option value="<?php echo e($valuexx->group); ?>" selected><?php echo e(($keyone+1).".".($keytwo+1).".".($keythree+1)); ?>)   <?php echo e($valuexx->menu_name); ?></option>

                                                                                        <?php endif; ?>
                                                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                                                        <?php else: ?>
                                                                                <?php if($valuesx->parent_id == $valuex->group): ?>
                                                                                <option value="<?php echo e($valuex->group); ?>" selected><?php echo e(($keyone+1).".".($keytwo+1)); ?>)  <?php echo e($valuex->menu_name); ?></option>
                                                                       <?php else: ?>
                                                                                    <option value="<?php echo e($valuex->group); ?>"><?php echo e(($keyone+1).".".($keytwo+1)); ?>)  <?php echo e($valuex->menu_name); ?></option>

                                                                                <?php endif; ?>
                                                                        <?php endif; ?>

                                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>



                                                        <?php else: ?>
                                                                            <?php if($valuesx->parent_id == $value->group): ?>
                                                                <option value="<?php echo e($value->group); ?>"><?php echo e($keyone+1); ?>)<?php echo e($value->menu_name); ?></option>
                                                            <?php else: ?>
                                                                                <option value="<?php echo e($value->group); ?>"><?php echo e($keyone+1); ?>)<?php echo e($value->menu_name); ?></option>
                                                            <?php endif; ?>
                                                        <?php endif; ?>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


                                                </select>
                                                <label for="regular2">type</label>
                                            </div>
                                            <div class="form-group floating-label">

                                                <select class="form-control" name="type">
                                                    <option value="1" <?php if($valuesx->type =="1"): ?> selected <?php endif; ?>>Link</option>
                                                    <option value="2" <?php if($valuesx->type =="2"): ?> selected <?php endif; ?>>Post</option>
                                                    <option value="3" <?php if($valuesx->type =="3"): ?> selected <?php endif; ?>>Page</option>
                                                    <option value="4" <?php if($valuesx->type =="4"): ?> selected <?php endif; ?>>Doc</option>
                                                    <option value="5" <?php if($valuesx->type =="5"): ?> selected <?php endif; ?>>Event</option>
                                                    <option value="6" <?php if($valuesx->type =="6"): ?> selected <?php endif; ?>>Tender</option>
                                                    <option value="7" <?php if($valuesx->type =="7"): ?> selected <?php endif; ?>>video</option>
                                                    <option value="8" <?php if($valuesx->type =="8"): ?> selected <?php endif; ?>>Photo</option>
                                                </select>
                                                <label for="regular2">type</label>
                                            </div>

                                            <div class="form-group floating-label">

                                                <label for="regular2">Categories</label>

                                                <select name="alias_category_id" class="form-control">
                                                    <optgroup label="Docs">
                                                        <?php $__currentLoopData = $categories["doc"]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <?php if($valuesx->alias_category_id == $value->group): ?>
                                                        <option value="<?php echo e($value->group); ?>" selected><?php echo e($value->category_name); ?></option>
                                                        <?php else: ?>
                                                                <option value="<?php echo e($value->group); ?>"><?php echo e($value->category_name); ?></option>

                                                            <?php endif; ?>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </optgroup>

                                                    <optgroup label="Tender">
                                                        <?php $__currentLoopData = $categories["tender"]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                                            <?php if($valuesx->alias_category_id == $value->group): ?>
                                                                <option value="<?php echo e($value->group); ?>" selected><?php echo e($value->category_name); ?></option>
                                                            <?php else: ?>
                                                                <option value="<?php echo e($value->group); ?>"><?php echo e($value->category_name); ?></option>

                                                            <?php endif; ?>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </optgroup>
                                                    <optgroup label="Event">
                                                        <?php $__currentLoopData = $categories["event"]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <?php if($valuesx->alias_category_id == $value->group): ?>
                                                                <option value="<?php echo e($value->group); ?>" selected><?php echo e($value->category_name); ?></option>
                                                            <?php else: ?>
                                                                <option value="<?php echo e($value->group); ?>"><?php echo e($value->category_name); ?></option>

                                                            <?php endif; ?>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </optgroup>

                                                    <optgroup label="Post">
                                                        <?php $__currentLoopData = $categories["post"]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <?php if($valuesx->alias_category_id == $value->group): ?>
                                                                <option value="<?php echo e($value->group); ?>" selected><?php echo e($value->category_name); ?></option>
                                                            <?php else: ?>
                                                                <option value="<?php echo e($value->group); ?>"><?php echo e($value->category_name); ?></option>

                                                            <?php endif; ?>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </optgroup>

                                                    <optgroup label="Page">
                                                        <?php $__currentLoopData = $categories["page"]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <?php if($valuesx->alias_category_id == $value->page_group_id): ?>
                                                                <option value="<?php echo e($value->page_group_id); ?>" selected><?php echo e($value->title); ?></option>
                                                            <?php else: ?>
                                                                <option value="<?php echo e($value->page_group_id); ?>"><?php echo e($value->title); ?></option>

                                                            <?php endif; ?>

                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </optgroup>

                                                    <optgroup label="Photo">
                                                        <?php $__currentLoopData = $categories["photo"]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <?php if($valuesx->alias_category_id == $value->group): ?>
                                                                <option value="<?php echo e($value->group); ?>" selected><?php echo e($value->title); ?></option>
                                                            <?php else: ?>
                                                                <option value="<?php echo e($value->group); ?>"><?php echo e($value->title); ?></option>

                                                            <?php endif; ?>

                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </optgroup>
                                                    <optgroup label="Photo">
                                                        <?php $__currentLoopData = $categories["video"]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <?php if($valuesx->alias_category_id == $value->group): ?>
                                                                <option value="<?php echo e($value->group); ?>" selected><?php echo e($value->title); ?></option>
                                                            <?php else: ?>
                                                                <option value="<?php echo e($value->group); ?>"><?php echo e($value->title); ?></option>

                                                            <?php endif; ?>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </optgroup>
                                                </select>
                                            </div>
                                            <div class="form-group floating-label">
                                                <input type="text" name="link" class="form-control" id="regular2">
                                                <label for="regular2">link</label>
                                            </div>


                                        </div>
                                    </div>
                                        <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php else: ?>
                                    <?php $__currentLoopData = $edit; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $valuesx): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if($valuesx->language_id == $language->id): ?>
                                    <div class="tab-pane" id="<?php echo e($language->id); ?>">
                                        <div class="form" role="form">
                                            <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                                            <input type="hidden" name="language_id[]" value="<?php echo e($language->id); ?>">
                                            <div class="form-group floating-label">
                                                <input type="text" name="menu_name[]" value="<?php echo e($valuesx->menu_name); ?>" class="form-control" id="regular2">
                                                <label for="regular2">menu_name</label>
                                            </div>
                                        </div>
                                    </div>
                                            <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <div class="card-actionbar-row">
                                <button type="submit" class="btn btn-flat btn-primary ink-reaction">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make("admin.layout.template", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\OpenServer\domains\gca\resources\views/admin/menubuildere.blade.php ENDPATH**/ ?>