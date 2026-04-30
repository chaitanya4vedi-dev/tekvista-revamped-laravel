@props(['title', 'copy', 'tone' => 'blue'])

@php
    $tones = [
        'green' => 'bg-[var(--accent-3)]/18 text-[var(--accent-3)]',
        'blue' => 'bg-[var(--accent-2)]/18 text-[var(--accent-2)]',
        'purple' => 'bg-[var(--accent-4)]/18 text-[var(--accent-4)]',
        'teal' => 'bg-[var(--accent)]/18 text-[var(--accent)]',
    ];
@endphp

<article {{ $attributes->merge(['class' => 'neo-card group p-5']) }}>
    <div class="mb-4 inline-flex rounded-lg p-2 {{ $tones[$tone] ?? $tones['blue'] }}">{{ $icon ?? '' }}</div>
    <h3 class="text-lg font-black text-[var(--text)]">{{ $title }}</h3>
    <p class="mt-3 text-sm leading-7 text-[var(--muted)]">{{ $copy }}</p>
</article>
