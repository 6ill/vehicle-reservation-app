<div class="form-group">
    <label for="name">Nama Kendaraan</label>
    <input type="text" id="name" name="name" value="{{ old('name', $vehicle->name ?? '') }}" required>
    @error('name') <div class="error">{{ $message }}</div> @enderror
</div>

<div class="form-group">
    <label for="license_plate">No. Polisi</label>
    <input type="text" id="license_plate" name="license_plate" value="{{ old('license_plate', $vehicle->license_plate ?? '') }}" required>
    @error('license_plate') <div class="error">{{ $message }}</div> @enderror
</div>

<div class="form-group">
    <label for="base_location_id">Lokasi Pangkalan</label>
    <select id="base_location_id" name="base_location_id" required>
        @foreach($locations as $location)
            <option value="{{ $location->id }}" @selected(old('base_location_id', $vehicle->base_location_id ?? '') == $location->id)>
                {{ $location->name }}
            </option>
        @endforeach
    </select>
    @error('base_location_id') <div class="error">{{ $message }}</div> @enderror
</div>

<div class="form-group">
    <label for="type">Jenis Kendaraan</label>
    <select id="type" name="type" required>
        <option value="angkutan_orang" @selected(old('type', $vehicle->type ?? '') == 'angkutan_orang')>Angkutan Orang</option>
        <option value="angkutan_barang" @selected(old('type', $vehicle->type ?? '') == 'angkutan_barang')>Angkutan Barang</option>
    </select>
    @error('type') <div class="error">{{ $message }}</div> @enderror
</div>

<div class="form-group">
    <label for="ownership">Kepemilikan</label>
    <select id="ownership" name="ownership" required>
        <option value="company" @selected(old('ownership', $vehicle->ownership ?? '') == 'company')>Milik Perusahaan</option>
        <option value="rental" @selected(old('ownership', $vehicle->ownership ?? '') == 'rental')>Sewa</option>
    </select>
    @error('ownership') <div class="error">{{ $message }}</div> @enderror
</div>

<div class="form-group">
    <label for="status">Status</label>
    <select id="status" name="status" required>
        <option value="available" @selected(old('status', $vehicle->status ?? '') == 'available')>Tersedia</option>
        <option value="in_use" @selected(old('status', $vehicle->status ?? '') == 'in_use')>Digunakan</option>
        <option value="maintenance" @selected(old('status', $vehicle->status ?? '') == 'maintenance')>Perawatan</option>
    </select>
    @error('status') <div class="error">{{ $message }}</div> @enderror
</div>

<button type="submit">Simpan</button>