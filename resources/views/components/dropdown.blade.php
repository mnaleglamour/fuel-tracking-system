@props(['align' => 'right', 'width' => '48', 'contentClasses' => ''])

<div class="dropdown">
    <div data-bs-toggle="dropdown" aria-expanded="false" style="cursor:pointer">
        {{ $trigger }}
    </div>
    <ul class="dropdown-menu shadow border-0 {{ $align === 'left' ? 'dropdown-menu-start' : 'dropdown-menu-end' }} {{ $contentClasses }}"
        style="min-width:{{ $width === '48' ? '12rem' : $width }}">
        {{ $content }}
    </ul>
</div>
