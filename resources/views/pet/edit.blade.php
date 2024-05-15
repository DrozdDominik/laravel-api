<!DOCTYPE html>
<html>
<head>
    <title>Edit Pet</title>
</head>
<body>
    <h1>Edit Pet</h1>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form method="POST" action="{{ route('editData') }}">
        @csrf
        <div>
            <label for="petId">Pet ID:</label>
            <input type="number" id="petId" name="petId" required>
        </div>
        <div>
            <label for="name">Name:</label>
            <input type="text" id="name" name="name">
        </div>
        <div>
            <label for="status">Status:</label>
            <select id="status" name="status">
                <option value="">Select status</option>
                <option value="available">Available</option>
                <option value="pending">Pending</option>
                <option value="sold">Sold</option>
            </select>
        </div>
        <div>
            <button type="submit">Submit</button>
        </div>
    </form>
    <a href="/" class="btn btn-primary">Go back</a>
</body>
</html>