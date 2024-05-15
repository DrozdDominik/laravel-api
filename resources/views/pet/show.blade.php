<!DOCTYPE html>
<html>
<head>
    <title>Search Pets</title>
</head>
<body>
    <h1>Search Pets</h1>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form method="GET" action="{{ route('getPet') }}">
        <label for="petId">Pet ID:</label>
        <input type="number" step="1" min="0" id="petId" name="petId">
        <input type="submit" value="Search by ID">
    </form>

    <a href="/" class="btn btn-primary">Go back</a>
</body>
</html>