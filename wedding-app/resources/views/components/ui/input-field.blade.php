@props([
    'label'    => '',
    'error'    => '',
    'hint'     => '',
    'required' => false,
])

<div class="flex flex-col gap-1.5">

    @if($label)
        <label class="text-sm font-medium text-[var(--color-text)]">
            {{ $label }}
            @if($required)
                <span class="text-[var(--color-danger)]">*</span>
            @endif
        </label>
    @endif

    <input {{ $attributes->merge([
        'class' => "
            w-full h-12 px-4 rounded-input
            bg-[var(--color-surface)] border
            text-md text-[var(--color-text)]
            placeholder:text-[var(--color-muted)]
            focus:outline-none focus:ring-2
            transition-all
            " . ($error
                ? 'border-[var(--color-danger)] focus:border-[var(--color-danger)] focus:ring-[var(--color-danger)]/20'
                : 'border-[var(--color-border)] focus:border-[var(--color-primary)] focus:ring-[var(--color-primary)]/20'
            )
    ]) }}>

    @if($hint && !$error)
        <p class="text-xs text-[var(--color-muted)]">{{ $hint }}</p>
    @endif

    @if($error)
        <p class="text-xs text-[var(--color-danger)]">{{ $error }}</p>
    @endif

</div>
