@extends('layouts.app')

@section('title', 'Peptide & SARM Certificates of Analysis UK | ResearchChem.uk')
@section('meta_description', 'Third-party HPLC-verified certificates of analysis for BPC-157, TB-500, Retatrutide, MK-677, RAD-140, LGD-4033 and all research compounds. Purity, batch number and test date for full traceability.')

@section('content')
<div x-data="{ lightbox: null }" @keydown.escape.window="lightbox = null">

    <!-- ── PAGE HEADER ── -->
    <div style="background-color: #0052a3; padding: 32px 24px 28px; text-align: center;">
        <div style="max-width: 960px; margin: 0 auto; text-align: left; margin-bottom: 10px;">
            <a href="{{ route('home') }}" style="color: rgba(255,255,255,0.8); font-size: 0.72rem; font-weight: 700; text-decoration: none; display: inline-flex; align-items: center; gap: 4px;">
                &larr; Home
            </a>
        </div>
        <span style="display: inline-block; border: 1px solid rgba(255,255,255,0.5); color: #fff; font-size: 0.58rem; font-weight: 800; letter-spacing: 0.2em; text-transform: uppercase; padding: 4px 12px; border-radius: 2px; margin-bottom: 10px;">
            Trienza Laboratory Research
        </span>
        <h1 style="font-family: var(--font-heading); color: #fff; font-size: clamp(1.6rem, 4vw, 2.2rem); font-weight: 900; margin: 0 0 8px; line-height: 1.1;">
            Certificates of Analysis (COA)
        </h1>
        <p style="color: rgba(255,255,255,0.85); font-size: 0.9rem; margin: 0 auto; max-width: 600px; line-height: 1.65;" class="font-sans">
            Every compound we supply is independently tested by a third-party UKAS-accredited laboratory.
            Purity, batch traceability, and full documentation &mdash; because research integrity starts with the source.
        </p>
    </div>

    <!-- ── QUALITY PROCESS ── -->
    <section style="background-color: #f0f7ff; border-bottom: 1px solid #c8d8ec;">
        <div style="max-width: 960px; margin: 0 auto; padding: 36px 24px;">
            <h2 style="color: #0052a3; font-family: var(--font-heading); font-weight: 800; font-size: 1.1rem; text-align: center; margin: 0 0 24px;">
                Our Quality Assurance Process
            </h2>
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 12px;">
                @php
                    $steps = [
                        ['title' => 'Synthesised', 'desc' => 'Compounds produced under controlled laboratory conditions to strict specification.'],
                        ['title' => 'Third-Party Tested', 'desc' => 'Every batch sent to an independent UKAS-accredited laboratory for HPLC analysis.'],
                        ['title' => 'Verified & Released', 'desc' => 'Only batches meeting our ≥98% purity threshold are approved for dispatch.'],
                        ['title' => 'COA Available', 'desc' => 'Full certificate of analysis available on request for every product we supply.']
                    ];
                @endphp
                @foreach($steps as $i => $s)
                    <div style="background-color: #fff; border: 1px solid #c8d8ec; padding: 18px 16px; display: flex; flex-direction: column; gap: 10px;">
                        <div style="display: flex; align-items: center; gap: 10px;">
                            <div style="width: 28px; height: 28px; background-color: #0052a3; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                <span style="color: #fff; font-size: 0.7rem; font-weight: 800; font-family: var(--font-heading);">{{ $i + 1 }}</span>
                            </div>
                            <h3 style="font-family: var(--font-heading); font-weight: 800; font-size: 0.85rem; color: #0052a3; margin: 0;">
                                {{ $s['title'] }}
                            </h3>
                        </div>
                        <p style="font-size: 0.78rem; color: #4a5a6a; line-height: 1.55; margin: 0;" class="font-sans">
                            {{ $s['desc'] }}
                        </p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- ── COA TABLES ── -->
    <section style="background-color: #fff; border-bottom: 1px solid #c8d8ec;">
        <div style="max-width: 960px; margin: 0 auto; padding: 36px 24px;">
            <h2 style="color: #0052a3; font-family: var(--font-heading); font-size: 1.4rem; font-weight: 800; margin: 0 0 4px;">
                Batch Records &amp; Purity Data
            </h2>
            <p style="color: #5a6a7a; font-size: 0.82rem; margin: 0 0 36px; border-bottom: 2px solid #d0dff0; padding-bottom: 16px;" class="font-sans">
                Current batch data shown below. Full PDF certificates available on request &mdash; contact us with your order number.
            </p>

            @foreach($categories as $cat)
                <div style="margin-bottom: 36px;">
                    <!-- Category heading — left border accent -->
                    <div style="border-left: 4px solid #0052a3; padding-left: 12px; margin-bottom: 12px;">
                        <h3 style="color: #0052a3; font-family: var(--font-heading); font-weight: 800; font-size: 1rem; margin: 0;">
                            {{ $cat['category'] }}
                        </h3>
                    </div>

                    <!-- Table — sharp border -->
                    <div style="overflow-x: auto; border: 1px solid #c8d8ec;">
                        <table style="width: 100%; font-size: 0.82rem; border-collapse: collapse;">
                            <thead>
                                <tr>
                                    <th style="text-align: left; padding: 10px 14px; color: #fff; font-weight: 700; font-family: var(--font-heading); white-space: nowrap; background-color: #0052a3;">
                                        Product
                                    </th>
                                    <th style="text-align: left; padding: 10px 14px; color: #fff; font-weight: 700; font-family: var(--font-heading); background-color: #0052a3;" class="hidden sm:table-cell">
                                        SKU
                                    </th>
                                    <th style="text-align: left; padding: 10px 14px; color: #fff; font-weight: 700; font-family: var(--font-heading); background-color: #0052a3;" class="hidden md:table-cell">
                                        Batch
                                    </th>
                                    <th style="text-align: left; padding: 10px 14px; color: #fff; font-weight: 700; font-family: var(--font-heading); background-color: #0052a3;" class="hidden sm:table-cell">
                                        Tested
                                    </th>
                                    <th style="text-align: left; padding: 10px 14px; color: #fff; font-weight: 700; font-family: var(--font-heading); background-color: #0052a3;">
                                        Purity
                                    </th>
                                    <th style="text-align: left; padding: 10px 14px; color: #fff; font-weight: 700; font-family: var(--font-heading); background-color: #0052a3;">
                                        COA
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($cat['items'] as $idx => $item)
                                    @php
                                        $rowBg = $idx % 2 === 0 ? '#ffffff' : '#f7f7f7';
                                    @endphp
                                    <tr style="background-color: {{ $rowBg }};">
                                        <td style="padding: 10px 14px; font-weight: 600; color: #0a1a2e; background-color: {{ $rowBg }}; border-bottom: 1px solid #dde8f5;">
                                            {{ $item['name'] }}
                                        </td>
                                        <td style="padding: 10px 14px; color: #5a6a7a; font-family: monospace; font-size: 0.75rem; background-color: {{ $rowBg }}; border-bottom: 1px solid #dde8f5;" class="hidden sm:table-cell">
                                            {{ $item['sku'] }}
                                        </td>
                                        <td style="padding: 10px 14px; color: #5a6a7a; font-family: monospace; font-size: 0.75rem; background-color: {{ $rowBg }}; border-bottom: 1px solid #dde8f5;" class="hidden md:table-cell">
                                            {{ $item['batch'] }}
                                        </td>
                                        <td style="padding: 10px 14px; color: #5a6a7a; background-color: {{ $rowBg }}; border-bottom: 1px solid #dde8f5;" class="hidden sm:table-cell">
                                            {{ $item['tested'] }}
                                        </td>
                                        <td style="padding: 10px 14px; background-color: {{ $rowBg }}; border-bottom: 1px solid #dde8f5;">
                                            <span style="display: inline-flex; align-items: center; gap: 4px; font-weight: 700; color: #16a34a;">
                                                <i data-lucide="check-circle-2" class="w-3.5 h-3.5 text-emerald-600"></i>
                                                {{ $item['purity'] }}
                                            </span>
                                        </td>
                                        <td style="padding: 10px 14px; background-color: {{ $rowBg }}; border-bottom: 1px solid #dde8f5;">
                                            @if(!empty($item['coaImg']))
                                                <button type="button"
                                                        @click="lightbox = '{{ $item['coaImg'] }}'"
                                                        style="display: inline-flex; align-items: center; gap: 4px; font-size: 0.72rem; font-weight: 700; padding: 5px 10px; background-color: #e8f0fb; color: #0052a3; border: 1px solid #0052a3; cursor: pointer; font-family: var(--font-heading); border-radius: 2px;">
                                                    <i data-lucide="download" class="w-3 h-3"></i>
                                                    View COA
                                                </button>
                                            @else
                                                <a href="{{ route('contact') }}"
                                                   style="display: inline-flex; align-items: center; gap: 4px; font-size: 0.72rem; font-weight: 700; padding: 5px 10px; background-color: #e8f0fb; color: #0052a3; text-decoration: none; font-family: var(--font-heading); border-radius: 2px; border: 1px solid #0052a3;">
                                                    <i data-lucide="download" class="w-3 h-3"></i>
                                                    Request
                                                </a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    <!-- ── REQUEST CTA ── -->
    <section style="background-color: #0052a3; border-bottom: 3px solid #003d7a;">
        <div style="max-width: 960px; margin: 0 auto; padding: 40px 24px; text-align: center;">
            <i data-lucide="shield-check" class="w-9 h-9 mx-auto mb-3" style="color: rgba(255,255,255,0.85);"></i>
            <h2 style="color: #fff; font-family: var(--font-heading); font-weight: 800; font-size: 1.2rem; margin: 0 0 10px;">
                Need a Full PDF Certificate?
            </h2>
            <p style="color: rgba(255,255,255,0.85); font-size: 0.85rem; max-width: 480px; margin: 0 auto 24px; line-height: 1.65;" class="font-sans">
                Batch-specific certificates of analysis are available. Contact us with your order reference and we will send the relevant COA.
            </p>
            <a href="{{ route('contact') }}"
               style="display: inline-flex; align-items: center; gap: 8px; padding: 11px 28px; font-weight: 800; font-size: 0.85rem; background-color: #fff; color: #0052a3; text-decoration: none; font-family: var(--font-heading); border: 2px solid #fff; border-radius: 2px;">
                Request a COA
                <i data-lucide="chevron-right" class="w-4 h-4"></i>
            </a>
        </div>
    </section>

    <!-- ── DISCLAIMER ── -->
    <section style="background-color: #f4f8ff; border-top: 1px solid #c8d8ec;">
        <div style="max-width: 960px; margin: 0 auto; padding: 20px 24px;">
            <p style="font-size: 0.72rem; color: #7a8a9a; line-height: 1.7; text-align: center; max-width: 700px; margin: 0 auto;" class="font-sans">
                All compounds supplied by ResearchChem.uk are intended strictly for laboratory research purposes only.
                Not for human consumption. For use by qualified researchers in controlled laboratory environments.
                Purity figures are derived from third-party HPLC analysis of the stated batch number.
            </p>
        </div>
    </section>

    <!-- ── COA LIGHTBOX MODAL ── -->
    <div x-show="lightbox" x-cloak
         @click="lightbox = null"
         style="position: fixed; inset: 0; z-index: 9999; background-color: rgba(10,26,46,0.88); backdrop-filter: blur(4px); display: flex; align-items: flex-start; justify-content: center; overflow-y: auto; padding: 32px 16px 48px;">
        <div @click.stop
             style="width: 100%; max-width: 720px; display: flex; flex-direction: column; box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.45); border-radius: 4px; overflow: hidden;">
            
            <!-- Close & Action bar -->
            <div style="background-color: #0052a3; display: flex; align-items: center; justify-content: space-between; padding: 12px 16px; flex-shrink: 0; border-bottom: 1px solid rgba(255,255,255,0.15);">
                <div style="display: flex; align-items: center; gap: 8px;">
                    <i data-lucide="file-check-2" class="w-4 h-4 text-emerald-400"></i>
                    <span style="color: #fff; font-size: 0.82rem; font-weight: 700; font-family: var(--font-heading); letter-spacing: 0.02em;">
                        Official Certificate of Analysis (HPLC Analytical Report)
                    </span>
                </div>
                <div style="display: flex; align-items: center; gap: 8px;">
                    <a :href="lightbox"
                       download
                       style="display: inline-flex; align-items: center; gap: 4px; background-color: rgba(255,255,255,0.15); color: #fff; border: 1px solid rgba(255,255,255,0.3); text-decoration: none; padding: 4px 10px; font-weight: 700; font-size: 0.72rem; font-family: var(--font-heading); border-radius: 2px;">
                        <i data-lucide="download" class="w-3 h-3"></i>
                        Save COA
                    </a>
                    <button type="button"
                            @click="lightbox = null"
                            style="display: inline-flex; align-items: center; gap: 4px; background-color: #fff; color: #0052a3; border: none; cursor: pointer; padding: 4px 12px; font-weight: 800; font-size: 0.75rem; font-family: var(--font-heading); border-radius: 2px;">
                        <i data-lucide="x" class="w-3.5 h-3.5"></i>
                        Close
                    </button>
                </div>
            </div>

            <!-- COA Document Image -->
            <div style="background-color: #ffffff; padding: 12px; display: flex; justify-content: center;">
                <img :src="lightbox"
                     alt="Official Certificate of Analysis"
                     @click.stop
                     style="display: block; width: 100%; height: auto; box-shadow: 0 4px 14px rgba(0,0,0,0.08); border: 1px solid #e2e8f0; border-radius: 2px;">
            </div>

            <!-- Dismiss hint -->
            <div style="background-color: #0f243d; padding: 8px 16px; text-align: center;">
                <p style="margin: 0; color: rgba(255,255,255,0.65); font-size: 0.72rem;" class="font-sans">
                    Third-party HPLC tested • UKAS ISO/IEC 17025:2017 compliant • Tap outside or press ESC to close
                </p>
            </div>
        </div>
    </div>

</div>
@endsection
