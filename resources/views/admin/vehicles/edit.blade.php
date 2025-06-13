<!DOCTYPE html>
<html>
<head>
    <title>Edit Kendaraan</title>
    <style> 
        body { font-family: sans-serif; margin: 2rem; max-width: 600px; }
        .form-group { margin-bottom: 1rem; }
        label { display: block; }
        input, select { width: 100%; padding: 8px; box-sizing: border-box; }
        .error { color: red; font-size: 0.875em; }
    </style>
</head>
<body>
    <h1>Edit Kendaraan</h1>
    <form action="{{ route('admin.vehicles.update', $vehicle) }}" method="POST">
        @csrf
        @method('PUT')
        @include('admin.vehicles.partials._form')
    </form>
</body>
</html>