<x-layouts.admin>
    <x-slot:title>Tambah Driver Baru</x-slot:title>

    <form action="{{ route('admin.drivers.store') }}" method="POST">
        @csrf
        @include('admin.drivers.partials._form')
    </form>
</x-layouts.admin>