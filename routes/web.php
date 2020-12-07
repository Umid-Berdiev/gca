<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::match(['get', 'post'], 'register', function () {
  return redirect('/');
});

Route::get('login', function () {
  return view('auth/login');
})->name('login');

Route::get('logout', function () {
  \Illuminate\Support\Facades\Auth::logout();
  return redirect(route('login'));
})->name('logout');

Route::post('/contact_post', 'FormController@contact_post');
Route::post('/send_post', 'FormController@store');
Route::post('/check', 'FormController@check');
Route::post('/cv_form_post', 'CvController@store');
Route::post('/obuna', 'FormController@obuna');


// Download Route
Route::get('download/{filename}', function ($filename) {
  // Check if file exists in app/storage/file folder
  $file_path = '/storage/app/' . $filename;
  if (file_exists($file_path)) {
    // Send Download
    return Response::download($file_path, $filename, [
      'Content-Length: ' . filesize($file_path)
    ]);
  } else {
    // Error
    exit('Requested file does not exist on our server!');
  }
})->where('filename', '[A-Za-z0-9\-\_\.]+');

#### front ##
Route::get('/', function () {
  return redirect("/en");
});
Route::get('locale/{locale}', function ($locale) {
  Session::put('locale', $locale);
  return redirect()->back();
});


###admin routes
Route::middleware(['isAuther'])->group(function () {
  Route::get('/admin', 'admin\PostController@index')->name('post');

  Route::get('/admin/pages/categories/', 'admin\PageCategoriesController@index')->name('page_categories');
  Route::get('/admin/pages/categories/create', 'admin\PageCategoriesController@create')->name('page_categories_create');
  Route::get('/admin/pages/categories/edit/{id}', 'admin\PageCategoriesController@edit')->name('page_categories_edit');
  Route::get('/admin/pages/categories/delete/{id}', 'admin\PageCategoriesController@destroy')->name('page_categories_delete');
  Route::post('/admin/pages/categories/store', 'admin\PageCategoriesController@store')->name('page_categories_store');
  Route::post('/admin/pages/categories/update', 'admin\PageCategoriesController@update')->name('page_categories_update');

  Route::get('/admin/pages/', 'admin\PageController@index')->name('pages');
  Route::get('/admin/pages/create', 'admin\PageController@create')->name('pages_create');
  Route::get('/admin/pages/edit/{id}', 'admin\PageController@edit')->name('pages_edit');
  Route::get('/admin/pages/delete/{id}', 'admin\PageController@destroy')->name('pages_delete');
  Route::post('/admin/pages/store', 'admin\PageController@store')->name('pages_store');
  Route::post('/admin/pages/update', 'admin\PageController@update')->name('pages_update');

  Route::get('/admin/language', 'admin\LanguageController@index')->name('languages');
  Route::post('/admin/language/edit', 'admin\LanguageController@Update');
  Route::get('/admin/language/edit', 'admin\LanguageController@UpdateShow')->name('languages_edit');
  Route::get('/admin/language/delete', 'admin\LanguageController@Delete')->name('languages_delete');
  Route::get('/admin/language/create', 'admin\LanguageController@Show')->name('languages_create');
  Route::post('/admin/language/insert', 'admin\LanguageController@Insert');

  Route::get('/admin/postcategory', 'admin\PostcategoryController@index')->name('post_category');
  Route::post('/admin/postcategory/edit', 'admin\PostcategoryController@Update');
  Route::get('/admin/postcategory/edit', 'admin\PostcategoryController@UpdateShow')->name('post_category_edit');
  Route::get('/admin/postcategory/delete', 'admin\PostcategoryController@Delete')->name('post_category_delete');
  Route::get('/admin/postcategory/create', 'admin\PostcategoryController@InsertShow')->name('post_category_create');
  Route::post('/admin/postcategory/insert', 'admin\PostcategoryController@Insert');

  Route::get('/admin/post', 'admin\PostController@index')->name('post');
  Route::post('/admin/post/edit', 'admin\PostController@Update');
  Route::get('/admin/post/edit', 'admin\PostController@UpdateShow')->name('post_edit');
  Route::get('/admin/post/delete', 'admin\PostController@Delete')->name('post_delete');
  Route::get('/admin/post/create', 'admin\PostController@InsertShow')->name('post_create');
  Route::post('/admin/post/insert', 'admin\PostController@Insert');

  Route::get('/admin/doccategory', 'admin\DoccategoryController@index')->name('doccategory');
  Route::post('/admin/doccategory/edit', 'admin\DoccategoryController@Update');
  Route::get('/admin/doccategory/edit', 'admin\DoccategoryController@UpdateShow')->name('doccategory_edit');
  Route::get('/admin/doccategory/delete', 'admin\DoccategoryController@Delete')->name('doccategory_delete');
  Route::get('/admin/doccategory/create', 'admin\DoccategoryController@InsertShow')->name('doccategory_create');
  Route::post('/admin/doccategory/insert', 'admin\DoccategoryController@Insert');

  Route::get('/admin/tendercategory', 'admin\TendercategoryController@index')->name('tendercategory');
  Route::post('/admin/tendercategory/edit', 'admin\TendercategoryController@Update');
  Route::get('/admin/tendercategory/edit', 'admin\TendercategoryController@UpdateShow')->name('tendercategory_edit');
  Route::get('/admin/tendercategory/delete', 'admin\TendercategoryController@Delete')->name('tendercategory_delete');
  Route::get('/admin/tendercategory/create', 'admin\TendercategoryController@InsertShow')->name('tendercategory_create');
  Route::post('/admin/tendercategory/insert', 'admin\TendercategoryController@Insert');

  Route::get('/admin/eventcategory', 'admin\EventcategoryController@index')->name('eventcategory');
  Route::post('/admin/eventcategory/edit', 'admin\EventcategoryController@Update');
  Route::get('/admin/eventcategory/edit', 'admin\EventcategoryController@UpdateShow')->name('eventcategory_edit');
  Route::get('/admin/eventcategory/delete', 'admin\EventcategoryController@Delete')->name('eventcategory_delete');
  Route::get('/admin/eventcategory/create', 'admin\EventcategoryController@InsertShow')->name('eventcategory_create');
  Route::post('/admin/eventcategory/insert', 'admin\EventcategoryController@Insert');

  Route::get('/admin/photocategory', 'admin\PhotocategoryController@index')->name('photocategory');
  Route::post('/admin/photocategory/edit', 'admin\PhotocategoryController@Update');
  Route::get('/admin/photocategory/edit', 'admin\PhotocategoryController@UpdateShow')->name('photocategory_edit');
  Route::get('/admin/photocategory/delete', 'admin\PhotocategoryController@Delete')->name('photocategory_delete');
  Route::get('/admin/photocategory/create', 'admin\PhotocategoryController@InsertShow')->name('photocategory_create');
  Route::post('/admin/photocategory/insert', 'admin\PhotocategoryController@Insert');

  Route::get('/admin/videocategory', 'admin\VideocategoryController@index')->name('videocategory');
  Route::post('/admin/videocategory/edit', 'admin\VideocategoryController@Update');
  Route::get('/admin/videocategory/edit', 'admin\VideocategoryController@UpdateShow')->name('videocategory_edit');
  Route::get('/admin/videocategory/delete', 'admin\VideocategoryController@Delete')->name('videocategory_delete');
  Route::get('/admin/videocategory/create', 'admin\VideocategoryController@InsertShow')->name('videocategory_create');
  Route::post('/admin/videocategory/insert', 'admin\VideocategoryController@Insert');

  Route::get('/admin/event', 'admin\EventController@index')->name('event');
  Route::post('/admin/event/edit', 'admin\EventController@Update');
  Route::get('/admin/event/edit', 'admin\EventController@UpdateShow')->name('event_edit');
  Route::get('/admin/event/delete', 'admin\EventController@Delete')->name('event_delete');
  Route::get('/admin/event/create', 'admin\EventController@InsertShow')->name('event_create');
  Route::post('/admin/event/insert', 'admin\EventController@Insert');

  Route::get('/admin/tender', 'admin\TenderController@index')->name('tender');
  Route::post('/admin/tender/edit', 'admin\TenderController@Update');
  Route::get('/admin/tender/edit', 'admin\TenderController@UpdateShow')->name('tender_edit');
  Route::get('/admin/tender/delete', 'admin\TenderController@Delete')->name('tender_delete');
  Route::get('/admin/tender/create', 'admin\TenderController@InsertShow')->name('tender_create');
  Route::post('/admin/tender/insert', 'admin\TenderController@Insert');

  Route::get('/admin/doc', 'admin\DocController@index')->name('doc');
  Route::post('/admin/doc/edit', 'admin\DocController@Update');
  Route::get('/admin/doc/edit', 'admin\DocController@UpdateShow')->name('doc_edit');
  Route::get('/admin/doc/delete', 'admin\DocController@Delete')->name('doc_delete');
  Route::get('/admin/doc/create', 'admin\DocController@InsertShow')->name('doc_create');
  Route::post('/admin/doc/insert', 'admin\DocController@Insert');

  Route::get('/admin/photo', 'admin\PhotoController@index')->name('photo');
  Route::post('/admin/photo/edit', 'admin\PhotoController@Update');
  Route::get('/admin/photo/edit', 'admin\PhotoController@UpdateShow')->name('photo_edit');
  Route::get('/admin/photo/delete', 'admin\PhotoController@Delete')->name('photo_delete');
  Route::get('/admin/photo/create', 'admin\PhotoController@InsertShow')->name('photo_create');
  Route::post('/admin/photo/insert', 'admin\PhotoController@Insert');

  Route::get('/admin/video', 'admin\VideoController@index')->name('video');
  Route::post('/admin/video/edit', 'admin\VideoController@Update');
  Route::get('/admin/video/edit', 'admin\VideoController@UpdateShow')->name('video_edit');
  Route::get('/admin/video/delete', 'admin\VideoController@Delete')->name('video_delete');
  Route::get('/admin/video/create', 'admin\VideoController@InsertShow')->name('video_create');
  Route::post('/admin/video/insert', 'admin\VideoController@Insert');

  Route::get('/admin/sorov', 'admin\SorovnomaController@index')->name('sorov');
  Route::post('/admin/sorov/edit', 'admin\SorovnomaController@Update');
  Route::get('/admin/sorov/edit', 'admin\SorovnomaController@UpdateShow')->name('sorov_edit');
  Route::get('/admin/sorov/delete', 'admin\SorovnomaController@Delete')->name('sorov_delete');
  Route::get('/admin/sorov/create', 'admin\SorovnomaController@InsertShow')->name('sorov_create');
  Route::post('/admin/sorov/insert', 'admin\SorovnomaController@Insert');

  Route::get('/admin/sorovatter', 'admin\SorovnomaatterController@index');
  Route::post('/admin/sorovatter/edit', 'admin\SorovnomaatterController@Update');
  Route::get('/admin/sorovatter/edit', 'admin\SorovnomaatterController@UpdateShow');
  Route::get('/admin/sorovatter/delete', 'admin\SorovnomaatterController@Delete');
  Route::get('/admin/sorovatter/create', 'admin\SorovnomaatterController@InsertShow');
  Route::post('/admin/sorovatter/insert', 'admin\SorovnomaatterController@Insert');

  Route::get('/admin/menu', 'MenuController@index')->name('menu');
  Route::get('/admin/contact', 'FormController@indexContact')->name('contact');
  Route::post('/admin/contact/search', 'FormController@ContactSearch');
  Route::get('/admin/cv', 'FormController@indexCV')->name('cv');
  Route::get('/admin/cv/search', 'FormController@CvSearch')->name('cv_search');
  Route::get('/admin/murojat/search', 'FormController@murojatSearch')->name('murojat_search');
  Route::get('/admin/cv/{id}', 'FormController@indexCVedit')->name('cv_edit');
  Route::post('/admin/cv_update', 'FormController@cvSave');
  Route::post('/admin/murojat_update', 'FormController@murojat_update');
  Route::get('/admin/murojat', 'FormController@indexMurojat')->name('murojat');
  Route::get('/admin/murojat/{id}', 'FormController@Murojat_edit')->name('murojat_id');
  Route::get('/admin/menu/edit', 'MenuController@editshow')->name('menu_edit');
  Route::get('/admin/menu/edits', 'MenuController@edits')->name('menu_edits');
  Route::get('/admin/menu/{id}', 'MenuController@indexx')->name('menu_id');
  Route::get('/admin/menuchange', 'MenuController@orderchange')->name('menu_change');
  Route::get('/admin/menudelete', 'MenuController@destroy')->name('menu_destroy');
  Route::post('/admin/menubuilder/insert', 'MenuController@Insert');
  Route::post('/admin/menubuilder/edit', 'MenuController@Update');

  Route::get('/admin/users/', 'admin\UserController@getUsers')->name('users');
  Route::get('/admin/logout', 'admin\UserController@logout');
  Route::get('/admin/users/create', 'admin\UserController@create')->name('users_create');
  Route::get('/admin/users/show', 'admin\UserController@Show')->name('users_edit');
  Route::post('/admin/users/store', 'admin\UserController@Store');
  Route::post('/admin/users/update', 'admin\UserController@Update');
  Route::post('/admin/users/profile_update', 'admin\UserController@profile_update');
  Route::get('/admin/users/delete', 'admin\UserController@Delete');
  Route::get('/admin/users/profile', 'admin\UserController@Profile');

  Route::get('/admin/statistica/', 'admin\StatisticaController@index')->name('statistica');
  Route::get('/admin/statistica/create', 'admin\StatisticaController@create')->name('statistica_create');
  Route::get('/admin/statistica/destroy', 'admin\StatisticaController@destroy');
  Route::post('/admin/statistica/store', 'admin\StatisticaController@store');

  Route::post('/admin/raxbariyat/store', 'admin\RaxbariyatController@store');
  Route::get('/admin/raxbariyat/', 'admin\RaxbariyatController@index')->name('raxbariyat');
  Route::get('/admin/raxbariyat/create', 'admin\RaxbariyatController@create')->name('raxbariyat_create');
  Route::get('/admin/raxbariyat/edit', 'admin\RaxbariyatController@edit')->name('raxbariyat_edit');
  Route::post('/admin/raxbariyat/update', 'admin\RaxbariyatController@update');
  Route::get('/admin/raxbariyat/delete', 'admin\RaxbariyatController@destroy');

  Route::get('/admin/links/categories/', 'admin\LinksController@indexCategories')->name('links_categories');
  Route::get('/admin/links/categories/create', 'admin\LinksController@createCategories')->name('links_categories_create');
  Route::get('/admin/links/categories/edit', 'admin\LinksController@editCategories')->name('links_categories_edit');
  Route::get('/admin/links/categories/delete', 'admin\LinksController@categories_destroy');
  Route::post('/admin/links/categories/store', 'admin\LinksController@categories_store');
  Route::post('/admin/links/categories/update', 'admin\LinksController@categories_update');

  Route::get('/admin/links/', 'admin\LinksController@index')->name('links');
  Route::get('/admin/links/create', 'admin\LinksController@create')->name('links_create');
  Route::post('/admin/links/store', 'admin\LinksController@store');
  Route::get('/admin/links/edit', 'admin\LinksController@edit')->name('links_edit');
  Route::post('/admin/links/update', 'admin\LinksController@update');
  Route::get('/admin/links/delete', 'admin\LinksController@destroy');

  Route::get('/admin/years/', 'admin\YearsController@index')->name('years');
  Route::get('/admin/years/create', 'admin\YearsController@create')->name('years_create');
  Route::get('/admin/years/edit', 'admin\YearsController@edit')->name('years_edit');
  Route::post('/admin/years/store', 'admin\YearsController@store');
  Route::post('/admin/years/update', 'admin\YearsController@update');
  Route::get('/admin/years/delete', 'admin\YearsController@destroy');

  Route::group(['prefix' => 'admin'], function () {
    Route::group(['prefix' => 'gcainfo'], function () {
      Route::get('/', 'admin\GcaInfoController@index')->name('gca.info.index');
      Route::get('/edit/{id}', 'admin\GcaInfoController@edit')->name('gca.info.edit');
      Route::get('/get', 'admin\GcaInfoController@get')->name('gca.info.get');
      Route::post('/update/', 'admin\GcaInfoController@update');
    });
  });

  Route::get('/admin/translate', function () {
    return view('admin/translate');
  })->name('translate');
  Route::post('/admin/translate', 'SitemapController@translate')->name('murojat_id');
  Route::post('/admin/translate_footer', 'SitemapController@translate_footer')->name('murojat_xxx');
  Route::post('/admin/translate_svg', 'SitemapController@translate_svg')->name('murojat_xx');
});

### end admin routes

Route::post('/vote', 'admin\SorovnomaController@vote')->name('vote');

Route::group(['prefix' => '{lang}', 'middleware' => ['lang']], function () {
  Route::get('/', 'FrontController@index')->name('front_index');
  Route::get('/rss/{str}', 'SitemapController@index');
  Route::get('/map', function () {
    return view('map');
  });
  Route::get('/page/{category_id}/{id}', 'FrontController@page')->name('front_page');
  Route::get('/page/{category_id}', 'FrontController@pages')->name('front_pages');
  Route::get('/post/{category_id}/{id}', 'FrontController@pages')->name('front_pages');
  Route::get('/tenders/filter', 'SearchController@TenderFilter');
  Route::get('/events/filter', 'SearchController@EventFilter');

  Route::post('/postf/filter', 'NewsController@PostsFilter');
  Route::get('/postf/filter', 'NewsController@PostsFilter');
  Route::get('/search', 'SearchController@index')->name('search');
  Route::get('/posts/{id}', 'NewsController@index')->name('news');
  Route::get('/posts/{id}/{title}', 'NewsController@indexin')->name('newsin');
  Route::get('/news/images/{id}', 'NewsController@download')->name('nimage');

  Route::get('/{page}/{id}', 'SearchController@allin')->name('pagesall');
  Route::get('/{page}/{id}/{ids}', 'SearchController@allinin')->name('pagesallin');
  Route::get('/downloads', 'SearchController@download');
  Route::get('/statistica', 'FrontController@getStatistika');
  Route::get('/raxbariyat', 'FrontController@getRaxbariyat');
  Route::get('/cv_form', 'CvController@index');
  Route::get('/send', 'FormController@index');
  Route::get('/getsorov', 'SearchController@sorov')->name('jsonsorov');
  Route::get('/contact', 'FormController@contact')->name('contact');
  Route::get('/video', 'VideoController@ViewVideo');
  Route::get('/photo', 'PhotoController@ViewPhoto');
  Route::get('/obuna/delete', 'FormController@deleteObune');
  Route::post('/errorpage', 'FormController@orpho');
});
### end front ###

//Clear Cache facade value:
Route::get('artisan/clear-cache', function () {
  $exitCode = \Illuminate\Support\Facades\Artisan::call('cache:clear');
  return '<h1>Cache facade value cleared</h1>';
});

//Reoptimized class loader:
Route::get('artisan/optimize', function () {
  $exitCode = \Illuminate\Support\Facades\Artisan::call('optimize');
  return '<h1>Reoptimized class loader</h1>';
});

//Route cache:
Route::get('artisan/route-cache', function () {
  $exitCode = \Illuminate\Support\Facades\Artisan::call('route:cache');
  return '<h1>Routes cached</h1>';
});

//Clear Route cache:
Route::get('artisan/route-clear', function () {
  $exitCode = \Illuminate\Support\Facades\Artisan::call('route:clear');
  return '<h1>Route cache cleared</h1>';
});

//Clear View cache:
Route::get('artisan/view-clear', function () {
  $exitCode = \Illuminate\Support\Facades\Artisan::call('view:clear');
  return '<h1>View cache cleared</h1>';
});

//Clear Config cache:
Route::get('artisan/config-cache', function () {
  $exitCode = \Illuminate\Support\Facades\Artisan::call('config:cache');
  return '<h1>Clear Config cleared</h1>';
});
