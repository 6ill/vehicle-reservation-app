<x-layouts.admin>
    <x-slot:title>Tambah Kendaraan Baru</x-slot:title>

    <form action="{{ route('admin.vehicles.store') }}" method="POST">
        @csrf
        {{-- Variabel $locations diteruskan dari VehicleController@create --}}
        @include('admin.vehicles.partials._form')
    </form>
</x-layouts.admin>