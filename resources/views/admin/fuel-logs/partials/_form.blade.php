<div class="bg-white shadow-md rounded-lg p-8 max-w-2xl mx-auto">
    <x-form.input label="Tanggal Pengisian" name="refuel_date" type="date" :value="$log->refuel_date ?? ''" required />
    <x-form.input label="Jumlah Liter Diisi" name="liters_filled" type="number" step="0.01" placeholder="Contoh: 40.5" :value="$log->liters_filled ?? ''" required />
    <x-form.input label="Total Biaya (Rp)" name="cost" type="number" placeholder="Contoh: 450000" :value="$log->cost ?? ''" />

    <div class="flex justify-end mt-6 border-t pt-6">
        <a href="{{ route('admin.vehicles.fuel-logs.index', $vehicle) }}" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 mr-3">
            Batal
        </a>
        <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-indigo-600 border border-transparent rounded-md shadow-sm hover:bg-indigo-700">
            Simpan
        </button>
    </div>
</div>