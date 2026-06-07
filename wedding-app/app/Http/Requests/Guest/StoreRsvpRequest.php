<?php

namespace App\Http\Requests\Guest;

use App\Enums\RsvpStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class StoreRsvpRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'status'           => ['required', new Enum(RsvpStatus::class)],
            'actual_attendees' => ['required', 'integer', 'min:1', 'max:10'],
            'message'          => ['nullable', 'string', 'max:500'],
        ];
    }
}
