<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    /** @use HasFactory<\Database\Factories\PostFactory> */
    use HasFactory;

    protected $fillable = [
        'category_id',
        'title',
        'description',
        'text',
        'image',
        'views',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    public function views()
    {
        return $this->hasMany(Views::class);
    }
    public function likes()
    {
        return $this->hasMany(Likes::class);
    }

    public function likeCount()
    {
        return $this->likes()->where('is_like', true)->count();
    }

    public function dislikeCount()
    {
        return $this->likes()->where('is_like', false)->count();
    }
    
}
