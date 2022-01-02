<?php 


 namespace Saidjon\InertiaCrudGenerator;
trait CrudList {

 public  $VUE_PATH="js/Pages/"; //with trailing slash

  
  // public $tableColumns = '';
   public $headingItems = [];


  public $columnsTemplate = "\t\t\t <td class='border-dashed border-t border-gray-200' :class='getObjectKey(item.{{columnKey}},item)'><span class='text-gray-700 px-6 py-3 flex items-center' >{{item.{{columnKey}} }}</span></td> \n "; 

   
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
           
            $temp.= $this->replace($this->columnsTemplate,[
                'columnKey'=>$v['fieldName'],
                ]);

        }
        return $temp;
    }
   
     

      
    public function generateListVue($replacements):string
    {
           $listVue=$this->getStub("vue/List");
        $listVue= $this->replace($listVue,$replacements);
        
 
        return $listVue;
        //  $filePath=base_path($this->VIEW_PATH.$replacements["folderName"]).'/table.blade.php';
        //     $this->fileWriter($replacements,$lwTable,$this->VIEW_PATH,$filePath);
       
    }
      public function fileWriterList($replacements,$template,$PATH,$fileNameWithExt)
    {
        
        if (!$this->filesystem->exists(resource_path($PATH.$replacements['folderName']))) {

            $this->filesystem->makeDirectory(resource_path($PATH).$replacements["folderName"],0755);

        }
        if (!$this->filesystem->exists(resource_path($PATH.$replacements['folderName'].'/'.$fileNameWithExt))) {

               $res =  $this->filesystem->put(resource_path($PATH.$replacements['folderName'].'/'.$fileNameWithExt),$template);
                // Storage::disk('rjs')->put($fileNameWithExt,$template);

                return ['message'=> 'List.vue file created'];
          }else{
                return ['message'=> 'List.vue exists . Not created'];

          }
        
    }


}