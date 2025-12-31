<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class QuestionStoreRequest extends FormRequest
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
            'question_text' => 'required',
            'marks' => 'required|integer|min:1',
            'options.*.text' => 'required',
            'correct_options' => 'required|array|min:1'
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
            'question_text.required' => 'The question text field is required.',
            'marks.required' => 'The marks field is required.',
            'marks.integer' => 'The marks field must be an integer.',
            'marks.min' => 'The marks field must be at least 1.',
            'options.*.text.required' => 'All option texts are required.',
            'correct_options.required' => 'At least one correct option must be selected.',
            'correct_options.array' => 'The correct options must be an array.',
            'correct_options.min' => 'At least one correct option must be selected.',
        ];
    }
}
