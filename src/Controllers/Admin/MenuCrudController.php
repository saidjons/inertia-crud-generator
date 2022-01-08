<?php

namespace Saidjon\InertiaCrudGenerator\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class MenuCrudController extends Controller
{
     
     public function index()
     {
         return Inertia::render('Menu/List');
     }

     public function show($id)
     {
         return Inertia::render('Menu/View');
     }


     public function create()
     {
         return Inertia::render('Menu/Create');
         
     }
}
