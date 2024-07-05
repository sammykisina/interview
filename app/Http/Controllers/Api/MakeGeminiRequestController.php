<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Requests\GeminiRequest;
use App\Services\GeminiService;
use Exception;
use Illuminate\Support\Facades\RateLimiter;
use JustSteveKing\StatusCode\Http;

final class MakeGeminiRequestController
{
    public function __construct(
        protected GeminiService $geminiService,
    ) {}


    public function __invoke(GeminiRequest $request)
    {
        try {
            /**
             * send an external api request
             */

            // $executed = RateLimiter::attempt(
            //     'chat-with-gemini:',
            //     $perMinute = 5,
            //     function (): void {},
            // );

            // if ( ! $executed) {
            //     return 'Too many messages sent!';
            // }

            $results = $this->geminiService->ChatWithGemini(
                prompt: $request->validated()['prompt'],
            );

             if ($results) {
                return [
                    'response' => $results->text(),
                    'status' => Http::OK(),
                    'message' => 'Request processed successfully',
                ];
            }
            /**
             * process the response if any returned
             */

        } catch (Exception $e) {
            /**
             * handle general exceptions
             */
            return [
                'message' => $e->getMessage(),
                'status' => Http::UNPROCESSABLE_ENTITY(),
                // 'status_code' => $e->getCode(),
            ];
        }
    }
}
