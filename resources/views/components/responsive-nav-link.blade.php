@props(['active'])

@php
$classes = ($active ?? false)
    ? 'nav-link active fw-semibold d-block py-2 px-3'
    : 'nav-link d-block py-2 px-3';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
