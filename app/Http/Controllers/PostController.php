<?php

namespace App\Http\Controllers;


use App\Models\Category;
use App\Models\Post;
use App\Models\Views;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request as FacadesRequest;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        $posts = Post::all();
        return view('posts.index' , compact('posts' , 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('posts.create' , compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'category_id' => 'required',
            'title' => 'required',
            'description' => 'required',
            'text' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:3000',
        ]);
    
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imagePath = $image->store('posts', 'public'); // Saves in storage/app/public/posts
            $data['image'] = $imagePath; // Store the relative path
        }
    
        Post::create($data);
    
        return redirect('/post');
    }
    
    

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $post = Post::findOrFail($id); 
        $categories = Category::all();
        return view('posts.edit', compact('post', 'categories'));
    }
    

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'category_id' => 'required',
            'title' => 'required|string',
            'description' => 'required|string',
            'text' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:3000',
        ]);
    
        $post = Post::findOrFail($id);
    
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('dist/img'), $imageName); 
            $data['image'] = 'dist/img/' . $imageName; 
    
            if ($post->image && file_exists(public_path($post->image))) {
                unlink(public_path($post->image));
            }
        }
    
        $post->update($data);
    
        return redirect('/post');
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();

        return redirect('/post');
    }
    public function showView(Post $post)
    {
        $ip = FacadesRequest::ip(); // Get the IP address of the visitor

        // Check if the IP address has already viewed the post
        $hasViewed = Views::where('post_id', $post->id)->where('ip_address', $ip)->exists();

        if (!$hasViewed) {
            // Increment the post's views count
            $post->increment('views');

            // Log the view in the database
            Views::create([
                'post_id' => $post->id,
                'ip_address' => $ip,
            ]);
        }

        return view('post.show', compact('post'));
    }
    public function toggleLike(Request $request, Post $post)
    {
        // Ensure user is logged in
        $user = auth()->user();
    
        if (!$user) {
            return redirect()->route('login')->with('error', 'You need to log in to like or dislike a post.');
        }
    
        // Validate the input
        $request->validate([
            'is_like' => 'required|boolean',
        ]);
    
        // Find existing like/dislike
        $existingLike = $post->likes()->where('user_id', $user->id)->first();
    
        if ($existingLike) {
            if ($existingLike->is_like == $request->is_like) {
                $existingLike->delete(); // Unlike/undislike
            } else {
                $existingLike->update(['is_like' => $request->is_like]);
            }
        } else {
            $post->likes()->create([
                'user_id' => $user->id,
                'is_like' => $request->is_like,
            ]);
        }
    
        return back()->with('success', 'Your action has been recorded.');
    }
    

    
}
