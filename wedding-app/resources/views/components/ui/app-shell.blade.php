@props([
    'surface' => false,
])

<div class="app-shell-outer">
    <div {{ $attributes->merge([
        'class' => 'app-shell-inner scroll-hidden ' . ($surface ? 'surface' : '')
    ]) }}>
        {{ $slot }}
    </div>
</div>
