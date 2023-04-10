<?php

namespace  Saidjon\InertiaCrudGenerator\Fields;

use Exception;
use Illuminate\Support\Facades\Log;
use Saidjon\InertiaCrudGenerator\Fields\BaseField;



class OptionField extends BaseField
{

    protected $createHtmlTemp = "\t\t\t  <OptionsField name='{{fieldName}}' :initialValue='{{fieldName}}' :options='{{fieldName}}Options' label='Choose {{fieldName}}' @inputChanged='set{{fieldNameUp}}'/>";

    public $fieldType = 'option';

    public $label = 'Select ';

    public array $optionItems;
    public array $optionDataRaw;

  
 
         public $optionsTemp = "\t\t\t 	{{fieldName}}Options:{
             \t\t\t	valueField:'id',
             \t\t\t	visibleField:'title',
             \t\t\t	items:[{{option}}]
             \t\t\t},  \n ";

        public function __construct(array $data)
        {
            $this->data = 
            [
                    'fieldName' => $data['fieldName'],
                    'fieldType' => $this->fieldType,
                    'fieldNameUp' => ucfirst($data['fieldName']),
                    'label' =>  $this->label.$data['fieldName'],
                ];
            //    dd(json_decode($data['option'],true));
                
                $this->optionDataRaw = json_decode($data['option'],true);

                $this->optionItems = $this->normaliseOption( $this->optionDataRaw);
              
        }

    public $optionItemTemp = "{
        \t\t\tid:'{{valueField}}',
        \t\t\t title:'{{visibleField}}',
        \t\t\t},";

    public function normaliseOption(array $options ):array
    {
        $items = [];
        if (filter_var($options['isWithKeys'], FILTER_VALIDATE_BOOLEAN)) {

            
              /**
             * its assosiative array
             * here if value field is different from the visible field . valueField is set to $key
             */
        foreach ($options['keyValues'] as   $item) {
              $item = ['valueField'=>$item['key'], 'visibleField' => $item['value']];
                $items[]=$item;
        }

        }else{

           

                            /**
                 * its sequensial array
                 * here if key is not set it uses $value as $key => $value
                 */ 
                foreach ($options['values'] as   $item) {
                    $item = ['valueField'=>$item , 'visibleField' => $item ];
                    $items[]=$item;
                }
        }
    
        return $items;
    }
    public function getData():array
    {

        return [
            "createHtmlField" =>$this->replaceArray($this->createHtmlTemp,$this->data),

            "postField" => $this->replace($this->postFieldTemp,'fieldName',$this->data['fieldName']),

            "dataField" => $this->setDataField(),

            "method" => $this->setMethod(),

            // "beforeMountSet" => $this->replace($this->onMountedMethodTemp,'fieldName','get'.$this->data["fieldNameUp"]),


            "onMountedSetFieldEdit" => $this->setonMountedSetFieldEdit(),

            "onMountedSetFieldView" => $this->replace($this->onMountedSetFieldTemp,'fieldName',$this->data['fieldName']),
            
            "viewHtmlField" =>$this->replaceArray($this->viewHtmlTemp,$this->data),
            "import"=>"\t\t\t import OptionsField from '@/Components/Fields/OptionsField.vue'\n "
        ];
    }

    public function setMethod():string
    {
        $t =   $this->replaceArray($this->setFunctionTemp,$this->data);
        return $t;
    }

    public function setDataField()
    {
        $optionItems = " ";
        
        $optionsTemp = $this->replace($this->optionsTemp,'fieldName',$this->data['fieldName']);

        foreach ($this->optionItems as $item) {
            $optionItems.=$this->replaceArray($this->optionItemTemp,$item);
        }

        $t = $this->replace($optionsTemp,'option',$optionItems);

        $t.= $this->replace($this->dataFieldTemp,'fieldName',$this->data['fieldName']);

        return $t;
    }

    public function setonMountedSetFieldEdit()
    {
        $t = $this->replace($this->onMountedSetFieldTemp,'fieldName',$this->data['fieldName']);


        return $t;

    }


}