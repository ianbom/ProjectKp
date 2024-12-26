<?php

use App\Http\Controllers\Admin\ClientController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\TutorialController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\AllProjectController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\TaskController;
use App\Models\Project;
use App\Models\Tutorial;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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




// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/', 'HomeController@login')->name('home');
Route::get('/details/{id}', 'DetailController@index')->name('detail');
Route::post('/details/{id}', 'DetailController@index')->name('detail');

Route::get('/details/comments/{id}', 'DetailCommentController@index')->name('detail-comments');
Route::post('/details/comments/{id}', 'DetailCommentController@index')->name('detail-comments');

Route::get('/details/tutorials/{id}', 'DetailTutorialController@index')->name('detail-tutorial');
Route::post('/details/tutorials/{id}', 'DetailTutorialController@index')->name('detail-tutorial');

// Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

Route::get('/register/success', 'Auth\RegisterController@success')->name('register-success');

// ->middleware(['auth','admin'])

Route::prefix('admin')->middleware(['auth', 'admin'])->namespace('Admin')->group(function () {
    Route::get('/', 'DashboardController@index')->name('admin-dashboard');
    Route::resource('client', ClientController::class);
    Route::resource('client.project', ProjectController::class)->shallow();
    Route::resource('tutorial', TutorialController::class);
    Route::resource('user', UserController::class);
    ///////////////////////////////////////////////

    Route::prefix('task')->group(function (){
    Route::get('/index', [TaskController::class, 'index'])->name('task.index');
    Route::get('/index/data', [TaskController::class, 'dataTask'])->name('data.task');
    Route::get('/create', [TaskController::class, 'create'])->name('task.create');
    Route::get('/edit/{id}', [TaskController::class, 'edit'])->name('task.edit');
    Route::put('/update/{id}', [TaskController::class, 'update'])->name('task.update');
    Route::post('/store', [TaskController::class, 'store'])->name('task.store');
    Route::delete('/delete/{id}', [TaskController::class, 'delete'])->name('task.delete');
    Route::get('detail/{id}', [TaskController::class, 'detail'])->name('task.detail');
    Route::get('detail/progress/{id}', [TaskController::class, 'detailProgress'])->name(name: 'task.detail.progress');
    Route::put('update/progress/{id}', [TaskController::class, 'updateProgress'])->name('task.detail.update');
    Route::delete('delete/imageTask/{id}', [TaskController::class, 'deleteImage'])->name('image.task.delete');
    });

    Route::prefix('projects')->group(function (){
        Route::get('/all', [AllProjectController::class, 'index'])->name('admin.projects.index');
        Route::get('/data', [AllProjectController::class, 'dataProjects'])->name('projects.data');

    });

    Route::get('/user/editpassword/{id}', 'UserController@editpassword')->name('user-edit-password');
    Route::put('/user/editpassword/{id}', 'UserController@updatepassword')->name('user-edit-password');
});

Route::prefix('karyawan')->group(function (){
    Route::get('/', [KaryawanController::class, 'indexTask'])->name('karyawan.task.index');
    Route::get('/detail-task/{id}', [KaryawanController::class, 'detailTask'])->name('karyawan.task.detail');
    Route::get('/progress/create-task/{id}', [KaryawanController::class, 'createProgress'])->name('karyawan.progress.create');
    Route::post('/progress/store-task/{id}', [KaryawanController::class, 'storeProgress'])->name('karyawan.progress.store');
    Route::get('/detail/{id}/progress', [KaryawanController::class, 'detailProgress'])->name('karyawan.progress.detail');
    Route::get('/edit/progress/{id}', [KaryawanController::class, 'editProgress'])->name('karyawan.progress.edit');
    Route::put('/update/progress/{id}', [KaryawanController::class, 'updateProgress'])->name('karyawan.progress.update');
    Route::delete('/delete/image-progress/{id}', [KaryawanController::class, 'deleteImage'])->name('karyawan.imageProgress.delete');
    Route::get('detail/progress/{id}', [TaskController::class, 'detailProgress'])->name('task.detail.progress');

});

Auth::routes();
