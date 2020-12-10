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




Auth::routes([
  'register' => false, // Registration Routes...
  'reset' => false, // Password Reset Routes...
  'verify' => false, // Email Verification Routes...
]);
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
})
  ->where('filename', '[A-Za-z0-9\-\_\.]+');
#### front ##

Route::get('/', function () {
  return redirect("/uz");
});
Route::get('locale/{locale}', function ($locale) {
  Session::put('locale', $locale);
  return redirect()->back();
});


###admin routes
Route::group(['middleware' => ['ipcheck'], 'prefix' => 'admin'], function () {
  Route::get('/', 'admin\PostController@index')->name('post')->middleware(['auth', 'isAuther']);

  Route::get('pages/categories/', 'admin\PageCategoriesController@index')->name('page_categories')->middleware(['auth', 'isAuther']);
  Route::get('pages/categories/create', 'admin\PageCategoriesController@create')->name('page_categories_create')->middleware(['auth', 'isAuther']);
  Route::get('pages/categories/edit/{id}', 'admin\PageCategoriesController@edit')->name('page_categories_edit')->middleware(['auth', 'isAuther']);
  Route::get('pages/categories/delete/{id}', 'admin\PageCategoriesController@destroy')->name('page_categories_delete')->middleware(['auth', 'isAuther']);
  Route::post('pages/categories/store', 'admin\PageCategoriesController@store')->name('page_categories_store')->middleware(['auth', 'isAuther']);
  Route::post('pages/categories/update', 'admin\PageCategoriesController@update')->name('page_categories_update')->middleware(['auth', 'isAuther']);


  Route::get('pages/', 'admin\PageController@index')->name('pages')->middleware(['auth', 'isAuther']);
  Route::get('pages/create', 'admin\PageController@create')->name('pages_create')->middleware(['auth', 'isAuther']);
  Route::get('pages/edit/{id}', 'admin\PageController@edit')->name('pages_edit')->middleware(['auth', 'isAuther']);
  Route::get('pages/delete/{id}', 'admin\PageController@destroy')->name('pages_delete')->middleware(['auth', 'isAuther']);
  Route::post('pages/store', 'admin\PageController@store')->name('pages_store')->middleware(['auth', 'isAuther']);
  Route::post('pages/update', 'admin\PageController@update')->name('pages_update')->middleware(['auth', 'isAuther']);


  Route::get('language', 'admin\LanguageController@index')->name('languages')->middleware(['auth', 'isAdmin']);
  Route::post('language/edit', 'admin\LanguageController@Update')->middleware(['auth', 'isAdmin']);
  Route::get('language/edit', 'admin\LanguageController@UpdateShow')->name('languages_edit')->middleware(['auth', 'isAdmin']);
  Route::get('language/delete', 'admin\LanguageController@Delete')->name('languages_delete')->middleware(['auth', 'isAdmin']);
  Route::get('language/create', 'admin\LanguageController@Show')->name('languages_create')->middleware(['auth', 'isAdmin']);
  Route::post('language/insert', 'admin\LanguageController@Insert')->middleware(['auth', 'isAdmin']);


  Route::get('postcategory', 'admin\PostcategoryController@index')->name('post_category')->middleware(['auth', 'isAuther']);
  Route::post('postcategory/edit', 'admin\PostcategoryController@Update');
  Route::get('postcategory/edit', 'admin\PostcategoryController@UpdateShow')->name('post_category_edit')->middleware(['auth', 'isAuther']);
  Route::get('postcategory/delete', 'admin\PostcategoryController@Delete')->name('post_category_delete')->middleware(['auth', 'isAuther']);
  Route::get('postcategory/create', 'admin\PostcategoryController@InsertShow')->name('post_category_create')->middleware(['auth', 'isAuther']);
  Route::post('postcategory/insert', 'admin\PostcategoryController@Insert');

  Route::get('post', 'admin\PostController@index')->name('post')->middleware(['auth', 'isAuther']);
  Route::post('post/edit', 'admin\PostController@Update')->middleware(['auth', 'isAuther']);
  Route::get('post/edit', 'admin\PostController@UpdateShow')->name('post_edit')->middleware(['auth', 'isAuther']);
  Route::get('post/delete', 'admin\PostController@Delete')->name('post_delete')->middleware(['auth', 'isAuther']);
  Route::get('post/create', 'admin\PostController@InsertShow')->name('post_create')->middleware(['auth', 'isAuther']);
  Route::post('post/insert', 'admin\PostController@Insert');


  Route::get('doccategory', 'admin\DocumentCategoryController@index')->name('doccategory')->middleware(['auth', 'isAuther']);
  Route::post('doccategory/edit', 'admin\DocumentCategoryController@Update')->middleware(['auth', 'isAuther']);
  Route::get('doccategory/edit', 'admin\DocumentCategoryController@UpdateShow')->name('doccategory_edit')->middleware(['auth', 'isAuther']);
  Route::get('doccategory/delete', 'admin\DocumentCategoryController@Delete')->name('doccategory_delete')->middleware(['auth', 'isAuther']);
  Route::get('doccategory/create', 'admin\DocumentCategoryController@InsertShow')->name('doccategory_create')->middleware(['auth', 'isAuther']);
  Route::post('doccategory/insert', 'admin\DocumentCategoryController@Insert')->middleware(['auth', 'isAuther']);


  Route::get('tendercategory', 'admin\TendercategoryController@index')->name('tendercategory')->middleware(['auth', 'isAuther']);
  Route::post('tendercategory/edit', 'admin\TendercategoryController@Update')->middleware(['auth', 'isAuther']);
  Route::get('tendercategory/edit', 'admin\TendercategoryController@UpdateShow')->name('tendercategory_edit')->middleware(['auth', 'isAuther']);
  Route::get('tendercategory/delete', 'admin\TendercategoryController@Delete')->name('tendercategory_delete')->middleware(['auth', 'isAuther']);
  Route::get('tendercategory/create', 'admin\TendercategoryController@InsertShow')->name('tendercategory_create')->middleware(['auth', 'isAuther']);
  Route::post('tendercategory/insert', 'admin\TendercategoryController@Insert');


  Route::get('eventcategory', 'admin\EventcategoryController@index')->name('eventcategory')->middleware(['auth', 'isAuther']);
  Route::post('eventcategory/edit', 'admin\EventcategoryController@Update')->middleware(['auth', 'isAuther']);
  Route::get('eventcategory/edit', 'admin\EventcategoryController@UpdateShow')->name('eventcategory_edit')->middleware(['auth', 'isAuther']);
  Route::get('eventcategory/delete', 'admin\EventcategoryController@Delete')->name('eventcategory_delete')->middleware(['auth', 'isAuther']);
  Route::get('eventcategory/create', 'admin\EventcategoryController@InsertShow')->name('eventcategory_create')->middleware(['auth', 'isAuther']);
  Route::post('eventcategory/insert', 'admin\EventcategoryController@Insert')->middleware(['auth', 'isAuther']);

  Route::get('photocategory', 'admin\PhotocategoryController@index')->name('photocategory')->middleware(['auth', 'isAuther']);
  Route::post('photocategory/edit', 'admin\PhotocategoryController@Update')->middleware(['auth', 'isAuther']);
  Route::get('photocategory/edit', 'admin\PhotocategoryController@UpdateShow')->name('photocategory_edit')->middleware(['auth', 'isAuther']);
  Route::get('photocategory/delete', 'admin\PhotocategoryController@Delete')->name('photocategory_delete')->middleware(['auth', 'isAuther']);
  Route::get('photocategory/create', 'admin\PhotocategoryController@InsertShow')->name('photocategory_create')->middleware(['auth', 'isAuther']);
  Route::post('photocategory/insert', 'admin\PhotocategoryController@Insert')->middleware(['auth', 'isAuther']);

  Route::get('videoalbum', 'admin\VideoalbumController@index')->name('videoalbum')->middleware(['auth', 'isAuther']);
  Route::post('videoalbum/edit', 'admin\VideoalbumController@Update')->middleware(['auth', 'isAuther']);
  Route::get('videoalbum/edit', 'admin\VideoalbumController@UpdateShow')->name('videocategory_edit')->middleware(['auth', 'isAuther']);
  Route::get('videoalbum/delete', 'admin\VideoalbumController@Delete')->name('videocategory_delete')->middleware(['auth', 'isAuther']);
  Route::get('videoalbum/create', 'admin\VideoalbumController@InsertShow')->name('videocategory_create')->middleware(['auth', 'isAuther']);
  Route::post('videoalbum/insert', 'admin\VideoalbumController@Insert')->middleware(['auth', 'isAuther']);

  Route::get('event', 'admin\EventController@index')->name('event')->middleware(['auth', 'isAuther']);
  Route::post('event/edit', 'admin\EventController@Update')->middleware(['auth', 'isAuther']);
  Route::get('event/edit', 'admin\EventController@UpdateShow')->name('event_edit')->middleware(['auth', 'isAuther']);
  Route::get('event/delete', 'admin\EventController@Delete')->name('event_delete')->middleware(['auth', 'isAuther']);
  Route::get('event/create', 'admin\EventController@InsertShow')->name('event_create')->middleware(['auth', 'isAuther']);
  Route::post('event/insert', 'admin\EventController@Insert')->middleware(['auth', 'isAuther']);


  Route::get('tender', 'admin\TenderController@index')->name('tender')->middleware(['auth', 'isAuther']);
  Route::post('tender/edit', 'admin\TenderController@Update')->middleware(['auth', 'isAuther']);
  Route::get('tender/edit', 'admin\TenderController@UpdateShow')->name('tender_edit')->middleware(['auth', 'isAuther']);
  Route::get('tender/delete', 'admin\TenderController@Delete')->name('tender_delete')->middleware(['auth', 'isAuther']);
  Route::get('tender/create', 'admin\TenderController@InsertShow')->name('tender_create')->middleware(['auth', 'isAuther']);
  Route::post('tender/insert', 'admin\TenderController@Insert')->middleware(['auth', 'isAuther']);


  Route::get('doc', 'admin\DocumentController@index')->name('doc')->middleware(['auth', 'isAuther']);
  Route::post('doc/edit', 'admin\DocumentController@Update')->middleware(['auth', 'isAuther']);
  Route::get('doc/edit', 'admin\DocumentController@UpdateShow')->name('doc_edit')->middleware(['auth', 'isAuther']);
  Route::get('doc/delete', 'admin\DocumentController@Delete')->name('doc_delete')->middleware(['auth', 'isAuther']);
  Route::get('doc/create', 'admin\DocumentController@InsertShow')->name('doc_create')->middleware(['auth', 'isAuther']);
  Route::post('doc/insert', 'admin\DocumentController@Insert')->middleware(['auth', 'isAuther']);

  Route::get('photo', 'admin\PhotoController@index')->name('photo')->middleware(['auth', 'isAuther']);
  Route::post('photo/edit', 'admin\PhotoController@Update')->middleware(['auth', 'isAuther']);
  Route::get('photo/edit', 'admin\PhotoController@UpdateShow')->name('photo_edit')->middleware(['auth', 'isAuther']);
  Route::get('photo/delete', 'admin\PhotoController@Delete')->name('photo_delete')->middleware(['auth', 'isAuther']);
  Route::get('photo/create', 'admin\PhotoController@InsertShow')->name('photo_create')->middleware(['auth', 'isAuther']);
  Route::post('photo/insert', 'admin\PhotoController@Insert')->middleware(['auth', 'isAuther']);


  Route::get('video', 'admin\VideoController@index')->name('video')->middleware(['auth', 'isAuther']);
  Route::post('video/edit', 'admin\VideoController@Update')->middleware(['auth', 'isAuther']);
  Route::get('video/edit', 'admin\VideoController@UpdateShow')->name('video_edit')->middleware(['auth', 'isAuther']);
  Route::get('video/delete', 'admin\VideoController@Delete')->name('video_delete')->middleware(['auth', 'isAuther']);
  Route::get('video/create', 'admin\VideoController@InsertShow')->name('video_create')->middleware(['auth', 'isAuther']);
  Route::post('video/insert', 'admin\VideoController@Insert')->middleware(['auth', 'isAuther']);


  Route::get('sorov', 'admin\SorovnomaController@index')->name('sorov')->middleware(['auth', 'isAuther']);

  Route::post('sorov/edit', 'admin\SorovnomaController@Update')->middleware(['auth', 'isAuther']);
  Route::get('sorov/edit', 'admin\SorovnomaController@UpdateShow')->name('sorov_edit')->middleware(['auth', 'isAuther']);
  Route::get('sorov/delete', 'admin\SorovnomaController@Delete')->name('sorov_delete')->middleware(['auth', 'isAuther']);
  Route::get('sorov/create', 'admin\SorovnomaController@InsertShow')->name('sorov_create')->middleware(['auth', 'isAuther']);
  Route::post('sorov/insert', 'admin\SorovnomaController@Insert')->middleware(['auth', 'isAuther']);


  Route::get('sorovatter', 'admin\SorovnomaatterController@index')->middleware(['auth', 'isAuther']);

  Route::post('sorovatter/edit', 'admin\SorovnomaatterController@Update')->middleware(['auth', 'isAuther']);
  Route::get('sorovatter/edit', 'admin\SorovnomaatterController@UpdateShow')->middleware(['auth', 'isAuther']);
  Route::get('sorovatter/delete', 'admin\SorovnomaatterController@Delete')->middleware(['auth', 'isAuther']);
  Route::get('sorovatter/create', 'admin\SorovnomaatterController@InsertShow')->middleware(['auth', 'isAuther']);
  Route::post('sorovatter/insert', 'admin\SorovnomaatterController@Insert')->middleware(['auth', 'isAuther']);

  Route::get('menu', 'MenuController@index')->name('menu')->middleware(['auth', 'isAuther']);
  Route::get('contact', 'FormController@indexContact')->name('contact')->middleware(['auth', 'isAuther']);
  Route::post('contact/search', 'FormController@ContactSearch')->middleware(['auth', 'isAuther']);
  Route::get('cv', 'FormController@indexCV')->name('cv')->middleware(['auth', 'isAuther']);
  Route::get('cv/search', 'FormController@CvSearch')->name('cv_search')->middleware(['auth', 'isAuther']);
  Route::get('murojat/search', 'FormController@murojatSearch')->name('murojat_search')->middleware(['auth', 'isAuther']);
  Route::get('cv/{id}', 'FormController@indexCVedit')->name('cv_edit')->middleware(['auth', 'isAuther']);
  Route::post('cv_update', 'FormController@cvSave')->middleware(['auth', 'isAuther']);
  Route::post('murojat_update', 'FormController@murojat_update')->middleware(['auth', 'isAuther']);
  Route::get('murojat', 'FormController@indexMurojat')->name('murojat')->middleware(['auth', 'isAuther']);
  Route::get('murojat/{id}', 'FormController@Murojat_edit')->name('murojat_id')->middleware(['auth', 'isAuther']);
  Route::get('menu/edit', 'MenuController@editshow')->name('menu_edit')->middleware(['auth', 'isAdmin']);
  Route::get('menu/edits', 'MenuController@edits')->name('menu_edits')->middleware(['auth', 'isAdmin']);
  Route::get('menu/{id}', 'MenuController@indexx')->name('menu_id')->middleware(['auth', 'isAdmin']);
  Route::get('menuchange', 'MenuController@orderchange')->name('menu_change')->middleware(['auth', 'isAdmin']);
  Route::get('menudelete', 'MenuController@destroy')->name('menu_destroy')->middleware(['auth', 'isAdmin']);
  Route::post('menubuilder/insert', 'MenuController@Insert')->middleware(['auth', 'isAdmin']);
  Route::post('menubuilder/edit', 'MenuController@Update')->middleware(['auth', 'isAdmin']);


  Route::get('users/', 'admin\UserController@getUsers')->name('users')->middleware(['auth', 'isAdmin']);
  Route::get('logout', 'admin\UserController@logout')->middleware(['auth']);
  Route::get('users/create', 'admin\UserController@create')->name('users_create')->middleware(['auth', 'isAdmin']);
  Route::get('users/show', 'admin\UserController@Show')->name('users_edit')->middleware(['auth', 'isAdmin']);
  Route::post('users/store', 'admin\UserController@Store')->middleware(['auth', 'isAdmin']);
  Route::post('users/update', 'admin\UserController@Update')->middleware(['auth', 'isAdmin']);
  Route::post('users/profile_update', 'admin\UserController@profile_update')->middleware(['auth']);
  Route::get('users/delete', 'admin\UserController@Delete')->middleware(['auth', 'isAdmin']);
  Route::get('users/profile', 'admin\UserController@Profile')->middleware(['auth', 'isAuther']);


  Route::get('statistica/', 'admin\StatisticaController@index')->name('statistica')->middleware(['auth', 'isAuther']);
  Route::get('statistica/create', 'admin\StatisticaController@create')->name('statistica_create')->middleware(['auth', 'isAuther']);
  Route::get('statistica/destroy', 'admin\StatisticaController@destroy')->middleware(['auth', 'isAuther']);
  Route::post('statistica/store', 'admin\StatisticaController@store')->middleware(['auth', 'isAuther']);

  Route::post('raxbariyat/store', 'admin\RaxbariyatController@store')->middleware(['auth', 'isAuther']);
  Route::get('raxbariyat/', 'admin\RaxbariyatController@index')->name('raxbariyat')->middleware(['auth', 'isAuther']);
  Route::get('raxbariyat/create', 'admin\RaxbariyatController@create')->name('raxbariyat_create')->middleware(['auth', 'isAuther']);
  Route::get('raxbariyat/edit', 'admin\RaxbariyatController@edit')->name('raxbariyat_edit')->middleware(['auth', 'isAuther']);
  Route::post('raxbariyat/update', 'admin\RaxbariyatController@update')->middleware(['auth', 'isAuther']);
  Route::get('raxbariyat/delete', 'admin\RaxbariyatController@destroy')->middleware(['auth', 'isAuther']);

  Route::get('links/categories/', 'admin\LinksController@indexCategories')->name('links_categories')->middleware(['auth', 'isAuther']);
  Route::get('links/categories/create', 'admin\LinksController@createCategories')->name('links_categories_create')->middleware(['auth', 'isAuther']);
  Route::get('links/categories/edit', 'admin\LinksController@editCategories')->name('links_categories_edit')->middleware(['auth', 'isAuther']);
  Route::get('links/categories/delete', 'admin\LinksController@categories_destroy')->middleware(['auth', 'isAuther']);
  Route::post('links/categories/store', 'admin\LinksController@categories_store')->middleware(['auth', 'isAuther']);
  Route::post('links/categories/update', 'admin\LinksController@categories_update')->middleware(['auth', 'isAuther']);


  Route::get('links/', 'admin\LinksController@index')->name('links')->middleware(['auth', 'isAuther']);
  Route::get('links/create', 'admin\LinksController@create')->name('links_create')->middleware(['auth', 'isAuther']);
  Route::post('links/store', 'admin\LinksController@store')->middleware(['auth', 'isAuther']);
  Route::get('links/edit', 'admin\LinksController@edit')->name('links_edit')->middleware(['auth', 'isAuther']);
  Route::post('links/update', 'admin\LinksController@update')->middleware(['auth', 'isAuther']);
  Route::get('links/delete', 'admin\LinksController@destroy')->middleware(['auth', 'isAuther']);


  Route::get('years/', 'admin\YearsController@index')->name('years')->middleware(['auth', 'isAuther']);
  Route::get('years/create', 'admin\YearsController@create')->name('years_create')->middleware(['auth', 'isAuther']);
  Route::get('years/edit', 'admin\YearsController@edit')->name('years_edit')->middleware(['auth', 'isAuther']);
  Route::post('years/store', 'admin\YearsController@store')->middleware(['auth', 'isAuther']);
  Route::post('years/update', 'admin\YearsController@update')->middleware(['auth', 'isAuther']);
  Route::get('years/delete', 'admin\YearsController@destroy')->middleware(['auth', 'isAuther']);

  Route::get('translate', function () {
    return view('admin/translate');
  })->name('translate')->middleware(['auth', 'isAuther']);
  Route::post('translate', 'SitemapController@translate')->name('murojat_id')->middleware(['auth', 'isAuther']);
  Route::post('translate_footer', 'SitemapController@translate_footer')->name('murojat_xxx')->middleware(['auth', 'isAuther']);
  Route::post('translate_svg', 'SitemapController@translate_svg')->name('murojat_xx')->middleware(['auth', 'isAuther']);
  ### end admin routes
});
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
  Route::get('/contact', 'FormController@contact');
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
