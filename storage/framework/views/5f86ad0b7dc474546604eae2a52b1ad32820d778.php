<b>FROM</b> <i><?php echo e($demo->sender); ?></i>,
<?php switch($demo->type):
    case ('contact'): ?>
    <p><b>Форма обращения:</b>Обратная связь</p>
    <div>
        <p><b>Источник обращения:</b><a href="http://water.gov.uz">Вебсайт Минводхоз РУз</a></p>
        <p><b>Ф.И.О. заявителя:</b>&nbsp;<?php echo e($demo->demo_one); ?></p>
        <p><b>Эл. почта заявителя: </b><?php echo e($demo->fio); ?></p>
        <pre><b>Текст сообщения:</b><br>&nbsp;<?php echo e($demo->demo_two); ?></pre>
    </div>
    <?php break; ?>
    <?php case ('contact_client'): ?>
    <div>
        <p><b>Мурожаатингиз қабул қилинди. </b></p>
    </div>
    <?php break; ?>
    <?php case ('murojat'): ?>
    <div>
        <p><b>Форма обращения:</b>Обращение граждан </p>
        <p><b>Источник обращения:</b><a href="http://water.gov.uz">Вебсайт Минводхоз РУз</a></p>
        <p><b>Ф.И.О. заявителя:</b><?php echo e($demo->fio); ?></p>
        <p><b>UNIQUE_NUMBER:</b>&nbsp;<?php echo e($demo->demo_one); ?></p>
        <pre><b>Текст сообщения:</b><br>&nbsp;<?php echo e($demo->demo_two); ?></pre>
    </div>
    <?php break; ?>
    <?php case ('cv'): ?>
    <div>
        <p><b>Форма обращения:</b>Отправка резюме </p>
        <p><b>Источник обращения:</b><a href="http://water.gov.uz">Вебсайт Минводхоз РУз</a></p>
        <p><b>Ф.И.О. заявителя:</b><?php echo e($demo->fio); ?></p>
        <p><b>UNIQUE_NUMBER:</b>&nbsp;<?php echo e($demo->demo_one); ?></p>
        <pre><b>Текст сообщения:</b><br>&nbsp;<?php echo e($demo->demo_two); ?></pre>
        <p><a href="<?php echo e($demo->link); ?>"><b>Вложение:</b></a></p>
    </div>
    <?php break; ?>
    <?php case ('murojat_client'): ?>
    <div>
        <p><b>Источник обращения:</b><a href="http://water.gov.uz">Вебсайт Минводхоз РУз</a></p>
        <p><b>Мурожаатингиз қабул қилинди. </b></p>
        <p><b>Ф.И.О. заявителя:</b><?php echo e($demo->fio); ?></p>
        <p><b>Аризангизни руйхат рақами:</b>&nbsp;<?php echo e($demo->demo_one); ?></p>
    </div>
    <?php break; ?>
    <?php case ('murojat_re'): ?>
    <div>
        <p><b>Источник обращения:</b><a href="http://water.gov.uz">Вебсайт Минводхоз РУз</a></p>
        <p><b>Мурожаатингиз Мақоми ўзгарди </b></p>
        <?php switch( $demo->fio):
            case (0): ?>
        <p><b>Мақоми : </b>Янги мурожаат</p>
            <?php break; ?>
            <?php case (1): ?>
            <p><b>Мақоми : </b>Қайта ишланмоқда</p>
            <?php break; ?>
            <?php case (2): ?>
            <p><b>Мақоми : </b>Кўриб чиқилмоқда</p>
            <?php break; ?>
            <?php case (3): ?>
            <p><b>Мақоми : </b>Жавоб жўнатилди</p>
            <?php break; ?>
        <?php endswitch; ?>
        <p><b>Аризангизни руйхат рақами:</b>&nbsp;<?php echo e($demo->demo_one); ?></p>
    </div>
    <?php break; ?>
    <?php case ('obuna'): ?>
    <div>
        <p><b>Источник обращения:</b><a href="http://water.gov.uz">Вебсайт Минводхоз РУз</a></p>
    <?php $date=date_create($demo->demo_two) ?>
        <p><b><?php echo e($demo->demo_one); ?> </b></p>
        <p><b>DATE:<?php echo e(date_format($date,"d.m.Y H:i")); ?> </b></p>
            <a href="<?php echo e(URL(App::getLocale().'/obuna/delete?id='.$demo->id)); ?>"><b>Отписаться от рассылок</b></a>
       <pre><?php echo $demo->fio; ?></pre>
    </div>
    <?php break; ?>
    <?php case ('orph'): ?>
    <div>

        <p>errortext : <b><?php echo e($demo->demo_one); ?> </b></p>
        <p>comment :<pre><?php echo $demo->fio; ?></pre></p>
    </div>
    <?php break; ?>

    <?php endswitch; ?>



<?php /**PATH D:\OpenServer\domains\gca\resources\views\emails\test.blade.php ENDPATH**/ ?>