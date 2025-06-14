<x-layouts.admin>
    <x-slot:title>Manajemen Kendaraan</x-slot:title>

    <div class="flex justify-end mb-4">
        <a href="{{ route('admin.vehicles.create') }}" class="inline-block px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600">
            Tambah Kendaraan
        </a>
    </div>

    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <table class="min-w-full leading-normal">
            <thead>
                <tr>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Nama & No. Polisi
                    </th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Jenis & Kepemilikan
                    </th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Status
                    </th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100"></th>
                </tr>
            </thead>
            <tbody>
                @forelse ($vehicles as $vehicle)
                    <tr>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                            <p class="text-gray-900 whitespace-no-wrap">{{ $vehicle->name }}</p>
                            <p class="text-gray-600 whitespace-no-wrap">{{ $vehicle->license_plate }}</p>
                        </td>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                            <p class="text-gray-900 whitespace-no-wrap">{{ Str::ucfirst(str_replace('_',' ',$vehicle->type)) }}</p>
                            <p class="text-gray-600 whitespace-no-wrap">{{ Str::ucfirst($vehicle->ownership) }}</p>
                        </td>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                            @php
                                $statusTextColor = '';
                                $statusBgColor = '';
                                switch ($vehicle->status) {
                                    case 'in_use':
                                        $statusTextColor = 'text-yellow-900';
                                        $statusBgColor = 'bg-yellow-200';
                                        break;
                                    case 'maintenance':
                                        $statusTextColor = 'text-blue-900';
                                        $statusBgColor = 'bg-blue-200';
                                        break;
                                    case 'available':
                                        $statusTextColor = 'text-green-900';
                                        $statusBgColor = 'bg-green-200';
                                        break;
                                }
                            @endphp
                            <span class="relative inline-block px-3 py-1 font-semibold {{ $statusTextColor }} leading-tight">
                                <span aria-hidden class="absolute inset-0 {{ $statusBgColor }} opacity-50 rounded-full"></span>
                                <span class="relative">{{ Str::ucfirst(str_replace('_', ' ',$vehicle->status)) }}</span>
                            </span>
                        </td>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-right">
                            <div class="flex flex-col space-y-2 md:flex-row md:space-y-0 md:space-x-2">
                                <a href="{{ route('admin.vehicles.service-history.index', $vehicle) }}" class="text-green-600 hover:text-green-900 mr-4">Riwayat Servis</a>
                                <a href="{{ route('admin.vehicles.fuel-logs.index', $vehicle) }}" class="text-blue-600 hover:text-blue-900 mr-4">Lihat BBM</a>
                                <a href="{{ route('admin.vehicles.edit', $vehicle) }}" class="text-indigo-600 hover:text-indigo-900 mr-4">Edit</a>
                                <form action="{{ route('admin.vehicles.destroy', $vehicle) }}" method="POST" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900 mr-4" onclick="return confirm('Anda yakin?')">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center">
                            Tidak ada data kendaraan.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-layouts.admin>