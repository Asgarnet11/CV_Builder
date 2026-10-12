<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AiGenerateSummaryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array<string, array<int, string>>
     */
    public function rules(): array
    {
        return [
            'role' => ['required', 'string', 'max:255'],
            'experience_level' => ['nullable', 'string', 'in:fresh_graduate,entry,mid,senior'],
            'skills' => ['nullable', 'string', 'max:500'],
            'tone' => ['nullable', 'string', 'in:professional,executive,impactful,concise'],
            'language' => ['nullable', 'string', 'in:id,en'],
        ];
    }
}
