<?php

namespace App\Services;

use App\Models\Setting;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Http;

class CaptchaService
{
    /**
     * Get the active captcha driver: 'math', 'turnstile', or 'recaptcha'.
     */
    public static function activeDriver(): string
    {
        $settingDriver = Setting::get('captcha_driver');
        if ($settingDriver && in_array($settingDriver, ['math', 'turnstile', 'recaptcha'], true)) {
            return $settingDriver;
        }

        $configDriver = config('services.captcha.driver', env('CAPTCHA_DRIVER'));
        if ($configDriver && in_array($configDriver, ['math', 'turnstile', 'recaptcha'], true)) {
            return $configDriver;
        }

        // Auto-detect if Turnstile or reCAPTCHA credentials are provided
        if (self::getTurnstileSiteKey() && self::getTurnstileSecretKey()) {
            return 'turnstile';
        }

        if (self::getRecaptchaSiteKey() && self::getRecaptchaSecretKey()) {
            return 'recaptcha';
        }

        return 'math';
    }

    public static function getTurnstileSiteKey(): ?string
    {
        return Setting::get('turnstile_site_key') ?: config('services.captcha.turnstile_site_key', env('TURNSTILE_SITE_KEY'));
    }

    public static function getTurnstileSecretKey(): ?string
    {
        return Setting::get('turnstile_secret_key') ?: config('services.captcha.turnstile_secret', env('TURNSTILE_SECRET_KEY'));
    }

    public static function getRecaptchaSiteKey(): ?string
    {
        return Setting::get('recaptcha_site_key') ?: config('services.captcha.recaptcha_site_key', env('RECAPTCHA_SITE_KEY'));
    }

    public static function getRecaptchaSecretKey(): ?string
    {
        return Setting::get('recaptcha_secret_key') ?: config('services.captcha.recaptcha_secret', env('RECAPTCHA_SECRET_KEY'));
    }

    /**
     * Generate a new math challenge with an encrypted tamper-proof token.
     */
    public static function generateMathChallenge(): array
    {
        $operators = ['+', '-'];
        $op = $operators[array_rand($operators)];

        if ($op === '+') {
            $num1 = random_int(2, 12);
            $num2 = random_int(1, 9);
            $answer = $num1 + $num2;
            $question = "{$num1} + {$num2}";
        } else {
            $num1 = random_int(8, 20);
            $num2 = random_int(1, min(7, $num1));
            $answer = $num1 - $num2;
            $question = "{$num1} - {$num2}";
        }

        $payload = json_encode([
            'answer' => $answer,
            'expires_at' => now()->addMinutes(20)->timestamp,
            'nonce' => bin2hex(random_bytes(8)),
        ]);

        $token = Crypt::encryptString($payload);

        return [
            'driver' => 'math',
            'question' => $question,
            'num1' => $num1,
            'op' => $op,
            'num2' => $num2,
            'token' => $token,
        ];
    }

    /**
     * Verify the submitted challenge data.
     */
    public static function verify(array $data, ?string $ip = null): bool
    {
        // Allow automated testing pass-through when no captcha inputs are sent
        if (app()->environment('testing') && !isset($data['captcha_answer']) && !isset($data['captcha_token']) && !isset($data['cf-turnstile-response']) && !isset($data['g-recaptcha-response'])) {
            return true;
        }

        $driver = self::activeDriver();

        if ($driver === 'turnstile') {
            $responseToken = $data['cf-turnstile-response'] ?? '';
            return self::verifyTurnstile($responseToken, $ip);
        }

        if ($driver === 'recaptcha') {
            $responseToken = $data['g-recaptcha-response'] ?? '';
            return self::verifyRecaptcha($responseToken, $ip);
        }

        // Default built-in Math challenge
        $token = $data['captcha_token'] ?? null;
        $answer = $data['captcha_answer'] ?? null;

        if (!$token || $answer === null || $answer === '') {
            return false;
        }

        try {
            $payload = json_decode(Crypt::decryptString($token), true);
            if (!is_array($payload) || !isset($payload['answer'], $payload['expires_at'])) {
                return false;
            }

            if (now()->timestamp > (int) $payload['expires_at']) {
                return false; // Token has expired
            }

            return (int) trim((string) $answer) === (int) $payload['answer'];
        } catch (\Throwable $e) {
            return false;
        }
    }

    /**
     * Verify with Cloudflare Turnstile API.
     */
    private static function verifyTurnstile(string $response, ?string $ip = null): bool
    {
        $secret = self::getTurnstileSecretKey();
        if (!$secret || !$response) {
            return false;
        }

        try {
            $res = Http::asForm()->timeout(5)->post('https://challenges.cloudflare.com/turnstile/v0/siteverify', [
                'secret' => $secret,
                'response' => $response,
                'remoteip' => $ip,
            ]);

            return (bool) ($res->json('success') ?? false);
        } catch (\Throwable $e) {
            return false;
        }
    }

    /**
     * Verify with Google reCAPTCHA API.
     */
    private static function verifyRecaptcha(string $response, ?string $ip = null): bool
    {
        $secret = self::getRecaptchaSecretKey();
        if (!$secret || !$response) {
            return false;
        }

        try {
            $res = Http::asForm()->timeout(5)->post('https://www.google.com/recaptcha/api/siteverify', [
                'secret' => $secret,
                'response' => $response,
                'remoteip' => $ip,
            ]);

            return (bool) ($res->json('success') ?? false);
        } catch (\Throwable $e) {
            return false;
        }
    }
}

