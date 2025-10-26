<?php

namespace App\Http\Controllers;

use App\Models\Battle;
use App\Models\Idea;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IdeaController extends Controller
{
    public function create(Battle $battle)
    {
        if (! $battle->isActive() && ! auth()->user()) {
            // Allow logged-out users to view but require login to create
        }
        return view('ideas.create', compact('battle'));
    }

    public function store(Request $r, Battle $battle)
    {
        $r->validate([
            'title'=>'required|string|max:255',
            'description'=>'nullable|string',
        ]);

        $idea = Idea::create([
            'battle_id'=>$battle->id,
            'user_id'=>auth()->id(),
            'title'=>$r->title,
            'description'=>$r->description,
        ]);

        return redirect()->route('battles.show',$battle)->with('success','Idea submitted!');
    }
}
