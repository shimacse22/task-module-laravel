<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTaskRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Allow all users or implement auth logic
    }

    public function rules(): array
    {
        return [
            'tasks'            => 'required|array|min:1',
            'tasks.*.title'    => 'required|string|max:255',
            'tasks.*.description' => 'nullable|string',
        ];
    }

    public function messages(): array
    {
        return [
            'tasks.required' => 'You must provide at least one task.',
            'tasks.*.title.required' => 'Each task must have a title.',
        ];
    }
}
