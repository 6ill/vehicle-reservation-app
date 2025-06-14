@props(['label', 'name', 'type' => 'text', 'value' => ''])

<div class="mb-4">
    <label for="{{ $name }}" class="block text-sm font-medium text-gray-700">{{ $label }}</label>
    <input type="{{ $type }}" 
           id="{{ $name }}" 
           name="{{ $name }}" 
           value="{{ old($name, $value) }}" 
           {{ $attributes->merge(['class' => 'mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm']) }}>
    @error($name)
        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
    @enderror
</div>