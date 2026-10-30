@extends('layouts.app')

@section('title', 'Payment Success — ResearchChem.uk')

@section('content')
<div class="max-w-3xl mx-auto px-4 py-20 text-center" x-init="$store.cart.clearCart()">
    <div class="w-16 h-16 rounded-full bg-emerald-100 text-emerald-600 flex items-center justify-center mx-auto mb-6">
        <i data-lucide="check-circle" class="w-10 h-10"></i>
    </div>

    <h1 class="text-3xl font-extrabold text-slate-900 mb-3" style="font-family: var(--font-heading);">
        Payment Completed Successfully
    </h1>
    <p class="text-slate-600 mb-8 max-w-lg mx-auto">
        Your payment has been received and verified. Your order is now being prepared for UK laboratory dispatch.
    </p>

    <a href="{{ route('home') }}" class="inline-flex items-center gap-2 px-8 py-3.5 rounded-xl text-sm font-bold bg-blue-700 text-white hover:bg-blue-800 transition-colors shadow-md">
        Continue to Homepage &rarr;
    </a>
</div>
@endsection

