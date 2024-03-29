<?php

use App\Http\Controllers\ProjectTasksController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectsController;
use App\Http\Controllers\ProjectInvitationsController;


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


Route::group(['middleware' => 'auth'], function (){
//    Route::post('/projects', [ProjectsController::class, 'store']);
//    Route::get('/projects/create', [ProjectsController::class, 'create']);
//    Route::get('/projects', [ProjectsController::class, 'index']);
//    Route::get('/projects/{project}', [ProjectsController::class, 'show']);
//    Route::delete('/projects/{project}', [ProjectsController::class, 'destroy']);
//    Route::get('/projects/{project}/edit', [ProjectsController::class, 'edit']);
//    Route::patch('/projects/{project}', [ProjectsController::class, 'update']);

    Route::resource('projects', ProjectsController::class);

    Route::post('/projects/{project}/tasks', [ProjectTasksController::class, 'store']);
    Route::patch('/projects/{project}/tasks/{task}', [ProjectTasksController::class, 'update']);

    Route::post('/projects/{project}/invitations', [ProjectInvitationsController::class, 'store']);


    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/test', function (){
        return view('projects.test');
    });
});




Route::get('/', function () {
    return view('welcome');
});

Auth::routes();


