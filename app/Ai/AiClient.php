<?php

namespace App\Ai;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;

/**
 * Chat completions on MudahCloud's AI Gateway (OpenAI compatible), with the key and model the
 * container was started with. Usage is paid from the owner's AI credit at MudahCloud.
 */
class AiClient
{
    public function enabled(): bool
    {
        return filled(config('compro.ai.base_url')) && filled(config('compro.ai.api_key'));
    }

    public function model(): string
    {
        return (string) config('compro.ai.model');
    }

    /**
     * The assistant's reply text.
     *
     * @param  list<array{role: string, content: string}>  $messages
     */
    public function chat(array $messages, int $maxTokens = 6000): string
    {
        if (! $this->enabled()) {
            throw new AiException('Asisten AI belum tersambung ke AI Gateway.');
        }

        try {
            $response = Http::withToken((string) config('compro.ai.api_key'))
                ->acceptJson()
                ->timeout(120)
                ->post(rtrim((string) config('compro.ai.base_url'), '/').'/chat/completions', [
                    'model' => $this->model(),
                    'messages' => $messages,
                    'max_tokens' => $maxTokens,
                    'temperature' => 0.6,
                    'response_format' => ['type' => 'json_object'],
                ]);
        } catch (ConnectionException) {
            throw new AiException('AI Gateway tidak bisa dihubungi. Coba lagi sebentar lagi.');
        }

        if ($response->failed()) {
            throw new AiException(match ($response->status()) {
                401, 403 => 'Kunci AI Gateway ditolak. Hubungi MudahCloud untuk memeriksanya.',
                402 => 'Kredit AI Anda habis. Isi ulang kredit AI di MudahCloud lalu coba lagi.',
                429 => 'Terlalu banyak permintaan ke AI. Tunggu sebentar lalu coba lagi.',
                default => 'AI Gateway sedang bermasalah (HTTP '.$response->status().'). Coba lagi nanti.',
            });
        }

        $text = $response->json('choices.0.message.content');

        if (! is_string($text) || trim($text) === '') {
            throw new AiException('AI tidak memberi jawaban. Coba ulangi permintaan Anda.');
        }

        return $text;
    }
}
