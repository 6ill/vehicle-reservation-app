<x-layouts.admin>
    <x-slot:title>Buat Reservasi Baru</x-slot:title>
    <form action="{{ route('admin.reservations.store') }}" method="POST">
        @csrf
        @include('admin.reservations.partials._form')
    </form>
</x-layouts.admin>