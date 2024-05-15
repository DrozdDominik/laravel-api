<!DOCTYPE html>
<html>
<head>
    <title>Pets List</title>
</head>
<body>
    <h1>Pets List</h1>
    @foreach($pets as $pet)
        <div>
            <p>ID: {{ $pet->id ?? 'N/A' }}</p>
            <p>Name: {{ $pet->name ?? 'N/A' }}</p>
            <p>Status: {{ $pet->status ?? 'N/A' }}</p>
            @if(isset($pet->photoUrls))
                <p>Photos:</p>
                <ul>
                @foreach($pet->photoUrls as $photoUrl)
                    <li>{{ $photoUrl }}</li>
                @endforeach
                </ul>
            @endif
            @if(isset($pet->tags))
                <p>Tags:</p>
                <ul>
                @foreach($pet->tags as $tag)
                    <li>{{ $tag->name ?? 'N/A' }}</li>
                @endforeach
                </ul>
            @endif
        </div>
    @endforeach
    <a href="{{ route('getPets') }}" class="btn btn-primary">Go back</a>
</body>
</html>