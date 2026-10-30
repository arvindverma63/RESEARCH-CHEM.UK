@extends('layouts.app')

@section('title', 'Contact Us — ResearchChem.uk')
@section('meta_description', 'Get in touch with ResearchChem.uk for inquiries regarding research compounds, batch documentation, or laboratory orders.')

@section('content')
<!-- Header Banner -->
<div class="bg-slate-50 border-b border-slate-200 py-10 lg:py-14">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <nav aria-label="Breadcrumb" class="flex items-center gap-2 text-xs text-slate-500 mb-4 font-sans">
            <a href="{{ route('home') }}" class="hover:text-blue-700 transition-colors">Home</a>
            <i data-lucide="chevron-right" class="w-3 h-3"></i>
            <span class="text-slate-800 font-medium">Contact</span>
        </nav>

        <h1 class="text-3xl sm:text-4xl font-extrabold text-slate-900 tracking-tight mb-3" style="font-family: var(--font-heading);">
            Contact Our Laboratory Team
        </h1>
        <p class="text-base text-slate-600 max-w-2xl leading-relaxed font-sans">
            Have questions regarding compound specifications, batch COAs, order status or laboratory delivery? Send us a message and our support team will respond within 24 business hours.
        </p>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 lg:py-16"
     x-data="{
        sending: false,
        sent: false,
        errorMsg: '',
        async submitForm(e) {
            this.sending = true;
            this.errorMsg = '';
            const formData = new FormData(e.target);
            try {
                const res = await fetch('{{ route('contact.submit') }}', {
                    method: 'POST',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json'
                    },
                    body: formData
                });
                const data = await res.json();
                if (data.success) {
                    this.sent = true;
                    e.target.reset();
                } else {
                    this.errorMsg = data.message || 'Something went wrong. Please try again.';
                }
            } catch(err) {
                this.errorMsg = 'Network error. Please try again or email us directly.';
            } finally {
                this.sending = false;
            }
        }
     }">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">

        <!-- ── Contact Information Column ── -->
        <div class="lg:col-span-1 space-y-6">
            <div class="p-6 rounded-2xl border border-slate-200 bg-white shadow-xs">
                <div class="w-10 h-10 rounded-lg flex items-center justify-center text-white mb-4" style="background-color: #0052a3;">
                    <i data-lucide="map-pin" class="w-5 h-5"></i>
                </div>
                <h3 class="text-base font-bold text-slate-900 mb-2" style="font-family: var(--font-heading);">
                    Laboratory Address
                </h3>
                <p class="text-sm text-slate-600 leading-relaxed font-sans">
                    4 Grove Avenue, Llanfoist<br>
                    Abergavenny, NP7 9NB<br>
                    United Kingdom
                </p>
            </div>

            <div class="p-6 rounded-2xl border border-slate-200 bg-white shadow-xs">
                <div class="w-10 h-10 rounded-lg flex items-center justify-center text-white mb-4" style="background-color: #0052a3;">
                    <i data-lucide="mail" class="w-5 h-5"></i>
                </div>
                <h3 class="text-base font-bold text-slate-900 mb-2" style="font-family: var(--font-heading);">
                    Direct Email
                </h3>
                <p class="text-sm text-slate-600 leading-relaxed font-sans mb-2">
                    For orders, batch documentation and technical inquiries:
                </p>
                <a href="mailto:info@research-chem.uk" class="text-sm font-bold text-blue-700 hover:underline">
                    info@research-chem.uk
                </a>
            </div>

            <div class="p-6 rounded-2xl border border-slate-200 bg-white shadow-xs">
                <div class="w-10 h-10 rounded-lg flex items-center justify-center text-white mb-4" style="background-color: #0052a3;">
                    <i data-lucide="clock" class="w-5 h-5"></i>
                </div>
                <h3 class="text-base font-bold text-slate-900 mb-2" style="font-family: var(--font-heading);">
                    Operating Hours
                </h3>
                <p class="text-sm text-slate-600 leading-relaxed font-sans">
                    Monday &ndash; Friday: 09:00 &ndash; 17:00 GMT<br>
                    Weekends &amp; UK Holidays: Closed
                </p>
            </div>
        </div>

        <!-- ── Contact Form Column ── -->
        <div class="lg:col-span-2">
            <div class="p-8 sm:p-10 rounded-2xl border border-slate-200 bg-white shadow-lg">
                <h2 class="text-2xl font-bold text-slate-900 mb-2" style="font-family: var(--font-heading);">
                    Send an Inquiry
                </h2>
                <p class="text-sm text-slate-500 mb-8 font-sans">
                    Fill in the form below and we will get back to you promptly.
                </p>

                <!-- Success Alert -->
                <div x-show="sent" x-cloak class="p-5 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-800 flex items-start gap-3 mb-6">
                    <i data-lucide="check-circle-2" class="w-5 h-5 text-emerald-600 shrink-0 mt-0.5"></i>
                    <div>
                        <h4 class="font-bold text-sm">Message Sent Successfully</h4>
                        <p class="text-xs text-emerald-700 mt-1">Thank you for your enquiry. A member of our team will review your message and reply via email shortly.</p>
                    </div>
                </div>

                <!-- Error Alert -->
                <div x-show="errorMsg" x-cloak class="p-4 rounded-xl bg-rose-50 border border-rose-200 text-rose-800 text-xs font-semibold mb-6 flex items-center gap-2">
                    <i data-lucide="alert-circle" class="w-4 h-4 text-rose-600 shrink-0"></i>
                    <span x-text="errorMsg"></span>
                </div>

                <form @submit.prevent="submitForm($event)" class="space-y-6">
                    @csrf
                    <!-- Honeypot Bot Trap -->
                    <input type="text" name="website" class="hidden" tabindex="-1" autocomplete="off">

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div>
                            <label for="name" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">
                                Your Name
                            </label>
                            <input type="text" id="name" name="name" required
                                   class="w-full px-4 py-3 rounded-lg border border-slate-300 text-slate-900 text-sm focus:border-blue-600 focus:ring-2 focus:ring-blue-600/20 outline-none transition-all placeholder:text-slate-400"
                                   placeholder="Dr. Alex Morgan">
                        </div>

                        <div>
                            <label for="email" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">
                                Email Address <span class="text-rose-500">*</span>
                            </label>
                            <input type="email" id="email" name="email" required
                                   class="w-full px-4 py-3 rounded-lg border border-slate-300 text-slate-900 text-sm focus:border-blue-600 focus:ring-2 focus:ring-blue-600/20 outline-none transition-all placeholder:text-slate-400"
                                   placeholder="alex.morgan@lab.co.uk">
                        </div>
                    </div>

                    <div>
                        <label for="subject" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">
                            Subject
                        </label>
                        <input type="text" id="subject" name="subject"
                               class="w-full px-4 py-3 rounded-lg border border-slate-300 text-slate-900 text-sm focus:border-blue-600 focus:ring-2 focus:ring-blue-600/20 outline-none transition-all placeholder:text-slate-400"
                               placeholder="e.g. Batch COA Request / Bulk Lab Pricing">
                    </div>

                    <div>
                        <label for="message" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">
                            Message <span class="text-rose-500">*</span>
                        </label>
                        <textarea id="message" name="message" rows="5" required
                                  class="w-full px-4 py-3 rounded-lg border border-slate-300 text-slate-900 text-sm focus:border-blue-600 focus:ring-2 focus:ring-blue-600/20 outline-none transition-all placeholder:text-slate-400"
                                  placeholder="Please provide details of your inquiry, batch number, or requested compounds..."></textarea>
                    </div>

                    <div>
                        <button type="submit"
                                :disabled="sending"
                                class="inline-flex items-center justify-center gap-2 px-8 py-3.5 rounded-lg text-sm font-bold text-white bg-blue-700 hover:bg-blue-800 disabled:opacity-50 transition-all shadow-md hover:shadow-lg"
                                style="font-family: var(--font-heading);">
                            <template x-if="!sending">
                                <span class="flex items-center gap-2">
                                    <i data-lucide="send" class="w-4 h-4"></i>
                                    <span>Send Message</span>
                                </span>
                            </template>
                            <template x-if="sending">
                                <span class="flex items-center gap-2">
                                    <span class="w-4 h-4 border-2 border-white/30 border-t-white rounded-full animate-spin"></span>
                                    <span>Sending...</span>
                                </span>
                            </template>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

