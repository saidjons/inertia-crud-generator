<?php

namespace  Saidjon\InertiaCrudGenerator\Fields;

use Saidjon\InertiaCrudGenerator\Fields\BaseField;



class TextField extends BaseField
{
    protected $createHtmlTemp = "\t\t\t <input-field  name='{{fieldName}}' label='{{label}}'  fieldType='{{fieldType}}' :initialValue='{{fieldName}}' @inputChanged='set{{fieldNameUp}}'/> \n "; 
    
<<<<<<< HEAD
    public $fieldType = 'text';

    public $label = 'Enter ';
=======
    protected $fieldType = 'text';

>>>>>>> 02d2ccd37d3376beef5169e576657b79650d9780
    
    

    public function getData():array
    {
        return [
<<<<<<< HEAD

=======
>>>>>>> 02d2ccd37d3376beef5169e576657b79650d9780
            "createHtmlField" =>$this->makeField($this->createHtmlTemp,$this->data),

            "postField" => $this->replace($this->postFieldTemp,'fieldName',$this->data['fieldName']),

            "dataField" => $this->replace($this->dataFieldTemp,'fieldName',$this->data['fieldName']),

<<<<<<< HEAD
            "setMethod" => $this->replaceArray($this->setFunctionTemp,$this->data),

            "onMountedSetField" => $this->replace($this->onMountedSetFieldTemp,'fieldName',$this->data['fieldName']),
=======
            "method" => $this->replaceArray($this->setFunctionTemp,$this->data),
>>>>>>> 02d2ccd37d3376beef5169e576657b79650d9780

            "beforeMountedSet" => "",

            "mountedSet" => "",
            
<<<<<<< HEAD
            
            "viewHtmlField" =>$this->replaceArray($this->viewHtmlTemp,$this->data),
=======
            "viewHtmlField" => "",
>>>>>>> 02d2ccd37d3376beef5169e576657b79650d9780


        ];
    }

}