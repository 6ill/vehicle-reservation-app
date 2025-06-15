<x-layouts.admin>
    <x-slot:title>Dashboard Monitoring</x-slot:title>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h3 class="text-gray-500 text-sm font-medium">Total Kendaraan</h3>
            <p class="text-3xl font-bold text-gray-900">{{ $stats['total_vehicles'] }}</p>
        </div>
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h3 class="text-gray-500 text-sm font-medium">Kendaraan Tersedia</h3>
            <p class="text-3xl font-bold text-green-500">{{ $stats['available_vehicles'] }}</p>
        </div>
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h3 class="text-gray-500 text-sm font-medium">Reservasi Pending</h3>
            <p class="text-3xl font-bold text-yellow-500">{{ $stats['pending_reservations'] }}</p>
        </div>
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h3 class="text-gray-500 text-sm font-medium">Total Driver</h3>
            <p class="text-3xl font-bold text-gray-900">{{ $stats['total_drivers'] }}</p>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h3 class="font-bold text-gray-800 mb-4">Reservasi 12 Bulan Terakhir</h3>
            <div class="relative h-96">
                <canvas id="monthlyReservationsChart" data-url="{{ route('admin.api.charts.reservations') }}"></canvas>
            </div>
        </div>
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h3 class="font-bold text-gray-800 mb-4">Penggunaan Berdasarkan Jenis Kendaraan</h3>
            <div class="max-w-xs mx-auto">
                <canvas id="reservationsByTypeChart"></canvas>
            </div>
        </div>
    </div>
</x-layouts.admin>
