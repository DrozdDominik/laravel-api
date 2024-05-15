<!DOCTYPE html>
<html>
<head>
    <title>Pets List</title>
</head>
<body>
    <h1>Pets List</h1>
    @foreach($pets as $pet)
        <div>
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
        </div>
    @endforeach
    <a href="{{ route('getPets') }}" class="btn btn-primary">Go back</a>
</body>
</html>