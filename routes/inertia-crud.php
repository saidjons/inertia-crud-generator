<?php 

 namespace Saidjon\InertiaCrudGenerator;

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;

##########    Inertia Crud  Generator
Route::get('/admin', function () {
    return Inertia::render('Admin');
})->name('admin');


Route::post('/admin/crud/generator', [CrudGeneratorController::class,'generate'])->name('crud-generator-generate');

Route::post('/admin/generator/get-table', [CrudGeneratorController::class,'getColumnsofTable'])->name('crud-generator-columns');

Route::get('/admin/generator/create', [CrudGeneratorController::class,'create'])->name('crud-generator');

