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

    Route::get('/View_About'    , [App\Http\Controllers\Admin\AdminController::class, 'viewabout'])     ->name('admin.about');
        Route::post('/save_about', [App\Http\Controllers\Admin\AdminController::class,'save_about']) ->name('admin.save.about');

    Route::get('/Clients'  , [App\Http\Controllers\Admin\AdminController::class, 'clients'])   ->name('admin.clients');
    Route::get('/CopyRight', [App\Http\Controllers\Admin\AdminController::class, 'copyright']) ->name('admin.copyright');
        Route::post('/save_copyright', [App\Http\Controllers\Admin\AdminController::class,'save_copy']) ->name('admin.save.copyright');

    Route::get('/General'  , [App\Http\Controllers\Admin\AdminController::class, 'general'])   ->name('admin.general');

    Route::get('/Group'    , [App\Http\Controllers\Admin\AdminController::class, 'group'])   ->name('admin.group');
        Route::post('/save_group', [App\Http\Controllers\Admin\AdminController::class,'save_group']) ->name('admin.save.group');

    Route::get('/Project'  , [App\Http\Controllers\Admin\AdminController::class, 'project'])   ->name('admin.project');
            Route::post('/save_project', [App\Http\Controllers\Admin\AdminController::class,'save_project']) ->name('admin.save.project');
            Route::post('/update_project', [App\Http\Controllers\Admin\AdminController::class,'update_project']) ->name('admin.update.project');
            Route::post('/delete_project', [App\Http\Controllers\Admin\AdminController::class,'delete_project']) ->name('admin.del.project');
            Route::post('/save_all_search', [App\Http\Controllers\Admin\AdminController::class,'save_all_search']) ->name('admin.all.search.project');

    
    Route::get('/Details'  , [App\Http\Controllers\Admin\AdminController::class, 'details'])   ->name('admin.details');

    Route::get('/Contact'  , [App\Http\Controllers\Admin\AdminController::class, 'contact'])   ->name('admin.contact');
            Route::post('/delete_contact', [App\Http\Controllers\Admin\AdminController::class,'delete_contact']) ->name('admin.delete.contact');

    Route::get('/Register' , [App\Http\Controllers\Admin\AdminController::class, 'reg'])   ->name('admin.reg');
});
