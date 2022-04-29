<?php 

namespace Saidjon\InertiaCrudGenerator\Traits;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

trait Replacor{

  public function replace(string $template  ,string $search,string $replacement ):string
  {
         try {
           
           $template=str_replace('{{'.$search.'}}',$replacement,$template);
           return $template;
         } catch (\Throwable  $th) {
            
          throw new \Exception("Could not replace ${search} with ${replacement}. {$th->getMessage()} ");

         }

              
  }
  public function replaceArray(string $template  ,array  $replacements ):string
  {
      foreach ($replacements as $key => $replacement) {

         
              $template=str_replace('{{'.$key.'}}',$replacement,$template);
          }
           
          return $template;
  }


}