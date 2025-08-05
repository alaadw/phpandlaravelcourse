
<div> {{ $page }}
    <h1>Article Details</h1>
    <h2>{{ $article-> title }}</h2>
    <p>{{ $article-> content }}</p>
    <a href="{{ route('articles.index') }}">Back to Articles</a>    