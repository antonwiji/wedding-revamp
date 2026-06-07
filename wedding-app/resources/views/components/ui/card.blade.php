@props(['padding' => 'p-4'])

<div {{ $attributes->merge([
    'class' => "bg-white rounded-card shadow-card $padding"
]) }}>
    {{ $slot }}
</div>
