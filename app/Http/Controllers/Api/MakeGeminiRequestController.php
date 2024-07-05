<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Requests\GeminiRequest;
use App\Services\GeminiService;
use Exception;
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
            $result = $this->geminiService->ChatWithGemini(
                prompt: $request->validated()['prompt'],
            );

            /**
             * process the response if any returned
             */
            if ($result) {
                return [
                    'response' => $result->text(),
                    'status' => Http::OK(),
                    'message' => 'Request processed successfully',
                ];
            }
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
