<?php

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

Route::get('/home', function () {
    return redirect()->route('admin.general');
    // return redirect('/Admin/Project');
});
Route::get('/home'     , [App\Http\Controllers\Admin\AdminController::class, 'project']);

Auth::routes();

Route::get('/'         , [App\Http\Controllers\Main\MainController::class, 'home'])      ->name('home');
Route::get('/About'    , [App\Http\Controllers\Main\MainController::class, 'about'])     ->name('about');
Route::get('/Clients'  , [App\Http\Controllers\Main\MainController::class, 'clients'])   ->name('clients');
Route::get('/Contact'  , [App\Http\Controllers\Main\MainController::class, 'contact'])   ->name('contact');
Route::get('/CopyRight', [App\Http\Controllers\Main\MainController::class, 'copyright']) ->name('copyright');
Route::get('/Project'  , [App\Http\Controllers\Main\MainController::class, 'project'])   ->name('project');


Route::group(['prefix' => 'Admin' , 'namespace' => 'Admin'] ,function()
{

    Route::get('/About'    , [App\Http\Controllers\Admin\AdminController::class, 'about'])     ->name('admin.about');
    Route::get('/Clients'  , [App\Http\Controllers\Admin\AdminController::class, 'clients'])   ->name('admin.clients');
    Route::get('/CopyRight', [App\Http\Controllers\Admin\AdminController::class, 'copyright']) ->name('admin.copyright');
    Route::get('/General'  , [App\Http\Controllers\Admin\AdminController::class, 'general'])   ->name('admin.general');
    Route::get('/Group'    , [App\Http\Controllers\Admin\AdminController::class, 'group'])   ->name('admin.group');
    Route::get('/Project'  , [App\Http\Controllers\Admin\AdminController::class, 'project'])   ->name('admin.project');
    Route::get('/Contact'  , [App\Http\Controllers\Admin\AdminController::class, 'contact'])   ->name('admin.contact');
    Route::get('/Register' , [App\Http\Controllers\Admin\AdminController::class, 'reg'])   ->name('admin.reg');
});
