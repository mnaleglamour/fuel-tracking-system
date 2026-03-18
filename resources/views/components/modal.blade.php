@props([
    'name',
    'show' => false,
    'maxWidth' => '2xl'
])

@php
$maxWidthClass = match ($maxWidth) {
    'sm' => 'modal-sm',
    'lg' => 'modal-lg',
    'xl' => 'modal-xl',
    default => '',
};
@endphp

<div class="modal fade" id="modal-{{ $name }}" tabindex="-1" aria-hidden="{{ $show ? 'false' : 'true' }}"
    style="{{ $show ? 'display:block' : '' }}">
    <div class="modal-dialog modal-dialog-centered {{ $maxWidthClass }}">
        <div class="modal-content border-0 shadow">
            {{ $slot }}
        </div>
    </div>
</div>

<script>
    (function () {
        document.addEventListener('DOMContentLoaded', function () {
            @if($show)
            var el = document.getElementById('modal-{{ $name }}');
            if (el) { var m = new bootstrap.Modal(el); m.show(); }
            @endif

            window.addEventListener('open-modal', function (e) {
                if (e.detail === '{{ $name }}') {
                    var el = document.getElementById('modal-{{ $name }}');
                    if (el) { var m = bootstrap.Modal.getOrCreateInstance(el); m.show(); }
                }
            });
            window.addEventListener('close-modal', function (e) {
                if (e.detail === '{{ $name }}') {
                    var el = document.getElementById('modal-{{ $name }}');
                    if (el) { var m = bootstrap.Modal.getInstance(el); if (m) m.hide(); }
                }
            });
        });
    })();
</script>
