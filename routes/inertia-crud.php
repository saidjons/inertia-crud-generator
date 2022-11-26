<?php 

 namespace Saidjon\InertiaCrudGenerator;

use Inertia\Inertia;
use Saidjon\InertiaCrudGenerator\Controllers\Admin\CrudGeneratorController;
use Illuminate\Support\Facades\Route;
use Saidjon\InertiaCrudGenerator\Controllers\Admin\MenuCrudController;
use Saidjon\InertiaCrudGenerator\Controllers\Admin\UploadController;

##########    Inertia Crud  Generator
Route::resource('/api/menus', \Saidjon\InertiaCrudGenerator\Controllers\API\MenuAPIController::class)->middleware(['auth:sanctum']);


Route::prefix('admin')->middleware(['auth:sanctum'])->group(function () {
    
Route::get('/', function () {
    return Inertia::render('Admin');
})->name('admin');


Route::post('/crud/generator', [CrudGeneratorController::class,'generate'])->name('crud-generator-generate');

Route::post('/generator/get-table', [CrudGeneratorController::class,'getColumnsofTable'])->name('crud-generator-columns');

Route::get('/generator/create', [CrudGeneratorController::class,'create'])->name('crud-generator');

 Route::post('api/menu',[MenuCrudController::class,'store']);
 Route::delete('api/menu/{id}',[MenuCrudController::class,'delete']);
 Route::get('api/menu/get/{role}',[MenuCrudController::class,'getMenus']);
 Route::patch('api/menu/{id}',[MenuCrudController::class,'update']);

Route::resource('menu', 'Saidjon\InertiaCrudGenerator\Controllers\Admin\MenuCrudController', [
            'only' => ['index', 'create', 'show','edit',]
        ]);
 
 
});
/*
    file upload and delete routes

*/

Route::middleware(['auth:sanctum'])->group(function () {
 #######latest upload controller
 Route::post('/admin/upload/ckeditor-image', [UploadController::class, 'ckeditorImageUpload']);
 Route::post('admin/upload/image/{fieldName}', [UploadController::class, 'imageUpload']);
 Route::post('admin/upload/file/{fieldName}', [UploadController::class, 'fileUpload']);
 Route::post('admin/delete/file/{filename}', [UploadController::class, 'fileDelete']);
 Route::post('/admin/delete/image/{filename}', [UploadController::class, 'imageDelete']);
});