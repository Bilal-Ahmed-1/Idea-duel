@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <div class="flex justify-between items-start">
        <div>
            <h1 class="text-2xl font-bold">{{ $battle->title }}</h1>
            <p class="text-gray-700">{{ $battle->description }}</p>
            <div class="text-sm text-gray-500 mt-2">
                Starts: {{ optional($battle->starts_at)->toDayDateTimeString() ?? 'Now' }} •
                Ends: {{ optional($battle->ends_at)->toDayDateTimeString() ?? 'N/A' }}
            </div>
        </div>

        <div>
            @auth
                <a href="{{ route('ideas.create', $battle) }}" class="btn">Submit Idea</a>
            @else
                <a href="{{ route('login') }}" class="btn">Login to Submit</a>
            @endauth
        </div>
    </div>

    <h2 class="text-xl mt-6">Ideas</h2>
    <div class="grid gap-4 mt-3">
        @forelse($ideas as $idea)
            <div class="p-4 border rounded">
                <div class="flex justify-between">
                    <div>
                        <h3 class="text-lg font-semibold">{{ $idea->title }}</h3>
                        <div class="text-sm text-gray-600">by {{ $idea->user->name }}</div>
                        <p class="mt-2">{{ Str::limit($idea->description, 300) }}</p>
                    </div>
                    <div class="text-center">
                        <div class="text-2xl font-bold">{{ $idea->points }}</div>
                        <div class="text-sm text-gray-500">points</div>
                        @auth
                        <form method="POST" action="{{ route('ideas.vote', ['idea' => $idea->id]) }}" class="mt-2">
                            @csrf
                            <button class="btn">Vote</button>
                        </form>
                        @endauth
                    </div>
                </div>

                <div class="mt-3 border-t pt-2">
                    <strong>Comments</strong>
                    <div class="mt-2">
                        @foreach($idea->comments as $comment)
                            <div class="text-sm border p-2 rounded mb-1">
                                <div class="text-xs text-gray-500">{{ $comment->user->name }} • {{ $comment->created_at->diffForHumans() }}</div>
                                <div>{{ $comment->body }}</div>
                            </div>
                        @endforeach
                    </div>

                    @auth
                    <form method="POST" action="{{ route('ideas.comment', $idea) }}" class="mt-2">
                        @csrf
                        <textarea name="body" class="w-full border p-2" rows="2" placeholder="Add a comment..."></textarea>
                        <button class="btn mt-1">Comment</button>
                    </form>
                    @endauth
                </div>
            </div>
        @empty
            <div>No ideas yet — be the first to submit!</div>
        @endforelse
    </div>
</div>
@endsection
