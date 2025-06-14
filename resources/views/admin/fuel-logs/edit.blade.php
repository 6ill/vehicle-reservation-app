<x-layouts.admin>
    <x-slot:title>Tambah Log BBM untuk: {{ $vehicle->name }}</x-slot:title>

    <form action="{{ route('admin.vehicles.fuel-logs.store', $fuelLog) }}" method="POST">
        @csrf
        @method('PUT')
        @include('admin.fuel-logs.partials._form', ['log' => $fuelLog])
    </form>
</x-layouts.admin>