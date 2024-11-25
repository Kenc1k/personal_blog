<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request as FacadesRequest;

class ViewsController extends Controller
{
    public function show(Post $post)
{
    $ip = FacadesRequest::ip();

    // Check if the IP has already viewed the post
    $hasViewed = PostView::where('post_id', $post->id)->where('ip_address', $ip)->exists();

    if (!$hasViewed) {
        // Increment the views count
        $post->increment('views');

        // Record the view
        PostView::create([
            'post_id' => $post->id,
            'ip_address' => $ip,
        ]);
    }

    return view('post.show', compact('post'));
}
}
