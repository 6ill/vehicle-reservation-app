<!DOCTYPE html>
<html>
<head>
    <title>Manajemen Kendaraan</title>
    <style> /* Anda bisa menggunakan CSS framework di sini */
        body { font-family: sans-serif; margin: 2rem; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #ccc; padding: 8px; text-align: left; }
        .btn { padding: 5px 10px; text-decoration: none; border-radius: 4px; color: white; }
        .btn-create { background-color: #28a745; margin-bottom: 1rem; display: inline-block;}
        .btn-edit { background-color: #ffc107; }
        .btn-delete { background-color: #dc3545; border: none; cursor: pointer; }
        .alert-success { padding: 1rem; background-color: #d4edda; color: #155724; border: 1px solid #c3e6cb; border-radius: 4px; margin-bottom: 1rem; }
    </style>
</head>
<body>
    @include('admin.layouts._nav')
    <h1>Manajemen Kendaraan</h1>
    <a href="{{ route('admin.vehicles.create') }}" class="btn btn-create">Tambah Kendaraan Baru</a>

    @if(session('success'))
        <div class="alert-success">{{ session('success') }}</div>
    @endif

    <table>
        <thead>
            <tr>
                <th>Nama Kendaraan</th>
                <th>No. Polisi</th>
                <th>Jenis</th>
                <th>Lokasi Pangkalan</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($vehicles as $vehicle)
                <tr>
                    <td>{{ $vehicle->name }}</td>
                    <td>{{ $vehicle->license_plate }}</td>
                    <td>{{ $vehicle->type }}</td>
                    <td>{{ $vehicle->baseLocation->name }}</td>
                    <td>{{ $vehicle->status }}</td>
                    <td>
                        <a href="{{ route('admin.vehicles.edit', $vehicle) }}" class="btn btn-edit">Edit</a>
                        <form action="{{ route('admin.vehicles.destroy', $vehicle) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-delete" onclick="return confirm('Anda yakin ingin menghapus?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6">Tidak ada data kendaraan.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>