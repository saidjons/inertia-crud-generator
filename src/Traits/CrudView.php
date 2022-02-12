<?php 

namespace Saidjon\InertiaCrudGenerator\Traits;

use Illuminate\Support\Facades\Log;

trait CrudView {


 
  public $setFieldTemplate = "\t\t\t  this.{{field}} = this.\$page.props.model.{{field}} ; \n ";

  public $textTemplate = "\t\t\t <text-view  name='{{fieldName}}' label='{{label}}'     :initialValue='{{fieldName}}'/> \n "; 
  

  public function generateVueView()
  {
    $templateString = $this->generateTemplateFrom($this->replacements,'vue','View');

         $message =  $this->createVueFile($this->replacements,$templateString,$this->VUE_PATH,'View.vue');
          $this->messages[] = $message;

         return $this;
  }
    public function makeViewFields()
    {

      $temp = '';
        foreach ($this->columns as  $v) {
          $t =['temp'=>$this->textTemplate,'fieldType'=>'text'];;
           
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

}