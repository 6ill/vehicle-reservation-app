<x-layouts.admin>
    <x-slot:title>Manajemen Reservasi</x-slot:title>
    
    <div class="flex justify-end mb-4">
        <a href="{{ route('admin.reservations.create') }}" class="inline-block px-4 py-2 bg-green-500 text-white rounded-lg shadow hover:bg-green-600 transition-colors">
            Buat Reservasi Baru
        </a>
    </div>

    <div class="bg-white shadow-md rounded-lg overflow-x-auto">
        <table class="min-w-full leading-normal">
            <thead>
                <tr>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Pemesan & Keperluan</th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Kendaraan & Driver</th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Jadwal</th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Status</th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($reservations as $reservation)
                <tr>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        <p class="text-gray-900 whitespace-no-wrap font-bold">{{ $reservation->requester->name }}</p>
                        <p class="text-gray-600 whitespace-no-wrap">{{ Str::limit($reservation->purpose, 30) }}</p>
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        <p class="text-gray-900 whitespace-no-wrap">{{ $reservation->vehicle->name }}</p>
                        <p class="text-gray-600 whitespace-no-wrap">Driver: {{ $reservation->driver->name }}</p>
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        <p class="text-gray-900 whitespace-no-wrap">Mulai: {{ \Carbon\Carbon::parse($reservation->start_datetime)->format('d M Y, H:i') }}</p>
                        <p class="text-gray-600 whitespace-no-wrap">Selesai: {{ \Carbon\Carbon::parse($reservation->end_datetime)->format('d M Y, H:i') }}</p>
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        @php
                            $statusTextColor = '';
                            $statusBgColor = '';
                            switch ($reservation->status) {
                                case 'pending':
                                    $statusTextColor = 'text-yellow-900';
                                    $statusBgColor = 'bg-yellow-200';
                                    break;
                                case 'approved':
                                    $statusTextColor = 'text-blue-900';
                                    $statusBgColor = 'bg-blue-200';
                                    break;
                                case 'completed':
                                    $statusTextColor = 'text-green-900';
                                    $statusBgColor = 'bg-green-200';
                                    break;
                                case 'rejected':
                                    $statusTextColor = 'text-red-900';
                                    $statusBgColor = 'bg-red-200';
                                    break;
                            }
                        @endphp
                        <span class="relative inline-block px-3 py-1 font-semibold leading-tight {{ $statusTextColor }}">
                            <span aria-hidden class="absolute inset-0 opacity-50 rounded-full {{ $statusBgColor }}"></span>
                            <span class="relative">{{ Str::ucfirst($reservation->status) }}</span>
                        </span>
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        @if ($reservation->status === 'approved')
                            <form action="{{ route('admin.reservations.complete', $reservation) }}" method="POST">
                                @csrf
                                <button type="submit" class="text-white bg-blue-500 hover:bg-blue-600 px-3 py-1 rounded-full text-xs">
                                    Selesaikan
                                </button>
                            </form>
                        @else
                            -
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center py-5">Belum ada data reservasi.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-layouts.admin>