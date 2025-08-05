<form action="{{ route('articles.store') }}" method="POST">
    @csrf
    <div>
        <label for="title">Title:</label>
        <input type="text" id="title" name="title" required>
    </div>
    <div>
        <label for="content">Content:</label>
        <textarea id="content" name="content" required></textarea>
    </div>
    <div>
        <label for="author">Author:</label>
        <input type="text" id="author" name="author" required>
    </div>
    <div>   
        <label for="published_at">Published At:</label>
        <input type="datetime-local" id="published_at" name="published_at" required>
    </div>
    <button type="submit">Create Article</button>
</form>