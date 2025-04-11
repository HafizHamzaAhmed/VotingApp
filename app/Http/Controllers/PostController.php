<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::where('is_hidden', false)->with('user', 'votes')->latest()->get();
        $topPosts = Post::where('is_hidden', false)->withCount('votes')->orderByDesc('votes_count')->take(10)->get();

        return view('posts.index', compact('posts', 'topPosts'));
    }

    public function create()
    {
        return view('posts.upsert');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required|max:1000',
            'type' => 'required|in:Request,Complaint,Improvement',
        ]);

        auth()->user()->posts()->create($request->only('title', 'description', 'type'));

        return redirect()->route('posts.index')->with('success', 'Post created.');
    }

    public function edit(Post $post)
    {
        return view('posts.upsert', compact('post'));
    }

    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required|max:1000',
            'type' => 'required|in:Request,Complaint,Improvement',
        ]);

        $post->update($request->only('title', 'description', 'type'));

        return redirect()->route('posts.index')->with('success', 'Post updated.');
    }
}
