<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class CvProfileUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
        $this->merge([
            'show_education' => $this->has('show_education') ? $this->boolean('show_education') : false,
            'show_experience' => $this->has('show_experience') ? $this->boolean('show_experience') : false,
            'show_skills' => $this->has('show_skills') ? $this->boolean('show_skills') : false,
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'full_name' => ['required', 'string', 'max:255'],
            'headline' => ['nullable', 'string', 'max:255'],
            'phone' => ['nullable', 'string', 'max:20'],
            'email_cv' => ['nullable', 'email', 'max:255'],
            'address' => ['nullable', 'string'],
            'summary' => ['nullable', 'string'],
            'linkedin_url' => ['nullable', 'url'],
            'portfolio_url' => ['nullable', 'url'],
            'theme_color' => ['nullable', 'string', 'regex:/^#[a-fA-F0-9]{6}$/'],
            'show_education' => ['nullable', 'boolean'],
            'show_experience' => ['nullable', 'boolean'],
            'show_skills' => ['nullable', 'boolean'],
            'photo' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
        ];
    }
}
