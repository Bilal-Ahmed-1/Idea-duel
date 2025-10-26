<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Battle;
use App\Models\Idea;
use Illuminate\Support\Facades\Hash;

class DemoSeeder extends Seeder
{
    public function run()
    {
        User::factory()->create([
            'name'=>'Alice',
            'email'=>'alice@example.com',
            'password'=>Hash::make('password'),
        ]);

        User::factory()->create([
            'name'=>'Bob',
            'email'=>'bob@example.com',
            'password'=>Hash::make('password'),
        ]);

        $b1 = Battle::create([
            'title'=>'Best startup idea under $100',
            'description'=>'Submit the best startup idea that can be launched with less than $100.',
            'starts_at'=>now()->subDays(1),
            'ends_at'=>now()->addDays(7),
        ]);

        $b2 = Battle::create([
            'title'=>'Most creative remote work tool',
            'description'=>'A tool or workflow that helps remote teams be more creative.',
            'starts_at'=>now()->subDays(10),
            'ends_at'=>now()->subDays(2), // archived
        ]);

        // ideas
        Idea::create([
            'battle_id'=>$b1->id,
            'user_id'=>1,
            'title'=>'Pocket Consulting',
            'description'=>'Micro-consulting on demand — 15 minute Zoom calls for niche experts.',
            'points'=>3,
        ]);

        Idea::create([
            'battle_id'=>$b1->id,
            'user_id'=>2,
            'title'=>'Local Lab',
            'description'=>'Tiny pop-up product tests in local markets',
            'points'=>1,
        ]);

        Idea::create([
            'battle_id'=>$b2->id,
            'user_id'=>2,
            'title'=>'Async brainstorm board',
            'description'=>'A simple board with timed idea prompts.',
            'points'=>5,
        ]);
    }
}

