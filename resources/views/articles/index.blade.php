 
 @extends('layouts.app')
@section('content')
<div>
    <h1>Articles</h1>
     <table class="table">
        <thead>
            <tr>
                <th>Title</th>
                <th>Category</th>
                <th>Author</th>
                <th>Published At</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($articles as $article)
                <tr>
                    <td>{{ $article->title }}</td>
                    <td>{{ $article->category->name }}</td>
                    <td>{{ $article->author }}</td>
                    <td>{{ $article->published_at }}</td>
                    <td>
                        <a href="{{ route('articles.show', $article->id) }}" class="btn btn-info">View</a>
                        <a href="{{ route('articles.edit', $article->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('articles.destroy', $article->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $articles->links() }}
@endsection
 