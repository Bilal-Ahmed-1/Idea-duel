@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold">Idea Battles</h1>
        @auth
            <a href="{{ route('battles.create') }}" class="btn">Create Battle</a>
        @endauth
    </div>

    <h2 class="text-xl mt-4">Active / Upcoming</h2>
    <div class="grid gap-4 mt-2">
        @forelse($active as $battle)
            <div class="p-4 border rounded">
                <a href="{{ route('battles.show', $battle) }}" class="text-lg font-semibold">{{ $battle->title }}</a>
                <p class="text-sm text-gray-600">{{ Str::limit($battle->description, 150) }}</p>
                <div class="text-xs text-gray-500 mt-2">
                    Starts: {{ optional($battle->starts_at)->toDayDateTimeString() ?? 'Now' }}
                    • Ends: {{ optional($battle->ends_at)->toDayDateTimeString() ?? 'N/A' }}
                </div>
            </div>
        @empty
            <div>No active battles yet.</div>
        @endforelse
    </div>

    <h2 class="text-xl mt-8">Archives</h2>
    <div class="grid gap-4 mt-2">
        @forelse($archived as $battle)
            <div class="p-4 border rounded">
                <a href="{{ route('battles.show', $battle) }}" class="text-lg font-semibold">{{ $battle->title }}</a>
                <p class="text-sm text-gray-600">{{ Str::limit($battle->description, 150) }}</p>
                <div class="text-xs text-gray-500 mt-2">
                    Ended: {{ optional($battle->ends_at)->toDayDateTimeString() }}
                </div>
            </div>
        @empty
            <div>No archived battles yet.</div>
        @endforelse
    </div>
</div>
@endsection