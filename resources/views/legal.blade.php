@extends('layouts.app')

@section('title', ($content['meta']['title'] ?? $pageTitle) . ' | ResearchChem.uk')
@section('meta_description', $content['meta']['description'] ?? 'Legal policies and documentation for ResearchChem.uk.')

@section('content')
<!-- Header Banner -->
<div class="bg-slate-50 border-b border-slate-200 py-10 lg:py-14">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <nav aria-label="Breadcrumb" class="flex items-center gap-2 text-xs text-slate-500 mb-4 font-sans">
            <a href="{{ route('home') }}" class="hover:text-blue-700 transition-colors">Home</a>
            <i data-lucide="chevron-right" class="w-3 h-3"></i>
            <span class="text-slate-800 font-medium">{{ $content['hero']['heading'] ?? $pageTitle }}</span>
        </nav>

        <h1 class="text-3xl sm:text-4xl font-extrabold text-slate-900 tracking-tight mb-2" style="font-family: var(--font-heading);">
            {{ $content['hero']['heading'] ?? $pageTitle }}
        </h1>
        @if(!empty($content['hero']['updated']))
            <p class="text-xs font-mono text-slate-500">
                Last updated: {{ $content['hero']['updated'] }} &middot; UK Law Applicable
            </p>
        @endif
    </div>
</div>

<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12 lg:py-16">
    <div class="bg-white rounded-2xl border border-slate-200 p-8 sm:p-12 shadow-xs space-y-10">
        @foreach($content['sections'] ?? [] as $sec)
            <section class="space-y-3">
                <h2 class="text-xl font-bold text-slate-900 border-b border-slate-100 pb-2" style="font-family: var(--font-heading);">
                    {{ $sec['heading'] }}
                </h2>
                <div class="prose prose-sm text-slate-600 leading-relaxed font-sans max-w-none">
                    @if(is_array($sec['body'] ?? null))
                        @foreach($sec['body'] as $para)
                            <p class="mb-3">{{ is_array($para) ? ($para['text'] ?? '') : $para }}</p>
                        @endforeach
                    @else
                        <p class="mb-3">{{ $sec['body'] ?? '' }}</p>
                    @endif

                    @if(!empty($sec['bullets']))
                        <ul class="list-disc pl-5 space-y-1.5 my-3 text-slate-700">
                            @foreach($sec['bullets'] as $bullet)
                                <li>{{ $bullet }}</li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </section>
        @endforeach
    </div>
</div>
@endsection

