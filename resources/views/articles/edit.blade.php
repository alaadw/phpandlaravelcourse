@extends('layouts.app')
@section('content')
<div class="row justify-content-center">  
    
    <form action="{{ route('articles.update', $article->id) }}" enctype="multipart/form-data" method="POST" class="col-md-8">
        @csrf
        @method('PUT')
        
        <div class="mb-3">
            <label for="title" class="form-label">Title:</label>
            <input type="text" id="title" name="title" value="{{ old('title', $article->title) }}" class="form-control" required>
        </div>
        <!-- asset is one of laravel helpers : means ready functions-->
        <img src="{{ asset('storage/' . $article->image) }}" alt="Article Image" class="img-fluid mb-3"/>
        <div class="mb-3">
            <label for="category_id" class="form-label">Category:</label>
            <select id="category_id" name="category_id" class="form-select" required>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ $article->category_id == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        <div class="mb-3">
            <label for="content" class="form-label">Content:</label>
            <textarea id="content" name="content" class="form-control" required>{{ old('content', $article->content) }}</textarea>
        </div>
        
        <div class="mb-3">
            <label for="author" class="form-label">Author:</label>
            <input type="text" id="author" name="author" value="{{ old('author', $article->author) }}" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Image:</label>
            <input type="file" id="image" name="image"  class="form-control" >
        </div>   
        <div class="mb-3">
            <label for="published_at" class="form-label">Published At:</label>
            <input type="datetime-local" id="published_at" name="published_at" value="{{ old('published_at', $article->published_at) }}" class="form-control" required>
        </div>
        
        <button type="submit" class="btn btn-primary">Update Article</button>
</div>