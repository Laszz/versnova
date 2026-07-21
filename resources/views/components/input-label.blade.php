@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-caption text-label text-gray-400 uppercase mb-1']) }}>
    {{ $value ?? $slot }}
</label>

