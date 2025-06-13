<div class="form-group">
    <label for="name">Nama Driver</label>
    <input type="text" id="name" name="name" value="{{ old('name', $driver->name ?? '') }}" required>
    @error('name') <div class="error">{{ $message }}</div> @enderror
</div>

<div class="form-group">
    <label for="phone_number">No. Telepon</label>
    <input type="text" id="phone_number" name="phone_number" value="{{ old('phone_number', $driver->phone_number ?? '') }}" required>
    @error('phone_number') <div class="error">{{ $message }}</div> @enderror
</div>

<div class="form-group">
    <label for="is_available">Status Ketersediaan</label>
    <select id="is_available" name="is_available" required>
        <option value="1" @selected(old('is_available', $driver->is_available ?? '') == 1)>Tersedia</option>
        <option value="0" @selected(old('is_available', $driver->is_available ?? '') == 0)>Tidak Tersedia</option>
    </select>
    @error('is_available') <div class="error">{{ $message }}</div> @enderror
</div>

<button type="submit">Simpan</button>