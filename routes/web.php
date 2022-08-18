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
Route::get('/', function () {
    return redirect('/main');
});
Route::get('/main'         , [App\Http\Controllers\Main\MainController::class, 'home'])      ->name('home');
Route::post('/save_message', [App\Http\Controllers\Main\MainController::class,'save_message']) ->name('save.message');
Route::post('/get_sections', [App\Http\Controllers\Main\MainController::class,'get_sections']) ->name('get.sections');
Route::post('/get_details', [App\Http\Controllers\Main\MainController::class,'get_details']) ->name('get.details');



Route::group(['prefix' => 'Admin' , 'namespace' => 'Admin'] ,function()
{

    Route::get('/View_About'    , [App\Http\Controllers\Admin\AdminController::class, 'viewabout'])     ->name('admin.about');
        Route::post('/save_about', [App\Http\Controllers\Admin\AdminController::class,'save_about']) ->name('admin.save.about');

    Route::get('/View_Clients'  , [App\Http\Controllers\Admin\AdminController::class, 'clients'])   ->name('admin.clients');
        Route::post('/save_client', [App\Http\Controllers\Admin\AdminController::class,'save_client']) ->name('admin.save.client');
        Route::post('/delete_client', [App\Http\Controllers\Admin\AdminController::class,'delete_client']) ->name('admin.delete.client');

    Route::get('/CopyRight', [App\Http\Controllers\Admin\AdminController::class, 'copyright']) ->name('admin.copyright');
        Route::post('/save_copyright', [App\Http\Controllers\Admin\AdminController::class,'save_copy']) ->name('admin.save.copyright');

    Route::get('/Social'  , [App\Http\Controllers\Admin\AdminController::class, 'general'])   ->name('admin.general');
        Route::post('/save_social', [App\Http\Controllers\Admin\AdminController::class,'save_social']) ->name('admin.save.social');


    Route::get('/Group'    , [App\Http\Controllers\Admin\AdminController::class, 'group'])   ->name('admin.group');
        Route::post('/save_group', [App\Http\Controllers\Admin\AdminController::class,'save_group']) ->name('admin.save.group');

    Route::get('/Project'  , [App\Http\Controllers\Admin\AdminController::class, 'project'])   ->name('admin.project');
            Route::post('/save_project', [App\Http\Controllers\Admin\AdminController::class,'save_project']) ->name('admin.save.project');
            Route::post('/get_update_project', [App\Http\Controllers\Admin\AdminController::class,'get_update_project']) ->name('admin.get.update.project');
            Route::post('/update_project', [App\Http\Controllers\Admin\AdminController::class,'update_project']) ->name('admin.update.project');
            Route::post('/delete_project', [App\Http\Controllers\Admin\AdminController::class,'delete_project']) ->name('admin.del.project');
            Route::post('/save_all_search', [App\Http\Controllers\Admin\AdminController::class,'save_all_search']) ->name('admin.all.search.project');


    Route::get('/ViewDetails'  , [App\Http\Controllers\Admin\AdminController::class, 'details'])   ->name('admin.details');
            Route::post('/save_details_project', [App\Http\Controllers\Admin\AdminController::class,'save_details_project']) ->name('admin.save.details.project');
            Route::post('/search_all_section', [App\Http\Controllers\Admin\AdminController::class,'search_all_section']) ->name('admin.search.all.section');
            Route::post('/delete_section', [App\Http\Controllers\Admin\AdminController::class,'delete_section']) ->name('admin.del.section');
            Route::post('/get_data_details', [App\Http\Controllers\Admin\AdminController::class,'get_data_details']) ->name('admin.get.update.details');
            Route::post('/del_image_details', [App\Http\Controllers\Admin\AdminController::class,'del_image_details']) ->name('admin.del.image.details');
            Route::post('/update_image_details', [App\Http\Controllers\Admin\AdminController::class,'update_image_details']) ->name('admin.update.image.details');




    Route::get('/Contact'  , [App\Http\Controllers\Admin\AdminController::class, 'contact'])   ->name('admin.contact');
            Route::post('/delete_contact', [App\Http\Controllers\Admin\AdminController::class,'delete_contact']) ->name('admin.delete.contact');

    Route::get('/Register' , [App\Http\Controllers\Admin\AdminController::class, 'reg'])   ->name('admin.reg');


    Route::get('/View_services'    , [App\Http\Controllers\Admin\AdminController::class, 'services'])     ->name('admin.services');
        Route::post('/delete_service', [App\Http\Controllers\Admin\AdminController::class,'delete_service']) ->name('admin.delete.service');
        Route::post('/save_service', [App\Http\Controllers\Admin\AdminController::class,'save_service']) ->name('admin.save.service');
        Route::post('/update_service', [App\Http\Controllers\Admin\AdminController::class,'update_service']) ->name('admin.update.services');
        Route::post('/get_update_service', [App\Http\Controllers\Admin\AdminController::class,'get_update_service']) ->name('admin.get.update.services');

    Route::get('/ViewData',[App\Http\Controllers\Admin\AdminController::class,'View_data']) ->name('admin.View_data');
        Route::post('/save_datasheet', [App\Http\Controllers\Admin\AdminController::class,'save_datasheet']) ->name('admin.save_datasheet');


});
