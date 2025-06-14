<x-layouts.app>
    <x-slot:title>Login</x-slot:title>

    <div class="flex items-center justify-center min-h-screen bg-gray-100">
        <div class="w-full max-w-md p-8 space-y-6 bg-white rounded-lg shadow-md">
            
            <div class="text-center">
                <h2 class="text-2xl font-bold text-gray-900">
                    Login Aplikasi Reservasi
                </h2>
                <p class="mt-2 text-sm text-gray-600">
                    Silakan masuk untuk melanjutkan
                </p>
            </div>

            @error('email')
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg relative" role="alert">
                    <span class="block sm:inline">{{ $message }}</span>
                </div>
            @enderror

            <form method="POST" action="{{ route('login') }}" class="space-y-6">
                @csrf

                <x-form.input 
                    label="Alamat Email" 
                    type="email" 
                    name="email" 
                    required 
                    autofocus 
                    placeholder="nama@perusahaan.com"
                />

                <x-form.input 
                    label="Password" 
                    type="password" 
                    name="password" 
                    required 
                />

                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <input id="remember" name="remember" type="checkbox" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                        <label for="remember" class="ml-2 block text-sm text-gray-900">
                            Ingat saya
                        </label>
                    </div>
                </div>

                <div>
                    <button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors">
                        Login
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-layouts.app>