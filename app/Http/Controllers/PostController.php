<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

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
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('dist/img'), $imageName); 
            $data['image'] = 'dist/img/' . $imageName; 
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
        $post = Post::findOrFail($id); // Fetch the post to edit
        $categories = Category::all(); // Fetch all categories for the dropdown
        return view('posts.edit', compact('post', 'categories')); // Pass both to the view
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
}
