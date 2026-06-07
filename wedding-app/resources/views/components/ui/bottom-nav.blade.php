@props(['items' => []])

<nav class="sticky bottom-0 z-40 bg-white border-t border-[var(--color-border)] pb-safe">
    <div class="flex items-stretch justify-around h-16 px-1">

        @foreach($items as $item)
            @php
                $isActive = request()->is(ltrim($item['match'], '/'));
            @endphp
            <a href="{{ $item['url'] }}"
               class="flex flex-col items-center justify-center gap-0.5 flex-1 px-2 rounded-xl mx-0.5 transition-colors
                      {{ $isActive
                          ? 'text-[var(--color-primary)]'
                          : 'text-[var(--color-muted)] hover:text-[var(--color-text)]' }}">

                <span class="text-xl leading-none">{{ $item['icon'] }}</span>
                <span class="text-[10px] font-{{ $isActive ? 'semibold' : 'medium' }} leading-none mt-0.5">
                    {{ $item['label'] }}
                </span>

                @if(!empty($item['badge']) && $item['badge'] > 0)
                    <span class="absolute top-2 ml-4 bg-[var(--color-danger)] text-white text-[9px] font-bold
                                 min-w-[16px] h-4 px-1 rounded-full flex items-center justify-center">
                        {{ $item['badge'] > 99 ? '99+' : $item['badge'] }}
                    </span>
                @endif

            </a>
        @endforeach

    </div>
</nav>
