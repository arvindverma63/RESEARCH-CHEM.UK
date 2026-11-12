@extends('layouts.app')

@section('title', 'Your Research Order — Shopping Cart & Checkout | ResearchChem.uk')
@section('meta_description', 'Review your selected laboratory research compounds, multi-buy volume discounts, and UK delivery details before confirming your order.')

@section('content')
<div class="bg-slate-50 min-h-[85vh] py-6 sm:py-8 lg:py-12"
     x-data="{
        submitting: false,
        orderRef: null,
        bankDetails: null,
        checkoutError: null,
        copiedField: null,
        name: '',
        email: '',
        address1: '',
        city: '',
        postcode: '',
        comments: '',

        copyToClipboard(text, field) {
            navigator.clipboard.writeText(text);
            this.copiedField = field;
            setTimeout(() => {
                if (this.copiedField === field) this.copiedField = null;
            }, 2000);
        },

        async placeOrder() {
            if (!$store.cart.items || $store.cart.items.length === 0) {
                this.checkoutError = 'Your cart is empty. Please select research compounds before placing an order.';
                return;
            }

            if (!this.name.trim() || !this.email.trim() || !this.address1.trim() || !this.city.trim() || !this.postcode.trim()) {
                this.checkoutError = 'Please complete all required delivery fields (Full Name, Email, Address Line 1, City, and Postcode).';
                return;
            }

            this.submitting = true;
            this.checkoutError = null;

            const discounts = [];
            if ($store.cart.sarmsDiscount() > 0) {
                discounts.push({ name: `SARMs Multi-buy (${$store.cart.sarmsPct()}% discount)`, amount: $store.cart.sarmsDiscount() });
            }
            if ($store.cart.vialDiscount() > 0) {
                discounts.push({ name: `Peptides Multi-buy (${$store.cart.vialPct()}% discount)`, amount: $store.cart.vialDiscount() });
            }

            try {
                const res = await fetch('/api/bank-transfer/place-order', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({
                        customerName: this.name.trim(),
                        customerEmail: this.email.trim(),
                        customerAddress: {
                            line1: this.address1.trim(),
                            city: this.city.trim(),
                            postcode: this.postcode.trim()
                        },
                        customerComments: this.comments.trim(),
                        items: $store.cart.items.map(i => ({
                            id: i.id,
                            name: i.name,
                            price: i.price,
                            quantity: i.quantity || 1,
                            currency: 'gbp'
                        })),
                        shippingFee: $store.cart.shippingFee(),
                        discounts: discounts,
                        finalTotal: $store.cart.finalTotal()
                    })
                });

                const data = await res.json();
                if (data.success) {
                    this.orderRef = data.ref;
                    this.bankDetails = data.bank;
                    $store.cart.clearCart();
                    window.scrollTo({ top: 0, behavior: 'smooth' });
                } else {
                    this.checkoutError = data.error || data.message || (data.errors ? Object.values(data.errors).flat().join(' ') : 'Unable to place order. Please review your details and try again.');
                }
            } catch(e) {
                this.checkoutError = 'Network error during order placement. Please check your connection or contact support at info@research-chem.uk.';
            } finally {
                this.submitting = false;
            }
        }
     }">

    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- ══════════════ ORDER SUCCESS SCREEN ══════════════ -->
        <template x-if="orderRef">
            <div class="max-w-2xl mx-auto">
                <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">

                    <!-- Header -->
                    <div class="px-5 sm:px-8 pt-8 pb-6 text-center border-b border-slate-100">
                        <div class="w-14 h-14 rounded-full bg-emerald-50 text-emerald-600 ring-8 ring-emerald-50/60 flex items-center justify-center mx-auto mb-5">
                            <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                            </svg>
                        </div>
                        <p class="text-xs font-semibold uppercase tracking-wider text-emerald-700 mb-1.5">Order reserved &middot; Awaiting transfer</p>
                        <h1 class="text-2xl sm:text-3xl font-bold text-slate-900 tracking-tight" style="font-family: var(--font-heading);">
                            Thank you, your order is placed
                        </h1>
                        <p class="mt-2 text-sm text-slate-600 max-w-md mx-auto leading-relaxed">
                            Your items are reserved. Send the bank transfer below to start packing and Royal Mail dispatch.
                        </p>
                    </div>

                    <div class="p-5 sm:p-8 space-y-6">
                        <!-- Reference -->
                        <div class="rounded-xl bg-blue-50 border border-blue-200 p-4 sm:p-5 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                            <div class="min-w-0">
                                <p class="text-xs font-semibold text-blue-900">Payment reference</p>
                                <p class="text-xl sm:text-2xl font-mono font-bold text-blue-800 tracking-wider break-all" x-text="orderRef"></p>
                                <p class="text-xs text-blue-700/80 mt-0.5">Use this exact reference when you make the payment.</p>
                            </div>
                            <button type="button"
                                    @click="copyToClipboard(orderRef, 'ref')"
                                    class="w-full sm:w-auto shrink-0 inline-flex items-center justify-center gap-1.5 px-4 py-2.5 rounded-lg bg-blue-700 hover:bg-blue-800 text-white text-sm font-semibold transition-colors cursor-pointer">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><rect x="9" y="9" width="11" height="11" rx="2"/><path stroke-linecap="round" d="M5 15V5a2 2 0 012-2h10"/></svg>
                                <span x-text="copiedField === 'ref' ? 'Copied!' : 'Copy reference'"></span>
                            </button>
                        </div>

                        <!-- Bank details -->
                        <div>
                            <div class="flex items-center justify-between mb-3">
                                <h2 class="text-sm font-semibold text-slate-900">UK bank transfer details</h2>
                                <span class="text-xs text-slate-500">Faster Payments / BACS</span>
                            </div>
                            <dl class="rounded-xl border border-slate-200 divide-y divide-slate-100 text-sm">
                                <div class="flex items-center justify-between gap-3 px-4 py-3">
                                    <dt class="text-slate-500">Account name</dt>
                                    <dd class="flex items-center gap-2 min-w-0">
                                        <span class="font-semibold text-slate-900 truncate" x-text="bankDetails?.name || 'Paul Stromberg'">Paul Stromberg</span>
                                        <button type="button" @click="copyToClipboard(bankDetails?.name || 'Paul Stromberg', 'name')" class="shrink-0 text-xs font-semibold text-blue-700 hover:text-blue-900 px-2 py-1 rounded-md hover:bg-blue-50 cursor-pointer">
                                            <span x-text="copiedField === 'name' ? '✓' : 'Copy'"></span>
                                        </button>
                                    </dd>
                                </div>
                                <div class="flex items-center justify-between gap-3 px-4 py-3">
                                    <dt class="text-slate-500">Sort code</dt>
                                    <dd class="flex items-center gap-2">
                                        <span class="font-mono font-semibold text-slate-900" x-text="bankDetails?.sortCode || '30-96-91'">30-96-91</span>
                                        <button type="button" @click="copyToClipboard(bankDetails?.sortCode || '30-96-91', 'sortCode')" class="shrink-0 text-xs font-semibold text-blue-700 hover:text-blue-900 px-2 py-1 rounded-md hover:bg-blue-50 cursor-pointer">
                                            <span x-text="copiedField === 'sortCode' ? '✓' : 'Copy'"></span>
                                        </button>
                                    </dd>
                                </div>
                                <div class="flex items-center justify-between gap-3 px-4 py-3">
                                    <dt class="text-slate-500">Account number</dt>
                                    <dd class="flex items-center gap-2">
                                        <span class="font-mono font-semibold text-slate-900" x-text="bankDetails?.account || '13746563'">13746563</span>
                                        <button type="button" @click="copyToClipboard(bankDetails?.account || '13746563', 'account')" class="shrink-0 text-xs font-semibold text-blue-700 hover:text-blue-900 px-2 py-1 rounded-md hover:bg-blue-50 cursor-pointer">
                                            <span x-text="copiedField === 'account' ? '✓' : 'Copy'"></span>
                                        </button>
                                    </dd>
                                </div>
                                <div class="flex items-center justify-between gap-3 px-4 py-3 bg-slate-50/70 rounded-b-xl">
                                    <dt class="text-slate-500">Reference</dt>
                                    <dd class="font-mono font-bold text-blue-700 break-all text-right" x-text="orderRef"></dd>
                                </div>
                            </dl>
                        </div>

                        <!-- Next steps -->
                        <div class="flex items-start gap-3 rounded-xl bg-slate-50 border border-slate-200 p-4 text-sm text-slate-600 leading-relaxed">
                            <svg class="w-5 h-5 text-blue-700 shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path stroke-linecap="round" d="M12 16v-4m0-4h.01"/></svg>
                            <div>
                                <p class="font-semibold text-slate-900 mb-0.5">What happens next?</p>
                                <p>We reconcile bank payments throughout business hours. Once verified, your order is packed in discreet plain packaging with batch analytical documentation and shipped next working day via Royal Mail Tracked.</p>
                            </div>
                        </div>

                        <div class="flex flex-col sm:flex-row gap-3">
                            <a href="{{ route('home') }}" class="flex-1 inline-flex items-center justify-center px-5 py-3 rounded-lg text-sm font-semibold bg-blue-700 text-white hover:bg-blue-800 transition-colors">
                                Continue shopping
                            </a>
                            <a href="{{ route('compliance') }}" class="flex-1 inline-flex items-center justify-center px-5 py-3 rounded-lg text-sm font-semibold bg-white text-slate-700 border border-slate-300 hover:bg-slate-50 transition-colors">
                                Compliance policy
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </template>

        <!-- ══════════════ MAIN CART & CHECKOUT ══════════════ -->
        <template x-if="!orderRef">
            <div>
                <!-- Page header -->
                <div class="mb-6 sm:mb-8">
                    <nav aria-label="Breadcrumb" class="flex items-center gap-2 text-xs text-slate-500 mb-2">
                        <a href="{{ route('home') }}" class="hover:text-blue-700 transition-colors">Home</a>
                        <svg class="w-3 h-3 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                        <span class="text-slate-700 font-medium">Cart &amp; Checkout</span>
                    </nav>
                    <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-4">
                        <h1 class="text-2xl sm:text-3xl font-bold text-slate-900 tracking-tight" style="font-family: var(--font-heading);">
                            Cart &amp; Checkout
                        </h1>

                        <!-- Steps -->
                        <ol class="flex items-center gap-2 sm:gap-3 text-xs font-medium text-slate-500">
                            <li class="flex items-center gap-1.5 text-blue-700">
                                <span class="w-5 h-5 rounded-full bg-blue-700 text-white text-[11px] font-semibold flex items-center justify-center">1</span>
                                <span>Review</span>
                            </li>
                            <li class="w-5 sm:w-8 h-px bg-slate-300" aria-hidden="true"></li>
                            <li class="flex items-center gap-1.5">
                                <span class="w-5 h-5 rounded-full border border-slate-300 bg-white text-[11px] font-semibold flex items-center justify-center">2</span>
                                <span>Delivery</span>
                            </li>
                            <li class="w-5 sm:w-8 h-px bg-slate-300" aria-hidden="true"></li>
                            <li class="flex items-center gap-1.5">
                                <span class="w-5 h-5 rounded-full border border-slate-300 bg-white text-[11px] font-semibold flex items-center justify-center">3</span>
                                <span>Payment</span>
                            </li>
                        </ol>
                    </div>
                </div>

                <!-- ── Empty cart ── -->
                <template x-if="$store.cart.items.length === 0">
                    <div class="bg-white rounded-2xl border border-slate-200 px-5 py-12 sm:p-16 text-center shadow-sm max-w-xl mx-auto">
                        <div class="w-16 h-16 rounded-full bg-slate-100 text-slate-500 flex items-center justify-center mx-auto mb-5">
                            <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.75">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                            </svg>
                        </div>
                        <h2 class="text-xl sm:text-2xl font-bold text-slate-900 mb-2" style="font-family: var(--font-heading);">
                            Your cart is empty
                        </h2>
                        <p class="text-sm text-slate-500 mb-8 max-w-sm mx-auto leading-relaxed">
                            You haven't added any research compounds or pen kits yet. Browse the catalogue to start your order.
                        </p>
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                            <a href="{{ route('peptides') }}" class="px-4 py-3 rounded-lg text-sm font-semibold bg-blue-700 text-white hover:bg-blue-800 transition-colors">
                                Peptide Vials
                            </a>
                            <a href="{{ route('sarms') }}" class="px-4 py-3 rounded-lg text-sm font-semibold bg-white text-slate-700 border border-slate-300 hover:bg-slate-50 transition-colors">
                                SARMs
                            </a>
                            <a href="{{ route('pen-kits') }}" class="px-4 py-3 rounded-lg text-sm font-semibold bg-white text-slate-700 border border-slate-300 hover:bg-slate-50 transition-colors">
                                Pen Kits
                            </a>
                        </div>
                    </div>
                </template>

                <!-- ── Active cart ── -->
                <template x-if="$store.cart.items.length > 0">
                    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 lg:gap-8 items-start">

                        <!-- ── Left column ── -->
                        <div class="lg:col-span-7 space-y-6 min-w-0">

                            <!-- Items -->
                            <section class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden" aria-labelledby="cart-items-heading">
                                <div class="px-4 sm:px-6 py-4 border-b border-slate-100 flex items-center justify-between">
                                    <h2 id="cart-items-heading" class="text-base font-semibold text-slate-900">Your items</h2>
                                    <span class="text-xs font-medium text-slate-500"
                                          x-text="$store.cart.count() + ($store.cart.count() === 1 ? ' item' : ' items')"></span>
                                </div>

                                <ul class="divide-y divide-slate-100">
                                    <template x-for="item in $store.cart.items" :key="item.id">
                                        <li class="p-4 sm:p-6 flex gap-3 sm:gap-5">
                                            <!-- Thumbnail -->
                                            <div class="w-16 h-16 sm:w-24 sm:h-24 rounded-lg bg-white border border-slate-200 p-1.5 shrink-0 flex items-center justify-center">
                                                <img :src="item.image || '{{ asset('og-image.png') }}'"
                                                     :alt="item.name"
                                                     class="w-full h-full object-contain">
                                            </div>

                                            <div class="flex-1 min-w-0 flex flex-col">
                                                <div class="flex items-start justify-between gap-3">
                                                    <div class="min-w-0">
                                                        <h3 class="text-sm sm:text-base font-semibold text-slate-900 leading-snug line-clamp-2 break-words"
                                                            x-text="item.name"></h3>
                                                        <div class="mt-1 flex flex-wrap items-center gap-x-2 gap-y-1">
                                                            <span class="text-xs sm:text-sm text-slate-500" x-text="$store.cart.formatMoney(item.price) + ' each'"></span>
                                                            <span class="inline-flex items-center gap-1 text-[11px] font-medium text-emerald-700">
                                                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                                                In stock
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <p class="shrink-0 text-sm sm:text-base font-semibold text-slate-900 tabular-nums"
                                                       x-text="$store.cart.formatMoney(item.price * (item.quantity || 1))"></p>
                                                </div>

                                                <div class="mt-3 sm:mt-auto sm:pt-4 flex items-center justify-between gap-3">
                                                    <!-- Quantity -->
                                                    <div class="inline-flex items-center rounded-lg border border-slate-300 bg-white overflow-hidden">
                                                        <button type="button"
                                                                @click="$store.cart.updateQuantity(item.id, (item.quantity || 1) - 1)"
                                                                aria-label="Decrease quantity"
                                                                class="w-9 h-9 flex items-center justify-center text-slate-600 hover:bg-slate-50 hover:text-blue-700 transition-colors cursor-pointer">
                                                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" d="M5 12h14"/></svg>
                                                        </button>
                                                        <span class="w-10 h-9 flex items-center justify-center text-sm font-semibold text-slate-900 border-x border-slate-200 tabular-nums"
                                                              aria-live="polite"
                                                              x-text="item.quantity || 1"></span>
                                                        <button type="button"
                                                                @click="$store.cart.updateQuantity(item.id, (item.quantity || 1) + 1)"
                                                                aria-label="Increase quantity"
                                                                class="w-9 h-9 flex items-center justify-center text-slate-600 hover:bg-slate-50 hover:text-blue-700 transition-colors cursor-pointer">
                                                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" d="M12 5v14M5 12h14"/></svg>
                                                        </button>
                                                    </div>

                                                    <!-- Remove -->
                                                    <button type="button"
                                                            @click="$store.cart.removeFromCart(item.id)"
                                                            class="inline-flex items-center gap-1.5 text-sm text-slate-500 hover:text-rose-600 font-medium transition-colors py-2 px-2 -mr-2 rounded-md hover:bg-rose-50 cursor-pointer">
                                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                        </svg>
                                                        <span class="hidden min-[360px]:inline">Remove</span>
                                                    </button>
                                                </div>
                                            </div>
                                        </li>
                                    </template>
                                </ul>
                            </section>

                            <!-- Volume discounts -->
                            <section class="rounded-2xl border border-blue-100 bg-blue-50/60 p-4 sm:p-5">
                                <div class="flex items-center gap-2 mb-3">
                                    <svg class="w-4 h-4 text-blue-700 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M7 7h.01M7 3h5a2 2 0 011.41.59l7 7a2 2 0 010 2.82l-7 7a2 2 0 01-2.82 0l-7-7A2 2 0 013 12V7a4 4 0 014-4z"/></svg>
                                    <h2 class="text-sm font-semibold text-blue-950">Volume discounts are applied automatically</h2>
                                </div>
                                <div class="grid grid-cols-1 sm:grid-cols-3 gap-2.5 text-sm">
                                    <div class="bg-white rounded-xl border border-blue-100 p-3">
                                        <p class="font-semibold text-slate-900">Peptide vials</p>
                                        <p class="text-xs text-slate-500 mt-1">5+ vials: <strong class="text-emerald-700">10% off</strong></p>
                                        <p class="text-xs text-slate-500">10+ vials: <strong class="text-emerald-700">20% off</strong></p>
                                    </div>
                                    <div class="bg-white rounded-xl border border-blue-100 p-3">
                                        <p class="font-semibold text-slate-900">Liquid SARMs</p>
                                        <p class="text-xs text-slate-500 mt-1">3+ bottles: <strong class="text-emerald-700">10% off</strong></p>
                                        <p class="text-xs text-slate-500">6+ bottles: <strong class="text-emerald-700">20% off</strong></p>
                                    </div>
                                    <div class="bg-white rounded-xl border border-blue-100 p-3">
                                        <p class="font-semibold text-slate-900">UK delivery</p>
                                        <p class="text-xs text-slate-500 mt-1">Orders over £50: <strong class="text-emerald-700">FREE</strong></p>
                                        <p class="text-xs text-slate-500">Royal Mail Tracked: <strong class="text-slate-700">£6.50</strong></p>
                                    </div>
                                </div>
                            </section>

                            <!-- Delivery details -->
                            <section class="bg-white rounded-2xl border border-slate-200 shadow-sm" aria-labelledby="delivery-heading">
                                <div class="px-4 sm:px-6 py-4 border-b border-slate-100 flex flex-wrap items-start justify-between gap-2">
                                    <div>
                                        <h2 id="delivery-heading" class="text-base font-semibold text-slate-900">Delivery &amp; contact details</h2>
                                        <p class="text-xs sm:text-sm text-slate-500 mt-0.5">Shipped next working day via Royal Mail Tracked in plain, discreet packaging.</p>
                                    </div>
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium bg-emerald-50 text-emerald-700 border border-emerald-200">
                                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><rect x="4" y="11" width="16" height="10" rx="2"/><path stroke-linecap="round" d="M8 11V7a4 4 0 018 0v4"/></svg>
                                        Discreet packaging
                                    </span>
                                </div>

                                <div class="p-4 sm:p-6 space-y-4">
                                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                        <div>
                                            <label for="co-name" class="block text-sm font-medium text-slate-700 mb-1.5">
                                                Full name <span class="text-rose-500">*</span>
                                            </label>
                                            <input id="co-name" type="text" autocomplete="name"
                                                   x-model="name"
                                                   required
                                                   class="w-full rounded-lg border border-slate-300 bg-white px-3.5 py-2.5 text-base sm:text-sm text-slate-900 placeholder:text-slate-400 shadow-xs transition focus:outline-none focus:ring-4 focus:ring-blue-600/15 focus:border-blue-600"
                                                   placeholder="Dr. / Researcher name">
                                        </div>
                                        <div>
                                            <label for="co-email" class="block text-sm font-medium text-slate-700 mb-1.5">
                                                Email address <span class="text-rose-500">*</span>
                                            </label>
                                            <input id="co-email" type="email" autocomplete="email" inputmode="email"
                                                   x-model="email"
                                                   required
                                                   class="w-full rounded-lg border border-slate-300 bg-white px-3.5 py-2.5 text-base sm:text-sm text-slate-900 placeholder:text-slate-400 shadow-xs transition focus:outline-none focus:ring-4 focus:ring-blue-600/15 focus:border-blue-600"
                                                   placeholder="researcher@laboratory.co.uk">
                                        </div>
                                    </div>

                                    <div>
                                        <label for="co-address1" class="block text-sm font-medium text-slate-700 mb-1.5">
                                            Address line 1 <span class="text-rose-500">*</span>
                                        </label>
                                        <input id="co-address1" type="text" autocomplete="address-line1"
                                               x-model="address1"
                                               required
                                               class="w-full rounded-lg border border-slate-300 bg-white px-3.5 py-2.5 text-base sm:text-sm text-slate-900 placeholder:text-slate-400 shadow-xs transition focus:outline-none focus:ring-4 focus:ring-blue-600/15 focus:border-blue-600"
                                               placeholder="Building, street address or laboratory unit">
                                    </div>

                                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                        <div>
                                            <label for="co-city" class="block text-sm font-medium text-slate-700 mb-1.5">
                                                Town / City <span class="text-rose-500">*</span>
                                            </label>
                                            <input id="co-city" type="text" autocomplete="address-level2"
                                                   x-model="city"
                                                   required
                                                   class="w-full rounded-lg border border-slate-300 bg-white px-3.5 py-2.5 text-base sm:text-sm text-slate-900 placeholder:text-slate-400 shadow-xs transition focus:outline-none focus:ring-4 focus:ring-blue-600/15 focus:border-blue-600"
                                                   placeholder="London">
                                        </div>
                                        <div>
                                            <label for="co-postcode" class="block text-sm font-medium text-slate-700 mb-1.5">
                                                UK postcode <span class="text-rose-500">*</span>
                                            </label>
                                            <input id="co-postcode" type="text" autocomplete="postal-code"
                                                   x-model="postcode"
                                                   required
                                                   class="w-full rounded-lg border border-slate-300 bg-white px-3.5 py-2.5 text-base sm:text-sm text-slate-900 uppercase placeholder:normal-case placeholder:text-slate-400 shadow-xs transition focus:outline-none focus:ring-4 focus:ring-blue-600/15 focus:border-blue-600"
                                                   placeholder="SW1A 1AA">
                                        </div>
                                    </div>

                                    <div>
                                        <label for="co-notes" class="block text-sm font-medium text-slate-700 mb-1.5">
                                            Delivery instructions / order notes <span class="text-slate-400 font-normal">(optional)</span>
                                        </label>
                                        <textarea id="co-notes" x-model="comments"
                                                  rows="3"
                                                  class="w-full rounded-lg border border-slate-300 bg-white px-3.5 py-2.5 text-base sm:text-sm text-slate-900 placeholder:text-slate-400 shadow-xs transition focus:outline-none focus:ring-4 focus:ring-blue-600/15 focus:border-blue-600 resize-y"
                                                  placeholder="E.g. leave in secure parcel drop, reception hours, internal PO reference"></textarea>
                                    </div>
                                </div>
                            </section>
                        </div>

                        <!-- ── Right column: order summary ── -->
                        <aside class="lg:col-span-5 lg:sticky lg:top-28 min-w-0" aria-labelledby="summary-heading">
                            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm">
                                <div class="px-4 sm:px-6 py-4 border-b border-slate-100 flex items-center justify-between">
                                    <h2 id="summary-heading" class="text-base font-semibold text-slate-900">Order summary</h2>
                                    <span class="text-xs font-medium text-slate-500"
                                          x-text="$store.cart.count() + ($store.cart.count() === 1 ? ' item' : ' items')"></span>
                                </div>

                                <div class="p-4 sm:p-6 space-y-5">
                                    <dl class="space-y-3 text-sm">
                                        <div class="flex justify-between gap-3">
                                            <dt class="text-slate-600">Subtotal</dt>
                                            <dd class="font-medium text-slate-900 tabular-nums" x-text="$store.cart.formatMoney($store.cart.subtotal())"></dd>
                                        </div>

                                        <template x-if="$store.cart.vialDiscount() > 0">
                                            <div class="flex justify-between gap-3 text-emerald-700">
                                                <dt x-text="'Peptides discount (' + $store.cart.vialPct() + '% off)'"></dt>
                                                <dd class="font-medium tabular-nums" x-text="'-' + $store.cart.formatMoney($store.cart.vialDiscount())"></dd>
                                            </div>
                                        </template>

                                        <template x-if="$store.cart.sarmsDiscount() > 0">
                                            <div class="flex justify-between gap-3 text-emerald-700">
                                                <dt x-text="'SARMs discount (' + $store.cart.sarmsPct() + '% off)'"></dt>
                                                <dd class="font-medium tabular-nums" x-text="'-' + $store.cart.formatMoney($store.cart.sarmsDiscount())"></dd>
                                            </div>
                                        </template>

                                        <div class="flex justify-between gap-3">
                                            <dt class="text-slate-600">
                                                Royal Mail Tracked
                                                <span class="block text-xs text-slate-400">Shipped next working day</span>
                                            </dt>
                                            <dd class="font-medium tabular-nums text-right"
                                                :class="$store.cart.shippingFee() === 0 ? 'text-emerald-700' : 'text-slate-900'"
                                                x-text="$store.cart.shippingFee() === 0 ? 'FREE (Over £50)' : $store.cart.formatMoney($store.cart.shippingFee())"></dd>
                                        </div>

                                        <div class="pt-4 border-t border-slate-200 flex justify-between items-baseline gap-3">
                                            <dt>
                                                <span class="text-base font-semibold text-slate-900">Total</span>
                                                <span class="block text-xs text-slate-400">Includes batch analytical documentation</span>
                                            </dt>
                                            <dd class="text-2xl font-bold text-slate-900 tabular-nums tracking-tight"
                                                x-text="$store.cart.formatMoney($store.cart.finalTotal())"></dd>
                                        </div>
                                    </dl>

                                    <!-- Error -->
                                    <template x-if="checkoutError">
                                        <div role="alert" class="p-3.5 rounded-lg bg-rose-50 border border-rose-200 text-rose-800 text-sm flex items-start gap-2.5">
                                            <svg class="w-4 h-4 text-rose-600 shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                            </svg>
                                            <span x-text="checkoutError"></span>
                                        </div>
                                    </template>

                                    <!-- Place order -->
                                    <button type="button"
                                            @click="placeOrder()"
                                            :disabled="submitting"
                                            class="w-full py-3.5 px-5 rounded-lg font-semibold text-white bg-blue-700 hover:bg-blue-800 disabled:opacity-60 disabled:cursor-not-allowed transition-colors shadow-sm flex items-center justify-center gap-2 cursor-pointer text-sm sm:text-base">
                                        <template x-if="!submitting">
                                            <span class="flex items-center gap-2">
                                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                                </svg>
                                                <span>Place order &middot; Bank transfer</span>
                                            </span>
                                        </template>
                                        <template x-if="submitting">
                                            <span class="flex items-center gap-2">
                                                <svg class="animate-spin h-4 w-4 text-white" fill="none" viewBox="0 0 24 24">
                                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path>
                                                </svg>
                                                <span>Placing your order&hellip;</span>
                                            </span>
                                        </template>
                                    </button>

                                    <p class="text-xs text-center text-slate-500">
                                        You'll receive bank transfer details on the next screen.
                                    </p>

                                    <!-- Trust signals -->
                                    <ul class="pt-4 border-t border-slate-100 space-y-2.5 text-xs text-slate-600">
                                        <li class="flex items-start gap-2">
                                            <svg class="w-4 h-4 text-blue-700 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                            </svg>
                                            <span>Confidential invoicing &amp; bank transfer payment</span>
                                        </li>
                                        <li class="flex items-start gap-2">
                                            <svg class="w-4 h-4 text-blue-700 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" />
                                            </svg>
                                            <span>Vacuum-sealed, discreet parcel packaging</span>
                                        </li>
                                        <li class="flex items-start gap-2">
                                            <svg class="w-4 h-4 text-blue-700 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                            </svg>
                                            <span>Certificate of Analysis (COA) provided with every batch</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </aside>

                    </div>
                </template>
            </div>
        </template>

    </div>
</div>
@endsection
