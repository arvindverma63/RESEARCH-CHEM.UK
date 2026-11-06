<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

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
        $lead = null;
        try {
            $lead = ContactMessage::create([
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

        $this->sendEnquiryEmails($validated, $lead?->id);

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json(['success' => true, 'message' => 'Your message has been sent successfully.']);
        }

        return back()->with('success', 'Your message has been sent successfully. We will respond shortly.');
    }

    /**
     * Email the enquiry to the admin and an acknowledgement to the customer.
     * Failures are logged and never block the form response.
     */
    private function sendEnquiryEmails(array $data, ?int $leadId = null): void
    {
        $adminEmail = config('mail.admin_address');
        $vars = [
            'name' => $data['name'] ?? '',
            'email' => $data['email'],
            'phone' => $data['phone'] ?? '',
            'subject' => $data['subject'] ?? 'General Laboratory Enquiry',
            'enquiry' => $data['message'],
            'receivedAt' => now()->format('d M Y, H:i'),
            'adminUrl' => $leadId ? route('admin.leads.show', $leadId) : route('admin.leads.index'),
        ];

        if ($adminEmail) {
            try {
                $text = "New enquiry from the Research-Chem contact form.\n\n"
                    . "Name: " . ($vars['name'] ?: '-') . "\n"
                    . "Email: {$vars['email']}\n"
                    . "Phone: " . ($vars['phone'] ?: '-') . "\n"
                    . "Subject: {$vars['subject']}\n\n"
                    . "Message:\n{$vars['enquiry']}\n\n"
                    . "View in admin: {$vars['adminUrl']}\n";

                Mail::send(['html' => 'emails.contact-admin', 'raw' => $text], $vars, function ($m) use ($adminEmail, $vars) {
                    $m->to($adminEmail)
                        ->replyTo($vars['email'], $vars['name'] ?: null)
                        ->subject("New Enquiry: {$vars['subject']}");
                });
            } catch (\Throwable $e) {
                Log::error('[contact] admin email failed: ' . $e->getMessage());
            }
        }

        try {
            $text = "Hi " . ($vars['name'] ?: 'there') . ",\n\n"
                . "Thank you for contacting Research-Chem. We have received your enquiry and will respond shortly.\n\n"
                . "Your message:\n{$vars['subject']}\n{$vars['enquiry']}\n\n"
                . "Research-Chem";

            Mail::send(['html' => 'emails.contact-customer', 'raw' => $text], $vars, function ($m) use ($vars, $adminEmail) {
                $m->to($vars['email'], $vars['name'] ?: null)
                    ->subject('We have received your enquiry | Research-Chem');
                if ($adminEmail) {
                    $m->replyTo($adminEmail);
                }
            });
        } catch (\Throwable $e) {
            Log::error('[contact] customer email failed: ' . $e->getMessage());
        }
    }
}
