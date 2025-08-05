<div>
    <h1>Articles</h1>
    <ul>
        @php
           $array = ['a', 'b', 'c']; 
        @endphp
        @foreach($articles as $k => $article)
              @if($k == 0)
                  <strong>Featured Article:</strong>
              @endif
            <li> {{ $k }}: {{ $article->title }} - {{ $article->content }}</li>
        @endforeach
        {{-- Comment --}}
        @foreach($array as $item)
            <li>{{ $item }}</li>
        @endforeach
    </ul>
</div>