@extends('admin.layouts.app')

@section('title', 'Leads & Inquiries')
@section('header_title', 'Customer Leads & Inquiries')

@section('content')
<div class="space-y-6">

    <!-- ── METRIC STATS ── -->
    <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
        <div class="bg-white p-4 rounded-lg border border-slate-200 shadow-xs">
            <div class="text-xs font-mono uppercase tracking-wider text-slate-500 font-bold mb-1">Total Inquiries</div>
            <div class="text-2xl font-black font-mono text-slate-900">{{ $counts['all'] }}</div>
            <div class="text-[11px] text-slate-500 mt-1 font-sans">All customer messages</div>
        </div>

        <div class="bg-white p-4 rounded-lg border border-emerald-200 shadow-xs bg-emerald-50/30">
            <div class="text-xs font-mono uppercase tracking-wider text-emerald-700 font-bold mb-1">New Leads</div>
            <div class="text-2xl font-black font-mono text-emerald-900">{{ $counts['new'] }}</div>
            <div class="text-[11px] text-emerald-700 mt-1 font-sans">Requires attention / reply</div>
        </div>

        <div class="bg-white p-4 rounded-lg border border-amber-200 shadow-xs bg-amber-50/30">
            <div class="text-xs font-mono uppercase tracking-wider text-amber-700 font-bold mb-1">In Progress</div>
            <div class="text-2xl font-black font-mono text-amber-900">{{ $counts['in_progress'] }}</div>
            <div class="text-[11px] text-amber-700 mt-1 font-sans">Active discussion or quote</div>
        </div>

        <div class="bg-white p-4 rounded-lg border border-blue-200 shadow-xs bg-blue-50/30">
            <div class="text-xs font-mono uppercase tracking-wider text-blue-700 font-bold mb-1">Replied / Solved</div>
            <div class="text-2xl font-black font-mono text-blue-900">{{ $counts['replied'] }}</div>
            <div class="text-[11px] text-blue-700 mt-1 font-sans">Response sent to customer</div>
        </div>
    </div>

    <!-- ── TABLE CARD ── -->
    <div class="bg-white rounded-lg border border-slate-200 shadow-xs overflow-hidden">
        
        <!-- Filter Tabs & Search Bar -->
        <div class="p-4 border-b border-slate-200 flex flex-col md:flex-row md:items-center justify-between gap-4">
            
            <!-- Status Tabs -->
            <div class="flex items-center gap-1 overflow-x-auto pb-1 md:pb-0">
                <a href="{{ route('admin.leads.index', array_merge(request()->query(), ['status' => 'all'])) }}"
                   class="px-3 py-1.5 rounded-md text-xs font-bold transition-colors whitespace-nowrap {{ $status === 'all' ? 'bg-[#0052a3] text-white' : 'text-slate-600 hover:bg-slate-100' }}">
                    All ({{ $counts['all'] }})
                </a>
                <a href="{{ route('admin.leads.index', array_merge(request()->query(), ['status' => 'new'])) }}"
                   class="px-3 py-1.5 rounded-md text-xs font-bold transition-colors whitespace-nowrap {{ $status === 'new' ? 'bg-emerald-600 text-white' : 'text-slate-600 hover:bg-slate-100' }}">
                    New Leads ({{ $counts['new'] }})
                </a>
                <a href="{{ route('admin.leads.index', array_merge(request()->query(), ['status' => 'in_progress'])) }}"
                   class="px-3 py-1.5 rounded-md text-xs font-bold transition-colors whitespace-nowrap {{ $status === 'in_progress' ? 'bg-amber-600 text-white' : 'text-slate-600 hover:bg-slate-100' }}">
                    In Progress ({{ $counts['in_progress'] }})
                </a>
                <a href="{{ route('admin.leads.index', array_merge(request()->query(), ['status' => 'replied'])) }}"
                   class="px-3 py-1.5 rounded-md text-xs font-bold transition-colors whitespace-nowrap {{ $status === 'replied' ? 'bg-blue-600 text-white' : 'text-slate-600 hover:bg-slate-100' }}">
                    Replied ({{ $counts['replied'] }})
                </a>
            </div>

            <!-- Search -->
            <form action="{{ route('admin.leads.index') }}" method="GET" class="flex items-center gap-2">
                @if(request('status'))
                    <input type="hidden" name="status" value="{{ request('status') }}">
                @endif
                <div class="relative">
                    <input type="text"
                           name="search"
                           value="{{ request('search') }}"
                           placeholder="Search Name, Email, Subject..."
                           class="pl-8 pr-3 py-1.5 text-xs rounded-md border border-slate-300 focus:outline-hidden focus:border-blue-600 w-52 sm:w-64 font-sans">
                    <i data-lucide="search" class="w-3.5 h-3.5 text-slate-400 absolute left-2.5 top-1/2 -translate-y-1/2"></i>
                </div>
                <button type="submit" class="px-3 py-1.5 bg-slate-900 text-white rounded-md text-xs font-bold hover:bg-slate-800">
                    Filter
                </button>
                @if(request('search'))
                    <a href="{{ route('admin.leads.index', ['status' => request('status', 'all')]) }}" class="text-xs text-slate-500 hover:text-slate-800">
                        Clear
                    </a>
                @endif
            </form>
        </div>

        <!-- Leads Table -->
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead class="bg-slate-50 border-b border-slate-200 text-slate-500 font-mono uppercase tracking-wider font-semibold">
                    <tr>
                        <th class="py-3 px-4">Contact / Sender</th>
                        <th class="py-3 px-4">Subject & Message Preview</th>
                        <th class="py-3 px-4">Source</th>
                        <th class="py-3 px-4">Status</th>
                        <th class="py-3 px-4">Received Date</th>
                        <th class="py-3 px-4 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($leads as $lead)
                        <tr class="hover:bg-slate-50/80 transition-colors {{ $lead->status === 'new' ? 'bg-emerald-50/20' : '' }}">
                            
                            <!-- Sender -->
                            <td class="py-3.5 px-4 font-sans">
                                <div class="font-bold text-slate-900">
                                    {{ $lead->name ?: 'Anonymous Researcher' }}
                                </div>
                                <a href="mailto:{{ $lead->email }}" class="text-blue-700 hover:underline font-mono text-[11px] block">
                                    {{ $lead->email }}
                                </a>
                                @if(!empty($lead->phone))
                                    <div class="text-slate-400 text-[10px]">{{ $lead->phone }}</div>
                                @endif
                            </td>

                            <!-- Subject & Message -->
                            <td class="py-3.5 px-4 font-sans max-w-md">
                                <a href="{{ route('admin.leads.show', $lead->id) }}" class="font-bold text-slate-900 hover:text-blue-700 block truncate text-xs">
                                    {{ $lead->subject }}
                                </a>
                                <p class="text-slate-500 text-[11px] line-clamp-1 mt-0.5">
                                    {{ $lead->message }}
                                </p>
                            </td>

                            <!-- Source -->
                            <td class="py-3.5 px-4 font-sans">
                                <span class="inline-block px-2 py-0.5 rounded-xs text-[10px] font-mono font-bold bg-slate-100 text-slate-700 uppercase">
                                    {{ str_replace('_', ' ', $lead->source) }}
                                </span>
                            </td>

                            <!-- Status -->
                            <td class="py-3.5 px-4">
                                <span class="inline-block px-2 py-0.5 rounded-full text-[10px] font-bold border {{ $lead->status_badge_class }}">
                                    {{ $lead->status_label }}
                                </span>
                            </td>

                            <!-- Date -->
                            <td class="py-3.5 px-4 font-mono text-[11px] text-slate-500">
                                {{ $lead->created_at->format('M d, Y · H:i') }}
                            </td>

                            <!-- Actions -->
                            <td class="py-3.5 px-4 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('admin.leads.show', $lead->id) }}"
                                       class="px-2.5 py-1 text-xs font-semibold rounded-md bg-blue-50 text-blue-700 hover:bg-blue-100 transition-colors">
                                        View
                                    </a>
                                    <form action="{{ route('admin.leads.destroy', $lead->id) }}" method="POST" onsubmit="return confirm('Delete this inquiry?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-1 text-slate-400 hover:text-rose-600 transition-colors" title="Delete">
                                            <i data-lucide="trash-2" class="w-4 h-4"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="py-12 text-center text-slate-500 font-sans">
                                <i data-lucide="inbox" class="w-10 h-10 mx-auto text-slate-300 mb-2"></i>
                                <p class="text-sm font-semibold">No inquiries found matching criteria.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($leads->hasPages())
            <div class="p-4 border-t border-slate-200">
                {{ $leads->links() }}
            </div>
        @endif
    </div>
</div>
@endsection

