<?php $language = \App\Language::all();

$values =  config('contact');
$translate = DB::table("translate")->where("type", "=", "contact")->orderByDesc("id")->first();
$translate_footer = DB::table("translate")->where("type", "=", "footer")->orderByDesc("id")->first();
$translate_svg = DB::table("translate")->where("type", "=", "svg")->orderByDesc("id")->first();



$json = json_decode($translate->jsons);

if ($translate_footer) {
  $jsonf = json_decode($translate_footer->jsons);
}
if ($translate_svg) {
  $jsons = json_decode($translate_svg->jsons);

  $ars =  json_decode(json_encode($jsons), true);



  $myar = [
    $ars[0]["uz_tk"],
    $ars[1]["uz_an"],
    $ars[2]["uz_na"],
    $ars[3]["uz_fa"],
    $ars[4]["uz_ta"],
    $ars[5]["uz_si"],
    $ars[6]["uz_ji"],
    $ars[7]["uz_sa"],
    $ars[8]["uz_qa"],
    $ars[9]["uz_su"],
    $ars[10]["uz_bu"],
    $ars[11]["uz_nv"],
    $ars[12]["uz_xo"],
    $ars[13]["uz_qo"],

  ];
}
//dd(json_decode($translate->jsons));

$language_count = \App\Language::all()->count();
?>



<?php $__env->startSection("content"); ?>

<div class="col-md-12" style="background-color: white;padding: 25px;">

  <ul class="nav nav-pills">
    <li class="active">
      <a href="#1a" data-toggle="tab">Contact</a>
    </li>
    <li><a href="#2a" data-toggle="tab">Footer</a>
    </li>

    <li><a href="#3a" data-toggle="tab">Свг карта</a>
    </li>

  </ul>

  <div class="tab-content clearfix">
    <div class="tab-pane active" id="1a">
      <form method="post" action="<?php echo e(URL("/admin/translate")); ?>">
        <input class="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
        <div class="row">
          <h3> TITLE</h3>
          <?php $__currentLoopData = $language;
          $__env->addLoop($__currentLoopData);
          foreach ($__currentLoopData as $key => $value) : $__env->incrementLoopIndices();
            $loop = $__env->getLastLoop(); ?>
            <input class="hidden" name="language_ids[]" value="<?php echo e($value->id); ?>">
            <div class="col-md-3">
              <div class="form-group">
                <h4><?php echo e($value->language_prefix); ?></h4>
                <input class="form-control" name="titles[]" value="<?php echo e($json->title[$key]); ?>">

              </div>
            </div>
          <?php endforeach;
          $__env->popLoop();
          $loop = $__env->getLastLoop(); ?>
        </div>

        <div class="row">
          <h3>Description</h3>
          <?php $__currentLoopData = $language;
          $__env->addLoop($__currentLoopData);
          foreach ($__currentLoopData as $key => $value) : $__env->incrementLoopIndices();
            $loop = $__env->getLastLoop(); ?>
            <div class="col-md-3">
              <div class="form-group">
                <h4><?php echo e($value->language_prefix); ?></h4>
                <input class="form-control" name="description[]" value="<?php echo e($json->description[$key]); ?>">

              </div>
            </div>
          <?php endforeach;
          $__env->popLoop();
          $loop = $__env->getLastLoop(); ?>
        </div>
        <div class="row" id="tables">
          <h3>Table</h3>
          <?php $__currentLoopData = $language;
          $__env->addLoop($__currentLoopData);
          foreach ($__currentLoopData as $value) : $__env->incrementLoopIndices();
            $loop = $__env->getLastLoop(); ?>

            <div class="col-md-4" id="<?php echo e($value->id); ?>x">


              <div class="form-group">

                <h4><?php echo e($value->language_prefix); ?></h4>



                <?php switch ($value->language_prefix):

                  case ("uz"): ?>
                    <?php $__currentLoopData = $json->tb_one_uz;
                    $__env->addLoop($__currentLoopData);
                    foreach ($__currentLoopData as $key => $val) : $__env->incrementLoopIndices();
                      $loop = $__env->getLastLoop(); ?>

                      <div style="margin: 40px;" id="<?php echo e($value->id); ?><?php echo e($key); ?>x">
                        <input class="form-control" name="tb_one_<?php echo e($value->language_prefix); ?>[]" value="<?php echo $json->tb_one_uz[$key]; ?>">
                        <input class="form-control" name="tb_two_<?php echo e($value->language_prefix); ?>[]" value="<?php echo $json->tb_two_uz[$key]; ?>">
                        <input class="form-control" name="tb_three_<?php echo e($value->language_prefix); ?>[]" value="<?php echo $json->tb_three_uz[$key]; ?>">
                        <input class="form-control" name="tb_four_<?php echo e($value->language_prefix); ?>[]" value="<?php echo $json->tb_four_uz[$key]; ?>">
                      </div>
                    <?php endforeach;
                    $__env->popLoop();
                    $loop = $__env->getLastLoop(); ?>
                    <?php break; ?>

                  <?php
                  case ("ru"): ?>
                    <?php $__currentLoopData = $json->tb_one_ru;
                    $__env->addLoop($__currentLoopData);
                    foreach ($__currentLoopData as $key => $val) : $__env->incrementLoopIndices();
                      $loop = $__env->getLastLoop(); ?>

                      <div style="margin: 40px;" id="<?php echo e($value->id); ?><?php echo e($key); ?>x">
                        <input class="form-control" name="tb_one_<?php echo e($value->language_prefix); ?>[]" value="<?php echo $json->tb_one_ru[$key]; ?>">
                        <input class="form-control" name="tb_two_<?php echo e($value->language_prefix); ?>[]" value="<?php echo $json->tb_two_ru[$key]; ?>">
                        <input class="form-control" name="tb_three_<?php echo e($value->language_prefix); ?>[]" value="<?php echo $json->tb_three_ru[$key]; ?>">
                        <input class="form-control" name="tb_four_<?php echo e($value->language_prefix); ?>[]" value="<?php echo $json->tb_four_ru[$key]; ?>">
                      </div>
                    <?php endforeach;
                    $__env->popLoop();
                    $loop = $__env->getLastLoop(); ?>
                    <?php break; ?>

                  <?php
                  case ("en"): ?>
                    <?php $__currentLoopData = $json->tb_one_en;
                    $__env->addLoop($__currentLoopData);
                    foreach ($__currentLoopData as $key => $val) : $__env->incrementLoopIndices();
                      $loop = $__env->getLastLoop(); ?>
                      <div style="margin: 40px;" id="<?php echo e($value->id); ?><?php echo e($key); ?>x">
                        <input class="form-control" name="tb_one_<?php echo e($value->language_prefix); ?>[]" value="<?php echo $json->tb_one_en[$key]; ?>">
                        <input class="form-control" name="tb_two_<?php echo e($value->language_prefix); ?>[]" value="<?php echo $json->tb_two_en[$key]; ?>">
                        <input class="form-control" name="tb_three_<?php echo e($value->language_prefix); ?>[]" value="<?php echo $json->tb_three_en[$key]; ?>">
                        <span><input class="form-control" name="tb_four_<?php echo e($value->language_prefix); ?>[]" value="<?php echo $json->tb_four_en[$key]; ?>"></span>


                      </div>
                      <a href="#" onclick="remove_id('<?php echo e($key); ?>x')" class="btn btn-danger" style="position: absolute;right: 0;margin-top: -190px;"><i class="fa fa-remove"></i></a>


                    <?php endforeach;
                    $__env->popLoop();
                    $loop = $__env->getLastLoop(); ?>
                    <?php break; ?>

                <?php endswitch; ?>


              </div>



            </div>
          <?php endforeach;
          $__env->popLoop();
          $loop = $__env->getLastLoop(); ?>


        </div>
        <button type="button" onclick="clickmeadd()" class="btn btn-success"><i class="fa fa-plus"></i></button>


        <div class="row">
          <h3> MAP TARGET</h3>
          <?php $__currentLoopData = $language;
          $__env->addLoop($__currentLoopData);
          foreach ($__currentLoopData as $key => $value) : $__env->incrementLoopIndices();
            $loop = $__env->getLastLoop(); ?>

            <div class="col-md-3">
              <div class="form-group">
                <h4><?php echo e($value->language_prefix); ?></h4>
                <input class="form-control" name="map_target[]" value="<?php echo e($json->map_target[$key]); ?>">

              </div>
            </div>
          <?php endforeach;
          $__env->popLoop();
          $loop = $__env->getLastLoop(); ?>
        </div>

        <div class="row">
          <h3> BOTTOM TITLE</h3>
          <?php $__currentLoopData = $language;
          $__env->addLoop($__currentLoopData);
          foreach ($__currentLoopData as $key => $value) : $__env->incrementLoopIndices();
            $loop = $__env->getLastLoop(); ?>

            <div class="col-md-3">
              <div class="form-group">
                <h4><?php echo e($value->language_prefix); ?></h4>
                <input class="form-control" name="bottom_title[]" value="<?php echo e($json->bottom_title[$key]); ?>">

              </div>
            </div>
          <?php endforeach;
          $__env->popLoop();
          $loop = $__env->getLastLoop(); ?>
        </div>

        <div class="row">
          <h3>Bottom table</h3>
          <?php $__currentLoopData = $language;
          $__env->addLoop($__currentLoopData);
          foreach ($__currentLoopData as $key => $value) : $__env->incrementLoopIndices();
            $loop = $__env->getLastLoop(); ?>
            <div class="col-md-3">
              <div class="form-group">
                <h4><?php echo e($value->language_prefix); ?></h4>
                <?php $tabs = $values['contact_' . $value->language_prefix]['bottom_table']; ?>

                <?php switch ($value->language_prefix):

                  case ("uz"): ?>
                    <input class="form-control" name="bottom_table_tb_one_<?php echo e($value->language_prefix); ?>[]" value="<?php echo $json->bottom_table_tb_one_uz[0]; ?>">
                    <input class="form-control" name="bottom_table_tb_two_<?php echo e($value->language_prefix); ?>[]" value="<?php echo $json->bottom_table_tb_two_uz[0]; ?>">
                    <input class="form-control" name="bottom_table_tb_three_<?php echo e($value->language_prefix); ?>[]" value="<?php echo $json->bottom_table_tb_three_uz[0]; ?>">
                    <input class="form-control" name="bottom_table_tb_four_<?php echo e($value->language_prefix); ?>[]" value="<?php echo $json->bottom_table_tb_four_uz[0]; ?>">

                    <?php break; ?>
                  <?php
                  case ("ru"): ?>
                    <input class="form-control" name="bottom_table_tb_one_<?php echo e($value->language_prefix); ?>[]" value="<?php echo $json->bottom_table_tb_one_ru[0]; ?>">
                    <input class="form-control" name="bottom_table_tb_two_<?php echo e($value->language_prefix); ?>[]" value="<?php echo $json->bottom_table_tb_two_ru[0]; ?>">
                    <input class="form-control" name="bottom_table_tb_three_<?php echo e($value->language_prefix); ?>[]" value="<?php echo $json->bottom_table_tb_three_ru[0]; ?>">
                    <input class="form-control" name="bottom_table_tb_four_<?php echo e($value->language_prefix); ?>[]" value="<?php echo $json->bottom_table_tb_four_ru[0]; ?>">
                    <?php break; ?>
                  <?php
                  case ("en"): ?>
                    <input class="form-control" name="bottom_table_tb_one_<?php echo e($value->language_prefix); ?>[]" value="<?php echo $json->bottom_table_tb_one_en[0]; ?>">
                    <input class="form-control" name="bottom_table_tb_two_<?php echo e($value->language_prefix); ?>[]" value="<?php echo $json->bottom_table_tb_two_en[0]; ?>">
                    <input class="form-control" name="bottom_table_tb_three_<?php echo e($value->language_prefix); ?>[]" value="<?php echo $json->bottom_table_tb_three_en[0]; ?>">
                    <input class="form-control" name="bottom_table_tb_four_<?php echo e($value->language_prefix); ?>[]" value="<?php echo $json->bottom_table_tb_four_en[0]; ?>">

                    <?php break; ?>



                <?php endswitch; ?>
              </div>
            </div>
          <?php endforeach;
          $__env->popLoop();
          $loop = $__env->getLastLoop(); ?>
        </div>

        <div class="row">
          <h3>Rahbar</h3>
          <?php $__currentLoopData = $language;
          $__env->addLoop($__currentLoopData);
          foreach ($__currentLoopData as $key => $value) : $__env->incrementLoopIndices();
            $loop = $__env->getLastLoop(); ?>

            <div class="col-md-3">
              <div class="form-group">
                <h4><?php echo e($value->language_prefix); ?></h4>
                <input class="form-control" name="rahbar[]" value="<?php echo e($json->rahbar[$key]); ?>">

              </div>
            </div>
          <?php endforeach;
          $__env->popLoop();
          $loop = $__env->getLastLoop(); ?>
        </div>

        <div class="row">
          <h3>Lavozim</h3>
          <?php $__currentLoopData = $language;
          $__env->addLoop($__currentLoopData);
          foreach ($__currentLoopData as $key => $value) : $__env->incrementLoopIndices();
            $loop = $__env->getLastLoop(); ?>

            <div class="col-md-3">
              <div class="form-group">
                <h4><?php echo e($value->language_prefix); ?></h4>
                <input class="form-control" name="lavozim[]" value="<?php echo e($json->lavozim[$key]); ?>">

              </div>
            </div>
          <?php endforeach;
          $__env->popLoop();
          $loop = $__env->getLastLoop(); ?>
        </div>

        <div class="row">
          <h3>Kun</h3>
          <?php $__currentLoopData = $language;
          $__env->addLoop($__currentLoopData);
          foreach ($__currentLoopData as $key => $value) : $__env->incrementLoopIndices();
            $loop = $__env->getLastLoop(); ?>

            <div class="col-md-3">
              <div class="form-group">
                <h4><?php echo e($value->language_prefix); ?></h4>
                <input class="form-control" name="kun[]" value="<?php echo e($json->kun[$key]); ?>">

              </div>
            </div>
          <?php endforeach;
          $__env->popLoop();
          $loop = $__env->getLastLoop(); ?>
        </div>

        <div class="row">
          <h3>Soat</h3>
          <?php $__currentLoopData = $language;
          $__env->addLoop($__currentLoopData);
          foreach ($__currentLoopData as $key => $value) : $__env->incrementLoopIndices();
            $loop = $__env->getLastLoop(); ?>

            <div class="col-md-3">
              <div class="form-group">
                <h4><?php echo e($value->language_prefix); ?></h4>
                <input class="form-control" name="soat[]" value="<?php echo e($json->soat[$key]); ?>">

              </div>
            </div>
          <?php endforeach;
          $__env->popLoop();
          $loop = $__env->getLastLoop(); ?>
        </div>

        <button class="btn btn-success" type="submit">save</button>
      </form>
    </div>
    <div class="tab-pane" id="2a">
      <form method="post" action="<?php echo e(URL("/admin/translate_footer")); ?>">
        <input class="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
        <div class="row">
          <h3>Ишонч телефони: </h3>


          <div class="col-md-3">
            <div class="form-group">

              <input class="form-control" name="telephone" value="<?php echo e($jsonf->telephone ?? ""); ?>">

            </div>
          </div>

        </div>

        <div class="row">
          <h3>Девонхона: </h3>


          <div class="col-md-3">
            <div class="form-group">

              <input class="form-control" name="devonxona" value="<?php echo e($jsonf->devonxona ?? ""); ?>">

            </div>
          </div>

        </div>
        <div class="row">
          <h3>Факс: </h3>


          <div class="col-md-3">
            <div class="form-group">

              <input class="form-control" name="fax" value="<?php echo e($jsonf->fax ?? ""); ?>">

            </div>
          </div>

        </div>
        <div class="row">
          <h3>Email: </h3>


          <div class="col-md-3">
            <div class="form-group">

              <input class="form-control" name="email" value="<?php echo e($jsonf->email ?? ""); ?>">

            </div>
          </div>

        </div>
        <div class="row">
          <h3>Манзил: </h3>

          <?php $__currentLoopData = $language;
          $__env->addLoop($__currentLoopData);
          foreach ($__currentLoopData as $key => $value) : $__env->incrementLoopIndices();
            $loop = $__env->getLastLoop(); ?>
            <div class="col-md-3">
              <div class="form-group">
                <h4><?php echo e($value->language_prefix); ?></h4>
                <input class="form-control" name="manzil[]" value="<?php echo e($jsonf->manzil[$key] ?? ""); ?>" placeholder="<?php echo e($value->language_prefix); ?>">

              </div>
            </div>
          <?php endforeach;
          $__env->popLoop();
          $loop = $__env->getLastLoop(); ?>

        </div>
        <div class="row">
          <h3>Обуна: </h3>

          <?php $__currentLoopData = $language;
          $__env->addLoop($__currentLoopData);
          foreach ($__currentLoopData as $key => $value) : $__env->incrementLoopIndices();
            $loop = $__env->getLastLoop(); ?>
            <div class="col-md-3">
              <div class="form-group">
                <h4><?php echo e($value->language_prefix); ?></h4>
                <input class="form-control" name="obuna[]" value="<?php echo e($jsonf->obuna[$key] ?? ""); ?>" placeholder="<?php echo e($value->language_prefix); ?>">

              </div>
            </div>
          <?php endforeach;
          $__env->popLoop();
          $loop = $__env->getLastLoop(); ?>

        </div>


        <button class="btn btn-success" type="submit">save</button>
      </form>
    </div>
    <div class="tab-pane" id="3a">

      <?php
      $countries = [
        ['Тошкент шахри', 'uz_tk'],
        ['Андижон вилояти', 'uz_an'],
        ['Наманган вилояти', 'uz_na'],
        ['Фарғона вилояти', 'uz_fa'],
        ['Тошкент вилояти', 'uz_ta'],
        ['Сирдарё вилояти', 'uz_si'],
        ['Жиззах вилояти', 'uz_ji'],
        ['Самарқанд вилояти', 'uz_sa'],
        ['[Қашқадарё вилояти', 'uz_qa'],
        ['Сурхондарё вилояти', 'uz_su'],
        ['Бухоро вилояти', 'uz_bu'],
        ['Навоий вилояти', 'uz_nv'],
        ['Хоразм вилояти', 'uz_xo'],
        ['Қорақалпоғистон', 'uz_qo'],
      ];
      ?>
      <form method="post" action="<?php echo e(URL("/admin/translate_svg")); ?>">
        <input class="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">

        <div class="row">


          <?php $__currentLoopData = $countries;
          $__env->addLoop($__currentLoopData);
          foreach ($__currentLoopData as $key => $value) : $__env->incrementLoopIndices();
            $loop = $__env->getLastLoop(); ?>
            <h3><?php echo e($value[0]); ?></h3>
            <input class="hidden" name="code[]" value="<?php echo e($value[1]); ?>">
            <div class="col-md-12">
              <div class="form-group">

                <input class="form-control" name="telefon[]" value="<?php echo e($myar[$key]["telefon"] ?? ""); ?>" placeholder="Телефон">

              </div>

              <div class="form-group">
                <?php $__currentLoopData = $language;
                $__env->addLoop($__currentLoopData);
                foreach ($__currentLoopData as $value) : $__env->incrementLoopIndices();
                  $loop = $__env->getLastLoop(); ?>

                  <input class="form-control" name="rahbar_<?php echo e($value->language_prefix); ?>[]" value="<?php echo e($myar[$key]["rahbar_" . $value->language_prefix] ?? ""); ?>" placeholder="Рахбар">
                <?php endforeach;
                $__env->popLoop();
                $loop = $__env->getLastLoop(); ?>

              </div>

              <div class="form-group">

                <input class="form-control" name="email[]" value="<?php echo e($myar[$key]["email"] ?? ""); ?>" placeholder="Почта">

              </div>
            </div>
          <?php endforeach;
          $__env->popLoop();
          $loop = $__env->getLastLoop(); ?>
        </div>

        <button class="btn btn-success" type="submit">save</button>
      </form>
    </div>

  </div>

</div>

<script>
  function clickmeadd() {
    <?php $__currentLoopData = $language;
    $__env->addLoop($__currentLoopData);
    foreach ($__currentLoopData as $value) : $__env->incrementLoopIndices();
      $loop = $__env->getLastLoop(); ?>
      $("#tables").append('<div class="col-md-4"> <div class="form-group" > <div style="margin: 40px;"> <input class="form-control" name="tb_one_<?php echo e($value->language_prefix); ?>[]" value=""> <input class="form-control" name="tb_two_<?php echo e($value->language_prefix); ?>[]" value=""> <input class="form-control" name="tb_three_<?php echo e($value->language_prefix); ?>[]" value=""> <input class="form-control" name="tb_four_<?php echo e($value->language_prefix); ?>[]" value=""></div> </div> </div>');
    <?php endforeach;
    $__env->popLoop();
    $loop = $__env->getLastLoop(); ?>
  }

  function remove_id(str) {

    console.log(str);
    $("#1" + str).remove();
    $("#2" + str).remove();
    $("#3" + str).remove();

  }
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make("admin.layout.template", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\OpenServer\domains\gca\resources\views\admin\translate.blade.php ENDPATH**/ ?>