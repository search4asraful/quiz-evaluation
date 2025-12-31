<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TestStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string',
            'starts_at' => 'required|date',
            'ends_at' => 'required|date|after:starts_at',
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'title.required' => 'The title field is required.',
            'starts_at.required' => 'The start date and time is required.',
            'ends_at.required' => 'The end date and time is required.',
            'ends_at.after' => 'The end date and time must be after the start date and time.',
        ];
    }
}
