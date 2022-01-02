<?php 

 namespace Saidjon\InertiaCrudGenerator;

use Illuminate\Support\Facades\Route;

##########      Generator
Route::post('/admin/crud/generator', [CrudGeneratorController::class,'generate'])->name('crud-generator-generate');
Route::post('/admin/generator/get-table', [CrudGeneratorController::class,'getColumnsofTable'])->name('crud-generator-columns');
Route::get('/admin/generator/create', [CrudGeneratorController::class,'create'])->name('crud-generator');
