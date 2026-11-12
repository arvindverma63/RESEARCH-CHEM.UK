<?php

namespace Tests\Feature;

use App\Models\ContactMessage;
use App\Services\CaptchaService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Crypt;
use Tests\TestCase;

class CaptchaContactTest extends TestCase
{
    use RefreshDatabase;

    public function test_contact_page_renders_with_captcha_challenge(): void
    {
        $response = $this->get('/contact');
        $response->assertStatus(200);
        $response->assertSee('Security Verification');
        $response->assertSee('captcha_answer');
        $response->assertSee('captcha_token');
    }

    public function test_captcha_refresh_endpoint_returns_json_challenge(): void
    {
        $response = $this->getJson('/contact/captcha');
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'driver',
            'question',
            'num1',
            'op',
            'num2',
            'token',
        ]);
        $this->assertEquals('math', $response->json('driver'));
        $this->assertNotEmpty($response->json('token'));
    }

    public function test_contact_form_succeeds_with_valid_captcha(): void
    {
        $challenge = CaptchaService::generateMathChallenge();
        $payload = json_decode(Crypt::decryptString($challenge['token']), true);
        $correctAnswer = $payload['answer'];

        $response = $this->postJson('/contact', [
            'name' => 'Dr. Robert Hooke',
            'email' => 'robert.hooke@royalsociety.org',
            'subject' => 'HPLC Test Inquiry',
            'message' => 'Please provide documentation for batch RET-99.',
            'captcha_answer' => (string) $correctAnswer,
            'captcha_token' => $challenge['token'],
        ]);

        $response->assertStatus(200);
        $response->assertJson(['success' => true]);

        $this->assertDatabaseHas('contact_messages', [
            'email' => 'robert.hooke@royalsociety.org',
            'name' => 'Dr. Robert Hooke',
        ]);
    }

    public function test_contact_form_fails_with_incorrect_captcha(): void
    {
        $challenge = CaptchaService::generateMathChallenge();
        $payload = json_decode(Crypt::decryptString($challenge['token']), true);
        $wrongAnswer = $payload['answer'] + 99;

        $response = $this->postJson('/contact', [
            'name' => 'Bot Intruder',
            'email' => 'bot@spammer.org',
            'subject' => 'Spam Subject',
            'message' => 'Spam message content.',
            'captcha_answer' => (string) $wrongAnswer,
            'captcha_token' => $challenge['token'],
        ]);

        $response->assertStatus(422);
        $response->assertJson(['success' => false]);
        $response->assertJsonStructure(['message', 'new_captcha']);
    }

    public function test_contact_form_fails_with_tampered_token(): void
    {
        $response = $this->postJson('/contact', [
            'name' => 'Hacker',
            'email' => 'hacker@example.org',
            'subject' => 'Attack',
            'message' => 'Testing forged token',
            'captcha_answer' => '12',
            'captcha_token' => 'invalid-tampered-token-123',
        ]);

        $response->assertStatus(422);
        $response->assertJson(['success' => false]);
    }

    public function test_honeypot_bot_trap_catches_bot(): void
    {
        $response = $this->postJson('/contact', [
            'name' => 'Bot User',
            'email' => 'bot@automated.com',
            'message' => 'I am a bot',
            'website' => 'http://spam-link.com',
        ]);

        $response->assertStatus(200);
        $response->assertJson(['success' => true]);
        // Shouldn't be inserted into DB
        $this->assertDatabaseMissing('contact_messages', [
            'email' => 'bot@automated.com',
        ]);
    }
}
