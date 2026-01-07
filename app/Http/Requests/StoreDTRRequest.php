<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDTRRequest extends FormRequest
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
            'dtr' => 'required|array|min:1',
            'dtr.*.employee_number' => 'required|exists:employees,employee_number',
            'dtr.*.type' => 'required|string',
            'dtr.*.date' => 'required|date_format:Y-m-d',
            'dtr.*.time' => 'required|date_format:H:i:s',
        ];
    }
}
