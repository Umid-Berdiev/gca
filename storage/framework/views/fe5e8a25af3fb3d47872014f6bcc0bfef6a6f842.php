<header>
    <div class="container">
        <div class="row">
            <div class="col-lg-2">
                <div class="logo">
                    <a href="<?php echo e(URL("/")); ?>">
                        <img class="img-fluid" src="<?php echo e(URL::asset("frondend/img/logo/black.png")); ?>" alt="">
                    </a>
                </div>
            </div>
            <div class="col-lg-10">
                <nav>
                    <ul class="nav">
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo e(URL(App::getLocale()."/about")); ?>"><?php echo e(trans("home.project")); ?> </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" aria-expanded="false" data-toggle="dropdown" href="#"><?php echo e(trans("home.books")); ?> <i class="fa fa-arrow-down"></i>
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="<?php echo e(URL(App::getLocale()."/book/ru")); ?>"><?php echo e(trans("home.ru")); ?></a>
                                </li>
                                <li>
                                    <a href="<?php echo e(URL(App::getLocale()."/book/en")); ?>"><?php echo e(trans("home.en")); ?></a>
                                </li>
                                <li>
                                    <a href="<?php echo e(URL(App::getLocale()."/book/uz")); ?>"><?php echo e(trans("home.uz")); ?></a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" aria-expanded="false" data-toggle="dropdown" href="#"><?php echo e(trans("home.audiobook")); ?> <i class="fa fa-arrow-down"></i>
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="<?php echo e(URL(App::getLocale()."/audio/ru")); ?>"><?php echo e(trans("home.ru")); ?></a>
                                </li>
                                <li>
                                    <a href="<?php echo e(URL(App::getLocale()."/audio/en")); ?>"><?php echo e(trans("home.en")); ?></a>
                                </li>
                                <li>
                                    <a href="<?php echo e(URL(App::getLocale()."/audio/uz")); ?>"><?php echo e(trans("home.uz")); ?></a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo e(URL(App::getLocale()."/news")); ?>"><?php echo e(trans("home.news")); ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo e(URL(App::getLocale()."/contact")); ?>"><?php echo e(trans("home.contact")); ?></a>
                        </li>

                        <?php if(Request::session()->exists("name")): ?>
                        <li class="nav-item breadcrumb-itm">
                            <a class="nav-link" href="<?php echo e(URL(App::getLocale()."/profile")); ?>"><?php echo e(trans("bookadmin.profile")); ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo e(URL(App::getLocale()."/exit")); ?>"><?php echo e(trans("bookadmin.exit")); ?></a>
                        </li>
                        <?php else: ?>
                            <li class="nav-item breadcrumb-itm">
                                <a class="nav-link" href="<?php echo e(URL(App::getLocale()."/enter")); ?>"><?php echo e(trans("bookadmin.enter")); ?></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo e(URL(App::getLocale()."/reg")); ?>"><?php echo e(trans("home.reg")); ?></a>
                            </li>
                        <?php endif; ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" aria-expanded="false" data-toggle="dropdown" href="#"><?php echo e(App::getLocale()); ?> <i class="fa fa-arrow-down"></i>
                            </a>
                            <ul class="dropdown-menu language-menu">

                                <?php if(App::getLocale() == "uz"): ?>

                                    <li>
                                        <a href="<?php echo e(URL("/ru")); ?>">RU</a>
                                    </li>
                                    <li>
                                        <a href="#<?php echo e(URL("/en")); ?>">EN</a>
                                    </li>
                                <?php endif; ?>

                                <?php if(App::getLocale() == "ru"): ?>

                                    <li>
                                        <a href="#<?php echo e(URL("/uz")); ?>">UZ</a>
                                    </li>
                                    <li>
                                        <a href="#<?php echo e(URL("/en")); ?>">EN</a>
                                    </li>
                                <?php endif; ?>

                                <?php if(App::getLocale() == "en"): ?>

                                    <li>
                                        <a href="#<?php echo e(URL("/uz")); ?>">UZ</a>
                                    </li>
                                    <li>
                                        <a href="<?php echo e(URL("/ru")); ?>">RU</a>
                                    </li>
                                <?php endif; ?>
                            </ul>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
    <div class="menu-btn">
        <span></span>
        <span></span>
        <span></span>
        <span></span>
    </div>
</header><?php /**PATH D:\OpenServer\domains\gca\resources\views\admin\layout\fheader.blade.php ENDPATH**/ ?>