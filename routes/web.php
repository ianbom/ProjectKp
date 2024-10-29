<?php

use App\Http\Controllers\Admin\ClientController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\TutorialController;
use App\Http\Controllers\Admin\UserController;
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
Route::get('/', 'HomeController@index')->name('home');
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
        });

    Route::get('/user/editpassword/{id}', 'UserController@editpassword')->name('user-edit-password');
    Route::put('/user/editpassword/{id}', 'UserController@updatepassword')->name('user-edit-password');
});

Auth::routes();
