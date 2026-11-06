<?php

namespace App\Providers;

use App\Mail\HostingerApiTransport;
use App\Models\Setting;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Hostinger Mail API driver (MAIL_MAILER=hostinger or chosen in Admin → Settings)
        Mail::extend('hostinger', function (array $config) {
            return new HostingerApiTransport(
                (string) ($config['token'] ?? ''),
                $config['mailbox_id'] ?? null,
                $config['base_url'] ?? 'https://api.mail.hostinger.com',
            );
        });

        $this->applyMailSettingsFromDatabase();
    }

    /**
     * Mail settings (driver, SMTP, Hostinger API) saved in Admin → Settings override .env.
     * Any setting left empty in the admin falls back to .env.
     */
    private function applyMailSettingsFromDatabase(): void
    {
        try {
            $s = Setting::allCached();
        } catch (\Throwable $e) {
            return; // settings table not migrated yet, or DB unavailable
        }

        $pick = fn (string $key) => isset($s[$key]) && $s[$key] !== '' ? $s[$key] : null;
        $config = [];

        if ($host = $pick('mail_host')) {
            $config['mail.default'] = 'smtp';
            $config['mail.mailers.smtp.host'] = $host;
        }
        if (in_array($driver = $pick('mail_driver'), ['smtp', 'hostinger'], true)) {
            $config['mail.default'] = $driver;
        }
        if ($token = $pick('hostinger_api_token')) {
            try {
                $config['mail.mailers.hostinger.token'] = Crypt::decryptString($token);
            } catch (\Throwable $e) {
                // APP_KEY changed since the token was saved; keep .env value
            }
        }
        if ($mailbox = $pick('hostinger_mailbox_id')) {
            $config['mail.mailers.hostinger.mailbox_id'] = $mailbox;
        }
        if ($port = $pick('mail_port')) {
            $config['mail.mailers.smtp.port'] = (int) $port;
        }
        if ($user = $pick('mail_username')) {
            $config['mail.mailers.smtp.username'] = $user;
        }
        if ($pass = $pick('mail_password')) {
            try {
                $config['mail.mailers.smtp.password'] = Crypt::decryptString($pass);
            } catch (\Throwable $e) {
                // APP_KEY changed since the password was saved; keep .env value
            }
        }
        if ($enc = $pick('mail_encryption')) {
            // ssl = implicit TLS (port 465). tls/none = plain smtp; STARTTLS is used automatically when offered.
            $config['mail.mailers.smtp.scheme'] = $enc === 'ssl' ? 'smtps' : 'smtp';
        }
        if ($from = $pick('mail_from_address')) {
            $config['mail.from.address'] = $from;
        }
        if ($name = $pick('mail_from_name')) {
            $config['mail.from.name'] = $name;
        }
        if ($admin = $pick('admin_email')) {
            $config['mail.admin_address'] = $admin;
        }

        if ($config) {
            config($config);
        }
    }
}
