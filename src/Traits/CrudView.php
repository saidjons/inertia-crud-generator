<?php 

namespace Saidjon\InertiaCrudGenerator\Traits;

use Illuminate\Support\Facades\Log;

trait CrudView {


  public $viewFileName = 'View';
  public $setFieldTemplate = "\t\t\t  this.{{field}} : this.\$page.props.model.{{field}} ; \n ";

  public $textTemplate = "\t\t\t <text-view  name='{{fieldName}}' label='{{label}}'     :initialValue='{{fieldName}}'/> \n "; 
  
    public function makeViewFields()
    {

      $temp = '';
        foreach ($this->columns as  $v) {
          $t =['temp'=>$this->inputTemplate,'fieldType'=>'text'];;
           
             $temp.= $this->replace($t['temp'],[
                'fieldName'=>$v['fieldName'],
                'label' => 'Enter '.$v['fieldName'],
                ]);
        }
        return $temp;
    }
    public function makeSetFields()
    {
        $temp = ' ';

        foreach ($this->columns as     $f) {
              $r = $this->replace($this->setFieldTemplate,['field'=>$f['fieldName']]);
              $temp .= $r;
        }
        return $temp;
    }
    

    
    public function generateViewVue($replacements):string
    {
           $viewVue=$this->getStub("/../stubs/vue/".$this->viewFileName);
        $viewVue= $this->replace($viewVue,$replacements);
        
 
  return $viewVue;
        //  $filePath=base_path($this->VIEW_PATH.$replacements["folderName"]).'/table.blade.php';
        //     $this->fileWriter($replacements,$lwTable,$this->VIEW_PATH,$filePath);
       
    }
      public function fileWriterView($replacements,$template,$PATH,$fileNameWithExt)
    {
        
        if (!$this->filesystem->exists(resource_path($PATH.$replacements['folderName']))) {

            $this->filesystem->makeDirectory(resource_path($PATH).$replacements["folderName"],0755);

        }
        if (!$this->filesystem->exists(resource_path($PATH.$replacements['folderName'].'/'.$fileNameWithExt))) {

                $this->filesystem->put(resource_path($PATH.$replacements['folderName'].'/'.$fileNameWithExt),$template);
                // Storage::disk('rjs')->put($fileNameWithExt,$template);
                return ['message'=> 'View.vue file created'];
          }else{
                return ['message'=> 'View.vue exists . Not created'];

          }
       
    }


}