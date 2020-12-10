<?php
$user = \Illuminate\Support\Facades\Auth::user();
?>
<!doctype html>
<html>

<head>
  <title></title>

  <!-- BEGIN META -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="keywords" content="your,keywords">
  <meta name="description" content="Short explanation about this website">
  <!-- END META -->

  <!-- BEGIN STYLESHEETS -->
  <link href='http://fonts.googleapis.com/css?family=Roboto:300italic,400italic,300,400,500,700,900' rel='stylesheet'
    type='text/css' />
  <link type="text/css" rel="stylesheet" href="<?php echo e(URL::asset("assets/css/theme-default/bootstrap.css?1422792965")); ?>" />
  <link type="text/css" rel="stylesheet"
    href="<?php echo e(URL::asset("assets/css/theme-default/materialadmin.css?1425466319")); ?>" />
  <link type="text/css" rel="stylesheet"
    href="<?php echo e(URL::asset("assets/css/theme-default/font-awesome.min.css?1422529194")); ?>" />
  <link type="text/css" rel="stylesheet"
    href="<?php echo e(URL::asset("assets/css/theme-default/material-design-iconic-font.min.css?1421434286")); ?>" />
  <script src="<?php echo e(URL::asset('js/vue.js')); ?>"></script>
  <!-- END STYLESHEETS -->
  <script src="<?php echo e(URL::asset("assets/js/libs/utils/html5shiv.js?1403934957")); ?>"></script>
  <script src="<?php echo e(URL::asset("assets/js/libs/utils/respond.min.js?1403934956")); ?>"></script>

</head>

<body class="menubar-hoverable header-fixed menubar-pin ">

  <!-- BEGIN HEADER-->

  <?php echo $__env->make("admin.layout.header", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  <!-- END HEADER-->

  <!-- BEGIN BASE-->
  <div id="base">

    <!-- BEGIN OFFCANVAS LEFT -->
    <div class="offcanvas">
    </div>
    <!--end .offcanvas-->
    <!-- END OFFCANVAS LEFT -->

    <!-- BEGIN CONTENT-->
    <div id="content">

      <!-- BEGIN BLANK SECTION -->
      <section>
        <div class="section-header">

        </div>
        <!--end .section-header -->
        <div class="section-body">
          <?php echo $__env->yieldContent('content'); ?>
        </div>
        <!--end .section-body -->
      </section>

      <!-- BEGIN BLANK SECTION -->
    </div>
    <!--end #content-->
    <!-- END CONTENT -->

    <!-- BEGIN MENUBAR-->
    <div id="menubar" class="menubar-inverse ">
      <div class="menubar-fixed-panel">
        <div>
          <a class="btn btn-icon-toggle btn-default menubar-toggle" data-toggle="menubar" href="javascript:void(0);">
            <i class="fa fa-bars"></i>
          </a>
        </div>
        <div class="expanded">
          <a href="<?php echo e(URL("/admin")); ?>">
            <span class="text-lg text-bold text-primary ">ADMIN-PANEL</span>
          </a>
        </div>
      </div>
      <div class="menubar-scroll-panel">

        <!-- BEGIN MAIN MENU -->
        <ul id="main-menu" class="gui-controls">
          <?php if($user->status == 1): ?>
          <li class="<?php echo e(starts_with(Route::current()->uri, 'admin/languages') ? 'active' : ''); ?>">
            <a href="<?php echo e(route('languages.index')); ?>">
              <div class="gui-icon"><i class="md md-web"></i></div>
              <span class="title">Языки</span>
            </a>
          </li>
          <?php endif; ?>

          <li class="gui-folder" id="pager">
            <a class="<?php echo e(starts_with(Route::current()->uri, 'admin/post') ? 'active' : ''); ?>">
              <div class="gui-icon"><i class="md md-computer"></i></div>
              <span class="title">Посты</span>
            </a>

            <ul>
              <li class="<?php echo e(starts_with(Route::current()->uri, 'admin/post-categories') ? 'active' : ''); ?>">
                <a href="<?php echo e(route('post-categories.index')); ?>">
                  <span class="title">Категории постов</span>
                </a>
              </li>
              <li class="<?php echo e(starts_with(Route::current()->uri, 'admin/posts') ? 'active' : ''); ?>">
                <a href="<?php echo e(route('posts.index')); ?>">
                  <span class="title">Посты</span>
                </a>
              </li>
            </ul>
          </li>

          <li class="gui-folder" id="pager">
            <ul>
              <?php if( Route::current()->getName() == 'tendercategory' ||
              Route::current()->getName() == 'tendercategory' ||
              Route::current()->getName() == 'tendercategory_edit' ||
              Route::current()->getName() == 'tendercategory_delete' ||
              Route::current()->getName() == 'tendercategory_create'
              ): ?>
              <li class="active">
                <a href="<?php echo e(URL('/admin/tendercategory/')); ?>">
                  <span class="title">Категория тендера</span>
                </a>
              </li>
              <?php else: ?>
              <li>
                <a href="<?php echo e(URL('/admin/tendercategory/')); ?>">
                  <span class="title">Категория тендера</span>
                </a>
              </li>
              <?php endif; ?>
              <?php if( Route::current()->getName() == 'tender' ||
              Route::current()->getName() == 'tender_edit' ||
              Route::current()->getName() == 'tender_delete' ||
              Route::current()->getName() == 'tender_create'): ?>
              <li class="active">
                <a href="<?php echo e(URL('/admin/tender/')); ?>">
                  <span class="title">Тендер</span>
                </a>
              </li>
              <?php else: ?>
              <li>
                <a href="<?php echo e(URL('/admin/tender/')); ?>">
                  <span class="title">Тендер</span>
                </a>
              </li>
              <?php endif; ?>

            </ul>
          </li>
          <li class="gui-folder" id="pager">
            <?php if(
            Route::current()->getName() == 'eventcategory' ||
            Route::current()->getName() == 'eventcategory_edit' ||
            Route::current()->getName() == 'eventcategory_delete' ||
            Route::current()->getName() == 'eventcategory_create' ||
            Route::current()->getName() == 'event' ||
            Route::current()->getName() == 'event_edit' ||
            Route::current()->getName() == 'event_delete' ||
            Route::current()->getName() == 'event_create'
            ): ?>
            <a class="active">
              <div class="gui-icon"><i class="md md-computer"></i></div>
              <span class="title">Мероприятия</span>
            </a>
            <?php else: ?>
            <a>
              <div class="gui-icon"><i class="md md-computer"></i></div>
              <span class="title">Мероприятия</span>
            </a>
            <?php endif; ?>

            <ul>
              <?php if(
              Route::current()->getName() == 'eventcategory' ||
              Route::current()->getName() == 'eventcategory_edit' ||
              Route::current()->getName() == 'eventcategory_delete' ||
              Route::current()->getName() == 'eventcategory_create'
              ): ?>
              <li class="active">
                <a href="<?php echo e(URL('/admin/eventcategory/')); ?>">
                  <span class="title">Категория мероприятия</span>
                </a>
              </li>
              <?php else: ?>
              <li>
                <a href="<?php echo e(URL('/admin/eventcategory/')); ?>">
                  <span class="title">Категория мероприятия</span>
                </a>
              </li>
              <?php endif; ?>
              <?php if(
              Route::current()->getName() == 'event' ||
              Route::current()->getName() == 'event_edit' ||
              Route::current()->getName() == 'event_delete' ||
              Route::current()->getName() == 'event_create'
              ): ?>
              <li class="active">
                <a href="<?php echo e(URL('/admin/event/')); ?>">
                  <span class="title">Мероприятие</span>
                </a>
              </li>
              <?php else: ?>
              <li>
                <a href="<?php echo e(URL('/admin/event/')); ?>">
                  <span class="title">Мероприятие</span>
                </a>
              </li>
              <?php endif; ?>
            </ul>
          </li>

          <li class="gui-folder" id="pager">
            <a class="<?php echo e(starts_with(Route::current()->uri, 'admin/document') ? 'active' : ''); ?>">
              <div class="gui-icon"><i class="md md-computer"></i></div>
              <span class="title">Документы</span>
            </a>

            <ul>
              <li class="<?php echo e(starts_with(Route::current()->uri, 'admin/document-categories') ? 'active' : ''); ?>">
                <a href="<?php echo e(route('document-categories.index')); ?>">
                  <span class="title">Категории Документов</span>
                </a>
              </li>
              <li class="<?php echo e(starts_with(Route::current()->uri, 'admin/documents') ? 'active' : ''); ?>">
                <a href="<?php echo e(route('documents.index')); ?>">
                  <span class="title">Документы</span>
                </a>
              </li>
            </ul>
          </li>

          <li class="gui-folder" id="pager">
            <a class="<?php echo e(starts_with(Route::current()->uri, 'admin/photo') ? 'active' : ''); ?>">
              <div class="gui-icon"><i class="md md-computer"></i></div>
              <span class="title">Фотогалерея</span>
            </a>

            <ul>
              <li class="<?php echo e(starts_with(Route::current()->uri, 'admin/photo-categories') ? 'active' : ''); ?>">
                <a href="<?php echo e(route('photo-categories.index')); ?>">
                  <span class="title">Фото альбом</span>
                </a>
              </li>
              <li class="<?php echo e(starts_with(Route::current()->uri, 'admin/photos') ? 'active' : ''); ?>">
                <a href="<?php echo e(route('photos.index')); ?>">
                  <span class="title">Фотографии</span>
                </a>
              </li>

            </ul>
          </li>

          <li class="gui-folder" id="pager">
            <a class="<?php echo e(starts_with(Route::current()->uri, 'admin/video') ? 'active' : ''); ?>">
              <div class="gui-icon"><i class="md md-computer"></i></div>
              <span class="title">Видеогалерея</span>
            </a>

            <ul>
              <li class="<?php echo e(starts_with(Route::current()->uri, 'admin/videoalbum') ? 'active' : ''); ?>">
                <a href="<?php echo e(route('videoalbum.index')); ?>">
                  <span class="title">Видео альбом</span>
                </a>
              </li>
              <li
                class="<?php echo e(Route::current()->getName() == 'video.index' || Route::current()->getName() == 'video.create' || Route::current()->getName() == 'video.edit' ? 'active' : ''); ?>">
                <a href="<?php echo e(route('video.index')); ?>">
                  <span class="title">Видео ролики</span>
                </a>
              </li>
            </ul>
          </li>

          <!-- BEGIN PAGES -->
          <li class="gui-folder" id="pager">
            <?php if('page_categories' == Route::current()->getName()
            || 'page_categories_create' == Route::current()->getName()
            || 'page_categories_edit' == Route::current()->getName()
            || 'pages' == Route::current()->getName()
            || 'pages_create' == Route::current()->getName()): ?>
            <a class="active">
              <div class="gui-icon"><i class="md md-computer"></i></div>
              <span class="title">Страницы</span>
            </a>
            <?php else: ?>
            <a>
              <div class="gui-icon"><i class="md md-computer"></i></div>
              <span class="title">Страницы</span>
            </a>
            <?php endif; ?>

            <!--start submenu -->
            <ul>
              <?php if('page_categories' == Route::current()->getName()
              || 'page_categories_create' == Route::current()->getName()
              || 'page_categories_edit' == Route::current()->getName()): ?>
              <li class="active">
                <a href="<?php echo e(URL('/admin/pages/categories/')); ?>">
                  <span class="title">Рубрики страниц</span>
                </a>
              </li>
              <?php else: ?>
              <li>
                <a href="<?php echo e(URL('/admin/pages/categories/')); ?>">
                  <span class="title">Рубрики страниц</span>
                </a>
              </li>
              <?php endif; ?>




              <?php if('pages' == Route::current()->getName()
              || 'pages_create' == Route::current()->getName()): ?>
              <li class="active">
                <a href="<?php echo e(URL('/admin/pages/')); ?>">
                  <span class="title">Страницы</span>
                </a>
              </li>
              <?php else: ?>
              <li>
                <a href="<?php echo e(URL('/admin/pages/')); ?>">
                  <span class="title">Страницы</span>
                </a>
              </li>
              <?php endif; ?>





            </ul>
            <!--end /submenu -->
          </li>
          <li class="gui-folder" id="pager">
            <?php if(
            'contact' == Route::current()->getName() ||
            'cv' == Route::current()->getName() ||
            'cv_search' == Route::current()->getName() ||
            'cv_edit' == Route::current()->getName() ||
            'murojat' == Route::current()->getName() ||
            'murojat_edit' == Route::current()->getName() ||
            'murojat_id' == Route::current()->getName()
            ): ?>
            <a class="active">
              <div class="gui-icon"><i class="md md-computer"></i></div>
              <span class="title">Обращения</span>
            </a>
            <?php else: ?>
            <a>
              <div class="gui-icon"><i class="md md-computer"></i></div>
              <span class="title">Обращения</span>
            </a>
            <?php endif; ?>
            <ul>
              <?php if(
              'contact' == Route::current()->getName()
              ): ?>
              <li class="active">
                <a href="<?php echo e(URL('/admin/contact')); ?>">
                  <span class="title">Контакты</span>
                </a>
              </li>
              <?php else: ?>
              <li>
                <a href="<?php echo e(URL('/admin/contact')); ?>">
                  <span class="title">Контакты</span>
                </a>
              </li>
              <?php endif; ?>

            </ul>
          </li>
          <li class="gui-folder" id="pager">
            <ul>
              <?php if(
              'links_categories' == Route::current()->getName()
              ): ?>
              <li class="active">
                <a href="<?php echo e(URL('/admin/links/categories/')); ?>">
                  <span class="title">Категория Ссылки</span>
                </a>
              </li>
              <?php else: ?>
              <li>
                <a href="<?php echo e(URL('/admin/links/categories/')); ?>">
                  <span class="title">Категория Ссылки</span>
                </a>
              </li>
              <?php endif; ?>

            </ul>

            <?php if(
            'statistica' == Route::current()->getName() ||
            'statistica_create' == Route::current()->getName()
            ): ?>
          <li class="active">
            <a href="<?php echo e(URL('/admin/statistica')); ?>">
              <span class="title">Статистика</span>
            </a>
          </li>
          <?php else: ?>
          <li>
            <a href="<?php echo e(URL('/admin/statistica')); ?>">
              <span class="title">Статистика</span>
            </a>
          </li>

          <?php endif; ?>

          <?php if('gca.info.index' == Route::current()->getName()): ?>
          <li class="active">
            <a href="<?php echo e(route('gca.info.index')); ?>">
              <span class="title">GCA INFO</span>
            </a>
          </li>
          <?php else: ?>
          <li>
            <a href="<?php echo e(route('gca.info.index')); ?>">
              <span class="title">GCA INFO</span>
            </a>
          </li>

          <?php endif; ?>
          <?php if($user->status == 1): ?>
          <?php if(
          'menu' == Route::current()->getName()
          ): ?>
          <li class="active">
            <a href="<?php echo e(URL('/admin/menu/')); ?>">
              <span class="title">Конструктор Меню</span>
            </a>
          </li>
          <!--end /menu-li -->
          <?php else: ?>
          <li>
            <a href="<?php echo e(URL('/admin/menu/')); ?>">
              <span class="title">Конструктор Меню</span>
            </a>
          </li>
          <?php endif; ?>



          <!-- END FORMS -->
          <?php if(
          'menu_edit' == Route::current()->getName() ||
          'menu_edits' == Route::current()->getName() ||
          'menu_id' == Route::current()->getName()
          ): ?>
          <li class="active">
            <a href="<?php echo e(URL('/admin/menu/edit')); ?>">
              <span class="title">Изменение меню</span>
            </a>
          </li>
          <?php else: ?>
          <li>
            <a href="<?php echo e(URL('/admin/menu/edit')); ?>">
              <span class="title">Изменение меню</span>
            </a>
          </li>

          <?php endif; ?>

          <?php if(
          'users' == Route::current()->getName() ||
          'users_create' == Route::current()->getName() ||
          'users_edit' == Route::current()->getName()

          ): ?>
          <li class="active">
            <a href="<?php echo e(URL('/admin/users/')); ?>">
              <span class="title">Пользователи</span>
            </a>
          </li>
          <?php else: ?>
          <li>
            <a href="<?php echo e(URL('/admin/users/')); ?>">
              <span class="title">Пользователи</span>
            </a>
          </li>

          <?php endif; ?>
          <?php endif; ?>

        </ul>
        <!--end .main-menu -->
        <!-- END MAIN MENU -->

        <div class="menubar-foot-panel">
          <small class="no-linebreak hidden-folded">
            <span class="opacity-75">Developed by </span> <strong><a href="http://kibera.uz/">Kibera
                Technology</a></strong>
          </small>
        </div>
      </div>
      <!--end .menubar-scroll-panel-->
    </div>
    <!--end #menubar-->
    <!-- END MENUBAR -->

  </div>
  <!--end #base-->
  <!-- END BASE -->

  <!-- BEGIN JAVASCRIPT -->
  <script src="<?php echo e(URL::asset("assets/js/libs/jquery/jquery-1.11.2.min.js")); ?>"></script>
  <script src="<?php echo e(URL::asset("assets/js/libs/jquery/jquery-migrate-1.2.1.min.js")); ?>"></script>
  <script src="<?php echo e(URL::asset("assets/js/libs/bootstrap/bootstrap.min.js")); ?>"></script>
  <script src="<?php echo e(URL::asset("assets/js/libs/spin.js/spin.min.js")); ?>"></script>
  <script src="<?php echo e(URL::asset("assets/js/libs/moment/moment.min.js")); ?>"></script>
  <script src="<?php echo e(URL::asset("assets/js/libs/flot/jquery.flot.min.js")); ?>"></script>
  <script src="<?php echo e(URL::asset("assets/js/libs/flot/jquery.flot.time.min.js")); ?>"></script>
  <script src="<?php echo e(URL::asset("assets/js/libs/flot/jquery.flot.resize.min.js")); ?>"></script>
  <script src="<?php echo e(URL::asset("assets/js/libs/flot/jquery.flot.orderBars.js")); ?>"></script>
  <script src="<?php echo e(URL::asset("assets/js/libs/flot/jquery.flot.pie.js")); ?>"></script>
  <script src="<?php echo e(URL::asset("assets/js/libs/flot/curvedLines.js")); ?>"></script>
  <script src="<?php echo e(URL::asset("assets/js/libs/jquery-knob/jquery.knob.min.js")); ?>"></script>
  <script src="<?php echo e(URL::asset("assets/js/libs/sparkline/jquery.sparkline.min.js")); ?>"></script>
  <script src="<?php echo e(URL::asset("assets/js/libs/nanoscroller/jquery.nanoscroller.min.js")); ?>"></script>
  <script src="<?php echo e(URL::asset("assets/js/libs/d3/d3.min.js")); ?>"></script>
  <script src="<?php echo e(URL::asset("assets/js/libs/d3/d3.v3.js")); ?>"></script>
  <script src="<?php echo e(URL::asset("assets/js/libs/rickshaw/rickshaw.min.js")); ?>"></script>

  <script src="<?php echo e(URL::asset("assets/js/libs/autosize/jquery.autosize.min.js")); ?>"></script>
  <script src="<?php echo e(URL::asset("assets/js/libs/nanoscroller/jquery.nanoscroller.min.js")); ?>"></script>

  <script src="<?php echo e(URL::asset("assets/js/core/source/App.js")); ?>"></script>
  <script src="<?php echo e(URL::asset("assets/js/core/source/AppNavigation.js")); ?>"></script>
  <script src="<?php echo e(URL::asset("assets/js/core/source/AppOffcanvas.js")); ?>"></script>
  <script src="<?php echo e(URL::asset("assets/js/core/source/AppCard.js")); ?>"></script>
  <script src="<?php echo e(URL::asset("assets/js/core/source/AppForm.js")); ?>"></script>
  <script src="<?php echo e(URL::asset("assets/js/core/source/AppNavSearch.js")); ?>"></script>
  <script src="<?php echo e(URL::asset("assets/js/core/source/AppVendor.js")); ?>"></script>

  <script src="<?php echo e(URL::asset("assets/js/tinymce/tinymce.min.js")); ?>"></script>
  <script src="<?php echo e(URL::asset("assets/js/core/demo/Demo.js")); ?>"></script>
  <!--<script src="<?php echo e(URL::asset("assets/js/core/demo/DemoDashboard.js")); ?>"></script>-->



  <script>
    /*  $apps = new Vue({
        el:'#pager',
        data:{
            menu:[],
        },


        created:function(){
            var _this = this;

            _this.getmenu();
        },

        methods:{
            getmenu:function () {
                var _this = this;
                $.getJSON("<?php echo e(URL(App::getLocale()."/admin/pages/json")); ?>", function(result){

                    _this.menu= result;

                    console.log(result);
                });

            }
        }

    });*/
  </script>

  <script>
    /* tinymce.init({
        selector: "textarea",theme: "modern",height: 300,
        plugins: [
            "advlist autolink link image lists charmap print preview hr  pagebreak",
            "searchreplace wordcount visualblocks visualchars insertdatetime media nonbreaking",
            "table contextmenu directionality emoticons paste textcolor responsivefilemanager code"
        ],
        toolbar1: "undo redo | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | styleselect | sizeselect | fontselect | fontsizeselect",
        toolbar2: "| responsivefilemanager | link unlink anchor | image media | forecolor backcolor  | print preview code ",
        image_advtab: true ,
        fontsize_formats: "8px 10px 12px 14px 18px 24px 36px",
        relative_urls: false,
        file_browser_callback : function(field_name, url, type, win) {
            var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
            var y = window.innerHeight || document.documentElement.clientHeight || document.getElementsByTagName('body')[0].clientHeight;

            var cmsURL = editor_config.path_absolute + 'laravel-filemanager?field_name=' + field_name;
            if (type == 'image') {
                cmsURL = cmsURL + "&type=Images";
            } else {
                cmsURL = cmsURL + "&type=Files";
            }

            tinyMCE.activeEditor.windowManager.open({
                file: cmsURL,
                title: 'Filemanager',
                width: x * 0.8,
                height: y * 0.8,
                resizable: "yes",
                close_previous: "no"
            });
        }
    });*/


   var editor_config = {
       path_absolute : "/",
       selector: "textarea",theme: "modern",height: 300,
       plugins: [
           "advlist autolink lists link image charmap print preview hr anchor pagebreak",
           "searchreplace wordcount visualblocks visualchars code fullscreen",
           "insertdatetime media nonbreaking save table contextmenu directionality",
           "emoticons template paste textcolor colorpicker textpattern"
       ],
       toolbar1: "responsivefilemanager undo redo | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | styleselect | sizeselect | fontselect | fontsizeselect",
       toolbar2: "link image media |link unlink anchor | image media | forecolor backcolor  | print preview code  fullscreen insertdatetime ",

       fontsize_formats: "8px 10px 12px 14px 18px 24px 36px",
       relative_urls: false,


       file_browser_callback : function(field_name, url, type, win) {
           var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
           var y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;

           var cmsURL = editor_config.path_absolute + 'public/laravel-filemanager?field_name=' + field_name;
           if (type == 'image') {
               cmsURL = cmsURL + "&type=Images";
           } else {
               cmsURL = cmsURL + "&type=Files";
           }

           tinyMCE.activeEditor.windowManager.open({
               file : cmsURL,
               title : 'Filemanager',
               width : x * 0.8,
               height : y * 0.8,
               resizable : "yes",
               close_previous : "no"
           });
       }



   };

   tinymce.init(editor_config);
  </script>


  <!-- END JAVASCRIPT -->

</body>

</html><?php /**PATH D:\OpenServer\domains\gca\resources\views/admin/layout/template.blade.php ENDPATH**/ ?>