<?php

namespace  Saidjon\InertiaCrudGenerator\Fields;

use Saidjon\InertiaCrudGenerator\Fields\BaseField;



class FileUploadField extends BaseField
{
    protected $createHtmlTemp = "\t\t\t  
    	<FileUpload
		name='{{fieldName}}' 
         label='Upload file for {{fieldNameUp}}' 
         uploadURL='/api/admin/upload/file/'
         deleteURL='/api/admin/delete/file/'
         :multiple=false
		 @upload='set{{fieldNameUp}}'
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
            "import"=>"\t\t\t import FileUploadField from '@/Components/Fields/uploader/FileUploadField.vue'\n "

        ];
    }

}