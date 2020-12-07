
<rss version="2.0">

    <channel>
        <title><?php echo e($title); ?></title>
        <link><?php echo e(URL("/")); ?></link>
        <description><?php echo e($title); ?></description>

        <?php $__currentLoopData = $table; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

        <item>
            <title><?php echo e($value["title"]); ?></title>
            <link><?php echo e($value["link"]); ?></link>
            <description><?php echo $value["description"]; ?> </description>
        </item>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    </channel>

</rss><?php /**PATH D:\OpenServer\domains\gca\resources\views\ress.blade.php ENDPATH**/ ?>