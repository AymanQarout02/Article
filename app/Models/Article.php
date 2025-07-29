<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends BaseModel{

    protected $fillable = [
        'name',
        'body',
        'image_id',
        'created_by',
        'updated_by',
        'deleted_by',
    ];
}
