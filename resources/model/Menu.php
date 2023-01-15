<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;
    public $table = 'menus';
    public $fillable = [
        'role',
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
        'role' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'role' => 'required|string|max:200',
        'data' => 'required|json',
        'published' => 'boolean|sometimes',
        'permissions' => 'sometimes|json'
    ];

    
}
