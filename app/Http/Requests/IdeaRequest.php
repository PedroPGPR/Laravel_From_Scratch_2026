<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class IdeaRequest extends FormRequest
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
            'idea' => ['required', 'min:5'],
        ];
    }

    public function messages(): array
    {
        return [
            'idea.required' => 'You must provide an idea.',
            'idea.min' => 'Sure your idea is good, but it must be at least :min characters long.',
        ];
    }
}
