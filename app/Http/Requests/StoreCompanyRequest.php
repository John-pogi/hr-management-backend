<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCompanyRequest extends FormRequest
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
            'companies' => 'required|array|min:1',
            'companies.name.*' => 'required|string|max:255',
            'companies.code.*' => 'required|string|max:255',
            'companies.logo.*' => 'nullable|string|max:255',
        ];
    }

    protected function prepareForValidation()
    {
        $companies = $this->input('companies');

        foreach ($companies as $index => &$company) {
            if (!isset($company['logo'])) {
                $company['logo'] = null;
            }
        }
        
        $this->merge(['companies' => $companies]);
    }
}
