@props(['value'])

<label {{ $attributes->merge([
    'class' => 'block font-bold text-xs text-gray-600']) }}>
    {{ $value ?? $slot }}
</label>
