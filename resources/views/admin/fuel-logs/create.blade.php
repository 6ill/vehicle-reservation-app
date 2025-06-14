<x-layouts.admin>
    <x-slot:title>Tambah Log BBM untuk: {{ $vehicle->name }}</x-slot:title>

    <form action="{{ route('admin.vehicles.fuel-logs.store', $vehicle) }}" method="POST">
        @csrf
        @include('admin.fuel-logs.partials._form', ['log' => new \App\Models\FuelLog()])
    </form>
</x-layouts.admin>