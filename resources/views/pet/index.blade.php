<!DOCTYPE html>
<html>
<head>
    <title>Welcome to Pets Application</title>
</head>
<body>
    <h1>Welcome to Pets Application</h1>
    <div>
        <a href="{{ route('getPets') }}" class="btn btn-primary">Show Pets (GET)</a>
        <a href="{{ route('addPet') }}" class="btn btn-primary">Add Pet (POST)</a>
        <a href="{{ route('updatePet') }}" class="btn btn-primary">Update Pet (PUT)</a>
        <a href="{{ route('deletePet') }}" class="btn btn-primary">Delete Pet (DELETE)</a>
    </div>
</body>
</html>