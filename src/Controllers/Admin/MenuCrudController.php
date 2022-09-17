<?php

namespace Saidjon\InertiaCrudGenerator\Controllers\Admin;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Saidjon\InertiaCrudGenerator\Models\Menu;

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
       public function edit(int $id)
    {
        $menu = Menu::findOrFail($id);
        return Inertia::render(config('inertia-crud.menu_edit_path'),
            [
                "menu" =>$menu
            ]
        );
    }
}

