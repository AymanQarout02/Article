<?php

namespace App\Models;

class Image extends BaseModel
{

   protected $fillable = [
        'name',
        'path',
        'size',
        'type',
        'extension',
        'created_by',
        'updated_by',
        'deleted_by',
    ];
}
