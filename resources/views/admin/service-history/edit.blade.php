<x-layouts.admin>
    <x-slot:title>Edit Catatan Servis untuk: {{ $vehicle->name }}</x-slot:title>
    <form action="{{ route('admin.service-history.update', $serviceHistory) }}" method="POST">
        @csrf
        @method('PUT')
        @include('admin.service-history.partials._form', ['history' => $serviceHistory])
    </form>
</x-layouts.admin>