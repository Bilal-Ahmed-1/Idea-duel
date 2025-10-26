<?php

namespace App\Http\Controllers;

use App\Models\Idea;
use App\Models\Vote;
use Illuminate\Http\Request;

class VoteController extends Controller
{
    public function store(Request $r, Idea $idea)
    {
        $user = $r->user();
        if (! $user) return redirect()->route('login');

        // Prevent voting on own idea
        if ($idea->user_id == $user->id) {
            return back()->with('error','You cannot vote for your own idea.');
        }

        // unique vote per (idea, user)
        $exists = Vote::where('idea_id', $idea->id)->where('user_id', $user->id)->exists();
        if ($exists) {
            return back()->with('error','You already voted for this idea.');
        }

        Vote::create(['idea_id'=>$idea->id,'user_id'=>$user->id]);
        $idea->recalcPoints();

        return back()->with('success','Vote registered. Thanks!');
    }
}

