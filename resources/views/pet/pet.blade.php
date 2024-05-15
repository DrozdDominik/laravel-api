<!DOCTYPE html>
<html>
<head>
    <title>Pet Details</title>
</head>
<body>
    <h1>Pet Details</h1>
    <p>ID: {{ $pet['id'] }}</p>
    <p>Name: {{ $pet['name'] }}</p>
    <p>Status: {{ $pet['status'] }}</p>
    <p>Photos:</p>
    <ul>
    @foreach($pet['photoUrls'] as $photoUrl)
        <li>{{ $photoUrl }}</li>
    @endforeach
    </ul>
    <p>Tags:</p>
    <ul>
    @foreach($pet['tags'] as $tag)
        <li>{{ $tag['name'] }}</li>
    @endforeach
    </ul>
    <a href="{{ route('getPets') }}" class="btn btn-primary">Go back</a>
</body>
</html>