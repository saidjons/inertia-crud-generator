<?php

namespace Saidjon\InertiaCrudGenerator\Generator;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

use Illuminate\Support\Facades\Schema;
use Saidjon\InertiaCrudGenerator\Models\Menu;
use Saidjon\InertiaCrudGenerator\Traits\Replacor;

 use Saidjon\InertiaCrudGenerator\Traits\CrudController;
 use Saidjon\InertiaCrudGenerator\Traits\CrudCreate;
 use Saidjon\InertiaCrudGenerator\Traits\CrudView;
 use Saidjon\InertiaCrudGenerator\Traits\CrudList;
 use Saidjon\InertiaCrudGenerator\Traits\CrudEdit;

class Generator extends BaseGenerator
{
     use Replacor,CrudController,CrudCreate,CrudEdit,CrudView,CrudList;

     public $postCols;
    
  public $replacements = [];
    
    public function __construct($table)
    {
      $this->table_name=$table;
      $this->model_name = $this->buildClassName();
 

    }
   
    
    public function setReplacement(){

        if (!$this->columnTypes) {
            $this->setColumnTypes();
        }

        $this->replacements=[
            'folderName'     =>    ucfirst(strtolower($this->model_name)),
            'model'     =>  strtolower($this->model_name),//lowercase
            'modelPl'   =>  Str::plural(strtolower($this->model_name), 2),
            'modelUp'       =>  $this->model_name,
            'controllerName'       =>  $this->getControllerName(),
            'tableColumns'    => $this->makeTableColumns(),
            'tableHeadingItems'    => $this->setTableHeading(),
             

            'createHtmlField'       =>  "",
            'viewHtmlField'       =>  "",
            'dataField'       =>  "",
            'postField'       =>  "",
            'mountedSet'       =>  "",
            'beforeMountSet'       =>  "",
            'onMountedSetField'       =>  "",
            'method'  => "",

        ];

        return $this;

    }

    public function fillReplacements()
    {
        if (count($this->postCols) < 1 ) {
            throw new \Exception("Columns less than 1");
        }

        foreach ($this->postCols as $column) {
            try {
                $resultArray = FieldFactory::getField($column['className'],$column);
                foreach ($resultArray as $key => $value) {
                    if (!empty($value)) {

                        $this->replacements[$key].= $value;
                    }

                }
                
            } catch (\Throwable $th) {
                
                $this->messages[] = ['error' => $th->getMessage()]; 
            }


        }

        return $this;
    }
    
    public function setTableHeading()
    {
        $template = '';

        foreach ($this->postCols as  $col) {
            $temp = $this->replace($this->tableHeadingItemsTemp,'fieldName',$col['fieldName']);

            $template .= "\t\t\t".$temp . "\n";
        }
       return  "\t\t\t ".$template ."\t\t\t \n";
        
    }

    public function handle()
    {
       
        if (!$this->tableExists()) {

            return false;
        }

        $this->fillReplacements()
        ->generateVueCreate()
        ->generateVueEdit()
        ->generateVueView()
        ->generateVueList()
        ->generateController()
        ->addRoute()
        ;

        $this->addToDB($this->replacements);

        return $this->messages;
     
    }
    public function addRoute()
    {
        $route = "Route::resource('/admin/".$this->replacements['model']."', 'App\Http\Controllers\Admin\\".$this->getControllerName()."', [
            'only' => ['index', 'create', 'show','edit']
        ]);";

        $this->fileAppend(base_path('routes/inertia-crud.php'),$route);

        return $this;

    }

    public function addToDB($data)
    {
          Menu::create([
            'role' =>'admin',
            'published' =>1,
            'data' =>json_encode([
                'title' =>$data['modelUp'],
                 'link' =>'',
                'nested' => true,
                'badgeNumber' => '',
                'icon' =>'',
                   'subs' =>[
                        [ 'title'=>'create',
                            'link'=>"/admin/${data['model']}/create",
                            'badgeNumber' =>2,
                        ],
                           [ 'title' =>'List',
                            'link' =>"/admin/${data['model']}",
                            'badgeNumber' =>10,
                           ], 
                           
                      ]
            ]),
        ]);
    }

    public function getControllerName():string
    {
        
        return ucfirst($this->model_name).'CrudController';
    }
    
   

    public function getColumnTypes()
    {
        return $this->columnTypes;
    }

    public function setPostedColumns($cols)
    {
        $this->postCols = $cols;
    }

    public function setColumnTypes():self
    {
          try {
              $columns  = Schema::getColumnListing($this->table_name);
              
              foreach ($columns as  $col) {
                  
              $type = DB::getSchemaBuilder()->getColumnType($this->table_name, $col);
                  $this->columnTypes[$col] = $type;
              }           
          } catch (\Throwable $th) {
             
                Log::info(__CLASS__.' '.$th->getLine() .' '.$th->getMessage());
          }


            return $this;
    }

    
    public function filterColumns():self
    {
            if(empty($this->columnTypes)){
               $this->setColumnTypes();
            }
       
        foreach ($this->unwantedColumns as $col) {
            if(isset($this->columnTypes[$col])){
                unset($this->columnTypes[$col]);
                
            }
        }
        return $this;
    }
  
    
    
}