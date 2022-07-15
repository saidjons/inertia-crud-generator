<?php

 namespace Saidjon\InertiaCrudGenerator\Controllers\Admin;

use Inertia\Inertia;
use Illuminate\Http\Request;
 
 
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Schema;
use Saidjon\InertiaCrudGenerator\Generator\Generator;
use Saidjon\InertiaCrudGenerator\InertiaCrudGenerator;
use Saidjon\InertiaCrudGenerator\Traits\AuthTokenTrait;

class CrudGeneratorController extends Controller
{
    use AuthTokenTrait;
    

    public function create()
    {
        
        return Inertia::render('Generator/Create');

        
    }

    public function getColumnsofTable(Request $request)
    {

        if (Schema::hasTable($request->input('tableName'))) {
            
            $gen = new Generator($request->input('tableName'));

            $columns = $gen->setColumnTypes()
                            ->filterColumns()
                            ->getColumnTypes();
            unset($gen);
            return  response()->json([
                'message' => $request->input('tableName') . ' table exists',
                'columns' => $columns,
            ],200);
        }else{

              return  response()->json([
                 'message' => ' Table DOES NOT exists',
                 
            ],201);

        }
    }

    public function generate(Request $r)
    {   
        $columns = $r->input('columns');
        $table = $r->input('table');
        $crud = new Generator($table);

         $crud->setPostedColumns($columns);
         $result = $crud->setReplacement()
                ->handle();  

        if ($result) {
                return  response()->json([
                 'messages' => [$result],
                 
            ]);
        } else
        {
                return  response()->json([
                 'message' => 'error see  log',
                 
            ],204);
        }
    }


}
