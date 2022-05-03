<?php

namespace  Saidjon\InertiaCrudGenerator\Fields;

use Illuminate\Support\Facades\Log;
use Saidjon\InertiaCrudGenerator\Fields\BaseField;



class RelationField extends BaseField
{

    protected $createHtmlTemp = "\t\t\t  <options-field name='{{fieldName}}' :options='{{fieldName}}RelationOptions' label='Choose {{fieldName}}' @inputChanged='set{{fieldNameUp}}'/>";

    public $fieldType = 'relation';

    public $label = 'Select ';


        /*
        $setRelationFunctionTemplate is appended to setFunctionTemplate and 
        inserted into {{setFunctions}} 
        */

        /*
       also create $onMountFunctionTemplate and append to onMountActions
       */
<<<<<<< HEAD
      
        $setRelationFunctionTemplate = "\t\t\t get{{fieldNameUp}}(){
            (async () => {
            const rawResponse = await fetch('/api/{{relationTableName}}', {
               method: 'GET',
            headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN' :this.\$page.props.csrf,
            'Authorization' : 'Bearer ' + this.\$page.props.token,
            }
               });
                const content = await rawResponse.json();
                this.{{fieldName}}RelationOptions.items = content.data
            })();
    },";
=======
>>>>>>> 8482fba5bfc92ad2fc68d4846e2d7c69d91a6415

    public $setRelationFunctionTemplate = "\t\t\t get{{fieldNameUp}}(){
        (async () => {
        const rawResponse = await fetch('/api/{{relationTableName}}', {
           method: 'GET',
        headers: {
        'Accept': 'application/json',
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN' :this.\$page.props.csrf,
        'Authorization' : 'Bearer ' + this.\$page.props.token,
        }
           });
            const content = await rawResponse.json();
            this.{{fieldName}}RelationOptions.items = content.data
        })();
         },";

          /*

         $relationDataTemplate is appended with datafields and inserted into 	{{dataFields}}
         */
         public $relationDataOptionsTemp = "\t\t\t 	{{fieldName}}RelationOptions:{
             \t\t\t	visibleField:'{{visibleField}}',
             \t\t\t	valueField:'{{valueField}}',
             \t\t\t	items:[]
             \t\t\t},  \n ";

      
    public function getData():array
    {

        Log::info(json_encode($this->data));
        return [
            "createHtmlField" =>$this->makeField($this->createHtmlTemp,$this->data),

            "postField" => $this->replace($this->postFieldTemp,'fieldName',$this->data['fieldName']),

<<<<<<< HEAD
            "dataField" => $this->replace($this->dataFieldTemp,'fieldName',$this->data['fieldName']).
                        $this->replaceArray($this->relationDataOptionsTemplate,$this->data)
                ,
            
            "method" => $this->methodField(),
=======
            "dataField" => $this->setDataField(),

            "method" => $this->setMethod(),
>>>>>>> 8482fba5bfc92ad2fc68d4846e2d7c69d91a6415

            "beforeMountedSet" => "",

            "mountedSet" => "",
            
            "viewHtmlField" => "",
        ];
    }

<<<<<<< HEAD
    public function methodField()
    {
        $method = '';

        $method .= $this->replaceArray($this->setFunctionTemp,$this->data);
            try {
        $method .=   $this->replaceArray($this->setRelationFunctionTemplate,$this->data);
                
            } catch (\Throwable $th) {
                Log::info(__CLASS__ .'  Line :'.$th->getLine().$th->getMessage());
            }
            return $method;
        
    }

=======
    public function setMethod():string
    {
        $t =   $this->replaceArray($this->setRelationFunctionTemplate,$this->data);
        $t.=$this->replaceArray($this->setFunctionTemp,$this->data);
        return $t;
    }

    public function setDataField()
    {
        $t = $this->replaceArray($this->relationDataOptionsTemp,$this->data);
        $t.= $this->replace($this->dataFieldTemp,'fieldName',$this->data['fieldName']);

        return $t;
    }


>>>>>>> 8482fba5bfc92ad2fc68d4846e2d7c69d91a6415
}