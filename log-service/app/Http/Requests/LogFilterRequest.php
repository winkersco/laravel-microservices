<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LogFilterRequest extends FormRequest
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
            'service_name' => [
                'required',
                'string',
                'max:255'
            ],
            'limit' => [
                'nullable',
                'integer',
                'between:1,100',
            ],
            'filters.identifier' => [
                'nullable',
                'string',
                'max:255'
            ],
            'filters.type' => [
                'nullable',
                'string',
                'max:255'
            ],
            'filters.level' => [
                'nullable',
                'string',
            ],
        ];
    }
}
