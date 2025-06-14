<x-layouts.approver> {{-- Kita bisa pakai layout admin yang sama untuk konsistensi --}}
    <x-slot:title>Dashboard Persetujuan</x-slot:title>

    <div class="bg-white shadow-md rounded-lg overflow-hidden overflow-x-auto">
        <table class="min-w-full leading-normal">
            <thead>
                <tr>
                    <th
                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                        Pemesan & Keperluan</th>
                    <th
                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                        Kendaraan</th>
                    <th
                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                        Jadwal</th>
                    <th
                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-center text-xs font-semibold text-gray-700 uppercase tracking-wider">
                        Level Persetujuan</th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($approvals as $approval)
                    <tr>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                            <p class="text-gray-900 whitespace-no-wrap font-bold">
                                {{ $approval->reservation->requester->name }}</p>
                            <p class="text-gray-600 whitespace-no-wrap">
                                {{ Str::limit($approval->reservation->purpose, 40) }}</p>
                        </td>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                            <p class="text-gray-900 whitespace-no-wrap">{{ $approval->reservation->vehicle->name }}
                            </p>
                            <p class="text-gray-600 whitespace-no-wrap">
                                {{ $approval->reservation->vehicle->license_plate }}</p>
                        </td>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                            <p class="text-gray-900 whitespace-no-wrap">Mulai:
                                {{ \Carbon\Carbon::parse($approval->reservation->start_datetime)->format('d M Y, H:i') }}
                            </p>
                            <p class="text-gray-600 whitespace-no-wrap">Selesai:
                                {{ \Carbon\Carbon::parse($approval->reservation->end_datetime)->format('d M Y, H:i') }}
                            </p>
                        </td>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center">
                            <span class="font-bold text-lg text-indigo-600">{{ $approval->level }}</span>
                        </td>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                            <div class="flex flex-col items-center space-y-2 md:flex-row md:space-y-0 md:space-x-2">
                                <form action="{{ route('approver.approve', $approval) }}" method="POST">
                                    @csrf
                                    <button type="submit"
                                        class="text-white bg-green-500 hover:bg-green-600 px-3 py-1 rounded-full text-xs">Setujui</button>
                                </form>
                                <form action="{{ route('approver.reject', $approval) }}" method="POST">
                                    @csrf
                                    <button type="submit"
                                        class="text-white bg-red-500 hover:bg-red-600 px-3 py-1 rounded-full text-xs"
                                        onclick="return confirm('Anda yakin ingin menolak reservasi ini?')">Tolak</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center py-10 text-gray-500">
                            Tidak ada permintaan persetujuan untuk Anda saat ini.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-layouts.approver>
