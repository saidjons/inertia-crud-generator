<?php

namespace  Saidjon\InertiaCrudGenerator\Fields;

use Saidjon\InertiaCrudGenerator\Fields\BaseField;



class TextareaField extends BaseField
{
    protected $createHtmlTemp = "\t\t\t <textarea-field name='{{fieldName}}' label='{{label}}' @inputChanged='set{{fieldNameUp}}' :initialValue='{{fieldName}}' /> \n"; 

<<<<<<< HEAD
    public $fieldType = 'textarea';

    public $label = 'Enter ';
=======
    protected $fieldType = 'textarea';

>>>>>>> 02d2ccd37d3376beef5169e576657b79650d9780
    
    

    public function getData():array
    {
        return [
            "createHtmlField" =>$this->makeField($this->createHtmlTemp,$this->data),

            "postField" => $this->replace($this->postFieldTemp,'fieldName',$this->data['fieldName']),

            "dataField" => $this->replace($this->dataFieldTemp,'fieldName',$this->data['fieldName']),

<<<<<<< HEAD
            "setMethod" => $this->replaceArray($this->setFunctionTemp,$this->data),
=======
            "method" => $this->replaceArray($this->setFunctionTemp,$this->data),
>>>>>>> 02d2ccd37d3376beef5169e576657b79650d9780

            "beforeMountedSet" => "",

            "mountedSet" => "",
            
            "viewHtmlField" => "",
        ];
    }

}