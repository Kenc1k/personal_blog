<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use App\Models\Views;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request as FacadesRequest;

class BlogController extends Controller
{
    public function blogView()
    {
        $categories = Category::all();
        $posts = Post::paginate(10);

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
    public function logout()
    {
        Auth::logout(); 
        return redirect()->route('loginPage');
    }
    public function storeComment(Request $request, $postId)
    {
        $request->validate([
            'comment' => 'required|string|max:1000', // Validate the comment input
        ]);

        // Check if the user is logged in
        if (auth()->check()) {
            $comment = new Comment();
            $comment->post_id = $postId;
            $comment->user_id = auth()->id(); // Get the logged-in user's ID
            $comment->comment = $request->comment;
            $comment->save();
            
            return redirect()->route('post.show', $postId)->with('success', 'Your comment has been posted.');
        } else {
            return redirect()->route('login')->with('error', 'You need to be logged in to post a comment.');
        }
    }
    public function showPost($id)
    {
        $categories = Category::all();
        $post = Post::with('comments')->findOrFail($id); // Eager load comments
        return view('blog.details', compact('post', 'categories'));
    }

    public function showView(Post $post)
    {
        $ip = FacadesRequest::ip();
        dd($post->id, $ip);
        // Check if the IP has already viewed the post
        $hasViewed = Views::where('post_id', $post->id)->where('ip_address', $ip)->exists();

        if (!$hasViewed) {
            // Increment the views count
            $post->increment('views');

            // Record the view
            Views::create([
                'post_id' => $post->id,
                'ip_address' => $ip,
            ]);
        }

        return view('post.show', compact('post'));
    }
    public function showByCategory(Category $category)
    {
        $posts = $category->posts;

        return view('posts.index', compact('posts', 'category'));
    }

}
