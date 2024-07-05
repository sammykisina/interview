<?php

declare(strict_types=1);

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

final class RegisterRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                'max:255',
            ],
            'email' => [
                'required',
                'email',
                'unique:users',
            ],
            'password' => [
                'required',
                'min:6',
                'max:255',
            ],
        ];
    }
}
