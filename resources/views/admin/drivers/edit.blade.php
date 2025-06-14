<x-layouts.admin>
    <x-slot:title>Edit Driver: {{ $driver->name }}</x-slot:title>

    <form action="{{ route('admin.drivers.update', $driver) }}" method="POST">
        @csrf
        @method('PUT')
        @include('admin.drivers.partials._form')
    </form>
</x-layouts.admin>