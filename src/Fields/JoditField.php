<?php

namespace  Saidjon\InertiaCrudGenerator\Fields;

use Saidjon\InertiaCrudGenerator\Fields\BaseField;



class JoditField extends BaseField
{
    protected $createHtmlTemp = "\t\t\t  <JoditField name='{{fieldName}}' label='{{fieldName}}' :content='{{fieldName}}'  @inputChanged='set{{fieldNameUp}}' /> \n"; 

    public $fieldType = 'jodit';

    public $label = 'Fill ';
    
    

    public function getData():array
    {
        return [
            "createHtmlField" =>$this->makeField($this->createHtmlTemp,$this->data),

          
            "postField" => $this->replace($this->postFieldTemp,'fieldName',$this->data['fieldName']),

            "dataField" => $this->replace($this->dataFieldTemp,'fieldName',$this->data['fieldName']),

            "method" => $this->replaceArray($this->setFunctionTemp,$this->data),

            "beforeMountSet" => "",
            "onMountedSetFieldEdit" => $this->replace($this->onMountedSetFieldTemp,'fieldName',$this->data['fieldName']),

            "onMountedSetFieldView" => $this->replace($this->onMountedSetFieldTemp,'fieldName',$this->data['fieldName']),


            "mountedSet" => "",
            
            "viewHtmlField" =>$this->replaceArray($this->viewHtmlTemp,$this->data),
            "import"=>"\t\t\t import JoditField from '@/Components/Fields/JoditField.vue'\n "
        ];
    }

}
