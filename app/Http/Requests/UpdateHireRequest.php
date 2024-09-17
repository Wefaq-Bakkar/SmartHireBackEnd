<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateHireRequest extends FormRequest
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
            'offer_id' => 'exists:offers,id',
            'job_id' => 'exists:jobs,id',
            'specialist_id' => 'exists:users,id',
            'seeker_id' => 'exists:users,id',
            'start_date' => 'date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'salary' => 'numeric|min:0',
            'employment_type' => 'in:full time,part time,contract,freelance,remote',
        ];
    }

    /**
     * Get the custom validation messages.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'salary.numeric' => 'The salary must be a number.',
        ];
    }
}