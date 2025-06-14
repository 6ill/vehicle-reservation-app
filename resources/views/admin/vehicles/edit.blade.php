<x-layouts.admin>
    <x-slot:title>Edit Kendaraan: {{ $vehicle->name }}</x-slot:title>

    <form action="{{ route('admin.vehicles.update', $vehicle) }}" method="POST">
        @csrf
        @method('PUT')
        {{-- Variabel $vehicle dan $locations diteruskan dari VehicleController@edit --}}
        @include('admin.vehicles._form')
    </form>
</x-layouts.admin>