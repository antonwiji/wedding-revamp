<?php

namespace App\Http\Requests\Admin;

use App\Enums\GuestCategory;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class StoreGuestRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'          => ['required', 'string', 'max:255'],
            'phone'         => ['nullable', 'string', 'max:20'],
            'email'         => ['nullable', 'email', 'max:255'],
            'category'      => ['required', new Enum(GuestCategory::class)],
            'max_attendees' => ['required', 'integer', 'min:1', 'max:10'],
        ];
    }
}
