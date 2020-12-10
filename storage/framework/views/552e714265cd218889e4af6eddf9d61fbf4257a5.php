<header id="header" style="z-index: 9999">
  <div class="headerbar">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="headerbar-left">
      <ul class="header-nav header-nav-options">
        <li class="header-nav-brand">
          <div class="brand-holder">
            <a href="<?php echo e(URL("/admin")); ?>">
              <span class="text-lg text-bold text-primary">Green CA</span>
            </a>
          </div>
        </li>
        <li>
          <a class="btn btn-icon-toggle menubar-toggle" data-toggle="menubar" href="javascript:void(0);">
            <i class="fa fa-bars"></i>
          </a>
        </li>
      </ul>
    </div>
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="headerbar-right">
      <ul class="header-nav header-nav-profile">
        <?php $__currentLoopData = \App\Language::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <li>
          <div>
            <a class="text-uppercase" href="<?php echo e(url('/locale/' . $language->language_prefix)); ?>">
              <?php echo e($language->language_prefix); ?>

            </a>

          </div>
        </li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <li class="dropdown">
          <a href="javascript:void(0);" class="dropdown-toggle ink-reaction" data-toggle="dropdown">
            <img src="<?php echo e(asset('assets/img/avatar1.jpg?1403934956')); ?>" alt="" />
            <span class="profile-info">
              <?php
                $user = \Illuminate\Support\Facades\Auth::user();
              ?>
              <?php echo e($user->name); ?>

              <?php switch($user->status):
              case (1): ?>
              <small>Administrator</small>
              <?php break; ?>
              <?php case (2): ?>
              <?php break; ?>
              <small>Author</small>

              <?php endswitch; ?>

            </span>
          </a>
          <ul class="dropdown-menu animation-dock">
            <li><a href="<?php echo e(URL('/admin/users/profile')); ?>"><i class="fa fa-fw fa-user text-danger"></i> Profile</a></li>
            <li><a href="<?php echo e(route('logout')); ?>"><i class="fa fa-fw fa-power-off text-danger"></i> Logout</a></li>
          </ul>
          <!--end .dropdown-menu -->
        </li>
        <!--end .dropdown -->
      </ul>
      <!--end .header-nav-profile -->
    </div>
    <!--end #header-navbar-collapse -->
  </div>
</header><?php /**PATH D:\OpenServer\domains\gca\resources\views/admin/layout/header.blade.php ENDPATH**/ ?>