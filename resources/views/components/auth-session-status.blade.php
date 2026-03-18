@props(['status'])

@if ($status)
    <div {{ $attributes->merge(['class' => 'alert alert-success d-flex align-items-center gap-2']) }}>
        <i class="bi bi-check-circle-fill"></i>
        {{ $status }}
    </div>
@endif
