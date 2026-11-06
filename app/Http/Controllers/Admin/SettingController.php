<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rule;

class SettingController extends Controller
{
    /**
     * Display the admin settings management view.
     */
    public function index()
    {
        $user = Auth::user();

        // Current effective mail settings (admin-saved values, else .env)
        $mail = [
            'host' => config('mail.mailers.smtp.host'),
            'port' => config('mail.mailers.smtp.port'),
            'username' => config('mail.mailers.smtp.username'),
            'encryption' => Setting::get('mail_encryption')
                ?? (config('mail.mailers.smtp.scheme') === 'smtps' || (int) config('mail.mailers.smtp.port') === 465 ? 'ssl' : 'tls'),
            'from_address' => config('mail.from.address'),
            'from_name' => config('mail.from.name'),
            'admin_email' => config('mail.admin_address'),
            'has_password' => filled(config('mail.mailers.smtp.password')),
            'mailer' => config('mail.default'),
            'has_api_token' => filled(config('mail.mailers.hostinger.token')),
            'mailbox_id' => config('mail.mailers.hostinger.mailbox_id'),
        ];

        return view('admin.settings.index', compact('user', 'mail'));
    }

    /**
     * Update admin profile details (display name & login email).
     */
    public function updateProfile(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore($user->id),
            ],
        ], [
            'name.required' => 'Display name is required.',
            'email.required' => 'Login email address is required.',
            'email.email' => 'Please provide a valid email address.',
            'email.unique' => 'This email address is already in use by another account.',
        ]);

        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->save();

        return redirect()->route('admin.settings.index')
            ->with('success', 'Admin profile and login email updated successfully.');
    }

    /**
     * Update admin account password.
     */
    public function updatePassword(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        $validated = $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ], [
            'current_password.required' => 'Please enter your current password.',
            'current_password.current_password' => 'The provided current password does not match our records.',
            'password.required' => 'Please enter a new password.',
            'password.min' => 'The new password must be at least 8 characters long.',
            'password.confirmed' => 'The new password confirmation does not match.',
        ]);

        $user->password = Hash::make($validated['password']);
        $user->save();

        return redirect()->route('admin.settings.index')
            ->with('success', 'Admin password changed successfully. Please remember your new password.');
    }

    /**
     * Save SMTP / email settings. They override the values in .env.
     */
    public function updateMail(Request $request)
    {
        $validated = $request->validate([
            'mail_driver' => ['required', Rule::in(['smtp', 'hostinger'])],
            'mail_host' => ['required_if:mail_driver,smtp', 'nullable', 'string', 'max:255'],
            'mail_port' => ['required_if:mail_driver,smtp', 'nullable', 'integer', 'between:1,65535'],
            'mail_username' => ['required_if:mail_driver,smtp', 'nullable', 'string', 'max:255'],
            'mail_password' => ['nullable', 'string', 'max:255'],
            'mail_encryption' => ['required_if:mail_driver,smtp', 'nullable', Rule::in(['ssl', 'tls', 'none'])],
            'hostinger_api_token' => [
                Rule::requiredIf(fn () => $request->input('mail_driver') === 'hostinger'
                    && blank(config('mail.mailers.hostinger.token'))),
                'nullable', 'string', 'max:255',
            ],
            'hostinger_mailbox_id' => ['nullable', 'string', 'max:100', 'regex:/^AC[A-Za-z0-9]+$/'],
            'mail_from_address' => ['required', 'email', 'max:255'],
            'mail_from_name' => ['required', 'string', 'max:100'],
            'admin_email' => ['required', 'email', 'max:255'],
        ], [
            'mail_host.required_if' => 'SMTP host is required when using SMTP.',
            'mail_port.required_if' => 'SMTP port is required when using SMTP.',
            'mail_username.required_if' => 'SMTP username is required when using SMTP.',
            'mail_encryption.required_if' => 'Encryption is required when using SMTP.',
            'hostinger_api_token.required' => 'Hostinger Mail API token is required.',
            'hostinger_mailbox_id.regex' => 'Mailbox ID should start with "AC" (or leave it blank to auto-detect).',
            'mail_from_address.required' => 'Sender email address is required.',
            'mail_from_name.required' => 'Sender name is required.',
            'admin_email.required' => 'Admin notification email is required.',
        ]);

        $values = [
            'mail_driver' => $validated['mail_driver'],
            'mail_host' => $validated['mail_host'] ?? '',
            'mail_port' => (string) ($validated['mail_port'] ?? ''),
            'mail_username' => $validated['mail_username'] ?? '',
            'mail_encryption' => $validated['mail_encryption'] ?? '',
            'hostinger_mailbox_id' => $validated['hostinger_mailbox_id'] ?? '',
            'mail_from_address' => $validated['mail_from_address'],
            'mail_from_name' => $validated['mail_from_name'],
            'admin_email' => $validated['admin_email'],
        ];

        // Blank password field = keep the current password
        if (filled($validated['mail_password'] ?? null)) {
            $values['mail_password'] = Crypt::encryptString($validated['mail_password']);
        }
        // Blank token field = keep the current token
        if (filled($validated['hostinger_api_token'] ?? null)) {
            $values['hostinger_api_token'] = Crypt::encryptString(trim($validated['hostinger_api_token']));
        }

        Setting::setMany($values);

        return redirect()->route('admin.settings.index')
            ->with('success', 'Email settings saved. Use "Send Test Email" to confirm they work.');
    }

    /**
     * Send a test email using the currently saved SMTP settings.
     */
    public function sendTestMail(Request $request)
    {
        $validated = $request->validate([
            'test_email' => ['required', 'email', 'max:255'],
        ]);

        try {
            Mail::raw(
                "This is a test email from the Research-Chem admin panel.\n\n"
                . "If you received it, your email settings are working.\n\nSent via: " . config('mail.default') . "\n\n"
                . 'Sent at: ' . now()->format('d M Y, H:i:s'),
                function ($m) use ($validated) {
                    $m->to($validated['test_email'])->subject('SMTP Test | Research-Chem');
                }
            );
        } catch (\Throwable $e) {
            return redirect()->route('admin.settings.index')
                ->withErrors(['mail_test' => 'Test email failed: ' . $e->getMessage()])
                ->withInput(['test_email' => $validated['test_email']]);
        }

        return redirect()->route('admin.settings.index')
            ->with('success', "Test email sent to {$validated['test_email']}. Check the inbox (and spam folder).");
    }
}
