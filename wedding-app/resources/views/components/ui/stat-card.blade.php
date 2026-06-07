@props([
    'label'  => '',
    'value'  => 0,
    'icon'   => '',
    'color'  => 'primary',
])

@php
$colors = [
    'primary' => ['bg' => 'bg-brand-primary/10', 'text' => 'text-brand-primary'],
    'success' => ['bg' => 'bg-brand-success/10', 'text' => 'text-brand-success'],
    'warning' => ['bg' => 'bg-brand-warning/10', 'text' => 'text-brand-warning'],
    'danger'  => ['bg' => 'bg-brand-danger/10',  'text' => 'text-brand-danger'],
];
@endphp

<div class="bg-white rounded-card shadow-card p-4 flex items-center gap-4">
    <div class="w-12 h-12 rounded-xl {{ $colors[$color]['bg'] }} flex items-center justify-center flex-shrink-0">
        <span class="text-2xl">{{ $icon }}</span>
    </div>
    <div class="flex flex-col min-w-0">
        <span class="text-2xl font-bold text-[var(--color-text)] leading-none">{{ $value }}</span>
        <span class="text-sm text-[var(--color-muted)] mt-0.5 truncate">{{ $label }}</span>
    </div>
</div>
