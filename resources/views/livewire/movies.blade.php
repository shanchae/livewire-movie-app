<div>
    <h1>Movies</h1>
    <ul>
        @foreach($movies as $movie)
            <li>{{ $movie['title'] }}</li>
        @endforeach
    </ul>

     @if($rawResponse)
        <pre>{{ json_encode($rawResponse, JSON_PRETTY_PRINT) }}</pre>
    @endif
</div>
