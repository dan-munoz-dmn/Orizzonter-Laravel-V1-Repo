<?php

namespace App\Http\Requests\Profile;

use Illuminate\Foundation\Http\FormRequest;

class StoreProfileRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'user_id' => ['required', 'exists:users,id', 'unique:profiles,user_id'],
            
            'nickname' => ['required', 'string', 'max:255', 'unique:profiles,nickname'],

            'gender' => ['required', 'string', 'in:male,female,other'],

            'description' => ['nullable', 'string'],
            'cyclist_type' => ['nullable', 'string'],
            'achievements' => ['nullable', 'array'],
        ];
    }
}
