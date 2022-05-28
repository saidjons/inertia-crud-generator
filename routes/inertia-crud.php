<?php 

 namespace Saidjon\InertiaCrudGenerator;

use Inertia\Inertia;
use Saidjon\InertiaCrudGenerator\Controllers\CrudGeneratorController;
use Illuminate\Support\Facades\Route;
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

 
Route::resource('menu', 'Saidjon\InertiaCrudGenerator\Controllers\Admin\MenuCrudController', [
            'only' => ['index', 'create', 'show','edit',]
        ]);
Route::post('/getMenus', ['Saidjon\InertiaCrudGenerator\Controllers\API\MenuAPIController','getMenus']);

 
});
 Route::post('/admin/upload/ckeditor-image',[UploadController::class,
 'ckeditorImageUpload'])->middleware(['auth:sanctum']);


 Route::post('/admin/upload/image/{fieldName}',[UploadController::class,
 'imageUpload'])->middleware(['auth:sanctum']);

  Route::post('/admin/upload/file/{fieldName}',[UploadController::class,
 'fileUpload'])->middleware(['auth:sanctum']);

   Route::post('/admin/delete/image',[UploadController::class,
 'imageDelete'])->middleware(['auth:sanctum']);
