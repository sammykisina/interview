<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Auth;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Resources\UserResource;
use App\Services\AuthService;
use Illuminate\Http\Response;
use JustSteveKing\StatusCode\Http;

final class AuthController
{
    public function __construct(
        protected AuthService $authService,
    ) {}


    /**
     * @param LoginRequest $request
     * @return Response
     */
    public function login(LoginRequest $request): Response
    {
        $user = $this->authService->login(
            data: $request->validated(),
        );

        if ($user) {
            $token = $user->createToken(name: 'auth')->plainTextToken;

            return response(
                content: [
                    'user' => new UserResource($user),
                    'token' => $token,
                    'message' =>  __('auth.login_success') ,
                ],
                status: Http::OK(),
            );
        }

        return response(
            content: [
                'message' => __('auth.failed'),
            ],
            status: Http::UNAUTHORIZED(),
        );
    }

    /**
     * @param RegisterRequest $request
     * @return Response
     */
    public function register(RegisterRequest $request): Response
    {
        $user = $this->authService->register(
            data: $request->validated(),
        );

        $token = $user->createToken(name: 'auth')->plainTextToken;

        return response(
            content: [
                'user' => new UserResource($user),
                'token' => $token,
                'message' => __('auth.registration_success'),
            ],
            status: Http::CREATED(),
        );
    }
}
