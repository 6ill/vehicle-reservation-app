<x-layouts.admin>
    <x-slot:title>Laporan Reservasi Periodik</x-slot:title>

    <div class="bg-white p-6 rounded-lg shadow-md mb-6">
        <h3 class="text-lg font-semibold mb-4">Filter Laporan</h3>
        <form method="GET" action="{{ route('admin.reports.reservations.index') }}" class="grid grid-cols-1 md:grid-cols-3 gap-4 items-end">
            <x-form.input label="Tanggal Mulai" name="start_date" type="date" :value="request('start_date')" />
            <x-form.input label="Tanggal Selesai" name="end_date" type="date" :value="request('end_date')" />
            <div class="flex space-x-2">
                <button type="submit" class="w-full justify-center py-2 px-4 bg-indigo-600 text-white rounded-md shadow-sm hover:bg-indigo-700">
                    Filter
                </button>
                <a href="{{ route('admin.reports.reservations.export', request()->query()) }}" class="w-full text-center justify-center py-2 px-4 bg-green-600 text-white rounded-md shadow-sm hover:bg-green-700">
                    Export Excel
                </a>
            </div>
        </form>
    </div>

    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <table class="min-w-full leading-normal">
            <thead>
                <tr>
                    <th class="px-5 py-3 border-b-2 ...">Pemesan</th>
                    <th class="px-5 py-3 border-b-2 ...">Kendaraan</th>
                    <th class="px-5 py-3 border-b-2 ...">Jadwal</th>
                    <th class="px-5 py-3 border-b-2 ...">Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($reservations as $reservation)
                    <tr>
                        <td class="px-5 py-5 border-b ...">{{ $reservation->requester->name }}</td>
                        <td class="px-5 py-5 border-b ...">{{ $reservation->vehicle->name }}</td>
                        <td class="px-5 py-5 border-b ...">{{ \Carbon\Carbon::parse($reservation->start_datetime)->format('d M Y') }}</td>
                        <td class="px-5 py-5 border-b ...">{{ ucfirst($reservation->status) }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center py-5">
                            @if(request()->has('start_date'))
                                Tidak ada data untuk rentang tanggal yang dipilih.
                            @else
                                Silakan gunakan filter untuk menampilkan laporan.
                            @endif
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <div class="p-4">
            {{-- Menambahkan parameter filter ke link pagination --}}
            {{ $reservations->appends(request()->query())->links() }}
            {{ Log::debug("message"); }}
        </div>
    </div>
</x-layouts.admin>