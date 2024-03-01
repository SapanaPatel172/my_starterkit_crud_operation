<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmailTemplateRequest extends FormRequest
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
            'title' => 'required|string|max:255',
            'tags' => 'required|string|max:255',
            'template' => 'required|string',
            'slug' => 'required|unique:email_templates|string|max:255',
            'description' => 'string|max:255',
            'status' => 'required|in:active,inactive',
        ];
    }
}
