<!DOCTYPE html>
<html>
<head>
    <title>Upload Pet Image</title>
</head>
<body>
    <h1>Upload Pet Image</h1>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('uploadData') }}" method="POST" enctype="multipart/form-data">
    @csrf
        <div>
            <label for="petId">Pet ID:</label>
            <input type="number" id="petId" name="petId" required>
        </div>
        <div>
            <label for="additionalMetadata">Additional Metadata:</label>
            <input type="text" id="additionalMetadata" name="additionalMetadata">
        </div>
        <div>
            <label for="file">File:</label>
            <input type="file" id="file" name="file" required>
        </div>
        <div>
            <button type="submit">Upload Image</button>
        </div>
    </form>

    <a href="/" class="btn btn-primary">Go back</a>
</body>
</html>