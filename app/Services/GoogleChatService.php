<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class GoogleChatService
{
    protected string $webhookUrl;

    public function __construct()
    {
        $this->webhookUrl = config('services.google_chat.webhook_url');
    }

    /**
     * Google Chat にテキストメッセージを送信する
     */
    public function sendMessage(string $message): bool
    {
        $payload = [
            'text' => $message,
        ];

        try {
            $response = Http::post($this->webhookUrl, $payload);

            if (!$response->successful()) {
                Log::error('Google Chat送信失敗', [
                    'status' => $response->status(),
                    'body' => $response->body(),
                ]);
                return false;
            }

            return true;
        } catch (\Exception $e) {
            Log::error('Google Chat送信中に例外発生', [
                'message' => $e->getMessage(),
            ]);
            return false;
        }
    }
}
