<?php 

 namespace Saidjon\InertiaCrudGenerator;

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use Saidjon\InertiaCrudGenerator\Controllers\Admin\ImageUploadController;

##########    Inertia Crud  Generator

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

 Route::post('/admin/upload/article-image',[ImageUploadController::class,
 'articleImageUpload'])->middleware(['auth:sanctum']);

Route::resource('admin/article', 'App\Http\Controllers\Admin\ArticleCrudController', [
            'only' => ['index', 'create', 'show']
        ]);
 