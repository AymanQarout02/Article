<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Models\Article;
use App\Models\Category;
use App\Models\Image;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, softDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function articlesCreator()
    {
        return $this->hasMany(Article::class, 'created_by');
    }
    public function categoriesCreator()
    {
        return $this->hasMany(Category::class, 'created_by');
    }
    public function imagesCreator()
    {
        return $this->hasMany(Image::class, 'created_by');
    }
    public function articlesUpdater()
    {
        return $this->belongsToMany(Article::class, 'updated_by');
    }
    public function categoriesUpdater()
    {
        return $this->belongsToMany(Category::class, 'updated_by');
    }
    public function imagesUpdater()
    {
        return $this->belongsToMany(Image::class, 'updated_by');
    }
    public function articlesDeleter()
    {
        return $this->belongsToMany(Article::class, 'deleted_by');
    }
    public function categoriesDeleter()
    {
        return $this->belongsToMany(Category::class, 'deleted_by');
    }
    public function imagesDeleter()
    {
        return $this->belongsToMany(Image::class, 'deleted_by');
    }


}
