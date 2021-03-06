<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Support\Facades\Facade;
use Saidjon\InertiaCrudGenerator\Fields\TextField;
use Saidjon\InertiaCrudGenerator\Fields\OptionField;
use Saidjon\InertiaCrudGenerator\Generator\Generator;
use Saidjon\InertiaCrudGenerator\Fields\RelationField;

class ImageUploadFieldTest extends TestCase
{
    public $gen;
    public $columns;
 

    public function setUp():void
    {
        $this->gen = new Generator('users');
        $this->columns = [
            ['fieldName'=>'title',
            'className'=>'TextField'
            ],
            ['fieldName'=>'cat_id',
            'className'=>'ImageUploadField',
            
            ],
        
        ];
    


        if (! $this->app) {
            $this->refreshApplication();
        }
        Facade::clearResolvedInstances();
        $this->gen->setPostedColumns($this->columns);
        $this->gen->setReplacement()->fillReplacements();
    
    
    }
    
 
 
   
     

       public function  test_vue_create_template_has_image_field()
    {
        $generatedCreateFileTemp = $this->gen->generateTemplateFrom($this->gen->replacements,'vue','Create');
        // relation html field exixst
        $this->assertStringContainsString("name='cat_id'",$generatedCreateFileTemp);
        // relation field exists in data({})
        $this->assertStringContainsString("cat_id : null",$generatedCreateFileTemp);
        $this->assertStringContainsString("@imageUploaded=",$generatedCreateFileTemp);
        // relation onchange set function exists
        $this->assertStringContainsString("setCat_id(data)",$generatedCreateFileTemp);
        // dd($generatedCreateFileTemp);
        // option Values isset
        
    }

       public function  test_edit_vue_has_option_column()
    {
        $generatedEditFileTemp = $this->gen->generateTemplateFrom($this->gen->replacements,'vue','Edit');
        $fieldNameUp = ucfirst($this->columns[1]['fieldName']);

        // relation data :null set
        $this->assertStringContainsString(strtolower($fieldNameUp)." : null",$generatedEditFileTemp);

    }

  
   
    
}
