@extends('admin.layouts.app')

@section('title', "Inquiry: {$lead->subject}")
@section('header_title', "Customer Inquiry Details")

@section('content')
<div class="space-y-6">

    <!-- Top Navigation -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-2">
        <div class="flex items-center gap-3">
            <a href="{{ route('admin.leads.index') }}" class="p-1.5 rounded-md border border-slate-300 bg-white hover:bg-slate-50 text-slate-700">
                <i data-lucide="arrow-left" class="w-4 h-4"></i>
            </a>
            <div>
                <div class="flex items-center gap-2">
                    <h2 class="text-xl font-black font-heading text-slate-900 tracking-tight">
                        {{ $lead->subject ?: 'General Inquiry' }}
                    </h2>
                    <span class="px-2.5 py-0.5 rounded-full text-xs font-bold border {{ $lead->status_badge_class }}">
                        {{ $lead->status_label }}
                    </span>
                </div>
                <div class="text-xs text-slate-500 font-sans mt-0.5">
                    Received on {{ $lead->created_at->format('l, F j, Y \a\t H:i') }} · via {{ str_replace('_', ' ', $lead->source) }}
                </div>
            </div>
        </div>

        <div class="flex items-center gap-2">
            <a href="mailto:{{ $lead->email }}?subject=Re: {{ rawurlencode($lead->subject) }}"
               class="inline-flex items-center gap-1.5 px-3.5 py-2 rounded-md bg-[#0052a3] text-white text-xs font-bold hover:bg-blue-800 transition-colors shadow-xs">
                <i data-lucide="reply" class="w-4 h-4"></i>
                <span>Reply to Customer</span>
            </a>
        </div>
    </div>

    <!-- 2-Column Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        <!-- ── LEFT: MESSAGE CONTENT ── -->
        <div class="lg:col-span-2 space-y-6">

            <!-- Message Card -->
            <div class="bg-white rounded-lg border border-slate-200 shadow-xs p-6">
                <div class="flex items-center justify-between pb-4 mb-4 border-b border-slate-100">
                    <div>
                        <div class="font-bold text-slate-900 text-sm font-sans">
                            From: {{ $lead->name ?: 'Anonymous Researcher' }}
                            <span class="text-blue-700 font-mono text-xs font-normal">({{ $lead->email }})</span>
                        </div>
                        @if(!empty($lead->phone))
                            <div class="text-xs text-slate-500 mt-0.5">Phone: {{ $lead->phone }}</div>
                        @endif
                    </div>
                    <span class="text-xs font-mono text-slate-400">
                        IP: {{ $lead->ip_address ?: 'Unknown' }}
                    </span>
                </div>

                <div class="prose max-w-none text-slate-800 text-sm font-sans leading-relaxed whitespace-pre-wrap bg-slate-50 p-4 rounded-md border border-slate-200">
{{ $lead->message }}
                </div>
            </div>

            <!-- Internal Staff Notes -->
            <div class="bg-white rounded-lg border border-slate-200 shadow-xs p-6">
                <h3 class="font-bold text-sm text-slate-900 font-heading mb-2">Staff Follow-Up History</h3>
                <div class="text-xs text-slate-600 font-sans bg-slate-50 p-3 rounded-md border border-slate-200">
                    {{ $lead->admin_notes ?: 'No staff notes recorded. Update the status card on the right to log communications or wholesale pricing provided.' }}
                </div>
            </div>
        </div>

        <!-- ── RIGHT: STATUS & ACTIONS ── -->
        <div class="space-y-6">

            <!-- Status Form -->
            <div class="bg-white rounded-lg border border-slate-200 shadow-xs p-5">
                <h3 class="font-bold text-sm text-slate-900 font-heading mb-3 flex items-center gap-2">
                    <i data-lucide="check-circle-2" class="w-4 h-4 text-blue-600"></i>
                    <span>Inquiry Status</span>
                </h3>

                <form action="{{ route('admin.leads.status', $lead->id) }}" method="POST" class="space-y-4">
                    @csrf
                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase font-mono mb-1">Status</label>
                        <select name="status" class="w-full text-xs font-semibold rounded-md border border-slate-300 p-2 focus:ring-2 focus:ring-blue-500 focus:outline-hidden">
                            <option value="new" {{ $lead->status === 'new' ? 'selected' : '' }}>New Lead (Unread/Action Required)</option>
                            <option value="in_progress" {{ $lead->status === 'in_progress' ? 'selected' : '' }}>In Progress (Under Review)</option>
                            <option value="replied" {{ $lead->status === 'replied' ? 'selected' : '' }}>Replied / Answered</option>
                            <option value="archived" {{ $lead->status === 'archived' ? 'selected' : '' }}>Archived (Completed)</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase font-mono mb-1">Follow-up Notes</label>
                        <textarea name="admin_notes" rows="4"
                                  placeholder="e.g. Sent wholesale catalogue and quoted £380 for 3x kits..."
                                  class="w-full text-xs rounded-md border border-slate-300 p-2 font-sans focus:ring-2 focus:ring-blue-500 focus:outline-hidden">{{ $lead->admin_notes }}</textarea>
                    </div>

                    <button type="submit" class="w-full py-2 bg-[#0052a3] text-white rounded-md text-xs font-bold hover:bg-blue-800 transition-colors shadow-xs">
                        Save Status & Notes
                    </button>
                </form>
            </div>

            <!-- Contact Card -->
            <div class="bg-white rounded-lg border border-slate-200 shadow-xs p-5 space-y-3 text-xs font-sans">
                <h3 class="font-bold text-sm text-slate-900 font-heading flex items-center gap-2">
                    <i data-lucide="user" class="w-4 h-4 text-blue-600"></i>
                    <span>Lead Contact Summary</span>
                </h3>

                <div>
                    <span class="text-slate-400 block text-[10px] uppercase font-mono">Contact Name</span>
                    <span class="font-bold text-slate-900">{{ $lead->name ?: 'Not provided' }}</span>
                </div>

                <div>
                    <span class="text-slate-400 block text-[10px] uppercase font-mono">Email</span>
                    <a href="mailto:{{ $lead->email }}" class="text-blue-700 font-mono hover:underline">{{ $lead->email }}</a>
                </div>

                @if(!empty($lead->phone))
                    <div>
                        <span class="text-slate-400 block text-[10px] uppercase font-mono">Phone</span>
                        <a href="tel:{{ $lead->phone }}" class="text-slate-800 hover:underline">{{ $lead->phone }}</a>
                    </div>
                @endif

                <div class="pt-3 border-t border-slate-200">
                    <form action="{{ route('admin.leads.destroy', $lead->id) }}" method="POST" onsubmit="return confirm('Delete this inquiry permanently?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-xs text-rose-600 hover:text-rose-800 font-bold flex items-center gap-1">
                            <i data-lucide="trash-2" class="w-3.5 h-3.5"></i>
                            <span>Delete this inquiry</span>
                        </button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection

