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

   public function creator(){
       return $this->belongsTo(User::class, 'created_by');

   }
   public function updater(){
       return $this->hasOne(User::class, 'updated_by');

   }
   public function deleter(){
       return $this->hasOne(User::class, 'deleted_by');

   }
   public function articles(){
       return $this->belongsTo(Article::class, 'image_id');
   }
}
