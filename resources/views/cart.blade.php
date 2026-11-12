@extends('layouts.app')

@section('title', 'Your Research Order — Shopping Cart & Checkout | ResearchChem.uk')
@section('meta_description', 'Review your selected laboratory research compounds, multi-buy volume discounts, and UK delivery details before confirming your order.')

@section('content')
<div class="bg-[#f8fafc] min-h-[85vh] py-8 lg:py-12"
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

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- ── ORDER SUCCESS SCREEN ── -->
        <template x-if="orderRef">
            <div class="max-w-2xl mx-auto bg-white rounded-2xl shadow-xl border border-slate-200/90 p-6 sm:p-10 my-4 text-center">
                <div class="w-16 h-16 rounded-full bg-emerald-50 text-emerald-600 flex items-center justify-center mx-auto mb-5 border border-emerald-200">
                    <svg class="w-9 h-9" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                    </svg>
                </div>

                <span class="inline-block px-3 py-1 rounded-full text-xs font-mono font-bold uppercase tracking-wider bg-emerald-100 text-emerald-800 mb-2">
                    Order Reserved &middot; Awaiting Transfer
                </span>

                <h1 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight mb-2" style="font-family: var(--font-heading);">
                    Order Placed Successfully
                </h1>
                <p class="text-sm text-slate-600 mb-6 font-sans">
                    Your research compounds have been reserved. Please submit the bank transfer payment below to initiate laboratory packing and Royal Mail dispatch.
                </p>

                <!-- Order Reference Highlight -->
                <div class="p-5 rounded-xl bg-blue-50/80 border border-blue-200 mb-6 text-left flex flex-col sm:flex-row items-start sm:items-center justify-between gap-3">
                    <div>
                        <p class="text-[11px] font-bold uppercase tracking-wider text-blue-900 mb-0.5">Your Payment Reference Number</p>
                        <p class="text-2xl font-mono font-black text-blue-800 tracking-wider" x-text="orderRef"></p>
                        <p class="text-[11px] text-blue-700 mt-0.5">Please quote this exact reference in your bank payment reference.</p>
                    </div>
                    <button type="button"
                            @click="copyToClipboard(orderRef, 'ref')"
                            class="px-4 py-2 rounded-lg bg-blue-700 hover:bg-blue-800 text-white text-xs font-bold font-sans transition-colors shrink-0 flex items-center gap-1.5 shadow-xs">
                        <span x-text="copiedField === 'ref' ? 'Copied!' : 'Copy Reference'"></span>
                    </button>
                </div>

                <!-- Bank Transfer Account Box -->
                <div class="bg-slate-50 rounded-xl border border-slate-200 p-5 sm:p-6 text-left mb-6 space-y-3.5 text-sm">
                    <div class="flex items-center justify-between border-b border-slate-200 pb-2.5">
                        <h3 class="font-extrabold text-slate-900 uppercase text-xs tracking-wider flex items-center gap-2">
                            <span>UK Bank Transfer Details</span>
                        </h3>
                        <span class="text-[11px] font-semibold text-slate-500">Faster Payments / BACS</span>
                    </div>

                    <div class="flex items-center justify-between py-1 border-b border-slate-100">
                        <span class="text-slate-500 text-xs font-medium">Account Name:</span>
                        <div class="flex items-center gap-2">
                            <span class="font-bold text-slate-900 font-sans" x-text="bankDetails?.name || 'Paul Stromberg'">Paul Stromberg</span>
                            <button type="button" @click="copyToClipboard(bankDetails?.name || 'Paul Stromberg', 'name')" class="text-blue-700 hover:text-blue-900 text-xs font-bold">
                                <span x-text="copiedField === 'name' ? '✓' : 'Copy'"></span>
                            </button>
                        </div>
                    </div>

                    <div class="flex items-center justify-between py-1 border-b border-slate-100">
                        <span class="text-slate-500 text-xs font-medium">Sort Code:</span>
                        <div class="flex items-center gap-2">
                            <span class="font-mono font-bold text-slate-900" x-text="bankDetails?.sortCode || '30-96-91'">30-96-91</span>
                            <button type="button" @click="copyToClipboard(bankDetails?.sortCode || '30-96-91', 'sortCode')" class="text-blue-700 hover:text-blue-900 text-xs font-bold">
                                <span x-text="copiedField === 'sortCode' ? '✓' : 'Copy'"></span>
                            </button>
                        </div>
                    </div>

                    <div class="flex items-center justify-between py-1 border-b border-slate-100">
                        <span class="text-slate-500 text-xs font-medium">Account Number:</span>
                        <div class="flex items-center gap-2">
                            <span class="font-mono font-bold text-slate-900" x-text="bankDetails?.account || '13746563'">13746563</span>
                            <button type="button" @click="copyToClipboard(bankDetails?.account || '13746563', 'account')" class="text-blue-700 hover:text-blue-900 text-xs font-bold">
                                <span x-text="copiedField === 'account' ? '✓' : 'Copy'"></span>
                            </button>
                        </div>
                    </div>

                    <div class="flex items-center justify-between py-1">
                        <span class="text-slate-500 text-xs font-medium">Payment Reference:</span>
                        <span class="font-mono font-extrabold text-blue-700" x-text="orderRef"></span>
                    </div>
                </div>

                <!-- Next steps instruction -->
                <div class="p-4 rounded-xl bg-slate-50 border border-slate-200 text-left text-xs text-slate-600 mb-6 leading-relaxed flex items-start gap-3">
                    <div class="w-6 h-6 rounded-full bg-blue-100 text-blue-700 flex items-center justify-center shrink-0 mt-0.5 font-bold text-[11px]">i</div>
                    <div>
                        <p class="font-bold text-slate-900 mb-0.5">What happens next?</p>
                        <p>We reconcile bank payments throughout business hours. Once verified, your order is hermetically packed in discreet plain packaging with batch analytical documentation and shipped next working day via Royal Mail Tracked delivery.</p>
                    </div>
                </div>

                <div class="flex flex-col sm:flex-row items-center justify-center gap-3">
                    <a href="{{ route('home') }}" class="w-full sm:w-auto px-6 py-3 rounded-lg text-xs font-bold uppercase tracking-wider bg-blue-700 text-white hover:bg-blue-800 transition-colors shadow-xs">
                        Return to Catalog &rarr;
                    </a>
                    <a href="{{ route('compliance') }}" class="w-full sm:w-auto px-6 py-3 rounded-lg text-xs font-bold uppercase tracking-wider bg-white text-slate-700 border border-slate-300 hover:bg-slate-50 transition-colors">
                        Laboratory Compliance Policy
                    </a>
                </div>
            </div>
        </template>

        <!-- ── MAIN CART & CHECKOUT ── -->
        <template x-if="!orderRef">
            <div>
                <!-- ── Breadcrumb & Clean Header ── -->
                <div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 pb-5 border-b border-slate-200">
                    <div>
                        <div class="flex items-center gap-2 text-xs font-medium text-slate-500 mb-1">
                            <a href="{{ route('home') }}" class="hover:text-blue-700 transition-colors">Home</a>
                            <span class="text-slate-300">/</span>
                            <span class="text-slate-700 font-semibold">Shopping Cart &amp; Checkout</span>
                        </div>
                        <h1 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight" style="font-family: var(--font-heading);">
                            Laboratory Research Order
                        </h1>
                    </div>

                    <!-- Step badges -->
                    <div class="flex items-center gap-1.5 text-xs font-semibold text-slate-500 bg-white border border-slate-200 rounded-lg p-1.5 shadow-2xs">
                        <span class="px-2.5 py-1 rounded-md bg-blue-700 text-white font-bold flex items-center gap-1.5">
                            <span class="w-4 h-4 rounded-full bg-white/20 text-[10px] flex items-center justify-center font-mono">1</span>
                            <span>Review Items</span>
                        </span>
                        <span class="text-slate-300 px-1">&rarr;</span>
                        <span class="px-2.5 py-1 rounded-md text-slate-600 flex items-center gap-1.5">
                            <span class="w-4 h-4 rounded-full bg-slate-200 text-[10px] flex items-center justify-center font-mono text-slate-700">2</span>
                            <span>UK Delivery</span>
                        </span>
                        <span class="text-slate-300 px-1">&rarr;</span>
                        <span class="px-2.5 py-1 rounded-md text-slate-600 flex items-center gap-1.5">
                            <span class="w-4 h-4 rounded-full bg-slate-200 text-[10px] flex items-center justify-center font-mono text-slate-700">3</span>
                            <span>Payment</span>
                        </span>
                    </div>
                </div>

                <!-- ── Empty Cart State ── -->
                <template x-if="$store.cart.items.length === 0">
                    <div class="bg-white rounded-2xl border border-slate-200 p-12 sm:p-16 text-center shadow-xs max-w-2xl mx-auto my-8">
                        <div class="w-20 h-20 rounded-2xl bg-blue-50 text-blue-700 flex items-center justify-center mx-auto mb-5 border border-blue-100 shadow-xs">
                            <svg class="w-10 h-10" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.75">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                            </svg>
                        </div>
                        <h2 class="text-2xl font-bold text-slate-900 mb-2" style="font-family: var(--font-heading);">
                            Your Cart is Currently Empty
                        </h2>
                        <p class="text-sm text-slate-500 mb-8 max-w-md mx-auto font-sans leading-relaxed">
                            No research compounds or pen kits selected yet. Explore our laboratory-tested catalog to begin your order.
                        </p>
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 max-w-md mx-auto">
                            <a href="{{ route('peptides') }}" class="px-4 py-3 rounded-lg text-xs font-bold uppercase tracking-wider bg-blue-700 text-white hover:bg-blue-800 transition-colors text-center shadow-xs">
                                Peptide Vials
                            </a>
                            <a href="{{ route('sarms') }}" class="px-4 py-3 rounded-lg text-xs font-bold uppercase tracking-wider bg-white text-slate-700 border border-slate-300 hover:bg-slate-50 transition-colors text-center">
                                SARMs Liquid
                            </a>
                            <a href="{{ route('pen-kits') }}" class="px-4 py-3 rounded-lg text-xs font-bold uppercase tracking-wider bg-white text-slate-700 border border-slate-300 hover:bg-slate-50 transition-colors text-center">
                                Pen Kits
                            </a>
                        </div>
                    </div>
                </template>

                <!-- ── Active Cart Layout (2 Columns) ── -->
                <template x-if="$store.cart.items.length > 0">
                    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">

                        <!-- ── Left Column: Items List & Delivery Form (7 cols) ── -->
                        <div class="lg:col-span-7 space-y-6">

                            <!-- Items Card -->
                            <div class="bg-white rounded-2xl border border-slate-200/90 shadow-xs overflow-hidden">
                                <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between bg-slate-50/60">
                                    <div class="flex items-center gap-2.5">
                                        <span class="w-2.5 h-2.5 rounded-full bg-blue-700"></span>
                                        <h2 class="text-sm font-extrabold uppercase tracking-wider text-slate-900 font-sans">
                                            Selected Compounds
                                        </h2>
                                    </div>
                                    <span class="text-xs font-mono font-bold text-slate-500 bg-white px-2.5 py-0.5 rounded-full border border-slate-200"
                                          x-text="$store.cart.count() + ($store.cart.count() === 1 ? ' item' : ' items')"></span>
                                </div>

                                <div class="divide-y divide-slate-100">
                                    <template x-for="item in $store.cart.items" :key="item.id">
                                        <div class="p-5 sm:p-6 flex items-center gap-4 sm:gap-6 hover:bg-slate-50/40 transition-colors">
                                            <!-- Product Thumbnail -->
                                            <div class="w-20 h-20 sm:w-24 sm:h-24 rounded-xl bg-white border border-slate-200/80 p-2 shrink-0 flex items-center justify-center shadow-xs">
                                                <img :src="item.image || '{{ asset('og-image.png') }}'"
                                                     :alt="item.name"
                                                     class="w-full h-full object-contain">
                                            </div>

                                            <!-- Info & Stepper -->
                                            <div class="flex-1 min-w-0">
                                                <div class="flex items-start justify-between gap-3">
                                                    <div>
                                                        <h3 class="text-sm sm:text-base font-bold text-slate-900 leading-snug line-clamp-2"
                                                            style="font-family: var(--font-heading);"
                                                            x-text="item.name"></h3>
                                                        <div class="flex items-center gap-2 mt-1">
                                                            <span class="text-xs font-mono font-bold text-blue-700" x-text="$store.cart.formatMoney(item.price) + ' each'"></span>
                                                            <span class="text-[10px] font-mono px-1.5 py-0.5 rounded-xs bg-slate-100 text-slate-600 uppercase font-semibold">
                                                                In Stock
                                                            </span>
                                                        </div>
                                                    </div>

                                                    <!-- Line Item Subtotal -->
                                                    <div class="text-right shrink-0">
                                                        <p class="text-base sm:text-lg font-black text-slate-900 font-mono tracking-tight"
                                                           x-text="$store.cart.formatMoney(item.price * (item.quantity || 1))"></p>
                                                    </div>
                                                </div>

                                                <!-- Controls row -->
                                                <div class="flex items-center justify-between gap-3 mt-4 pt-3 border-t border-slate-100">
                                                    <!-- Stepper Pill -->
                                                    <div class="inline-flex items-center rounded-lg border border-slate-300 bg-slate-50/80 overflow-hidden shadow-2xs">
                                                        <button type="button"
                                                                @click="$store.cart.updateQuantity(item.id, (item.quantity || 1) - 1)"
                                                                aria-label="Decrease quantity"
                                                                class="w-8 h-8 flex items-center justify-center text-slate-600 hover:text-blue-700 hover:bg-white transition-colors font-bold text-base cursor-pointer">
                                                            &minus;
                                                        </button>
                                                        <span class="w-10 text-center text-xs font-mono font-bold text-slate-900 bg-white h-8 flex items-center justify-center border-x border-slate-200"
                                                              x-text="item.quantity || 1"></span>
                                                        <button type="button"
                                                                @click="$store.cart.updateQuantity(item.id, (item.quantity || 1) + 1)"
                                                                aria-label="Increase quantity"
                                                                class="w-8 h-8 flex items-center justify-center text-slate-600 hover:text-blue-700 hover:bg-white transition-colors font-bold text-base cursor-pointer">
                                                            &plus;
                                                        </button>
                                                    </div>

                                                    <!-- Remove button -->
                                                    <button type="button"
                                                            @click="$store.cart.removeFromCart(item.id)"
                                                            class="inline-flex items-center gap-1.5 text-xs text-slate-400 hover:text-rose-600 font-semibold transition-colors py-1 px-2 rounded-md hover:bg-rose-50 cursor-pointer">
                                                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                        </svg>
                                                        <span>Remove</span>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </template>
                                </div>
                            </div>

                            <!-- ── Multi-Buy Volume Discounts Info Banner ── -->
                            <div class="bg-gradient-to-br from-blue-50/70 to-indigo-50/50 rounded-2xl border border-blue-200/90 p-5 shadow-2xs">
                                <div class="flex items-center gap-2 mb-3">
                                    <div class="w-6 h-6 rounded-full bg-blue-700 text-white flex items-center justify-center text-xs font-bold shrink-0">
                                        %
                                    </div>
                                    <h3 class="text-xs font-bold uppercase tracking-wider text-blue-900 font-sans">
                                        Automatic Volume Discounts Applied at Checkout
                                    </h3>
                                </div>

                                <div class="grid grid-cols-1 sm:grid-cols-3 gap-2.5 text-xs">
                                    <div class="bg-white/90 rounded-xl p-3 border border-blue-200/60 flex flex-col justify-between">
                                        <div class="font-bold text-slate-800">Peptide Vials</div>
                                        <div class="text-[11px] text-slate-500 mt-1">5+ vials = <strong class="text-emerald-700">10% off</strong></div>
                                        <div class="text-[11px] text-slate-500">10+ vials = <strong class="text-emerald-700">20% off</strong></div>
                                    </div>
                                    <div class="bg-white/90 rounded-xl p-3 border border-blue-200/60 flex flex-col justify-between">
                                        <div class="font-bold text-slate-800">Liquid SARMs</div>
                                        <div class="text-[11px] text-slate-500 mt-1">3+ bottles = <strong class="text-emerald-700">10% off</strong></div>
                                        <div class="text-[11px] text-slate-500">6+ bottles = <strong class="text-emerald-700">20% off</strong></div>
                                    </div>
                                    <div class="bg-white/90 rounded-xl p-3 border border-blue-200/60 flex flex-col justify-between">
                                        <div class="font-bold text-slate-800">UK Delivery</div>
                                        <div class="text-[11px] text-slate-500 mt-1">Orders over £50 = <strong class="text-emerald-700">FREE</strong></div>
                                        <div class="text-[11px] text-slate-500">Standard Royal Mail: <strong>£6.50</strong></div>
                                    </div>
                                </div>
                            </div>

                            <!-- ── Delivery Details Form ── -->
                            <div class="bg-white rounded-2xl border border-slate-200/90 p-6 sm:p-8 shadow-xs">
                                <div class="flex items-start justify-between border-b border-slate-100 pb-4 mb-6">
                                    <div>
                                        <div class="flex items-center gap-2">
                                            <span class="w-2.5 h-2.5 rounded-full bg-blue-700"></span>
                                            <h2 class="text-base sm:text-lg font-bold text-slate-900 tracking-tight" style="font-family: var(--font-heading);">
                                                UK Delivery &amp; Contact Details
                                            </h2>
                                        </div>
                                        <p class="text-xs text-slate-500 mt-1 font-sans">
                                            Orders are shipped next working day via Royal Mail Tracked in plain, discreet laboratory packaging.
                                        </p>
                                    </div>
                                    <span class="hidden sm:inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md text-[11px] font-semibold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                        🔒 Discreet Packaging
                                    </span>
                                </div>

                                <div class="space-y-4">
                                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                        <div>
                                            <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5 font-sans">
                                                Full Name <span class="text-rose-500">*</span>
                                            </label>
                                            <input type="text"
                                                   x-model="name"
                                                   required
                                                   class="w-full px-3.5 py-2.5 rounded-lg border border-slate-300 text-xs text-slate-900 placeholder:text-slate-400 focus:ring-2 focus:ring-blue-600/20 focus:border-blue-600 outline-none transition-all"
                                                   placeholder="Dr. / Researcher Name">
                                        </div>
                                        <div>
                                            <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5 font-sans">
                                                Email Address <span class="text-rose-500">*</span>
                                            </label>
                                            <input type="email"
                                                   x-model="email"
                                                   required
                                                   class="w-full px-3.5 py-2.5 rounded-lg border border-slate-300 text-xs text-slate-900 placeholder:text-slate-400 focus:ring-2 focus:ring-blue-600/20 focus:border-blue-600 outline-none transition-all"
                                                   placeholder="researcher@laboratory.co.uk">
                                        </div>
                                    </div>

                                    <div>
                                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5 font-sans">
                                            Address Line 1 <span class="text-rose-500">*</span>
                                        </label>
                                        <input type="text"
                                               x-model="address1"
                                               required
                                               class="w-full px-3.5 py-2.5 rounded-lg border border-slate-300 text-xs text-slate-900 placeholder:text-slate-400 focus:ring-2 focus:ring-blue-600/20 focus:border-blue-600 outline-none transition-all"
                                               placeholder="Building name, street address, or laboratory unit">
                                    </div>

                                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                        <div>
                                            <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5 font-sans">
                                                Town / City <span class="text-rose-500">*</span>
                                            </label>
                                            <input type="text"
                                                   x-model="city"
                                                   required
                                                   class="w-full px-3.5 py-2.5 rounded-lg border border-slate-300 text-xs text-slate-900 placeholder:text-slate-400 focus:ring-2 focus:ring-blue-600/20 focus:border-blue-600 outline-none transition-all"
                                                   placeholder="London, Manchester, Edinburgh...">
                                        </div>
                                        <div>
                                            <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5 font-sans">
                                                UK Postcode <span class="text-rose-500">*</span>
                                            </label>
                                            <input type="text"
                                                   x-model="postcode"
                                                   required
                                                   class="w-full px-3.5 py-2.5 rounded-lg border border-slate-300 text-xs text-slate-900 uppercase placeholder:text-slate-400 focus:ring-2 focus:ring-blue-600/20 focus:border-blue-600 outline-none transition-all font-mono"
                                                   placeholder="SW1A 1AA">
                                        </div>
                                    </div>

                                    <div>
                                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5 font-sans">
                                            Delivery Instructions / Purchase Notes (Optional)
                                        </label>
                                        <textarea x-model="comments"
                                                  rows="2"
                                                  class="w-full px-3.5 py-2.5 rounded-lg border border-slate-300 text-xs text-slate-900 placeholder:text-slate-400 focus:ring-2 focus:ring-blue-600/20 focus:border-blue-600 outline-none transition-all"
                                                  placeholder="E.g., Leave in secure parcel drop, reception delivery hours, internal PO reference..."></textarea>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <!-- ── Right Column: Order Summary Sidebar (5 cols sticky) ── -->
                        <div class="lg:col-span-5 sticky top-24">
                            <div class="bg-white rounded-2xl border border-slate-200/90 p-6 sm:p-7 shadow-sm space-y-6">

                                <div class="flex items-center justify-between pb-4 border-b border-slate-100">
                                    <h3 class="text-lg font-bold text-slate-900 tracking-tight" style="font-family: var(--font-heading);">
                                        Order Summary
                                    </h3>
                                    <span class="text-xs font-mono font-bold text-slate-500"
                                          x-text="$store.cart.count() + ($store.cart.count() === 1 ? ' item' : ' items')"></span>
                                </div>

                                <!-- Financial breakdown -->
                                <div class="space-y-3.5 text-sm">
                                    <div class="flex justify-between text-slate-600">
                                        <span class="font-medium">Subtotal</span>
                                        <span class="font-mono font-bold text-slate-900" x-text="$store.cart.formatMoney($store.cart.subtotal())"></span>
                                    </div>

                                    <!-- Peptides Multi-buy -->
                                    <template x-if="$store.cart.vialDiscount() > 0">
                                        <div class="flex items-center justify-between text-emerald-700 text-xs font-semibold py-1 px-2.5 rounded-lg bg-emerald-50 border border-emerald-200/60">
                                            <span class="flex items-center gap-1.5">
                                                <span>🏷</span>
                                                <span x-text="'Peptides Volume Discount (' + $store.cart.vialPct() + '% off)'"></span>
                                            </span>
                                            <span class="font-mono font-bold" x-text="'-' + $store.cart.formatMoney($store.cart.vialDiscount())"></span>
                                        </div>
                                    </template>

                                    <!-- SARMs Multi-buy -->
                                    <template x-if="$store.cart.sarmsDiscount() > 0">
                                        <div class="flex items-center justify-between text-emerald-700 text-xs font-semibold py-1 px-2.5 rounded-lg bg-emerald-50 border border-emerald-200/60">
                                            <span class="flex items-center gap-1.5">
                                                <span>🏷</span>
                                                <span x-text="'SARMs Volume Discount (' + $store.cart.sarmsPct() + '% off)'"></span>
                                            </span>
                                            <span class="font-mono font-bold" x-text="'-' + $store.cart.formatMoney($store.cart.sarmsDiscount())"></span>
                                        </div>
                                    </template>

                                    <!-- UK Delivery -->
                                    <div class="flex justify-between items-center text-slate-600 text-xs">
                                        <div>
                                            <span class="font-medium block">Royal Mail Tracked Delivery</span>
                                            <span class="text-[10px] text-slate-400 font-sans">Shipped next working day</span>
                                        </div>
                                        <span class="font-mono font-bold text-xs"
                                              :class="$store.cart.shippingFee() === 0 ? 'text-emerald-700 font-extrabold' : 'text-slate-900'"
                                              x-text="$store.cart.shippingFee() === 0 ? 'FREE (Over £50)' : $store.cart.formatMoney($store.cart.shippingFee())"></span>
                                    </div>

                                    <!-- Total Due -->
                                    <div class="pt-4 border-t-2 border-slate-100 flex justify-between items-baseline">
                                        <div>
                                            <span class="text-base font-extrabold text-slate-900 block" style="font-family: var(--font-heading);">
                                                Total Due
                                            </span>
                                            <span class="text-[11px] text-slate-400 font-mono">Inclusive of batch analytical documentation</span>
                                        </div>
                                        <span class="text-2xl sm:text-3xl font-black text-blue-900 font-mono tracking-tight"
                                              x-text="$store.cart.formatMoney($store.cart.finalTotal())"></span>
                                    </div>
                                </div>

                                <!-- Error Alert -->
                                <template x-if="checkoutError">
                                    <div class="p-3.5 rounded-xl bg-rose-50 border border-rose-200 text-rose-800 text-xs font-semibold flex items-start gap-2.5">
                                        <svg class="w-4 h-4 text-rose-600 shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                        </svg>
                                        <span x-text="checkoutError"></span>
                                    </div>
                                </template>

                                <!-- Checkout Button -->
                                <button type="button"
                                        @click="placeOrder()"
                                        :disabled="submitting"
                                        class="w-full py-4 px-6 rounded-xl font-bold text-white bg-blue-700 hover:bg-blue-800 disabled:opacity-50 transition-all shadow-md hover:shadow-lg flex items-center justify-center gap-2 cursor-pointer text-sm"
                                        style="font-family: var(--font-heading);">
                                    <template x-if="!submitting">
                                        <span class="flex items-center gap-2 font-bold tracking-wide">
                                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                            </svg>
                                            <span>Place Order (Bank Transfer)</span>
                                        </span>
                                    </template>
                                    <template x-if="submitting">
                                        <span class="flex items-center gap-2">
                                            <svg class="animate-spin h-4 w-4 text-white" fill="none" viewBox="0 0 24 24">
                                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path>
                                            </svg>
                                            <span>Processing Your Order...</span>
                                        </span>
                                    </template>
                                </button>

                                <!-- Trust & Security Signals -->
                                <div class="pt-2 border-t border-slate-100 space-y-2 text-[11px] text-slate-500">
                                    <div class="flex items-center gap-2 text-slate-600">
                                        <svg class="w-3.5 h-3.5 text-blue-700 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                        </svg>
                                        <span>Confidential laboratory invoicing &amp; bank transfer payment</span>
                                    </div>
                                    <div class="flex items-center gap-2 text-slate-600">
                                        <svg class="w-3.5 h-3.5 text-blue-700 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" />
                                        </svg>
                                        <span>Vacuum-sealed discreet parcel packaging</span>
                                    </div>
                                    <div class="flex items-center gap-2 text-slate-600">
                                        <svg class="w-3.5 h-3.5 text-blue-700 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                        </svg>
                                        <span>Batch Certificate of Analysis (COA) provided with every batch</span>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                </template>
            </div>
        </template>

    </div>
</div>
@endsection
