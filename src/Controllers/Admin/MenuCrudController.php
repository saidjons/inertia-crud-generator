<?php

namespace Saidjon\InertiaCrudGenerator\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class MenuCrudController extends Controller
{
     
     public function index()
     {
         return Inertia::render(config('inertia-crud.menu_list_path'));
     }

     public function show($id)
     {
        return Inertia::render(config('inertia-crud.menu_view_path'));

     }


     public function create()
     {
         return Inertia::render(config('inertia-crud.menu_create_path'));
         
     }
}
