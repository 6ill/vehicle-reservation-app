<x-layouts.admin>
    <x-slot:title>Log BBM: {{ $vehicle->name }}</x-slot:title>

    <div class="flex justify-between items-center mb-4">
        <a href="{{ route('admin.vehicles.index') }}" class="text-sm text-indigo-600 hover:text-indigo-900">&larr; Kembali ke Daftar Kendaraan</a>
        <a href="{{ route('admin.vehicles.fuel-logs.create', $vehicle) }}" class="inline-block px-4 py-2 bg-green-500 text-white rounded-lg shadow hover:bg-green-600 transition-colors">
            + Tambah Log Baru
        </a>
    </div>

    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <table class="min-w-full leading-normal">
            <thead>
                <tr>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Tanggal Isi</th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Jumlah (Liter)</th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Biaya (Rp)</th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100"></th>
                </tr>
            </thead>
            <tbody>
                @forelse ($logs as $log)
                    <tr>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{{ \Carbon\Carbon::parse($log->refuel_date)->format('d M Y') }}</td>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{{ $log->liters_filled }}</td>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{{ number_format($log->cost, 0, ',', '.') }}</td>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-right">
                            <a href="{{ route('admin.fuel-logs.edit', $log) }}" class="text-indigo-600 hover:text-indigo-900 mr-4">Edit</a>
                            <form action="{{ route('admin.fuel-logs.destroy', $log) }}" method="POST" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Anda yakin?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="text-center py-5">Belum ada data log BBM.</td></tr>
                @endforelse
            </tbody>
        </table>
        <div class="p-4">
            {{ $logs->links() }}
        </div>
    </div>
</x-layouts.admin>