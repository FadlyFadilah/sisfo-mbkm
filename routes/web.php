<?php

use App\Http\Controllers\Admin\RekapitulasiDataController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/login');
Route::get('/home', function () {
    if (session('status')) {
        return redirect()->route('admin.home')->with('status', session('status'));
    }

    return redirect()->route('admin.home');
});
Route::get('/migrate', function () {
    Artisan::call('migrate');
    return 'migrated!';
});
Route::get('/storage-link', function () {
    Artisan::call('storage:link');
    return 'linked!';
});
Route::get('/seed', function () {
    Artisan::call('db:seed');
    return 'seeded!';
});

Auth::routes();

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {
    
    Route::get('/', 'HomeController@index')->name('home');
    Route::get('/chart', 'HomeController@chart')->name('chart');
    Route::get('/chartbar', 'HomeController@chartbar');
    Route::get('/chartbarprodi', 'HomeController@chartMahasiswaByProdi');
    Route::get('/details/{nama}', 'HomeController@detail')->name('home.details');
    Route::get('/details/{nama}/{prodi}', 'HomeController@show')->name('home.show');
    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::resource('users', 'UsersController');

    // Prodi
    Route::delete('prodis/destroy', 'ProdiController@massDestroy')->name('prodis.massDestroy');
    Route::resource('prodis', 'ProdiController');

    // Periode
    Route::delete('periodes/destroy', 'PeriodeController@massDestroy')->name('periodes.massDestroy');
    Route::resource('periodes', 'PeriodeController');

    // Program
    Route::delete('programs/destroy', 'ProgramController@massDestroy')->name('programs.massDestroy');
    Route::resource('programs', 'ProgramController');
    
    // Mahasiswa
    Route::delete('mahasiswas/destroy', 'MahasiswaController@massDestroy')->name('mahasiswas.massDestroy');
    Route::resource('mahasiswas', 'MahasiswaController');
    Route::post('mahasiswa', 'MahasiswaController@index')->name('mahasiswa.index');
    // Pengajuan
    Route::delete('pengajuans/destroy', 'PengajuanController@massDestroy')->name('pengajuans.massDestroy');
    Route::patch('pengajuans/verif/{pengajuan}', 'PengajuanController@verif')->name('pengajuans.verif');
    Route::resource('pengajuans', 'PengajuanController');
    
    // Laporan
    Route::delete('laporans/destroy', 'LaporanController@massDestroy')->name('laporans.massDestroy');
    Route::post('laporans/media', 'LaporanController@storeMedia')->name('laporans.storeMedia');
    Route::post('laporans/ckmedia', 'LaporanController@storeCKEditorImages')->name('laporans.storeCKEditorImages');
    Route::resource('laporans', 'LaporanController');

    // Rekapitulasi Data
    Route::resource('rekapitulasi-datas', 'RekapitulasiDataController');
    Route::post('export/full', [RekapitulasiDataController::class, 'export'])->name('export.full');
});
Route::group(['prefix' => 'profile', 'as' => 'profile.', 'namespace' => 'Auth', 'middleware' => ['auth']], function () {
    // Change password
    if (file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php'))) {
        Route::get('password', 'ChangePasswordController@edit')->name('password.edit');
        Route::post('password', 'ChangePasswordController@update')->name('password.update');
        Route::post('profile', 'ChangePasswordController@updateProfile')->name('password.updateProfile');
        Route::post('profile/destroy', 'ChangePasswordController@destroy')->name('password.destroyProfile');
    }
});
Route::group(['as' => 'frontend.', 'namespace' => 'Frontend', 'middleware' => ['auth']], function () {
    
    Route::get('password', 'ChangePasswordUserController@edit')->name('password.edit');
    Route::post('password', 'ChangePasswordUserController@update')->name('password.update');
    Route::post('profile', 'ChangePasswordUserController@updateProfile')->name('password.updateProfile');
    Route::post('profile/destroy', 'ChangePasswordUserController@destroy')->name('password.destroyProfile');
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/chart', 'HomeController@Chart');
    // Route::get('/chartbar', 'HomeController@chartbar');

    // Mahasiswa
    Route::resource('mahasiswas', 'MahasiswaController');

    // Pengajuan
    Route::resource('pengajuans', 'PengajuanController');

    // Laporan
    Route::delete('laporans/destroy', 'LaporanController@massDestroy')->name('laporans.massDestroy');
    Route::post('laporans/media', 'LaporanController@storeMedia')->name('laporans.storeMedia');
    Route::post('laporans/ckmedia', 'LaporanController@storeCKEditorImages')->name('laporans.storeCKEditorImages');
    Route::resource('laporans', 'LaporanController');

    Route::get('frontend/profile', 'ProfileController@index')->name('profile.index');
    Route::post('frontend/profile', 'ProfileController@update')->name('profile.update');
    Route::post('frontend/profile/destroy', 'ProfileController@destroy')->name('profile.destroy');
    Route::post('frontend/profile/password', 'ProfileController@password')->name('profile.password');
});