<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function blogView()
    {
        $categories = Category::all();
        $posts = Post::all();

        return view('blog.blog', compact('categories' , 'posts'));
    }

    public function blog_details()
    {
        $categories = Category::all();
        $posts = Post::all();
        return view('blog.details', compact('categories' , 'posts'));
    }
    public function show($id)
    {
        $post = Post::with('category')->findOrFail($id); // Eager load category
        $categories = Category::all(); // Optional, for the navigation menu
        return view('blog.details', compact('post', 'categories'));
    }

}
