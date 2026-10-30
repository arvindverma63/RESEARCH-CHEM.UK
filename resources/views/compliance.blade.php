@extends('layouts.app')

@section('title', 'About & Compliance — ResearchChem.uk')
@section('meta_description', $content['meta']['description'] ?? 'About ResearchChem.uk — our commitment to research-grade quality, regulatory compliance, and responsible supply of laboratory compounds in the United Kingdom.')

@section('content')
<!-- Header Banner -->
<div class="text-white py-14 lg:py-20" style="background-color: #0052a3;">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <nav aria-label="Breadcrumb" class="flex items-center gap-2 text-xs text-blue-200 mb-4 font-sans">
            <a href="{{ route('home') }}" class="hover:text-white transition-colors">Home</a>
            <i data-lucide="chevron-right" class="w-3 h-3 text-blue-300"></i>
            <span class="text-white font-medium">About &amp; Compliance</span>
        </nav>

        <span class="text-xs font-mono font-bold tracking-widest text-blue-200 uppercase mb-2 block">
            {{ $content['hero']['eyebrow'] ?? 'About ResearchChem.uk' }}
        </span>
        <h1 class="text-3xl sm:text-5xl font-extrabold tracking-tight mb-4" style="font-family: var(--font-heading);">
            {{ $content['hero']['heading'] ?? 'Research-Grade Quality. Uncompromising Standards.' }}
        </h1>
        <p class="text-base sm:text-lg text-blue-100/90 leading-relaxed font-sans">
            {{ $content['hero']['subheading'] ?? 'We supply verified, high-purity research compounds exclusively to qualified laboratory professionals across the United Kingdom.' }}
        </p>
    </div>
</div>

<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12 lg:py-16 space-y-12">
    <!-- Notice box -->
    <div class="p-6 rounded-xl border border-amber-300 bg-amber-50">
        <div class="flex items-start gap-4">
            <i data-lucide="alert-triangle" class="w-6 h-6 text-amber-700 shrink-0 mt-0.5"></i>
            <div>
                <h3 class="text-sm font-bold text-amber-950 uppercase tracking-wider mb-1">
                    Crucial Compliance Notice
                </h3>
                <p class="text-xs sm:text-sm text-amber-900 leading-relaxed font-sans">
                    All compounds, peptides, SARMs, and products sold by ResearchChem.uk are strictly intended for in-vitro laboratory research purposes only. They are not intended for human consumption, veterinary use, or any clinical application whatsoever.
                </p>
            </div>
        </div>
    </div>

    <!-- About Section -->
    @if(!empty($content['about']))
        <div class="p-8 rounded-2xl border border-slate-200 bg-white shadow-xs">
            <div class="flex items-center gap-3 mb-4">
                <div class="w-10 h-10 rounded-lg flex items-center justify-center text-white" style="background-color: #0052a3;">
                    <i data-lucide="info" class="w-5 h-5"></i>
                </div>
                <h2 class="text-2xl font-bold text-slate-900" style="font-family: var(--font-heading);">
                    {{ $content['about']['heading'] ?? 'Who We Are' }}
                </h2>
            </div>
            <div class="prose prose-sm text-slate-600 leading-relaxed space-y-3 font-sans max-w-none">
                @foreach($content['about']['body'] ?? [] as $para)
                    <p>{{ is_array($para) ? ($para['text'] ?? '') : $para }}</p>
                @endforeach
            </div>
        </div>
    @endif

    <!-- Disclaimers Grid -->
    @if(!empty($content['disclaimers']))
        <div class="space-y-6">
            <h2 class="text-2xl font-bold text-slate-900" style="font-family: var(--font-heading);">
                Regulatory &amp; Laboratory Compliance Standards
            </h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                @php
                    $iconMap = [
                        'flask' => 'flask-conical',
                        'shield' => 'shield-alert',
                        'id' => 'user-check',
                        'law' => 'scale',
                        'hazard' => 'alert-triangle',
                        'globe' => 'globe-2'
                    ];
                @endphp
                @foreach($content['disclaimers'] as $disc)
                    <div class="p-6 rounded-xl border border-slate-200 bg-white shadow-xs">
                        <div class="w-10 h-10 rounded-lg flex items-center justify-center text-blue-700 bg-blue-50 mb-4">
                            <i data-lucide="{{ $iconMap[$disc['icon'] ?? 'flask'] ?? 'shield' }}" class="w-5 h-5"></i>
                        </div>
                        <h3 class="text-base font-bold text-slate-900 mb-2" style="font-family: var(--font-heading);">
                            {{ $disc['heading'] }}
                        </h3>
                        <p class="text-xs text-slate-600 leading-relaxed font-sans">
                            {{ $disc['body'] }}
                        </p>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    <!-- Quality Standards -->
    @if(!empty($content['quality']))
        <div class="p-8 rounded-2xl border border-slate-200 bg-white shadow-xs">
            <h2 class="text-2xl font-bold text-slate-900 mb-6" style="font-family: var(--font-heading);">
                {{ $content['quality']['heading'] ?? 'Our Quality Standards' }}
            </h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                @foreach($content['quality']['points'] ?? [] as $pt)
                    <div class="p-4 rounded-xl bg-slate-50 border border-slate-100 flex items-start gap-3">
                        <i data-lucide="check-circle-2" class="w-5 h-5 text-emerald-600 shrink-0 mt-0.5"></i>
                        <div>
                            <h4 class="text-sm font-bold text-slate-900">{{ $pt['label'] }}</h4>
                            <p class="text-xs text-slate-600 mt-0.5">{{ $pt['detail'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    <!-- Legal Notice -->
    @if(!empty($content['legal']))
        <div class="p-8 rounded-2xl border border-slate-200 bg-white shadow-xs">
            <h2 class="text-2xl font-bold text-slate-900 mb-4" style="font-family: var(--font-heading);">
                {{ $content['legal']['heading'] ?? 'Legal Notice' }}
            </h2>
            <div class="space-y-3 text-sm text-slate-600 leading-relaxed font-sans">
                @foreach($content['legal']['body'] ?? [] as $para)
                    <p>{{ is_array($para) ? ($para['text'] ?? '') : $para }}</p>
                @endforeach
            </div>
        </div>
    @endif

    <!-- Contact note -->
    <div class="p-8 rounded-2xl bg-blue-50 border border-blue-200 text-center">
        <h3 class="text-lg font-bold text-blue-950 mb-2" style="font-family: var(--font-heading);">
            {{ $content['contact']['heading'] ?? 'Compliance Enquiries' }}
        </h3>
        <p class="text-sm text-blue-900/80 mb-6 font-sans">
            {{ $content['contact']['body'] ?? 'For compliance-related enquiries, requests for Safety Data Sheets, or Certificate of Analysis documentation, please contact our team directly.' }}
        </p>
        <a href="{{ route('contact') }}" class="inline-flex items-center gap-2 px-6 py-3 rounded-lg text-sm font-bold bg-blue-700 text-white hover:bg-blue-800 transition-colors shadow-xs" style="font-family: var(--font-heading);">
            <i data-lucide="mail" class="w-4 h-4"></i>
            {{ $content['contact']['cta'] ?? 'Contact Us' }}
        </a>
    </div>
</div>
@endsection
