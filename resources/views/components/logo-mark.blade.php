@props([
    'bond' => '#0b1f44',
    'node' => '#0b1f44',
    'accent' => '#3b8fe0',
    'strokeWidth' => 5,
])
@php($gid = substr(md5($accent), 0, 8))
{{-- Molecule mark from the Research-Chem.uk logo: two fused rings with two highlighted atoms. --}}
<svg {{ $attributes->merge(['viewBox' => '0 0 92 84', 'xmlns' => 'http://www.w3.org/2000/svg', 'aria-hidden' => 'true']) }}>
    <defs>
        <radialGradient id="lm-accent-{{ $gid }}" cx="35%" cy="30%" r="70%">
            <stop offset="0%" stop-color="#ffffff" stop-opacity="0.75" />
            <stop offset="45%" stop-color="{{ $accent }}" />
            <stop offset="100%" stop-color="{{ $accent }}" />
        </radialGradient>
    </defs>
    <g fill="none" stroke="{{ $bond }}" stroke-width="{{ $strokeWidth }}" stroke-linecap="round" stroke-linejoin="round">
        {{-- Ring A --}}
        <polyline points="39,26.4 21,26.4 12,42 21,57.6 39,57.6 48,42 39,26.4" />
        {{-- Ring B (shares the 48,42 → 39,57.6 bond) --}}
        <polyline points="39,57.6 48,73.2 66,73.2 75,57.6 66,42 48,42" />
        {{-- Branches to accent atoms --}}
        <line x1="39" y1="26.4" x2="52" y2="11" />
        <line x1="66" y1="42" x2="79" y2="29" />
    </g>
    <g fill="{{ $node }}">
        <circle cx="21" cy="26.4" r="5.2" />
        <circle cx="12" cy="42" r="5.2" />
        <circle cx="21" cy="57.6" r="5.2" />
        <circle cx="48" cy="73.2" r="5.2" />
        <circle cx="75" cy="57.6" r="5.2" />
    </g>
    <circle cx="52" cy="11" r="8.5" fill="url(#lm-accent-{{ $gid }})" />
    <circle cx="79" cy="29" r="6.5" fill="url(#lm-accent-{{ $gid }})" />
</svg>
