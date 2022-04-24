<?php 

namespace Saidjon\InertiaCrudGenerator\Traits;

use Illuminate\Support\Facades\Log;

trait CrudView {


  public function generateVueView()
  {
    $templateString = $this->generateTemplateFrom($this->replacements,'vue','View');

         $message =  $this->createFile($templateString,$this->VUE_PATH,$this->replacements['folderName'],'View.vue');
          $this->messages[] = $message;

         return $this;
  }
   

    // public function makeSetFields()
    // {
    //     $temp = ' ';

    //     foreach ($this->columns as     $f) {
    //           $r = $this->replaceArray($this->setFieldTemplate,['field'=>$f['fieldName']]);
    //           $temp .= $r;
    //     }
    //     return $temp;
    // }

}