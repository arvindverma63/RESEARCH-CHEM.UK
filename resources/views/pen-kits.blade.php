@extends('layouts.app')

@section('title', 'Retatrutide Pen Kit UK — Reta Pen, Peptide Pens & Research Kits | ResearchChem.uk')
@section('meta_description', 'Buy Retatrutide pen kits (Reta pen), Wolverine, and GLOW GHK-CU peptide pen kits in the UK. Bestselling research compound kits with micro pin injector pen. Dispatched within 2–3 working days.')

@section('content')
<style>
  .pen-tier-btn {
    flex: 1 1 0%;
    min-width: 80px;
    padding: 10px 8px;
    background-color: #ffffff;
    border: 1.5px solid #c8d8ec;
    border-radius: 4px;
    cursor: pointer;
    transition: all 0.15s ease;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    gap: 2px;
    box-sizing: border-box;
  }
  .pen-tier-btn:hover {
    border-color: #0052a3;
  }
  .pen-tier-btn.active {
    background-color: #0052a3 !important;
    border-color: #0052a3 !important;
  }
  .pen-tier-price {
    font-family: var(--font-heading);
    font-weight: 900;
    font-size: 1rem;
    line-height: 1;
    color: #0052a3;
  }
  .pen-tier-btn.active .pen-tier-price {
    color: #ffffff !important;
  }
  .pen-tier-sub {
    font-size: 0.62rem;
    font-weight: 700;
    color: #3a5070;
    line-height: 1.2;
    white-space: nowrap;
  }
  .pen-tier-btn.active .pen-tier-sub {
    color: rgba(255, 255, 255, 0.95) !important;
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

<!-- ── PAGE HEADER ── -->
<div style="background-color: #0052a3; padding: 32px 24px 28px; text-align: center;">
    <div style="max-width: 900px; margin: 0 auto; text-align: left; margin-bottom: 10px;">
        <a href="{{ route('home') }}" style="color: rgba(255,255,255,0.8); font-size: 0.72rem; font-weight: 700; text-decoration: none; display: inline-flex; align-items: center; gap: 4px;">
            &larr; Home
        </a>
    </div>
    <span style="display: inline-block; border: 1px solid rgba(255,255,255,0.5); color: #fff; font-size: 0.58rem; font-weight: 800; letter-spacing: 0.2em; text-transform: uppercase; padding: 4px 12px; border-radius: 2px; margin-bottom: 10px;">
        Trienza Laboratory Research
    </span>
    <h1 style="font-family: var(--font-heading); color: #fff; font-size: clamp(1.8rem, 4vw, 2.6rem); font-weight: 900; margin: 0 0 8px; line-height: 1.1;">
        {{ $content['pageTitle'] ?? 'Peptide Pen Kits' }}
    </h1>
    <p style="color: rgba(255,255,255,0.85); font-size: 0.88rem; margin: 0 0 18px;" class="font-sans">
        {{ $content['pageSubtitle'] ?? 'Research compound kits · Listed accessories included · Dispatched within 2–3 working days' }}
    </p>
    <div style="display: inline-flex; flex-wrap: wrap; justify-content: center; gap: 6px 20px; background-color: rgba(255,255,255,0.12); border-radius: 3px; padding: 10px 20px;">
        @foreach(['Filled Peptide Vial', 'Micro Pin Injector Pen', '12× 32G Micro Pins', '12× Alcohol Wipes'] as $item)
            <span style="display: flex; align-items: center; gap: 6px; color: #fff; font-size: 0.75rem; font-weight: 600;">
                <span style="width: 5px; height: 5px; border-radius: 50%; background-color: #fff; display: inline-block; flex-shrink: 0;"></span>
                {{ $item }}
            </span>
        @endforeach
    </div>
</div>

<!-- ── CATEGORY INTRO ── -->
<div style="background-color: #f8f9fa; border-bottom: 1px solid #e2e8f0;">
    <div style="max-width: 900px; margin: 0 auto; padding: 28px 16px 24px;">
        <h2 style="font-family: var(--font-heading); color: #0052a3; font-size: clamp(1rem, 2.5vw, 1.25rem); font-weight: 800; margin: 0 0 14px; line-height: 1.2;">
            {{ $content['categoryIntro']['heading'] ?? "Retatrutide Pen Kits & Peptide Pens — UK's Best Sellers" }}
        </h2>
        @foreach($content['categoryIntro']['body'] ?? [] as $p)
            <p style="font-size: 0.82rem; color: #475569; line-height: 1.7; margin: 0 0 10px; max-width: 800px;" class="font-sans">
                {{ $p['text'] ?? $p }}
            </p>
        @endforeach
    </div>
</div>

<!-- ── PRODUCTS LIST ── -->
<div style="max-width: 900px; margin: 0 auto; padding: 24px 16px 40px;">
    @php
        $imgMap = [
            'retatrutide-pen-kit' => '/airo-assets/images/pages/pen-kits/shot-162840?v=5',
            'wolverine-pen-kit' => '/airo-assets/images/pages/pen-kits/shot-155333?v=5',
            'glow-ghk-cu-pen-kit' => '/airo-assets/images/pages/pen-kits/shot-161643?v=5',
        ];
    @endphp

    @foreach($content['PRODUCTS'] ?? [] as $kit)
        @php
            $slug = $kit['slug'];
            $img = $kit['image'] ?? ($imgMap[$slug] ?? "/assets/images/pen-kit-{$slug}-hd.jpg");
            $tiers = $kit['tiers'] ?? [];
        @endphp
        <div style="background-color: #fff; border-radius: 6px; margin-bottom: 16px; border: 1.5px solid #0052a3; overflow: hidden;"
             x-data="{
                selectedTierQty: '{{ !empty($tiers) ? ($tiers[0]['qty'] ?? '1 Kit') : '1 Kit' }}',
                chemOpen: false,
                loading: false,
                added: false,
                tiers: {{ json_encode($tiers) }},
                get currentTier() {
                    const match = this.tiers.find(t => t.qty === this.selectedTierQty);
                    return match || this.tiers[0] || { price: '{{ $kit['price'] ?? '£0' }}', each: '', qty: '1 Kit' };
                },
                get pricePence() {
                    const clean = (this.currentTier.price || '{{ $kit['price'] ?? '0' }}').replace(/[^0-9.]/g, '');
                    return Math.round(parseFloat(clean) * 100);
                }
             }">

            <!-- Product Presentation Image -->
            <div style="position: relative; width: 100%; background-color: #ffffff; display: flex; align-items: center; justify-content: center; min-height: 240px; padding: 16px; box-sizing: border-box;">
                <img src="{{ $img }}"
                     alt="{{ $kit['name'] }} {{ $kit['dose'] }} Pen Kit"
                     loading="lazy"
                     decoding="async"
                     onerror="this.onerror=null; this.src='/assets/images/pen-kit-retatrutide-hd.jpg';" style="width: 100%; max-height: 340px; object-fit: contain; display: block; background: #ffffff;">

                <!-- Top Badges -->
                <div style="position: absolute; top: 12px; left: 12px; background-color: #0052a3; color: #fff; font-size: 0.52rem; font-weight: 800; letter-spacing: 0.14em; text-transform: uppercase; padding: 4px 9px; border-radius: 2px;">
                    Research Use Only
                </div>
                <div style="position: absolute; top: 12px; right: 12px; background-color: #0052a3; color: #fff; font-family: var(--font-heading); font-weight: 900; font-size: 1.1rem; padding: 5px 14px; border-radius: 3px;">
                    {{ $kit['dose'] }}
                </div>
            </div>

            <!-- Product Info -->
            <div style="padding: 14px 18px 18px;">
                <!-- Name row -->
                <div style="margin-bottom: 10px; padding-bottom: 8px; border-bottom: 2px solid #0052a3;">
                    <span style="display: inline-block; background-color: #e8f0ff; color: #0052a3; font-size: 0.55rem; font-weight: 800; letter-spacing: 0.1em; text-transform: uppercase; padding: 2px 8px; border-radius: 2px; margin-bottom: 4px; max-width: 100%;">
                        {{ $kit['formula'] ?? '' }}
                    </span>
                    <h2 style="font-family: var(--font-heading); color: #0a1a2e; font-size: clamp(1.5rem, 3vw, 2rem); font-weight: 900; margin: 0 0 4px; line-height: 1.1;">
                        {{ $kit['name'] }}
                    </h2>
                    <p style="color: #3a5070; font-size: 0.84rem; margin: 0; line-height: 1.5;" class="font-sans">
                        {{ $kit['subtitle'] ?? '' }}
                    </p>
                </div>

                <!-- Kit Contents -->
                <div style="margin-bottom: 14px;">
                    <span style="display: block; color: #0052a3; font-size: 0.58rem; font-weight: 800; letter-spacing: 0.15em; text-transform: uppercase; margin-bottom: 8px;">
                        Kit Contents
                    </span>
                    <div style="display: grid; grid-template-columns: 1fr; gap: 2px;">
                        @foreach($kit['contents'] ?? [] as $item)
                            @php
                                $cleanItem = preg_replace('/needles/i', 'Pins', $item);
                            @endphp
                            <div style="display: flex; align-items: flex-start; gap: 6px; padding: 3px 0; border-bottom: 1px solid #e8f0f8;">
                                <span style="width: 5px; height: 5px; border-radius: 50%; background-color: #0052a3; flex-shrink: 0; margin-top: 6px; display: block;"></span>
                                <span style="color: #1a2e44; font-size: 0.78rem; line-height: 1.4;" class="font-sans">{{ $cleanItem }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- ── QUANTITY + ORDER ── -->
                <div style="border-top: 1.5px solid #0052a3; padding-top: 12px;">
                    <span style="display: block; color: #0052a3; font-size: 0.58rem; font-weight: 800; letter-spacing: 0.15em; text-transform: uppercase; margin-bottom: 10px;">
                        Select Quantity
                    </span>

                    <div style="display: flex; gap: 8px; margin-bottom: 10px; flex-wrap: wrap;">
                        @if(!empty($tiers))
                            @foreach($tiers as $tier)
                                <button type="button"
                                        @click="selectedTierQty = '{{ $tier['qty'] }}'"
                                        class="pen-tier-btn"
                                        :class="{ 'active': currentTier.qty === '{{ $tier['qty'] }}' }">
                                    <span class="pen-tier-price">
                                        {{ $tier['price'] }}
                                    </span>
                                    <span class="pen-tier-sub">
                                        {{ $tier['qty'] }}{{ !empty($tier['each']) ? ' · ' . $tier['each'] : '' }}
                                    </span>
                                </button>
                            @endforeach
                        @else
                            @foreach([1, 2, 3, 4, 5] as $tQty)
                                @php
                                    $defaultPrices = [1 => '£150', 2 => '£300', 3 => '£420', 4 => '£560', 5 => '£650'];
                                    $defaultEaches = [1 => '', 2 => '£150 each', 3 => '£140 each', 4 => '£140 each', 5 => '£130 each'];
                                    $qLabel = $tQty === 1 ? '1 Kit' : "{$tQty} Kits";
                                @endphp
                                <button type="button"
                                        @click="selectedTierQty = '{{ $qLabel }}'"
                                        class="pen-tier-btn"
                                        :class="{ 'active': selectedTierQty === '{{ $qLabel }}' }">
                                    <span class="pen-tier-price">
                                        {{ $defaultPrices[$tQty] }}
                                    </span>
                                    <span class="pen-tier-sub">
                                        {{ $qLabel }}{{ !empty($defaultEaches[$tQty]) ? ' · ' . $defaultEaches[$tQty] : '' }}
                                    </span>
                                </button>
                            @endforeach
                        @endif
                    </div>

                    <!-- Action buttons -->
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 10px; margin-top: 10px; width: 100%;">
                        <a href="{{ route('products.show', $slug) }}"
                           class="btn-secondary-details-kit">
                            View Details
                        </a>
                        <button type="button"
                                class="btn-primary-cart-kit"
                                :class="{ 'is-added': added }"
                                :disabled="loading"
                                @click="
                                    if (loading) return;
                                    loading = true;
                                    setTimeout(() => {
                                        $store.cart.addToCart({
                                            id: '{{ $slug }}' + '-' + (currentTier.qty || '1Kit').replace(/[^a-zA-Z0-9]/g, ''),
                                            name: '{{ addslashes($kit['name']) }} (' + (currentTier.qty || '1 Kit') + ')',
                                            price: pricePence,
                                            currency: 'gbp',
                                            image: '{{ $img }}',
                                            category: 'pen-kits'
                                        });
                                        loading = false;
                                        added = true;
                                        setTimeout(() => added = false, 2000);
                                    }, 300);
                                ">
                            <span x-show="loading" x-cloak style="display: inline-flex; align-items: center; gap: 6px;">
                                <svg class="animate-spin" style="width: 14px; height: 14px; color: #ffffff;" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path></svg>
                                <span style="color: #ffffff;">Adding...</span>
                            </span>
                            <span x-show="!loading && !added" style="display: inline-flex; align-items: center; gap: 6px;">
                                <svg style="width: 15px; height: 15px; color: #ffffff;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" /></svg>
                                <span style="color: #ffffff;">Add to Cart</span>
                            </span>
                            <span x-show="!loading && added" x-cloak style="display: inline-flex; align-items: center; gap: 5px;">
                                <svg style="width: 14px; height: 14px; color: #ffffff;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" /></svg>
                                <span style="color: #ffffff;">Added!</span>
                            </span>
                        </button>
                    </div>

                    <!-- Inline chemical data sheet -->
                    <div style="border-top: 1px solid #dde8f5; margin-top: 14px;">
                        <button type="button"
                                @click="chemOpen = !chemOpen"
                                style="width: 100%; background: none; border: none; cursor: pointer; padding: 8px 0 4px; display: flex; align-items: center; justify-content: space-between; color: #0052a3; font-family: var(--font-heading); font-weight: 700; font-size: 0.65rem; letter-spacing: 0.04em; text-transform: uppercase;">
                            <span>⚗ Data Sheet</span>
                            <span style="display: inline-block; transition: transform 0.2s; font-size: 0.75rem;"
                                  :style="chemOpen ? 'transform: rotate(180deg)' : 'transform: rotate(0deg)'">▾</span>
                        </button>

                        <div x-show="chemOpen" x-cloak x-collapse
                             style="background-color: #f4f8ff; border: 1px solid #c8daf5; border-radius: 4px; padding: 10px 12px; margin-top: 6px;">
                            @if(!empty($kit['chemDesc']))
                                <p style="font-size: 0.62rem; color: #2a3a50; line-height: 1.55; margin: 0 0 8px; font-style: italic;">
                                    {{ $kit['chemDesc'] }}
                                </p>
                            @endif
                            <table style="width: 100%; border-collapse: collapse; font-size: 0.6rem;">
                                <tbody>
                                    @if(!empty($kit['cas']))
                                    <tr style="border-bottom: 1px solid #dde8f5;">
                                        <td class="chem-label">CAS No.</td>
                                        <td class="chem-value">{{ $kit['cas'] }}</td>
                                    </tr>
                                    @endif
                                    @if(!empty($kit['molecularFormula']))
                                    <tr style="border-bottom: 1px solid #dde8f5;">
                                        <td class="chem-label">Mol. Formula</td>
                                        <td class="chem-value">{{ $kit['molecularFormula'] }}</td>
                                    </tr>
                                    @endif
                                    @if(!empty($kit['molecularWeight']))
                                    <tr style="border-bottom: 1px solid #dde8f5;">
                                        <td class="chem-label">Mol. Weight</td>
                                        <td class="chem-value">{{ $kit['molecularWeight'] }}</td>
                                    </tr>
                                    @endif
                                    @if(!empty($kit['purity']))
                                    <tr style="border-bottom: 1px solid #dde8f5;">
                                        <td class="chem-label">Purity</td>
                                        <td class="chem-value">{{ $kit['purity'] }}</td>
                                    </tr>
                                    @endif
                                    @if(!empty($kit['sequence']))
                                    <tr style="border-bottom: 1px solid #dde8f5;">
                                        <td class="chem-label">Sequence</td>
                                        <td class="chem-value" style="word-break: break-all;">{{ $kit['sequence'] }}</td>
                                    </tr>
                                    @endif
                                    @if(!empty($kit['appearance']))
                                    <tr style="border-bottom: 1px solid #dde8f5;">
                                        <td class="chem-label">Appearance</td>
                                        <td class="chem-value">{{ $kit['appearance'] }}</td>
                                    </tr>
                                    @endif
                                    @if(!empty($kit['storage']))
                                    <tr>
                                        <td class="chem-label">Storage</td>
                                        <td class="chem-value">{{ $kit['storage'] }}</td>
                                    </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>

<!-- ── DISCLAIMER ── -->
<div style="background-color: #0052a3; padding: 12px 24px; text-align: center;">
    <p style="color: rgba(255,255,255,0.75); font-size: 0.65rem; margin: 0; line-height: 1.5;" class="font-sans">
        All products are for laboratory research purposes only. Not for human or veterinary use. For qualified researchers only.
    </p>
</div>
@endsection
