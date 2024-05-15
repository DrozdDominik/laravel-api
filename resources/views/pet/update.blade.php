<!DOCTYPE html>
<html>
<head>
    <title>Update Pet</title>
</head>
<body>
    <h1>Update Pet</h1>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    
    <a href="/" class="btn btn-primary">Go back</a>
</body>
</html>