@props(['value'])

<label {{ $attributes->merge([
    'class' => 'block font-medium text-sm text-gray-600']) }}>
    {{ $value ?? $slot }}
</label>
