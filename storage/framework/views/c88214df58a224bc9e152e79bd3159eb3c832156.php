
<div class="mobile-menu">
    <ul class="list">
        <li>
            <a href="<?php echo e(URL(App::getLocale()."/about")); ?>"><?php echo e(trans("home.project")); ?></a>
        </li>
        <li>
            <a href="<?php echo e(URL(App::getLocale()."/book")); ?>" class="menu-toggle"><?php echo e(trans("home.books")); ?></a>
            <ul class="ml-menu">
                <li>
                    <a href="<?php echo e(URL("/ru/book")); ?>"><?php echo e(trans("home.ru")); ?></a>
                </li>
                <li>
                    <a href="<?php echo e(URL("/en/book")); ?>"><?php echo e(trans("home.en")); ?></a>
                </li>
                <li>
                    <a href="<?php echo e(URL("/uz/book")); ?>"><?php echo e(trans("home.uz")); ?></a>
                </li>
            </ul>
        </li>
        <li>
            <a href="#" class="menu-toggle"><?php echo e(trans("home.audiobook")); ?></a>
            <ul class="ml-menu">
                <li>
                    <a href="<?php echo e(URL("/ru/book")); ?>"><?php echo e(trans("home.uz")); ?>"><?php echo e(trans("home.ru")); ?></a>
                </li>
                <li>
                    <a href="<?php echo e(URL("/en/book")); ?>"><?php echo e(trans("home.uz")); ?>"><?php echo e(trans("home.en")); ?></a>
                </li>
                <li>
                    <a href="<?php echo e(URL("/uz/book")); ?>"><?php echo e(trans("home.uz")); ?>"><?php echo e(trans("home.uz")); ?></a>
                </li>
            </ul>
        </li>
        <li>
            <a href="<?php echo e(URL(App::getLocale()."/news")); ?>"><?php echo e(trans("home.news")); ?></a>
        </li>
        <li>
            <a href="<?php echo e(URL(App::getLocale()."/contact")); ?>">Контакты</a>
        </li>
        <li>
            <a href="<?php echo e(URL(App::getLocale()."/enter")); ?>">Вход</a>
        </li>
        <li>
            <a href="<?php echo e(URL(App::getLocale()."/reg")); ?>"><?php echo e(trans("home.reg")); ?></a>
        </li>
        <li>
            <a href="#" class="menu-toggle">RU</a>
            <ul class="ml-menu">
                <li>
                    <a href="<?php echo e(URL("/uz")); ?>">UZ</a>
                </li>
                <li>
                    <a href="#">ENG</a>
                </li>
            </ul>
        </li>
    </ul>
</div>

<?php /**PATH D:\OpenServer\domains\gca\resources\views\admin\layout\fmenu.blade.php ENDPATH**/ ?>