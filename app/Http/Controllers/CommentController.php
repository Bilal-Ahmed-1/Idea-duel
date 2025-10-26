<?php

namespace App\Http\Controllers;

use App\Models\Idea;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $r, Idea $idea)
    {
        $r->validate(['body'=>'required|string|max:1000']);
        $user = $r->user();
        if (! $user) return redirect()->route('login');

        Comment::create([
            'idea_id'=>$idea->id,
            'user_id'=>$user->id,
            'body'=>$r->body,
        ]);

        return back()->with('success','Comment posted.');
    }
}

