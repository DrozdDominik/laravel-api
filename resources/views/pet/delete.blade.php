<!DOCTYPE html>
<html>
<head>
    <title>Delete Pet</title>
</head>
<body>
    <h1>Delete Pet</h1>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form method="POST" action="{{ route('deleteData') }}">
        @csrf

        <div>
            <label for="petId">Pet ID:</label>
            <input type="number" id="petId" name="petId" required>
        </div>

        <div>
            <button type="submit">Submit</button>
        </div>
    </form>

    <a href="/" class="btn btn-primary">Go back</a>
</body>
</html>