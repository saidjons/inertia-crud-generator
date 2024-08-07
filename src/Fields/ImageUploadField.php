<?php

namespace  Saidjon\InertiaCrudGenerator\Fields;

use Saidjon\InertiaCrudGenerator\Fields\BaseField;



class ImageUploadField extends BaseField
{
    protected $createHtmlTemp = "\t\t\t  
    	<ImageUploadField 
		name='{{fieldName}}' 
         label='Upload Image for {{fieldNameUp}}' 
		 uploadURL='/api/admin/upload/image/'
         deleteURL='/api/admin/delete/image/'
         :multiple=false
		 @uploaded='set{{fieldNameUp}}'
		  :initialValue='{{fieldName}}'
		 />
    
     \n"; 
    public $fieldType = 'imageUpload';

    public $label = 'Upload Image  ';
    
    

    public function getData():array
    {
        return [
            "createHtmlField" =>$this->makeField($this->createHtmlTemp,$this->data),

         
            "postField" => $this->replace($this->postFieldTemp,'fieldName',$this->data['fieldName']),

            "dataField" => $this->replace($this->dataFieldTemp,'fieldName',$this->data['fieldName']),

            "method" => $this->replaceArray($this->setFunctionTemp,$this->data),

            "beforeMountSet" => "",

            "mountedSet" => "",
            "onMountedSetFieldEdit" => $this->replace($this->onMountedSetFieldTemp,'fieldName',$this->data['fieldName']),
            "onMountedSetFieldView" => $this->replace($this->onMountedSetFieldTemp,'fieldName',$this->data['fieldName']),

            
            "viewHtmlField" =>$this->replaceArray($this->viewHtmlTemp,$this->data),
            "import"=>"\t\t\t import ImageUploadField from '@/Components/Fields/uploader/ImageUploadField.vue'\n " 
        ];
    }

}