@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4 max-w-2xl">
    <h1 class="text-2xl font-bold mb-4">Create Battle</h1>

    <form method="POST" action="{{ route('battles.store') }}">
        @csrf
        <div class="mb-3">
            <label class="block">Title</label>
            <input name="title" class="w-full border p-2" value="{{ old('title') }}" required>
        </div>

        <div class="mb-3">
            <label class="block">Description</label>
            <textarea name="description" class="w-full border p-2">{{ old('description') }}</textarea>
        </div>

        <div class="mb-3">
            <label class="block">Starts at (optional)</label>
            <input type="datetime-local" name="starts_at" class="w-full border p-2" value="{{ old('starts_at') }}">
        </div>

        <div class="mb-3">
            <label class="block">Ends at (optional)</label>
            <input type="datetime-local" name="ends_at" class="w-full border p-2" value="{{ old('ends_at') }}">
        </div>

        <div class="mb-3">
            <label><input type="checkbox" name="is_public" {{ old('is_public') ? 'checked' : '' }}> Public</label>
        </div>

        <button class="btn">Create</button>
    </form>
</div>
@endsection

