<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

final class AuthService
{
    /**
     * @param array $data
     * @return User
     */
    public function register(array $data): User
    {
        $user = User::create([
            'uuid' => Str::uuid(), // Uuid::uuid4()->toString(),
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        return $user;
    }

    /**
     * @param array $data
     * @return User|null
     */
    public function login(array $data): ?User
    {
        $user = User::query()->where('email', $data['email'])->first();

        if ($user && Hash::check(value: $data['password'], hashedValue: $user->password)) {
            return $user;
        }

        return null;
    }

    /**
     * @param string $email
     * @return User
     */
    public function getUserByEmail(string $email): User
    {
        return User::query()->where('email', $email)->first();
    }
}
