<?php

namespace App\Mail;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Symfony\Component\Mailer\Exception\TransportException;
use Symfony\Component\Mailer\SentMessage;
use Symfony\Component\Mailer\Transport\AbstractTransport;
use Symfony\Component\Mime\Address;
use Symfony\Component\Mime\MessageConverter;

/**
 * Laravel mail transport for the Hostinger Mail API.
 *
 * Docs: https://docs.hostinger.com/emails/mail-api
 *   GET  /api/v1/me                                   → mailboxes the token can use
 *   POST /api/v1/mailboxes/{mailboxResourceId}/send   → send (204 on success)
 *
 * The API always sends from the mailbox itself; only the display name can be
 * changed. Reply-To is not supported by the API and is ignored.
 */
class HostingerApiTransport extends AbstractTransport
{
    public function __construct(
        private string $token,
        private ?string $mailboxId = null,
        private string $baseUrl = 'https://api.mail.hostinger.com',
    ) {
        parent::__construct();
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    protected function doSend(SentMessage $message): void
    {
        if ($this->token === '') {
            throw new TransportException('Hostinger Mail API token is not set.');
        }

        $email = MessageConverter::toEmail($message->getOriginalMessage());
        $from = $email->getFrom()[0] ?? null;

        $addresses = fn (array $list) => array_map(fn (Address $a) => $a->getAddress(), $list);

        $payload = array_filter([
            'to' => $addresses($email->getTo()),
            'cc' => $addresses($email->getCc()),
            'bcc' => $addresses($email->getBcc()),
            'displayName' => $from?->getName() ?: null,
            'subject' => $email->getSubject() ?? '',
            'text' => $this->bodyToString($email->getTextBody()),
            'html' => $this->bodyToString($email->getHtmlBody()),
        ], fn ($v) => $v !== null && $v !== [] && $v !== '');

        $attachments = [];
        foreach ($email->getAttachments() as $part) {
            $headers = $part->getPreparedHeaders();
            $disposition = $headers->getHeaderParameter('Content-Disposition', 'filename');
            $attachment = [
                'filename' => $part->getFilename() ?? $disposition ?? 'attachment',
                'content' => base64_encode($part->getBody()),
                'contentType' => $part->getMediaType() . '/' . $part->getMediaSubtype(),
            ];
            if ($headers->has('Content-ID')) {
                $attachment['cid'] = trim($headers->get('Content-ID')->getBodyAsString(), '<>');
            }
            $attachments[] = $attachment;
        }
        if ($attachments) {
            $payload['attachments'] = $attachments;
        }

        $mailboxId = $this->resolveMailboxId($from?->getAddress());

        $response = Http::withToken($this->token)
            ->acceptJson()
            ->timeout(30)
            ->post("{$this->baseUrl}/api/v1/mailboxes/{$mailboxId}/send", $payload);

        if (! $response->successful()) {
            throw new TransportException($this->describeError('send', $response));
        }
    }

    /**
     * Use the configured mailbox ID, or look it up from /api/v1/me by matching
     * the From address (falls back to the first mailbox). Cached for a day.
     */
    private function resolveMailboxId(?string $fromAddress): string
    {
        if ($this->mailboxId) {
            return $this->mailboxId;
        }

        $cacheKey = 'hostinger_mailbox_id_' . sha1($this->token . '|' . strtolower((string) $fromAddress));

        return Cache::remember($cacheKey, now()->addDay(), function () use ($fromAddress) {
            $response = Http::withToken($this->token)
                ->acceptJson()
                ->timeout(20)
                ->get("{$this->baseUrl}/api/v1/me");

            if (! $response->successful()) {
                throw new TransportException($this->describeError('mailbox lookup', $response));
            }

            $mailboxes = $response->json('data.mailboxes') ?? [];
            if (! $mailboxes) {
                throw new TransportException('Hostinger Mail API: this token has no mailboxes it can send from.');
            }

            foreach ($mailboxes as $mb) {
                if ($fromAddress && strcasecmp($mb['address'] ?? '', $fromAddress) === 0) {
                    return $mb['resourceId'];
                }
            }

            return $mailboxes[0]['resourceId'];
        });
    }

    private function describeError(string $action, $response): string
    {
        $error = $response->json('error') ?? $response->body();
        $code = $response->json('code');

        return "Hostinger Mail API {$action} failed (HTTP {$response->status()}"
            . ($code ? ", {$code}" : '') . "): {$error}";
    }

    private function bodyToString($body): ?string
    {
        if ($body === null) {
            return null;
        }

        return is_resource($body) ? stream_get_contents($body) : (string) $body;
    }

    public function __toString(): string
    {
        return 'hostinger+api://' . parse_url($this->baseUrl, PHP_URL_HOST);
    }
}
