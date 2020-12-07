<?php

$all =\DB::table('translate')->where('type',"=","kurs")->orderByDesc("id")->first();
;

?>
<div class="info-block" id="kurs">
    <div class="col-xs-12 info-header">
        <h4 class="text-center"><?php echo app('translator')->getFromJson('blog.curse'); ?></h4>
    </div>
    <div class="col-xs-12 info-content force-margin">
        <br>
        <div class="text-center">
            <table class="table table-condensed">
                <thead>
                <tr>
                    <th><?php echo app('translator')->getFromJson('blog.currency-code'); ?></th>
                    <th><?php echo app('translator')->getFromJson('blog.currency-rate'); ?></th>
                    <th><?php echo app('translator')->getFromJson('blog.currency-diff'); ?></th>
                </tr>
                </thead>
                <tbody>














                </tbody>
            </table>
            <a href="http://cbu.uz/ru/arkhiv-kursov-valyut/"><?php echo app('translator')->getFromJson('blog.source'); ?>: <?php echo app('translator')->getFromJson('blog.currency-source'); ?></a>
        </div>
    </div>
</div>
<?php /**PATH D:\OpenServer\domains\gca\resources\views\layout\kurs.blade.php ENDPATH**/ ?>