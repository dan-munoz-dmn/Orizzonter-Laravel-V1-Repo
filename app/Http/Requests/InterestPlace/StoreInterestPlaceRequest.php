<?php

namespace App\Http\Requests\InterestPlace;

use Illuminate\Foundation\Http\FormRequest;

class StoreInterestPlaceRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'latitude' => ['required', 'numeric', 'between:-90,90'],
            'longitude' => ['required', 'numeric', 'between:-180,180'],
            'category' => ['required', 'string', 'max:255'],
        ];
    }
}
