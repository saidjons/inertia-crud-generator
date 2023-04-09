<?php

namespace Saidjon\InertiaCrudGenerator\Controllers\Admin;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Models\Menu;

class MenuCrudController extends Controller
{

    public function index()
    {
        return Inertia::render(config('inertia-crud.menu_list_path'));
    }

    public function show($id)
    {
        $menu = Menu::findOrFail($id);
        return Inertia::render(config('inertia-crud.menu_view_path'), [
            "menu" => $menu,
        ]);
    }


    public function create()
    {
        return Inertia::render(config('inertia-crud.menu_create_path'));
    }
    public function edit(int $id)
    {
        $menu = Menu::findOrFail($id);
        return Inertia::render(
            config('inertia-crud.menu_edit_path'),
            [
                "model" => $menu
            ]
        );
    }
    public function store(Request $r)
    {
        $validator = Validator::make($r->all(), [

            "role" => 'required|string',
            "data" => 'required|json',
            'published' => 'required|boolean',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors->first(),
            ]);
        }
        $validated = $validator->validated();
        $menu = Menu::create($validated);
        return response()->json(
            [
                "menu" => $menu
            ]
        );
    }
    public function update(Request $r, int $id)
    {

        $menu = Menu::findOrFail($id);
        $validator = Validator::make($r->all(), [

            "role" => 'required|string',
            "data" => 'required|json',
            'published' => 'required|boolean',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors->first(),
            ]);
        }

        $validated = $validator->validated();
        $menu = $menu::update($validated);
        return response()->json(
            [
                "menu" => $menu
            ]
        );
    }

    public function getMenus($role)
    {

        $menu = Menu::where('role', $role)->get();

        return response()->json([
            "menu" => $menu,
            "message" => 'Menus retrieved successfully'
        ]);
    }
    public function delete(int $id)
    {
        $menu  = Menu::findOrFail($id);
        $menu->delete();

        return response()->json([
            "message" => 'Menus deleted successfully'
        ]);
    }
}
