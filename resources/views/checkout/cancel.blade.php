@extends('layouts.app')

@section('title', 'Payment Cancelled — ResearchChem.uk')

@section('content')
<div class="max-w-3xl mx-auto px-4 py-20 text-center">
    <div class="w-16 h-16 rounded-full bg-amber-100 text-amber-600 flex items-center justify-center mx-auto mb-6">
        <i data-lucide="alert-circle" class="w-10 h-10"></i>
    </div>

    <h1 class="text-3xl font-extrabold text-slate-900 mb-3" style="font-family: var(--font-heading);">
        Payment Cancelled
    </h1>
    <p class="text-slate-600 mb-8 max-w-lg mx-auto">
        Your payment session was cancelled. No charges were made. You can review your cart or try again when you are ready.
    </p>

    <div class="flex justify-center gap-4">
        <a href="{{ route('cart') }}" class="px-6 py-3 rounded-xl text-sm font-bold bg-blue-700 text-white hover:bg-blue-800 transition-colors shadow-md">
            Return to Cart
        </a>
        <a href="{{ route('home') }}" class="px-6 py-3 rounded-xl text-sm font-bold bg-white text-slate-700 border border-slate-300 hover:bg-slate-50 transition-colors">
            Back to Homepage
        </a>
    </div>
</div>
@endsection

