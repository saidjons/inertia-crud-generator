<?php

 namespace Saidjon\InertiaCrudGenerator;

use Inertia\Inertia;
use Illuminate\Http\Request;
 
 
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Schema;
use Saidjon\InertiaCrudGenerator\InertiaCrudGenerator;
use Saidjon\InertiaCrudGenerator\Traits\AuthTokenTrait;

class CrudGeneratorController extends Controller
{
    use AuthTokenTrait;
    

    public function create()
    {
        
        $token = $this->ensureSessionSameWithAuthtokenCookie();
        return Inertia::render('Generator/Create',[
            'token' => $token,
            'csrf'  => csrf_token(),
        ]);

        
    }

    public function getColumnsofTable(Request $request)
    {

        if (Schema::hasTable($request->input('tableName'))) {
            
            $c = new InertiaCrudGenerator($request->input('tableName'));
            $columns = $c->getFilteredColumns();
            unset($c);
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
        $crud = new InertiaCrudGenerator($table);

        $crud->setColumns($columns);
        $result = $crud->handle();

        if ($result) {
                return  response()->json([
                 'messages' => [$result],
                 
            ]);
        }else{
                return  response()->json([
                 'message' => 'error see  log',
                 
            ],204);
        }
    }


}
