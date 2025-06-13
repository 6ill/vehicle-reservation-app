<!DOCTYPE html>
<html>
<head>
    <title>Manajemen Driver</title>
    {{-- Kita akan ganti style ini dengan layout nanti --}}
    <style> body { font-family: sans-serif; margin: 2rem; } table { width: 100%; border-collapse: collapse; } th, td { border: 1px solid #ccc; padding: 8px; text-align: left; } .btn { padding: 5px 10px; text-decoration: none; border-radius: 4px; color: white; } .btn-create { background-color: #28a745; margin-bottom: 1rem; display: inline-block;} .btn-edit { background-color: #ffc107; } .btn-delete { background-color: #dc3545; border: none; cursor: pointer; } .alert-success { padding: 1rem; background-color: #d4edda; color: #155724; border: 1px solid #c3e6cb; border-radius: 4px; margin-bottom: 1rem; } </style>
</head>
<body>
    @include('admin.layouts._nav')

    <h1>Manajemen Driver</h1>
    <a href="{{ route('admin.drivers.create') }}" class="btn btn-create">Tambah Driver Baru</a>

    @if(session('success'))
        <div class="alert-success">{{ session('success') }}</div>
    @endif

    <table>
        <thead>
            <tr>
                <th>Nama Driver</th>
                <th>No. Telepon</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($drivers as $driver)
                <tr>
                    <td>{{ $driver->name }}</td>
                    <td>{{ $driver->phone_number }}</td>
                    <td>{{ $driver->is_available ? 'Tersedia' : 'Tidak Tersedia' }}</td>
                    <td>
                        <a href="{{ route('admin.drivers.edit', $driver) }}" class="btn btn-edit">Edit</a>
                        <form action="{{ route('admin.drivers.destroy', $driver) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-delete" onclick="return confirm('Anda yakin ingin menghapus?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">Tidak ada data driver.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>