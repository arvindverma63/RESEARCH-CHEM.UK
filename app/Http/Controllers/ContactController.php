<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ContactController extends Controller
{
    public function index()
    {
        return view('contact');
    }

    public function submit(Request $request)
    {
        // Bot trap check
        if ($request->filled('website') || $request->filled('honeypot')) {
            return response()->json(['success' => true]);
        }

        $validated = $request->validate([
            'name' => 'nullable|string|max:100',
            'email' => 'required|email|max:150',
            'phone' => 'nullable|string|max:40',
            'subject' => 'nullable|string|max:200',
            'message' => 'required|string|max:5000',
        ]);

        // Save enquiry to database
        try {
            ContactMessage::create([
                'name' => $validated['name'] ?? null,
                'email' => $validated['email'],
                'phone' => $validated['phone'] ?? null,
                'subject' => $validated['subject'] ?? 'General Laboratory Enquiry',
                'message' => $validated['message'],
                'ip_address' => $request->ip(),
                'status' => 'new',
                'source' => 'contact_form',
            ]);
        } catch (\Throwable $e) {
            // Keep resilient
        }

        // Save enquiry to jsonl log file in storage
        $logPath = storage_path('app/contact-messages.jsonl');
        $entry = [
            'timestamp' => now()->toIso8601String(),
            'name' => $validated['name'] ?? '',
            'email' => $validated['email'],
            'subject' => $validated['subject'] ?? 'General Enquiry',
            'message' => $validated['message'],
            'ip' => $request->ip(),
        ];

        file_put_contents($logPath, json_encode($entry) . PHP_EOL, FILE_APPEND);

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json(['success' => true, 'message' => 'Your message has been sent successfully.']);
        }

        return back()->with('success', 'Your message has been sent successfully. We will respond shortly.');
    }
}


