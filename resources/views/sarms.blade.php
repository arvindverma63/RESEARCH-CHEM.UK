@extends('layouts.app')

@section('title', 'Buy SARMs UK — MK-677, RAD-140, LGD-4033, YK-11 | ResearchChem.uk')
@section('meta_description', $content['pageSubtitle'] ?? 'Buy SARMs UK. MK-677 Ibutamoren, RAD-140 Testolone, YK-11, LGD-4033 Ligandrol, MK-2866 Ostarine, GW-501516 Cardarine. 60ml liquid, HPLC-verified, COA included. UK dispatched.')

@section('content')
<!-- ── Hero banner ── -->
<div style="background-color: #0052a3; padding: 28px 16px 24px; text-align: center;">
    <div style="max-width: 960px; margin: 0 auto; text-align: left; margin-bottom: 10px;">
        <a href="{{ route('home') }}" style="color: rgba(255,255,255,0.8); font-size: 0.72rem; font-weight: 700; text-decoration: none; display: inline-flex; align-items: center; gap: 4px;">
            &larr; Home
        </a>
    </div>
    <span style="display: inline-block; background-color: rgba(255,255,255,0.18); color: #fff; font-size: 0.58rem; font-weight: 800; letter-spacing: 0.16em; text-transform: uppercase; padding: 3px 10px; border-radius: 2px; margin-bottom: 10px;">
        Trienza Laboratory Research
    </span>
    <h1 style="font-family: var(--font-heading); color: #fff; font-size: clamp(1.6rem, 4vw, 2.4rem); font-weight: 900; margin: 0 0 8px; line-height: 1.1;">
        {{ $content['pageTitle'] ?? 'SARMs Research Compounds' }}
    </h1>
    <p style="color: rgba(255,255,255,0.85); font-size: 0.82rem; margin: 0 0 14px; max-width: 560px; margin-left: auto; margin-right: auto;" class="font-sans">
        {{ $content['pageSubtitle'] ?? 'Selective androgen receptor modulators supplied strictly for in-vitro laboratory research. HPLC verified with Certificate of Analysis included.' }}
    </p>
    <!-- Discount banner -->
    <div style="display: inline-block; background-color: rgba(255,255,255,0.15); border: 1px solid rgba(255,255,255,0.3); border-radius: 3px; padding: 7px 16px; color: #fff; font-size: 0.75rem; font-weight: 700;">
        {{ $content['discountBanner'] ?? 'Buy any 3 SARMs — 10% off · Buy any 6 SARMs — 20% off' }}
    </div>
</div>

<!-- ── Category intro ── -->
<div style="background-color: #f8f9fa; border-bottom: 1px solid #e2e8f0;">
    <div style="max-width: 960px; margin: 0 auto; padding: 28px 16px 24px;">
        <h2 style="font-family: var(--font-heading); color: #0052a3; font-size: clamp(1rem, 2.5vw, 1.25rem); font-weight: 800; margin: 0 0 14px; line-height: 1.2;">
            {{ $content['categoryIntro']['heading'] ?? 'Research SARMs — UK Dispatched' }}
        </h2>
        @foreach($content['categoryIntro']['body'] ?? [] as $p)
            <p style="font-size: 0.82rem; color: #475569; line-height: 1.7; margin: 0 0 10px; max-width: 800px;" class="font-sans">
                {{ $p['text'] ?? $p }}
            </p>
        @endforeach
    </div>
</div>

<!-- ── Product grid ── -->
<div style="max-width: 1080px; margin: 0 auto; padding: 24px 16px 56px;">
    <style>
      .sarms-grid {
        display: grid;
        grid-template-columns: repeat(1, 1fr);
        gap: 16px;
      }
      @media (min-width: 600px) {
        .sarms-grid { grid-template-columns: repeat(2, 1fr); gap: 16px; }
      }
      @media (min-width: 860px) {
        .sarms-grid { grid-template-columns: repeat(3, 1fr); gap: 16px; }
      }
      .sarms-card {
        display: flex;
        flex-direction: column;
        background: #fff;
        border-radius: 6px;
        border: 1.5px solid #0052a3;
        overflow: hidden;
      }
      .sarms-img-area {
        width: 100%;
        aspect-ratio: 3 / 4;
        background: #fff;
        position: relative;
        flex-shrink: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 8px 8px 14px;
        box-sizing: border-box;
      }
      .sarms-badge-research {
        position: absolute;
        top: 6px;
        left: 6px;
        background: #0052a3;
        color: #fff;
        font-size: 0.42rem;
        font-weight: 800;
        letter-spacing: 0.1em;
        text-transform: uppercase;
        padding: 3px 6px;
        border-radius: 2px;
        z-index: 2;
      }
      .sarms-name {
        font-family: var(--font-heading);
        color: #0a1a2e;
        font-size: clamp(0.95rem, 2.8vw, 1.25rem);
        font-weight: 900;
        margin: 0 0 1px;
        line-height: 1.1;
      }
      .sarms-price {
        font-family: var(--font-heading);
        font-size: clamp(1.2rem, 3.5vw, 1.55rem);
        font-weight: 900;
        color: #0052a3;
        line-height: 1;
      }
      .chem-label {
        padding: 3px 6px 3px 0;
        color: #0052a3;
        font-weight: 800;
        font-family: var(--font-heading);
        white-space: nowrap;
        vertical-align: top;
        width: 38%;
      }
      .chem-value {
        padding: 3px 0;
        color: #1a2a3a;
        font-family: monospace;
        word-break: break-word;
        line-height: 1.4;
      }
    </style>

    <div class="sarms-grid">
        @foreach($content['products'] ?? [] as $sarm)
            @php
                $slug = $sarm['slug'];
                $pricePence = \App\Services\ContentService::parsePence($sarm['price'] ?? '£0');
                $img = $sarm['image'] ?? $sarm['img'] ?? "/airo-assets/images/pages/sarms/{$slug}";
            @endphp
            <div class="sarms-card" x-data="{ chemOpen: false, loading: false, added: false }">
                <!-- Image -->
                <div class="sarms-img-area">
                    <img src="{{ $img }}"
                         alt="{{ $sarm['name'] }} {{ $sarm['subtitle'] ?? '' }} {{ $sarm['concentration'] ?? $sarm['dose'] ?? '' }}"
                         loading="lazy"
                         decoding="async"
                         onerror="this.onerror=null; this.src='/assets/images/sarm-mk-677-hd.jpg';" style="width: 100%; height: 100%; object-fit: contain; object-position: center center; display: block; background: #ffffff;">
                    <div class="sarms-badge-research">Research Only</div>
                </div>

                <!-- Info -->
                <div style="padding: 10px 10px 12px; display: flex; flex-direction: column; flex: 1;">
                    <!-- Name -->
                    <div style="margin-bottom: 8px; padding-bottom: 6px; border-bottom: 2px solid #0052a3;">
                        <h2 class="sarms-name">{{ $sarm['name'] }}</h2>
                        <p style="color: #0052a3; font-size: 0.72rem; font-weight: 700; margin: 0;">
                            {{ $sarm['subtitle'] ?? '' }}
                        </p>
                    </div>

                    <!-- Concentration + volume pills -->
                    <div style="margin-bottom: 8px;">
                        <span style="display: inline-block; background-color: #e8f0ff; color: #0052a3; font-size: 0.6rem; font-weight: 800; padding: 2px 6px; border-radius: 2px;">
                            {{ $sarm['concentration'] ?? $sarm['dose'] ?? '30mg/ml' }}
                        </span>
                        <span style="display: inline-block; background-color: #f0f4f8; color: #3a5070; font-size: 0.6rem; font-weight: 700; padding: 2px 6px; border-radius: 2px; margin-left: 4px;">
                            {{ $sarm['volume'] ?? '60ml' }}
                        </span>
                    </div>

                    <!-- Price -->
                    <div style="margin-bottom: 10px;">
                        <span class="sarms-price">{{ $sarm['price'] }}</span>
                    </div>

                    <!-- Two Action Buttons -->
                    <div style="display: flex; flex-direction: column; gap: 6px; margin-top: auto;">
                        <a href="{{ route('products.show', $slug) }}"
                           class="btn-secondary-details">
                            View Details
                        </a>
                        <button type="button"
                                class="btn-primary-cart"
                                :class="{ 'is-added': added }"
                                :disabled="loading"
                                @click="
                                    if (loading) return;
                                    loading = true;
                                    setTimeout(() => {
                                        $store.cart.addToCart({
                                            id: '{{ $slug }}',
                                            name: '{{ addslashes($sarm['name']) }} {{ $sarm['volume'] ?? '60ml' }}',
                                            price: {{ $pricePence }},
                                            currency: 'gbp',
                                            image: '{{ $img }}',
                                            category: 'sarms'
                                        });
                                        loading = false;
                                        added = true;
                                        setTimeout(() => added = false, 2000);
                                    }, 300);
                                ">
                            <span x-show="loading" x-cloak style="display: inline-flex; align-items: center; gap: 5px;">
                                <svg class="animate-spin" style="width: 13px; height: 13px; color: #ffffff;" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path></svg>
                                <span style="color: #ffffff;">Adding...</span>
                            </span>
                            <span x-show="!loading && !added" style="display: inline-flex; align-items: center; gap: 5px;">
                                <svg style="width: 13px; height: 13px; color: #ffffff;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" /></svg>
                                <span style="color: #ffffff;">Add to Cart</span>
                            </span>
                            <span x-show="!loading && added" x-cloak style="display: inline-flex; align-items: center; gap: 4px;">
                                <svg style="width: 13px; height: 13px; color: #ffffff;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" /></svg>
                                <span style="color: #ffffff;">Added!</span>
                            </span>
                        </button>
                    </div>

                    <!-- Inline chemical data sheet -->
                    <div style="border-top: 1px solid #dde8f5; margin-top: 8px;">
                        <button type="button"
                                @click="chemOpen = !chemOpen"
                                style="width: 100%; background: none; border: none; cursor: pointer; padding: 6px 0 4px; display: flex; align-items: center; justify-content: space-between; color: #0052a3; font-family: var(--font-heading); font-weight: 700; font-size: 0.62rem; letter-spacing: 0.04em; text-transform: uppercase;">
                            <span>⚗ Data Sheet</span>
                            <span style="display: inline-block; transition: transform 0.2s; font-size: 0.7rem;"
                                  :style="chemOpen ? 'transform: rotate(180deg)' : 'transform: rotate(0deg)'">▾</span>
                        </button>

                        <div x-show="chemOpen" x-cloak x-collapse
                             style="background-color: #f4f8ff; border: 1px solid #c8daf5; border-radius: 4px; padding: 8px 10px; margin-bottom: 6px;">
                            @if(!empty($sarm['chemDesc']))
                                <p style="font-size: 0.6rem; color: #2a3a50; line-height: 1.55; margin: 0 0 7px; font-style: italic;">
                                    {{ $sarm['chemDesc'] }}
                                </p>
                            @endif
                            <table style="width: 100%; border-collapse: collapse; font-size: 0.58rem;">
                                <tbody>
                                    @if(!empty($sarm['cas']))
                                    <tr style="border-bottom: 1px solid #dde8f5;">
                                        <td class="chem-label">CAS No.</td>
                                        <td class="chem-value">{{ $sarm['cas'] }}</td>
                                    </tr>
                                    @endif
                                    @if(!empty($sarm['molecularFormula']))
                                    <tr style="border-bottom: 1px solid #dde8f5;">
                                        <td class="chem-label">Mol. Formula</td>
                                        <td class="chem-value">{{ $sarm['molecularFormula'] }}</td>
                                    </tr>
                                    @endif
                                    @if(!empty($sarm['molecularWeight']))
                                    <tr style="border-bottom: 1px solid #dde8f5;">
                                        <td class="chem-label">Mol. Weight</td>
                                        <td class="chem-value">{{ $sarm['molecularWeight'] }}</td>
                                    </tr>
                                    @endif
                                    @if(!empty($sarm['purity']))
                                    <tr style="border-bottom: 1px solid #dde8f5;">
                                        <td class="chem-label">Purity</td>
                                        <td class="chem-value">{{ $sarm['purity'] }}</td>
                                    </tr>
                                    @endif
                                    @if(!empty($sarm['solvent']))
                                    <tr style="border-bottom: 1px solid #dde8f5;">
                                        <td class="chem-label">Solvent</td>
                                        <td class="chem-value">{{ $sarm['solvent'] }}</td>
                                    </tr>
                                    @endif
                                    @if(!empty($sarm['appearance']))
                                    <tr style="border-bottom: 1px solid #dde8f5;">
                                        <td class="chem-label">Appearance</td>
                                        <td class="chem-value">{{ $sarm['appearance'] }}</td>
                                    </tr>
                                    @endif
                                    @if(!empty($sarm['storage']))
                                    <tr>
                                        <td class="chem-label">Storage</td>
                                        <td class="chem-value">{{ $sarm['storage'] }}</td>
                                    </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
