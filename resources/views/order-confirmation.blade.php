@extends('layouts.app')

@section('title', 'Order Confirmation — ResearchChem.uk')

@section('content')
<div class="max-w-3xl mx-auto px-4 py-16 text-center">
    <div class="w-16 h-16 rounded-full bg-emerald-100 text-emerald-600 flex items-center justify-center mx-auto mb-6">
        <i data-lucide="check-circle" class="w-10 h-10"></i>
    </div>

    <h1 class="text-3xl font-extrabold text-slate-900 mb-3" style="font-family: var(--font-heading);">
        Order Confirmed
    </h1>
    <p class="text-slate-600 mb-8 max-w-lg mx-auto">
        Thank you for your order with ResearchChem.uk. Your research compounds will be packaged discreetly and shipped next working day.
    </p>

    <div class="p-6 rounded-2xl bg-slate-50 border border-slate-200 text-left mb-8 space-y-3 text-sm">
        <h3 class="font-bold text-slate-900 uppercase text-xs tracking-wider border-b border-slate-200 pb-2">
            Order Status &amp; Dispatch Details
        </h3>
        <p class="text-slate-600">
            A confirmation receipt has been logged. You will receive tracking updates via Royal Mail once the parcel is handed to the courier.
        </p>
    </div>

    <a href="{{ route('home') }}" class="inline-flex items-center gap-2 px-8 py-3.5 rounded-xl text-sm font-bold bg-blue-700 text-white hover:bg-blue-800 transition-colors shadow-md">
        Return to Store &rarr;
    </a>
</div>
@endsection

