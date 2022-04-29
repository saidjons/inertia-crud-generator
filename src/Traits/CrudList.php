<?php 


 namespace Saidjon\InertiaCrudGenerator\Traits;
trait CrudList {

  // public $tableColumns = '';
   public $headingItems = [];


  public $columnsTemplate = "\t\t\t <td class='border-dashed border-t border-gray-200' :class='getObjectKey(item.{{columnKey}},item)'><span class='text-gray-700 px-6 py-3 flex items-center' >{{item.{{columnKey}} }}</span></td> \n "; 

   public function generateVueList()
   {
       $templateString = $this->generateTemplateFrom($this->replacements,'vue','List');

      $message = $this->createFile($templateString,$this->VUE_PATH,$this->replacements['folderName'],'List.vue');
          $this->messages[] = $message;

      return $this;
   }

    public function makeTableHeadings()
    {
      $headingItems = '';
      foreach ($this->columns as  $col) {
          $temp = "{ key:'".$col['fieldName'] ."',cell:'text',visible:true, value: '".$col['fieldName']."'},\n";
          $headingItems .= "\t\t\t".$temp . "\n";
      }
      return "\t\t\t ".$headingItems ."\t\t\t \n";
    }

    public function makeTableColumns()
    {
       


      $temp = '';
        foreach ($this->columns as  $v) {
           
            $temp.= $this->replaceArray($this->columnsTemplate,[
                'columnKey'=>$v['fieldName'],
                ]);

        }
        return $temp;
    }
   
     

      
  
       


}