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

    public function image()
    {
        return $this->hasOne(Image::class, 'image_id');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
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
