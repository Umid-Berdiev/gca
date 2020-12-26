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
Route::middleware(['isAuther'])->prefix('admin')->group(function () {
  Route::get('/', 'admin\PostController@index')->name('post');

  Route::get('pages/categories', 'admin\PageCategoriesController@index')->name('page_categories');
  Route::get('pages/categories/create', 'admin\PageCategoriesController@create')->name('page_categories_create');
  Route::get('pages/categories/edit/{id}', 'admin\PageCategoriesController@edit')->name('page_categories_edit');
  Route::get('pages/categories/delete/{id}', 'admin\PageCategoriesController@destroy')->name('page_categories_delete');
  Route::post('pages/categories/store', 'admin\PageCategoriesController@store')->name('page_categories_store');
  Route::post('pages/categories/update', 'admin\PageCategoriesController@update')->name('page_categories_update');

  Route::get('pages', 'admin\PageController@index')->name('pages');
  Route::get('pages/create', 'admin\PageController@create')->name('pages_create');
  Route::get('pages/edit/{id}', 'admin\PageController@edit')->name('pages_edit');
  Route::get('pages/delete/{id}', 'admin\PageController@destroy')->name('pages_delete');
  Route::post('pages/store', 'admin\PageController@store')->name('pages_store');
  Route::post('pages/update', 'admin\PageController@update')->name('pages_update');

  Route::resource('languages', 'admin\LanguageController');
  // Route::get('language', 'admin\LanguageController@index')->name('languages');
  // Route::post('language/edit', 'admin\LanguageController@Update');
  // Route::get('language/edit', 'admin\LanguageController@UpdateShow')->name('languages_edit');
  // Route::get('language/delete', 'admin\LanguageController@Delete')->name('languages_delete');
  // Route::get('language/create', 'admin\LanguageController@Show')->name('languages_create');
  // Route::post('language/insert', 'admin\LanguageController@Insert');

  Route::resource('post-categories', 'admin\PostcategoryController');
  // Route::get('postcategory', 'admin\PostcategoryController@index')->name('post_category');
  // Route::post('postcategory/edit', 'admin\PostcategoryController@Update');
  // Route::get('postcategory/edit', 'admin\PostcategoryController@UpdateShow')->name('post_category_edit');
  // Route::get('postcategory/delete', 'admin\PostcategoryController@Delete')->name('post_category_delete');
  // Route::get('postcategory/create', 'admin\PostcategoryController@InsertShow')->name('post_category_create');
  // Route::post('postcategory/insert', 'admin\PostcategoryController@Insert');

  Route::resource('posts', 'admin\PostController');
  // Route::get('post', 'admin\PostController@index')->name('post');
  // Route::post('post/edit', 'admin\PostController@Update');
  // Route::get('post/edit', 'admin\PostController@UpdateShow')->name('post_edit');
  // Route::get('post/delete', 'admin\PostController@Delete')->name('post_delete');
  // Route::get('post/create', 'admin\PostController@InsertShow')->name('post_create');
  // Route::post('post/insert', 'admin\PostController@Insert');

  Route::resource('document-categories', 'admin\DocumentCategoryController');
  // Route::get('doccategory', 'admin\DocumentCategoryController@index')->name('doccategory');
  // Route::post('doccategory/edit', 'admin\DocumentCategoryController@Update');
  // Route::get('doccategory/edit', 'admin\DocumentCategoryController@UpdateShow')->name('doccategory_edit');
  // Route::get('doccategory/delete', 'admin\DocumentCategoryController@Delete')->name('doccategory_delete');
  // Route::get('doccategory/create', 'admin\DocumentCategoryController@InsertShow')->name('doccategory_create');
  // Route::post('doccategory/insert', 'admin\DocumentCategoryController@Insert');

  Route::get('tendercategory', 'admin\TendercategoryController@index')->name('tendercategory');
  Route::post('tendercategory/edit', 'admin\TendercategoryController@Update');
  Route::get('tendercategory/edit', 'admin\TendercategoryController@UpdateShow')->name('tendercategory_edit');
  Route::get('tendercategory/delete', 'admin\TendercategoryController@Delete')->name('tendercategory_delete');
  Route::get('tendercategory/create', 'admin\TendercategoryController@InsertShow')->name('tendercategory_create');
  Route::post('tendercategory/insert', 'admin\TendercategoryController@Insert');

  Route::resource('event-categories', 'admin\EventcategoryController');
  // Route::get('eventcategory', 'admin\EventcategoryController@index')->name('eventcategory');
  // Route::post('eventcategory/edit', 'admin\EventcategoryController@Update');
  // Route::get('eventcategory/edit', 'admin\EventcategoryController@UpdateShow')->name('eventcategory_edit');
  // Route::get('eventcategory/delete', 'admin\EventcategoryController@Delete')->name('eventcategory_delete');
  // Route::get('eventcategory/create', 'admin\EventcategoryController@InsertShow')->name('eventcategory_create');
  // Route::post('eventcategory/insert', 'admin\EventcategoryController@Insert');

  Route::resource('photo-categories', 'admin\PhotocategoryController');
  // Route::get('photocategory', 'admin\PhotocategoryController@index')->name('photocategory');
  // Route::post('photocategory/edit', 'admin\PhotocategoryController@Update');
  // Route::get('photocategory/edit', 'admin\PhotocategoryController@UpdateShow')->name('photocategory_edit');
  // Route::get('photocategory/delete', 'admin\PhotocategoryController@Delete')->name('photocategory_delete');
  // Route::get('photocategory/create', 'admin\PhotocategoryController@InsertShow')->name('photocategory_create');
  // Route::post('photocategory/insert', 'admin\PhotocategoryController@Insert');

  // Route::get('videoalbum', 'admin\VideoalbumController@index')->name('videoalbum');
  // Route::post('videoalbum/edit', 'admin\VideoalbumController@Update');
  // Route::get('videoalbum/edit', 'admin\VideoalbumController@UpdateShow')->name('videocategory_edit');
  // Route::get('videoalbum/delete', 'admin\VideoalbumController@Delete')->name('videocategory_delete');
  // Route::get('videoalbum/create', 'admin\VideoalbumController@InsertShow')->name('videocategory_create');
  // Route::post('videoalbum/insert', 'admin\VideoalbumController@Insert');

  Route::resource('events', 'admin\EventController');
  // Route::get('event', 'admin\EventController@index')->name('event');
  // Route::post('event/edit', 'admin\EventController@Update');
  // Route::get('event/edit', 'admin\EventController@UpdateShow')->name('event_edit');
  // Route::get('event/delete', 'admin\EventController@Delete')->name('event_delete');
  // Route::get('event/create', 'admin\EventController@InsertShow')->name('event_create');
  // Route::post('event/insert', 'admin\EventController@Insert');

  Route::get('tender', 'admin\TenderController@index')->name('tender');
  Route::post('tender/edit', 'admin\TenderController@Update');
  Route::get('tender/edit', 'admin\TenderController@UpdateShow')->name('tender_edit');
  Route::get('tender/delete', 'admin\TenderController@Delete')->name('tender_delete');
  Route::get('tender/create', 'admin\TenderController@InsertShow')->name('tender_create');
  Route::post('tender/insert', 'admin\TenderController@Insert');

  Route::resource('documents', 'admin\DocumentController');
  // Route::get('doc', 'admin\DocumentController@index')->name('doc');
  // Route::post('doc/edit', 'admin\DocumentController@Update');
  // Route::get('doc/edit', 'admin\DocumentController@UpdateShow')->name('doc_edit');
  // Route::get('doc/delete', 'admin\DocumentController@Delete')->name('doc_delete');
  // Route::get('doc/create', 'admin\DocumentController@InsertShow')->name('doc_create');
  // Route::post('doc/insert', 'admin\DocumentController@Insert');

  Route::resource('photos', 'admin\PhotoController');
  // Route::get('photo', 'admin\PhotoController@index')->name('photo');
  // Route::post('photo/edit', 'admin\PhotoController@Update');
  // Route::get('photo/edit', 'admin\PhotoController@UpdateShow')->name('photo_edit');
  // Route::get('photo/delete', 'admin\PhotoController@Delete')->name('photo_delete');
  // Route::get('photo/create', 'admin\PhotoController@InsertShow')->name('photo_create');
  // Route::post('photo/insert', 'admin\PhotoController@Insert');

  Route::resource('video', 'admin\VideoController');
  Route::resource('videoalbum', 'admin\VideoalbumController');

  Route::get('sorov', 'admin\SorovnomaController@index')->name('sorov');
  Route::post('sorov/edit', 'admin\SorovnomaController@Update');
  Route::get('sorov/edit', 'admin\SorovnomaController@UpdateShow')->name('sorov_edit');
  Route::get('sorov/delete', 'admin\SorovnomaController@Delete')->name('sorov_delete');
  Route::get('sorov/create', 'admin\SorovnomaController@InsertShow')->name('sorov_create');
  Route::post('sorov/insert', 'admin\SorovnomaController@Insert');

  Route::get('sorovatter', 'admin\SorovnomaatterController@index');
  Route::post('sorovatter/edit', 'admin\SorovnomaatterController@Update');
  Route::get('sorovatter/edit', 'admin\SorovnomaatterController@UpdateShow');
  Route::get('sorovatter/delete', 'admin\SorovnomaatterController@Delete');
  Route::get('sorovatter/create', 'admin\SorovnomaatterController@InsertShow');
  Route::post('sorovatter/insert', 'admin\SorovnomaatterController@Insert');

  Route::get('menu', 'MenuController@index')->name('menu');
  Route::get('contact', 'FormController@indexContact')->name('contact');
  Route::post('contact/search', 'FormController@ContactSearch');
  Route::get('cv', 'FormController@indexCV')->name('cv');
  Route::get('cv/search', 'FormController@CvSearch')->name('cv_search');
  Route::get('murojat/search', 'FormController@murojatSearch')->name('murojat_search');
  Route::get('cv/{id}', 'FormController@indexCVedit')->name('cv_edit');
  Route::post('cv_update', 'FormController@cvSave');
  Route::post('murojat_update', 'FormController@murojat_update');
  Route::get('murojat', 'FormController@indexMurojat')->name('murojat');
  Route::get('murojat/{id}', 'FormController@Murojat_edit')->name('murojat_id');
  Route::get('menu/edit', 'MenuController@editshow')->name('menu_edit');
  Route::get('menu/edits', 'MenuController@edits')->name('menu_edits');
  Route::get('menu/{id}', 'MenuController@indexx')->name('menu_id');
  Route::get('menuchange', 'MenuController@orderchange')->name('menu_change');
  Route::get('menudelete', 'MenuController@destroy')->name('menu_destroy');
  Route::post('menubuilder/insert', 'MenuController@Insert');
  Route::post('menubuilder/edit', 'MenuController@Update');

  Route::get('users', 'admin\UserController@getUsers')->name('users');
  Route::get('logout', 'admin\UserController@logout');
  Route::get('users/create', 'admin\UserController@create')->name('users_create');
  Route::get('users/show', 'admin\UserController@Show')->name('users_edit');
  Route::post('users/store', 'admin\UserController@Store');
  Route::post('users/update', 'admin\UserController@Update');
  Route::post('users/profile_update', 'admin\UserController@profile_update');
  Route::get('users/delete', 'admin\UserController@Delete');
  Route::get('users/profile', 'admin\UserController@Profile');

  Route::get('statistica', 'admin\StatisticaController@index')->name('statistica');
  Route::get('statistica/create', 'admin\StatisticaController@create')->name('statistica_create');
  Route::get('statistica/destroy', 'admin\StatisticaController@destroy');
  Route::post('statistica/store', 'admin\StatisticaController@store');

  Route::post('raxbariyat/store', 'admin\RaxbariyatController@store');
  Route::get('raxbariyat', 'admin\RaxbariyatController@index')->name('raxbariyat');
  Route::get('raxbariyat/create', 'admin\RaxbariyatController@create')->name('raxbariyat_create');
  Route::get('raxbariyat/edit', 'admin\RaxbariyatController@edit')->name('raxbariyat_edit');
  Route::post('raxbariyat/update', 'admin\RaxbariyatController@update');
  Route::get('raxbariyat/delete', 'admin\RaxbariyatController@destroy');

  Route::get('links/categories', 'admin\LinksController@indexCategories')->name('links_categories');
  Route::get('links/categories/create', 'admin\LinksController@createCategories')->name('links_categories_create');
  Route::get('links/categories/edit', 'admin\LinksController@editCategories')->name('links_categories_edit');
  Route::get('links/categories/delete', 'admin\LinksController@categories_destroy');
  Route::post('links/categories/store', 'admin\LinksController@categories_store');
  Route::post('links/categories/update', 'admin\LinksController@categories_update');

  Route::get('links', 'admin\LinksController@index')->name('links');
  Route::get('links/create', 'admin\LinksController@create')->name('links_create');
  Route::post('links/store', 'admin\LinksController@store');
  Route::get('links/edit', 'admin\LinksController@edit')->name('links_edit');
  Route::post('links/update', 'admin\LinksController@update');
  Route::get('links/delete', 'admin\LinksController@destroy');

  Route::get('years', 'admin\YearsController@index')->name('years');
  Route::get('years/create', 'admin\YearsController@create')->name('years_create');
  Route::get('years/edit', 'admin\YearsController@edit')->name('years_edit');
  Route::post('years/store', 'admin\YearsController@store');
  Route::post('years/update', 'admin\YearsController@update');
  Route::get('years/delete', 'admin\YearsController@destroy');

  Route::prefix('gcainfo')->group(function () {
    Route::get('/', 'admin\GcaInfoController@index')->name('gca.info.index');
    Route::get('edit/{id}', 'admin\GcaInfoController@edit')->name('gca.info.edit');
    Route::get('get', 'admin\GcaInfoController@get')->name('gca.info.get');
    Route::post('update', 'admin\GcaInfoController@update');
  });

  Route::get('translate', function () {
    return view('admin/translate');
  })->name('translate');
  Route::post('translate', 'SitemapController@translate')->name('murojat_id');
  Route::post('translate_footer', 'SitemapController@translate_footer')->name('murojat_xxx');
  Route::post('translate_svg', 'SitemapController@translate_svg')->name('murojat_xx');
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
