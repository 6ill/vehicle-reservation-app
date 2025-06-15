<div class="bg-white shadow-md rounded-lg p-8">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        {{-- Kolom Kiri --}}
        <div>
            <x-form.input label="Nama Kendaraan" name="name" :value="$vehicle->name ?? ''" required />
            <x-form.input label="No. Polisi" name="license_plate" :value="$vehicle->license_plate ?? ''" required />
            <div class="mb-4">
                <label for="type" class="block text-sm font-medium text-gray-700">Jenis Kendaraan</label>
                <select id="type" name="type" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    <option value="angkutan_orang" @selected(old('type', $vehicle->type ?? '') == 'angkutan_orang')>Angkutan Orang</option>
                    <option value="angkutan_barang" @selected(old('type', $vehicle->type ?? '') == 'angkutan_barang')>Angkutan Barang</option>
                </select>
            </div>
        </div>

        {{-- Kolom Kanan --}}
        <div>
            <div class="mb-4">
                <label for="ownership" class="block text-sm font-medium text-gray-700">Kepemilikan</label>
                <select id="ownership" name="ownership" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    <option value="company" @selected(old('ownership', $vehicle->ownership ?? '') == 'company')>Milik Perusahaan</option>
                    <option value="rental" @selected(old('ownership', $vehicle->ownership ?? '') == 'rental')>Sewa</option>
                </select>
            </div>

             <div class="mb-4">
                <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                <select id="status" name="status" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    <option value="available" @selected(old('status', $vehicle->status ?? 'available') == 'available')>Tersedia</option>
                    <option value="in_use" @selected(old('status', $vehicle->status ?? '') == 'in_use')>Digunakan</option>
                    <option value="maintenance" @selected(old('status', $vehicle->status ?? '') == 'maintenance')>Perawatan</option>
                </select>
            </div>
        </div>
    </div>
    
    <div class="flex justify-end mt-6 border-t pt-6">
        <a href="{{ route('admin.vehicles.index') }}" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 mr-3">
            Batal
        </a>
        <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-indigo-600 border border-transparent rounded-md shadow-sm hover:bg-indigo-700">
            Simpan Kendaraan
        </button>
    </div>
</div>