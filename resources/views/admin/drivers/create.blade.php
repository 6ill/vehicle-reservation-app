<!DOCTYPE html>
<html>

<head>
    <title>Tambah Driver</title>
    <style>
        body {
            font-family: sans-serif;
            margin: 2rem;
            max-width: 600px;
        }

        .form-group {
            margin-bottom: 1rem;
        }

        label {
            display: block;
        }

        input,
        select {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
        }

        .error {
            color: red;
            font-size: 0.875em;
        }
    </style>
</head>

<body>
    <h1>Tambah Driver Baru</h1>
    <form action="{{ route('admin.drivers.store') }}" method="POST">
        @csrf 
        @include('admin.drivers.partials._form')
    </form>
</body>

</html>
