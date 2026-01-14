<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;
use Twilio\Rest\Client;

class WhatsAppService
{
    public function __construct(
        private readonly ?string $accountSid = null,
        private readonly ?string $authToken = null,
        private readonly ?string $fromNumber = null,
    ) {
        $this->accountSid ??= config('services.twilio.sid');
        $this->authToken ??= config('services.twilio.token');
        $this->fromNumber ??= config('services.twilio.whatsapp_from');
    }

    public function send(string $to, string $message): void
    {
        if (!$this->accountSid || !$this->authToken || !$this->fromNumber) {
            Log::warning('Twilio credentials missing, WhatsApp message skipped', compact('to'));

            return;
        }

        $client = new Client($this->accountSid, $this->authToken);

        $client->messages->create(
            "whatsapp:{$to}",
            [
                'from' => "whatsapp:{$this->fromNumber}",
                'body' => $message,
            ],
        );
    }
}
