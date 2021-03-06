<?php 

namespace Saidjon\InertiaCrudGenerator\Traits;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

trait CrudEdit{

    public function generateVueEdit()
    {
        $generatedEditFile = $this->generateTemplateFrom($this->replacements,'vue','Edit');
        $message = $this->createFile($generatedEditFile,$this->VUE_PATH,$this->replacements['folderName'],'Edit.vue');
          $this->messages[] = $message;
        return $this;
    }


}