<?php

namespace App\Models;


class Category extends BaseModel
{
    protected $fillable = [
        'name',
        'created_by',
        'updated_by',
        'deleted_by',
    ];

}
