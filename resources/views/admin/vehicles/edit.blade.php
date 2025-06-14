<x-layouts.admin>
    <x-slot:title>Edit Kendaraan: {{ $vehicle->name }}</x-slot:title>

    <form action="{{ route('admin.vehicles.update', $vehicle) }}" method="POST">
        @csrf
        @method('PUT')
        @include('admin.vehicles.partials._form')
    </form>
</x-layouts.admin>