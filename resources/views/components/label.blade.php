@props(['value'])


<label {{ $attributes->merge(['class' => 'block font-medium text-sm
 ']) }}>
    {{-- dedault: text-gray-700 --}}
    {{ $value ?? $slot }}
</label>
