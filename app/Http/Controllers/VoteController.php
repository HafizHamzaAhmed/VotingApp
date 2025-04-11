<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Vote;
use Illuminate\Http\Request;

class VoteController extends Controller
{
    public function store(Post $post)
    {
        if ($post->is_hidden) {
            return back()->with('error', 'You cannot vote for a hidden post.');
        }

        $alreadyVoted = Vote::where('user_id', auth()->id())->where('post_id', $post->id)->exists();

        if ($alreadyVoted) {
            return back()->with('error', 'You have already voted for this post.');
        }

        Vote::create([
            'user_id' => auth()->id(),
            'post_id' => $post->id,
        ]);

        return back()->with('success', 'Vote recorded.');
    }
}
