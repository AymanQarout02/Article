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

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
    public function articles()
    {
        return $this->belongsToMany(Article::class);
    }
    public function updater()
    {
        return $this->hasOne(User::class, 'updated_by');
    }
    public function deleter()
    {
        return $this->hasOne(User::class, 'deleted_by');
    }


}
