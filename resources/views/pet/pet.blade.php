<!DOCTYPE html>
<html>
<head>
    <title>Pet Details</title>
</head>
<body>
    <h1>Pet Details</h1>
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
            <li>{{ is_string($tag->name) ? $tag->name : 'N/A' }}</li>
        @endforeach
        </ul>
    @endif
    <a href="{{ route('getPets') }}" class="btn btn-primary">Go back</a>
</body>
</html>