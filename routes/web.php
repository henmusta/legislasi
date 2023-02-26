<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Backend as Backend;
use App\Http\Controllers\Frontend as Frontend;

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

Route::get('/foo', function () {
    Artisan::call('storage:link');
 });

Route::get('/clear-cache', function() {
    $exitCode = Artisan::call('cache:clear');
    return '<h1>Cache facade value cleared</h1>';
});

//Reoptimized class loader:
Route::get('/optimize', function() {
    $exitCode = Artisan::call('optimize');
    return '<h1>Reoptimized class loader</h1>';
});

//Route cache:
Route::get('/route-cache', function() {
    $exitCode = Artisan::call('route:cache');
    return '<h1>Routes cached</h1>';
});

//Clear Route cache:
Route::get('/route-clear', function() {
    $exitCode = Artisan::call('route:clear');
    return '<h1>Route cache cleared</h1>';
});

//Clear View cache:
Route::get('/view-clear', function() {
    $exitCode = Artisan::call('view:clear');
    return '<h1>View cache cleared</h1>';
});

Route::get('/', [Frontend\HomeController::class,  'index'])->name('index');
Route::resource('/home', Frontend\HomeController::class);
Route::get('e-legislasi/countlegislasi', [Frontend\FrontendLegislasiController::class, 'countlegislasi'])->name('e-legislasi.countlegislasi');
Route::resource('/e-legislasi', Frontend\FrontendLegislasiController::class);
Route::resource('/e-aspirasi', Frontend\FrontendAspirasiController::class);
Route::resource('/e-survey', Frontend\FrontendSurveyController::class);
// Route::resource('/e-pages/{id}', Frontend\FrontendPagesController::class);
Route::get('/e-pages/{name}', [Frontend\FrontendPagesController::class, 'index'])->name('e-pages.index');
// Route::get('/', function () {
//     return redirect()->route('backend.login');
//   });

  Route::get('logout', [LoginController::class, 'logout'])->name('logout');
  Route::prefix('backend')->name('backend.')->group(function () {
      Route::get('/', [LoginController::class, 'showLoginForm']);
      Route::post('/', [LoginController::class, 'login'])->name('login');
  });

Route::get('/event',function(){
  broadcast(new ChatEvent());
   broadcast(new NotificationChatEvent());
});

Route::get('/websocket', function() {
    Artisan::call('websockets:serve');
    return 'Configuration cache cleared!';
});
Route::get('backend/pengusul/select2', [Backend\PengusulController::class, 'select2'])->name('backend.pengusul.select2');
Route::get('backend/tahapanlegislasi/select2', [Backend\TahapanLegislasiController::class, 'select2'])->name('backend.tahapanlegislasi.select2');
Route::get('backend/kabupaten/select2', [Backend\KabupatenController::class, 'select2'])->name('backend.kabupaten.select2');
Route::get('backend/kecamatan/select2', [Backend\KecamatanController::class, 'select2'])->name('backend.kecamatan.select2');
Route::get('backend/dewan/select2', [Backend\DewanController::class, 'select2'])->name('backend.dewan.select2');
Route::get('backend/skpd/select2', [Backend\SkpdController::class, 'select2'])->name('backend.skpd.select2');
Route::middleware('auth:henmus')->group(function(){
  Route::prefix('backend')->name('backend.')->group(function(){
    Route::get('dashboard/countdashboard', [Backend\DashboardController::class, 'countdashboard'])->name('dashboard.countdashboard');
    Route::get('dashboard', [Backend\DashboardController::class, 'index'])->name('index');
    Route::post('resetpassword', [Backend\UserController::class, 'resetpassword'])->name('users.resetpassword');
    Route::post('changepassword', [Backend\UserController::class, 'changepassword'])->name('users.changepassword');
    Route::get('users/select2', [Backend\UserController::class, 'select2'])->name('users.select2');
    Route::post('users/import', [Backend\UserController::class, 'import'])->name('users.import');
    Route::resource('users', Backend\UserController::class);
    Route::get('roles/select2', [Backend\RoleController::class, 'select2'])->name('roles.select2');
    Route::resource('roles', Backend\RoleController::class);
    Route::resource('permissions', Backend\PermissionController::class);
    Route::get('menupermissions/select2', [Backend\MenuPermissionController::class, 'select2'])->name('menupermissions.select2');
    Route::resource('menupermissions', Backend\MenuPermissionController::class)->except('create', 'edit', 'show');
    Route::resource('menu', Backend\MenuManagerController::class)->except('create', 'show');
    Route::post('menu/changeHierarchy', [Backend\MenuManagerController::class, 'changeHierarchy'])->name('menu.changeHierarchy');
    Route::resource('settings', Backend\SettingsController::class);
    Route::resource('settingsfront', Backend\FrontendSettingsController::class);


          //provinsi
          Route::get('provinsi/select2', [Backend\ProvinsiController::class, 'select2'])->name('provinsi.select2');
          Route::resource('provinsi', Backend\ProvinsiController::class);
          //kabupaten

          Route::resource('kabupaten', Backend\KabupatenController::class);
          //kecamatan

          Route::resource('kecamatan', Backend\KecamatanController::class);
          //jabatan
          Route::get('jabatan/select2', [Backend\JabatanController::class, 'select2'])->name('jabatan.select2');
          Route::resource('jabatan', Backend\JabatanController::class);

          //kategoriranperda
          Route::get('kategoriranperda/select2', [Backend\KategoriRanperdaController::class, 'select2'])->name('kategoriranperda.select2');
          Route::resource('kategoriranperda', Backend\KategoriRanperdaController::class);


          //kategorisurvey
          Route::get('kategorisurvey/select2', [Backend\KategoriSurveyController::class, 'select2'])->name('kategorisurvey.select2');
          Route::resource('kategorisurvey', Backend\KategoriSurveyController::class);

          //pengusul

          Route::resource('pengusul', Backend\PengusulController::class);

          //dewan

          Route::resource('dewan', Backend\DewanController::class);

          //skpd

          Route::resource('skpd', Backend\SkpdController::class);

          //statuslegislasi

          Route::resource('tahapanlegislasi', Backend\TahapanLegislasiController::class);


          //legislasi
          Route::put('kegislasi/validasi', [Backend\LegislasiController::class, 'validasi'])->name('legislasi.validasi');
          Route::get('legislasi/select2', [Backend\LegislasiController::class, 'select2'])->name('legislasi.select2');
          Route::resource('legislasi', Backend\LegislasiController::class);

          //agenda
          Route::resource('agenda', Backend\AgendaController::class);

          //aspirasi
          Route::resource('aspirasi', Backend\AspirasiController::class);

          //sliderimage
          Route::resource('imageslider', Backend\SliderImageController::class);

          //formaspirasi
          Route::resource('formaspirasi', Backend\FormAspirasiController::class);

          //feedbacck
          Route::resource('feedback', Backend\CommentController::class);

          //survey
          Route::put('survey/validasi', [Backend\SurveyController::class, 'validasi'])->name('survey.validasi');
          Route::get('survey/select2', [Backend\SurveyController::class, 'select2'])->name('survey.select2');
          Route::resource('survey', Backend\SurveyController::class);


          //question
          Route::resource('question', Backend\QuestionController::class);

          //question
          Route::resource('partisipan', Backend\ParticipantsController::class);

          //question
          Route::resource('page', Backend\PagesController::class);

          //question
          Route::get('laporansurvey/countsurvey', [Backend\LaporanSurveyController::class, 'countsurvey'])->name('laporansurvey.countsurvey');
          Route::resource('laporansurvey', Backend\LaporanSurveyController::class);

            //question
          Route::get('laporanaspirasi/countaspirasi', [Backend\LaporanAspirasiController::class, 'countaspirasi'])->name('laporanaspirasi.countaspirasi');
          Route::resource('laporanaspirasi', Backend\LaporanAspirasiController::class);

          //question
          Route::get('laporanlegislasi/countlegislasi', [Backend\LaporanLegislasiController::class, 'countlegislasi'])->name('laporanlegislasi.countlegislasi');
          Route::resource('laporanlegislasi', Backend\LaporanLegislasiController::class);

        //   //question
        //   Route::resource('laporanaspirasi', Backend\LaporanLegislasiController::class);

  });
});
