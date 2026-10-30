<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use Illuminate\Http\Request;

class LeadController extends Controller
{
    public function index(Request $request)
    {
        $query = ContactMessage::query()->orderBy('created_at', 'desc');

        $status = $request->get('status', 'all');
        if ($status !== 'all' && in_array($status, ['new', 'in_progress', 'replied', 'archived'])) {
            $query->where('status', $status);
        }

        $source = $request->get('source', 'all');
        if ($source !== 'all' && in_array($source, ['contact_form', 'checkout_lead', 'inquiry'])) {
            $query->where('source', $source);
        }

        if ($search = $request->get('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('subject', 'like', "%{$search}%")
                  ->orWhere('message', 'like', "%{$search}%");
            });
        }

        $leads = $query->paginate(15)->withQueryString();

        $counts = [
            'all' => ContactMessage::count(),
            'new' => ContactMessage::where('status', 'new')->count(),
            'in_progress' => ContactMessage::where('status', 'in_progress')->count(),
            'replied' => ContactMessage::where('status', 'replied')->count(),
            'archived' => ContactMessage::where('status', 'archived')->count(),
        ];

        return view('admin.leads.index', compact('leads', 'counts', 'status', 'source'));
    }

    public function show(int $id)
    {
        $lead = ContactMessage::findOrFail($id);
        return view('admin.leads.show', compact('lead'));
    }

    public function updateStatus(Request $request, int $id)
    {
        $lead = ContactMessage::findOrFail($id);

        $validated = $request->validate([
            'status' => 'required|in:new,in_progress,replied,archived',
            'admin_notes' => 'nullable|string|max:3000',
        ]);

        $lead->update([
            'status' => $validated['status'],
            'admin_notes' => $validated['admin_notes'] ?? $lead->admin_notes,
        ]);

        return redirect()->route('admin.leads.show', $lead->id)
            ->with('success', "Inquiry from {$lead->email} updated to '{$lead->status_label}'.");
    }

    public function destroy(int $id)
    {
        $lead = ContactMessage::findOrFail($id);
        $email = $lead->email;
        $lead->delete();

        return redirect()->route('admin.leads.index')
            ->with('success', "Lead inquiry from {$email} was deleted.");
    }
}

