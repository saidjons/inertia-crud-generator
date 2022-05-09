<?php

require './vendor/autoload.php';

use Saidjon\InertiaCrudGenerator\Generator\Generator;

    $columns = [
        ['fieldName'=>'title',
        'className'=>'TextField'
        ],
        ['fieldName'=>'description',
        'className'=>'TextareaField'
        ],
        ['fieldName'=>'checkbox',
        'className'=>'CheckboxField'
        ],
    ];

$gen = new Generator('users');

$gen->setPostedColumns($columns);

    // $gen->setReplacement();
// $gen->handle();

dd($gen);


// next error :
cannot get table-columns 
// projects/testing
// print_r($gen->replacements);


