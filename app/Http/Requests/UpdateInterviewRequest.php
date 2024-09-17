<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateInterviewRequest extends FormRequest
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
            'application_id' => 'exists:applications,id',
            'seeker_id' => 'exists:users,id',
            'specialist_id' => 'exists:users,id',
            'date_from' => 'date',
            'date_to' => 'date|after:date_from',
            'location' => 'string',
            'status' => 'in:strong-hire,wait-list,short-list,rejected',
        ];
    }
}
