<?php

namespace App\Restify;

use Binaryk\LaravelRestify\Fields\Field;
use Binaryk\LaravelRestify\Http\Requests\RestifyRequest;

class MenuRepository extends Repository
{
    public static $model = 'App\\Models\\Menu';

    public function fields(RestifyRequest $request): array
    {
        return [
            field('role')->storingRules('required','max:100','string'),
            field('data')->storingRules('required','json',),
            field('published')->storingRules('required','boolean',),
            // field('permissions')->storingRules('required','json',),

        ];
    }
}
