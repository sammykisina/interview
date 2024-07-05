<?php

declare(strict_types=1);

namespace App\Services;

use Gemini\Laravel\Facades\Gemini;
use Gemini\Responses\GenerativeModel\GenerateContentResponse;

final class GeminiService
{
    /**
     * communicate with gemini AI API
     */
    public function ChatWithGemini(string $prompt): GenerateContentResponse
    {
        return Gemini::geminiPro()->generateContent($prompt);
    }
}
