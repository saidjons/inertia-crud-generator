<?php

namespace Saidjon\InertiaCrudGenerator\Models;

use Illuminate\Database\Eloquent\Model as Model;



/**
 * Class Menu
 * @package App\Models
 * @version January 6, 2022, 8:38 am UTC
 *
 * @property string $title
 * @property json $data
 * @property bool $published
 * @property json $permissions
 */
class Menu extends Model
{


    public $table = 'menus';
    



    public $fillable = [
        'title',
        'data',
        'published',
        'permissions'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'title' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'title' => 'required|unique:menus',
        'data' => 'required|json',
        'published' => 'boolean|sometimes',
        'permissions' => 'sometimes|json'
    ];

    
}
