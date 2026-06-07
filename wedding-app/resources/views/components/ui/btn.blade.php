@props([
    'variant' => 'primary',
    'size'    => 'md',
    'full'    => false,
    'href'    => null,
])

@php
$base = "inline-flex items-center justify-center gap-2 font-semibold rounded-btn transition-all btn-press select-none focus:outline-none";

$sizes = [
    'sm' => 'h-10 px-4 text-sm',
    'md' => 'h-12 px-6 text-md',
    'lg' => 'h-14 px-8 text-lg',
];

$variants = [
    'primary'   => 'bg-[var(--color-primary)] text-white shadow-btn active:shadow-none',
    'secondary' => 'bg-[var(--color-border)] text-[var(--color-text)]',
    'ghost'     => 'bg-transparent text-[var(--color-primary)] border-2 border-[var(--color-primary)]',
    'danger'    => 'bg-[var(--color-danger)] text-white',
];

$width = $full ? 'w-full justify-center' : '';
$classes = "$base {$sizes[$size]} {$variants[$variant]} $width";
@endphp

@if($href)
    <a href="{{ $href }}" {{ $attributes->merge(['class' => $classes]) }}>
        {{ $slot }}
    </a>
@else
    <button {{ $attributes->merge(['class' => $classes]) }}>
        {{ $slot }}
    </button>
@endif
