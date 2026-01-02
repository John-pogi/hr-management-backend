<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreIrregEmployeeScheduleRequest extends FormRequest
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
            'schedule_id' => 'required|exists:schedules,id',
            'employees' => 'required|array|min:1',
            'employees.*' => 'required|exists:employees,id',
            'date' => 'required|date_format:Y-m'
        ];
    }

    public function messages(): array
    {
        return [
            'schedule_id.required' => 'Schedule selection is required.',
            'schedule_id.exists' => 'Selected schedule does not exist.',
            'employees.required' => 'At least one employee must be selected.',
            'employees.array' => 'Employees must be an array.',
            'employees.min' => 'Select at least one employee.',
            'employees.*.required' => 'Each employee ID is required.',
            'employees.*.exists' => 'One or more selected employees do not exist.',
            'date.required' => 'Date (YYYY-MM) is required.',
            'date.date_format' => 'Date must be in YYYY-MM format (e.g., 2026-01).',
        ];
    }

}
