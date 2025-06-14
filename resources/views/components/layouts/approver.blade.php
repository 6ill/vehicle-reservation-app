<x-layouts.app>
    @section('title', $title ?? 'Approver Panel')

    <div class="flex h-screen bg-gray-200">
        <aside class="w-64 flex-shrink-0 hidden sm:block bg-gray-800 text-white">
            <div class="p-4 text-2xl font-bold">Admin Panel</div>
            <nav class="mt-5">
                <a href="{{ route('approver.dashboard') }}" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-gray-700">Dashboard</a>
            </nav>
        </aside>

        <div class="flex-1 flex flex-col overflow-hidden">
            <header class="flex justify-between items-center p-4 bg-white border-b-2 border-gray-200">
                <div>
                    <h1 class="text-2xl font-bold text-gray-800">@yield('title')</h1>
                </div>
                <div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-sm text-gray-600 hover:text-gray-900">Logout</button>
                    </form>
                </div>
            </header>

            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100 p-6">
                @if(session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                        <span class="block sm:inline">{{ session('success') }}</span>
                    </div>
                @endif

                {{ $slot }}
            </main>
        </div>
    </div>
</x-layouts.app>