@props(['active' => false])

@php
$classes = $active
            ? 'active'
            : '';
@endphp
<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>