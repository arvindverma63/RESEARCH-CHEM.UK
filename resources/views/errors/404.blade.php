@extends('layouts.app')

@section('title', 'Page Not Found — ResearchChem.uk')

@section('content')
<div class="max-w-2xl mx-auto px-4 py-24 text-center">
    <div class="w-16 h-16 rounded-full bg-blue-50 text-blue-700 flex items-center justify-center mx-auto mb-6">
        <i data-lucide="flask-conical" class="w-8 h-8"></i>
    </div>

    <h1 class="text-4xl sm:text-5xl font-black text-slate-900 tracking-tight mb-3" style="font-family: var(--font-heading);">
        404 &middot; Compound Not Found
    </h1>
    <p class="text-base text-slate-600 mb-8 max-w-md mx-auto font-sans">
        The research page or compound you requested could not be located. It may have been moved or updated.
    </p>

    <div class="flex flex-wrap justify-center gap-4">
        <a href="{{ route('home') }}" class="px-6 py-3 rounded-lg text-sm font-bold bg-blue-700 text-white hover:bg-blue-800 transition-colors shadow-xs">
            Return to Homepage
        </a>
        <a href="{{ route('peptides') }}" class="px-6 py-3 rounded-lg text-sm font-bold bg-white text-slate-700 border border-slate-300 hover:bg-slate-50 transition-colors">
            View Peptide Vials
        </a>
    </div>
</div>
@endsection

