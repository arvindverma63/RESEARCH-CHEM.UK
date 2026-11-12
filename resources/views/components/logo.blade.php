@props(['variant' => 'light', 'taglineClass' => ''])
@php
    $dark = $variant === 'dark';
@endphp
{{-- Full Research-Chem.uk logo: molecule mark + wordmark + tagline. "dark" = for dark backgrounds. --}}
<span {{ $attributes->merge(['class' => 'inline-flex items-center gap-2 min-[400px]:gap-2.5']) }}>
    <x-logo-mark class="h-7 min-[400px]:h-8 lg:h-10 w-auto shrink-0"
                 :bond="$dark ? '#cbd5e1' : '#0b1f44'"
                 :node="$dark ? '#e2e8f0' : '#0b1f44'" />
    <span class="flex flex-col leading-none whitespace-nowrap">
        <span class="text-[0.8rem] min-[400px]:text-[0.95rem] lg:text-[1.05rem] xl:text-[1.2rem]" style="font-family: var(--font-heading); font-weight: 900; letter-spacing: -0.01em; color: {{ $dark ? '#ffffff' : '#0b1f44' }};">RESEARCH-CHEM.UK</span>
        <span class="{{ $taglineClass }} mt-1 pt-1 border-t" style="border-color: {{ $dark ? 'rgba(148,163,184,0.5)' : 'rgba(59,143,224,0.55)' }}; font-size: 0.56rem; font-weight: 600; letter-spacing: 0.22em; color: {{ $dark ? '#94a3b8' : '#5b6474' }};">PREMIUM RESEARCH COMPOUNDS</span>
    </span>
</span>
