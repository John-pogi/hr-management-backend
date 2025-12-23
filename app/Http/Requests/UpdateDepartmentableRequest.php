<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDepartmentableRequest extends FormRequest
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
            'companies' => 'sometimes|array',
            'companies.*.company_id' => 'sometimes|exists:companies,id',
            'remove_companies' => 'sometimes|array',
            'remove_companies.*.company_id' => 'sometimes|exists:companies,id',
        ];
    }

    protected function prepareForValidation()
    {
        $this->mergeIfMissing([
            'companies' => [], 
            'remove_companies' => [],
        ]);
    }
}
