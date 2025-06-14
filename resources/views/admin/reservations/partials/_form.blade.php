<div class="bg-white shadow-md rounded-lg p-8">
    @if(session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg relative mb-4" role="alert">
            <strong class="font-bold">Error!</strong>
            <span class="block sm:inline">{{ session('error') }}</span>
        </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6">
        <div>
            <div class="mb-4">
                <label for="requester_id" class="block text-sm font-medium text-gray-700">Pegawai Pemesan</label>
                <select id="requester_id" name="requester_id" required>
                    <option value="">Pilih Pegawai...</option>
                    @foreach($employees as $employee)
                        <option value="{{ $employee->id }}" @selected(old('requester_id') == $employee->id)>{{ $employee->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-4">
                <label for="vehicle_id" class="block text-sm font-medium text-gray-700">Kendaraan</label>
                <select id="vehicle_id" name="vehicle_id" required>
                    <option value="">Pilih Kendaraan...</option>
                    @foreach($vehicles as $vehicle)
                        <option value="{{ $vehicle->id }}" @selected(old('vehicle_id') == $vehicle->id)>{{ $vehicle->name }} ({{ $vehicle->license_plate }})</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-4">
                <label for="driver_id" class="block text-sm font-medium text-gray-700">Driver</label>
                <select id="driver_id" name="driver_id" required>
                    <option value="">Pilih Driver...</option>
                    @foreach($drivers as $driver)
                        <option value="{{ $driver->id }}" @selected(old('driver_id') == $driver->id)>{{ $driver->name }}</option>
                    @endforeach
                </select>
            </div>
             <div class="mb-4">
                <label for="purpose" class="block text-sm font-medium text-gray-700">Keperluan</label>
                <textarea id="purpose" name="purpose" rows="4" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>{{ old('purpose') }}</textarea>
            </div>
        </div>
        <div>
            <div class="mb-4">
                <label for="start_location_id" class="block text-sm font-medium text-gray-700">Lokasi Awal</label>
                <select id="start_location_id" name="start_location_id" required>
                    <option value="">Pilih Lokasi Awal...</option>
                    @foreach($locations as $location)
                        <option value="{{ $location->id }}" @selected(old('start_location_id') == $location->id)>{{ $location->name }}</option>
                    @endforeach
                </select>
            </div>
            <x-form.input label="Destinasi Tujuan" name="destination" required />
            <x-form.input label="Waktu Mulai" type="datetime-local" name="start_datetime" required />
            <x-form.input label="Waktu Selesai" type="datetime-local" name="end_datetime" required />
        </div>
    </div>

    <div class="flex justify-end mt-6 border-t pt-6">
        <button type="submit" class="px-6 py-2 text-sm font-medium text-white bg-indigo-600 border border-transparent rounded-md shadow-sm hover:bg-indigo-700">
            Buat Reservasi
        </button>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const tomSelectSettings = {
            create: false,
            sortField: { field: "text", direction: "asc" }
        };
        new TomSelect('#requester_id', tomSelectSettings);
        new TomSelect('#vehicle_id', tomSelectSettings);
        new TomSelect('#driver_id', tomSelectSettings);
        new TomSelect('#start_location_id', tomSelectSettings); // <-- Inisialisasi Tom Select untuk lokasi awal
    });
</script>
@endpush