<div class="bg-white shadow-md rounded-lg p-8">
    <x-form.input 
        label="Nama Driver" 
        name="name" 
        :value="$driver->name ?? ''" 
        required 
    />

    <x-form.input 
        label="No. Telepon" 
        name="phone_number" 
        :value="$driver->phone_number ?? ''" 
        required 
    />

    <div class="mb-4">
        <label for="is_available" class="block text-sm font-medium text-gray-700">Status Ketersediaan</label>
        <select id="is_available" name="is_available" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            <option value="1" @selected(old('is_available', $driver->is_available ?? '1') == 1)>Tersedia</option>
            <option value="0" @selected(old('is_available', $driver->is_available ?? '') == 0)>Tidak Tersedia</option>
        </select>
        @error('is_available')
            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div class="flex justify-end mt-6">
        <a href="{{ route('admin.drivers.index') }}" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 mr-3">
            Batal
        </a>
        <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-indigo-600 border border-transparent rounded-md shadow-sm hover:bg-indigo-700">
            Simpan
        </button>
    </div>
</div>