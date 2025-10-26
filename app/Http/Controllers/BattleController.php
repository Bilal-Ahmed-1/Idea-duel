<?php

namespace App\Http\Controllers;

use App\Models\Battle;
use Illuminate\Http\Request;

class BattleController extends Controller
{
    public function index()
    {
        $active = Battle::where(function($q){
            $q->whereNull('ends_at')->orWhere('ends_at', '>', now());
        })->orderByDesc('created_at')->get();

        $archived = Battle::whereNotNull('ends_at')->where('ends_at','<=', now())->orderByDesc('ends_at')->get();

        return view('battles.index', compact('active','archived'));
    }

    public function create()
    {
        return view('battles.create');
    }

    public function store(Request $r)
    {
        $data = $r->validate([
            'title'=>'required|string|max:255',
            'description'=>'nullable|string',
            'starts_at'=>'nullable|date',
            'ends_at'=>'nullable|date|after:starts_at',
            'is_public'=>'nullable|boolean',
        ]);

        $data['is_public'] = $r->has('is_public');
        $battle = Battle::create($data);

        return redirect()->route('battles.show', $battle)->with('success','Battle created.');
    }

    public function show(Battle $battle)
    {
        $ideas = $battle->ideas()->with('user','votes','comments')->orderByDesc('points')->get();
        return view('battles.show', compact('battle','ideas'));
    }
}

