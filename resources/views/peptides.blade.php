@extends('layouts.app')

@section('title', 'Buy Peptide Vials UK — BPC-157, TB-500, Retatrutide | ResearchChem.uk')
@section('meta_description', $content['pageSubtitle'] ?? 'Lyophilised peptide vials for laboratory research. Batch documentation is available. Orders are shipped next working day.')

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
        Peptide Lyophilized Vials
    </h1>
    <p style="color: rgba(255,255,255,0.85); font-size: 0.82rem; margin: 0 0 14px; max-width: 560px; margin-left: auto; margin-right: auto;" class="font-sans">
        {{ $content['pageSubtitle'] ?? 'Lyophilised peptide vials for laboratory research. Batch documentation is available. Orders are shipped next working day.' }}
    </p>
    <!-- Discount banner -->
    <div style="display: inline-block; background-color: rgba(255,255,255,0.15); border: 1px solid rgba(255,255,255,0.3); border-radius: 3px; padding: 7px 16px; color: #fff; font-size: 0.75rem; font-weight: 700;">
        {{ $content['discountBanner'] ?? 'Buy any 5 vials — 10% off · Buy any 10 vials — 20% off' }}
    </div>
</div>

<!-- ── Category intro ── -->
<div style="background-color: #f8f9fa; border-bottom: 1px solid #e2e8f0;">
    <div style="max-width: 960px; margin: 0 auto; padding: 28px 16px 24px;">
        <h2 style="font-family: var(--font-heading); color: #0052a3; font-size: clamp(1rem, 2.5vw, 1.25rem); font-weight: 800; margin: 0 0 14px; line-height: 1.2;">
            {{ $content['categoryIntro']['heading'] ?? 'Research Peptide Vials — UK Dispatched' }}
        </h2>
        @foreach($content['categoryIntro']['body'] ?? [] as $p)
            <p style="font-size: 0.82rem; color: #475569; line-height: 1.7; margin: 0 0 10px; max-width: 800px;" class="font-sans">
                {{ $p['text'] ?? $p }}
            </p>
        @endforeach
    </div>
</div>

<!-- ── Product grid ── -->
<div style="max-width: 1200px; margin: 0 auto; padding: 24px 16px 56px;">
    <style>
      .vials-grid {
        display: grid;
        grid-template-columns: repeat(1, 1fr);
        gap: 16px;
      }
      @media (min-width: 560px) {
        .vials-grid { grid-template-columns: repeat(2, 1fr); gap: 16px; }
      }
      @media (min-width: 900px) {
        .vials-grid { grid-template-columns: repeat(4, 1fr); gap: 16px; }
      }
      .vial-card {
        display: flex;
        flex-direction: column;
        background: #fff;
        border-radius: 6px;
        border: 1.5px solid #0052a3;
        overflow: hidden;
      }
      .vial-img-area {
        width: 100%;
        height: 220px;
        background: #fff;
        position: relative;
        flex-shrink: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 8px 8px 12px;
        box-sizing: border-box;
      }
      .vial-badge-research {
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
      .vial-info {
        padding: 10px 10px 12px;
        display: flex;
        flex-direction: column;
        flex: 1;
      }
      .vial-name {
        font-family: var(--font-heading);
        color: #0a1a2e;
        font-size: clamp(0.9rem, 2.5vw, 1.15rem);
        font-weight: 900;
        margin: 0 0 1px;
        line-height: 1.15;
      }
      .vial-subtitle {
        color: #0052a3;
        font-size: 0.65rem;
        font-weight: 700;
        margin: 0;
      }
      .vial-price {
        font-family: var(--font-heading);
        font-size: clamp(1.2rem, 3.5vw, 1.5rem);
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

    <div class="vials-grid">
        @foreach($content['vials'] ?? [] as $vial)
            @php
                $slug = $vial['slug'];
                $pricePence = \App\Services\ContentService::parsePence($vial['price'] ?? '£0');
                $img = $vial['image'] ?? $vial['img'] ?? "/airo-assets/images/pages/peptides/{$slug}";
            @endphp
            <div class="vial-card" x-data="{ chemOpen: false, loading: false, added: false }">
                <!-- Image -->
                <div class="vial-img-area">
                    <img src="{{ $img }}"
                         alt="{{ $vial['name'] }} {{ $vial['dose'] }} research vial"
                         loading="lazy"
                         decoding="async"
                         onerror="this.onerror=null; this.src='/assets/images/photorealistic-single-glass-research-via-ATRm5m.png';" style="display: block; width: 100%; height: 100%; object-fit: contain; object-position: center center; background: #ffffff;">
                    <div class="vial-badge-research">Research Only</div>
                </div>

                <!-- Info -->
                <div class="vial-info">
                    <div style="margin-bottom: 6px; padding-bottom: 5px; border-bottom: 2px solid #0052a3;">
                        <h2 class="vial-name">{{ $vial['name'] }}</h2>
                        <p class="vial-subtitle">{{ $vial['dose'] ?? '' }} · {{ $vial['vialSize'] ?? '3ml' }} vial</p>
                    </div>

                    <div style="margin-bottom: 8px;">
                        <span class="vial-price">{{ $vial['price'] }}</span>
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
                                            name: '{{ addslashes($vial['name']) }} {{ $vial['dose'] }}',
                                            price: {{ $pricePence }},
                                            currency: 'gbp',
                                            image: '{{ $img }}',
                                            category: 'peptides'
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
                                <svg style="width: 13px; height: 13px; color: #ffffff;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" /></svg>
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
                            @if(!empty($vial['chemDesc']))
                                <p style="font-size: 0.6rem; color: #2a3a50; line-height: 1.55; margin: 0 0 7px; font-style: italic;">
                                    {{ $vial['chemDesc'] }}
                                </p>
                            @endif
                            <table style="width: 100%; border-collapse: collapse; font-size: 0.58rem;">
                                <tbody>
                                    @if(!empty($vial['cas']))
                                    <tr style="border-bottom: 1px solid #dde8f5;">
                                        <td class="chem-label">CAS No.</td>
                                        <td class="chem-value">{{ $vial['cas'] }}</td>
                                    </tr>
                                    @endif
                                    @if(!empty($vial['molecularFormula']))
                                    <tr style="border-bottom: 1px solid #dde8f5;">
                                        <td class="chem-label">Mol. Formula</td>
                                        <td class="chem-value">{{ $vial['molecularFormula'] }}</td>
                                    </tr>
                                    @endif
                                    @if(!empty($vial['molecularWeight']))
                                    <tr style="border-bottom: 1px solid #dde8f5;">
                                        <td class="chem-label">Mol. Weight</td>
                                        <td class="chem-value">{{ $vial['molecularWeight'] }}</td>
                                    </tr>
                                    @endif
                                    @if(!empty($vial['purity']))
                                    <tr style="border-bottom: 1px solid #dde8f5;">
                                        <td class="chem-label">Purity</td>
                                        <td class="chem-value">{{ $vial['purity'] }}</td>
                                    </tr>
                                    @endif
                                    @if(!empty($vial['sequence']))
                                    <tr style="border-bottom: 1px solid #dde8f5;">
                                        <td class="chem-label">Sequence</td>
                                        <td class="chem-value" style="font-size: 0.55rem; word-break: break-all;">{{ $vial['sequence'] }}</td>
                                    </tr>
                                    @endif
                                    @if(!empty($vial['appearance']))
                                    <tr style="border-bottom: 1px solid #dde8f5;">
                                        <td class="chem-label">Appearance</td>
                                        <td class="chem-value">{{ $vial['appearance'] }}</td>
                                    </tr>
                                    @endif
                                    @if(!empty($vial['storage']))
                                    <tr>
                                        <td class="chem-label">Storage</td>
                                        <td class="chem-value">{{ $vial['storage'] }}</td>
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
