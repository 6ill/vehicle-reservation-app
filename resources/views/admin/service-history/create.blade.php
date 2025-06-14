<x-layouts.admin>
    <x-slot:title>Tambah Catatan Servis untuk: {{ $vehicle->name }}</x-slot:title>
    <form action="{{ route('admin.vehicles.service-history.store', $vehicle) }}" method="POST">
        @csrf
        @include('admin.service-history.partials._form', ['history' => new \App\Models\ServiceHistory()])
    </form>
</x-layouts.admin>