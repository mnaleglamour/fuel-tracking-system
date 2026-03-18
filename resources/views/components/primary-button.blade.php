<button {{ $attributes->merge(['type' => 'submit', 'class' => 'btn text-white fw-semibold']) }} style="background:var(--accent-blue)">
    {{ $slot }}
</button>
