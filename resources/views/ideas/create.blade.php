@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4 max-w-2xl">
    <h1 class="text-2xl font-bold mb-4">Submit Idea to: {{ $battle->title }}</h1>

    <form method="POST" action="{{ route('ideas.store', $battle) }}">
        @csrf
        <div class="mb-3">
            <label class="block">Title</label>
            <input name="title" class="w-full border p-2" required>
        </div>

        <div class="mb-3">
            <label class="block">Description</label>
            <textarea name="description" class="w-full border p-2" rows="6"></textarea>
        </div>

        <button class="btn">Submit Idea</button>
    </form>
</div>
@endsection
