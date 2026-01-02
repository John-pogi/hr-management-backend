<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateScheduleRequest extends FormRequest
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
                'shift' => 'required|array|min:1',
                'shift.*.week' => 'required|integer|min:1|max:5',
                'shift.*.start' => 'required|date_format:H:i:s',
                'shift.*.end' => 'required|date_format:H:i:s',
                'shift.*.day_of_week' => 'required|array|min:1|max:7',
                'shift.*.day_of_week.*' => 'required|string|in:Mon,Tue,Wed,Thu,Fri,Sat,Sun',
            ];
    }
}
