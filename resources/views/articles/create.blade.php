 
@extends('layouts.app')
@section('content')
<form action="{{ route('articles.store') }}" method="POST" class="mt-4">
    @csrf
    <div class="mb-3">
        <label for="title">Title:</label>
        <input type="text" id="title" name="title" required>
    </div>
    <div class="mb-3">
        <label for="content">Content:</label>
        <textarea id="content" name="content" required></textarea>
    </div>
    <div class="mb-3">
        <label for="author">Author:</label>
        <input type="text" id="author" name="author" required>
    </div>
    <div class="mb-3">
        <label for="published_at">Published At:</label>
        <input type="datetime-local" id="published_at" name="published_at" required>
    </div>
    <button type="submit" class="btn btn-primary">Create Article</button>
</form>
@endsection