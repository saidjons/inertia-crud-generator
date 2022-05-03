<?php

namespace  Saidjon\InertiaCrudGenerator\Fields;

use Saidjon\InertiaCrudGenerator\Fields\BaseField;



class DropdownField extends BaseField
{
    protected $createHtmlTemp  = "\t\t\t <options-field name='{{fieldName}}' :options='{{options}}' label='{{label}}' :initialValue='{{fieldName}}'  @inputChanged='set{{fieldNameUp}}'/> \n"; 
  
    
   protected  $fieldDataTemp = "\t\t\t {{fieldName}} : {
        \t\t\t\t  visibleField:'{{visibleField}}',
        \t\t\t\t  valueField:'{{valueField}}',
        \t\t\t\t  items:[
        \t\t\t\t  
        \t\t\t\t  ] ,\n ";


    public $fieldType = 'dropdown';

    public $label = 'Select ';
    
    

    public function getData():array
    {
        return [
            "createHtmlField" =>$this->makeField($this->createHtmlTemp,$this->data),

            "postField" => $this->replace($this->postFieldTemp,'fieldName',$this->data['fieldName']),

            "dataField" => $this->replace($this->dataFieldTemp,'fieldName',$this->data['fieldName']),

            "setMethod" => $this->replaceArray($this->setFunctionTemp,$this->data),

            "beforeMountSet" => "",
            "onMountedSetField" => $this->replace($this->onMountedSetFieldTemp,'fieldName',$this->data['fieldName']),


            "mountedSet" => "",
            
            "viewHtmlField" => "",

        ];
    }

}