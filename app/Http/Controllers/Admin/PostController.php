<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::with('user', 'votes')->latest()->get();
        return view('admin.posts.index', compact('posts'));
    }

    public function destroy(string $id)
    {
        $post = Post::findOrFail($id);
        $post->delete();
        return back()->with('success', 'Post deleted.');
    }

    public function hide(Post $post)
    {
        $post->is_hidden = !$post->is_hidden;
        $post->save();
    
        return back()->with('success', $post->is_hidden ? 'Post hidden.' : 'Post unhidden.');
    }
}
