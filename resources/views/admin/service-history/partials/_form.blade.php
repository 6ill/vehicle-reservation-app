<div class="bg-white shadow-md rounded-lg p-8 max-w-2xl mx-auto">
    <x-form.input label="Tanggal Servis" name="service_date" type="date" :value="optional($history ?? null)->service_date" required />

    <div class="mb-4">
        <label for="service_details" class="block text-sm font-medium text-gray-700">Detail Pekerjaan</label>
        <textarea id="service_details" name="service_details" rows="5" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>{{ old('service_details', $history->service_details ?? '') }}</textarea>
        @error('service_details') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
    </div>
    
    <x-form.input label="Total Biaya (Rp)" name="cost" type="number" placeholder="Contoh: 1500000" :value="optional($history ?? null)->cost" />

    <div class="flex justify-end mt-6 border-t pt-6">
        <a href="{{ route('admin.vehicles.service-history.index', $vehicle) }}" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 mr-3">
            Batal
        </a>
        <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-indigo-600 border border-transparent rounded-md shadow-sm hover:bg-indigo-700">
            Simpan Catatan
        </button>
    </div>
</div>