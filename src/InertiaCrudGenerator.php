<?php 
 namespace Saidjon\InertiaCrudGenerator;

 
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
use phpDocumentor\Reflection\Types\This;
 use Saidjon\InertiaCrudGenerator\Traits\CrudList;
 use Saidjon\InertiaCrudGenerator\Traits\CrudCreate;
 use Saidjon\InertiaCrudGenerator\Traits\CrudController;

class InertiaCrudGenerator
{

use CrudCreate;
use CrudList;
use CrudController;

    public string $model_path="App\Models";
    protected string $model_name='';
    protected string $table_name;
    public array $columnsAndTypes=[];
    public array  $columns = [];
    protected $connectionParams;
    protected object $conn,$sm;
    public object $filesystem;
    protected string $stub_path='../stubs/';
    protected string  $CLASS_PATH="resources/js/paka/";

   

     protected $unwantedColumns = [
        'id',
        // 'password',
        'email_verified_at',
        'remember_token',
        'created_at',
        'updated_at',
        'deleted_at',
        'uuid',
    ];

    public function setColumns($d)
    {
        $this->columns = $d;
    }
    public function __construct($name)
    {
      $this->table_name=$name;
        $this->filesystem = new Filesystem;

 

    }

    public function setColumTypes():array
    {
          
            $columns  = Schema::getColumnListing($this->table_name);
            foreach ($columns as  $col) {
                
            $type = DB::getSchemaBuilder()->getColumnType($this->table_name, $col);
                $this->columnsAndTypes[$col] = $type;
            }           

            return $this->columnsAndTypes;
    }

    public function getColumns():array
    {       
        $columns = $this->sm->listTableColumns($this->table_name);

        return array_keys($columns);
    }

   public function handle()
    {
       
 
        if (!$this->tableExists()) {
            return false;
        }

        // Build the class name from table name
        $this->model_name = $this->_buildClassName();
            
        // Generate the crud
        //    $this->buildModel()
		// 		->buildViews();
	 

        $replacements=[
            'folderName'     =>    ucfirst(strtolower($this->model_name)),
            'model'     =>  strtolower($this->model_name),//lowercase
            'modelPl'   =>  Str::plural(strtolower($this->model_name), 2),
            'upModel'       =>  $this->model_name,
            'mountRelatedFields'       =>  '',
            'createFields'       =>  $this->makeInputFields(),
            'dataFields'       =>  $this->makeDataFields(),
            'postFields'       =>  $this->makePostFields(),
            'tableColumns'    => $this->makeTableColumns(),
            'headingItems'    => $this->makeTableHeadings(),
            'controllerName'  => $this->makeControllerName(),
            'setFunctions'  => $this->makeSetFunctions(),

        ];

        $generatedCreateCtl = $this->generateController($replacements);
        $generatedCreateFile = $this->generateCreateVue($replacements);
        $generatedListFile = $this->generateListVue($replacements);
        $rCreate = $this->fileWriterCreate($replacements,$generatedCreateFile,$this->VUE_PATH,'Create.vue');
        $rList = $this->fileWriterList($replacements,$generatedListFile,$this->VUE_PATH,'List.vue');
         $rController =  $this->fileWriterController($replacements,$generatedCreateCtl,$this->CTL_PATH,$replacements['controllerName'].'.php');

        $route = `Route::resource('`.$replacements['model'].`', 'App\Http\Controllers\Admin\\`.$replacements['modelUp'].`Controller', [
            'only' => ['index', 'create', 'show']
        ]);`;

        
         $this->fileAppend(base_path('routes/inertia-crud.php'),$route);

            return  [$rCreate,$rList,$rController];
     
    }

    public function fileAppend($file,$txt)
    {
        
        try {
            file_put_contents($file,$txt.PHP_EOL , FILE_APPEND | LOCK_EX);
            return true;

        } catch (\Throwable $th) {
            return false;
        }
        

    }
    public function setModelName()
    {
        $this->model_name=Str::studly(Str::singular('users'));;
    }

    public function modelReplacements()
    {
       


    }
     public function getStub($type)
    {
        

        $template= $this->filesystem->get(__DIR__.$type.'.stub');
        return  $template;

    }



      public function getFilteredColumns()
    {
            if(empty($this->columnsAndTypes)){
               $this->setColumTypes();
            }
       
        foreach ($this->unwantedColumns as $col) {
            if(isset($this->columnsAndTypes[$col])){
                unset($this->columnsAndTypes[$col]);
                
            }
        }
        return $this->columnsAndTypes;

      
    }
    public function getProperties()
    {
         $v= $this->getFilteredColumns();
         $p= array_map(function($item){
             return '$'.$item;
         },$v);
         return implode(',',$p);

    }  
   
 
   
    public function replace($template,$replacements)
    {
        foreach ($replacements as $key => $replacement) {
                $template=str_replace('{{'.$key.'}}',$replacement,$template);
                
            }
            return $template;
    }


    public function fileWriter($replacements,$template,$PATH,$fileNameWithExt)
    {
        
        if (!$this->filesystem->exists(resource_path($PATH.$replacements['folderName']))) {

            $this->filesystem->makeDirectory(resource_path($PATH).$replacements["folderName"],0755);

        }
        if (!$this->filesystem->exists(resource_path($PATH.$replacements['folderName'].'/'.$fileNameWithExt))) {

                $this->filesystem->put(resource_path($PATH.$replacements['folderName'].'/'.$fileNameWithExt),$template);
                // Storage::disk('rjs')->put($fileNameWithExt,$template);

        }
        return $this;
    }


    public function getNameInput()
    {
        return trim($this->model_name);
    }

      public function tableExists()
    {
        return Schema::hasTable($this->table_name);
    }

     public function _buildClassName()
    {
        return   Str::studly(Str::singular($this->table_name));
    }

       public function buildReplacements()
    {
        return [
            '{{modelName}}' => $this->name,
            '{{className}}' => Str::title(Str::snake($this->name, ' ')),
            '{{lowercaseModelName}}' => Str::camel(Str::plural($this->name)),
            '{{properties}}' =>"a,b,c",
            '{{data}}'  =>  "a,b,c,",
        ];
    }


      





}