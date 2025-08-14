
@extends('layouts.app')
@section('content')
    <div> {{ $page }}
        <h1>Article Details</h1>
        <h2>{{ $article-> title }}</h2>
        <p>{{ $article-> content }}</p>
        <p>Category: {{ $article->category->name }}</p>
        <a href="{{ route('articles.index') }}">Back to Articles</a> 
    </div>
@endsection
@section('scripts')
    <script>
        // You can add any specific scripts for this page here
        console.log('Article details page loaded');
    </script>       
@endsection    
       