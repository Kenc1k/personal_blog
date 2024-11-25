<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    /** @use HasFactory<\Database\Factories\CategoryFactory> */
    use HasFactory;

    protected $fillable = ['name'];

    public function post()
    {
        return $this->hasMany(Post::class);
    }
    // app/Models/Category.php

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

}
