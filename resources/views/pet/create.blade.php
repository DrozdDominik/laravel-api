<!DOCTYPE html>
<html>
<head>
    <title>Create Pet</title>
</head>
<body>

    <h1>Create a new Pet</h1>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form method="POST" action="{{ route('createPet') }}">
        @csrf

        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>

        <div class="form-group">
            <label for="status">Status</label>
            <select class="form-control" id="status" name="status">
                <option value="available">Available</option>
                <option value="pending">Pending</option>
                <option value="sold">Sold</option>
            </select>
        </div>

        <div id="urls" class="form-group">
            <label for="photoUrls">Photo URLs</label>
            <input type="text" class="form-control" id="photoUrls" name="photoUrls[]" required>
            <small class="form-text text-muted">Add more photo URLs by clicking the "Add another URL" button.</small>
            <button type="button" class="btn btn-secondary" onclick="addPhotoUrl()">Add another URL</button>
        </div>

        <div id="tags" class="form-group">
            <label for="tags">Tags</label>
            <input type="text" class="form-control" id="tags" name="tags[]">
            <small class="form-text text-muted">Add more tags by clicking the "Add another tag" button.</small>
            <button type="button" class="btn btn-secondary" onclick="addTag()">Add another tag</button>
        </div>

        <div class="form-group">
            <label for="name">Category</label>
            <input type="text" class="form-control" id="category" name="category">
        </div>

        <input type="submit" value="Add pet">

    </form>

    <script>
        function addPhotoUrl() {
            var input = document.createElement('input');
            input.type = 'text';
            input.name = 'photoUrls[]';
            input.classList.add('form-control');
            document.querySelector('#urls').appendChild(input);
        }

        function addTag() {
            var input = document.createElement('input');
            input.type = 'text';
            input.name = 'tags[]';
            input.classList.add('form-control');
            document.querySelector('#tags').appendChild(input);
        }
    </script>

    <a href="/" class="btn btn-primary">Go back</a>
</body>
</html>