<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreInterviewRequest extends FormRequest
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
            'application_id' => 'required|exists:applications,id',
            'seeker_id' => 'required|exists:users,id',
            'specialist_id' => 'required|exists:users,id',
            'date_from' => 'required|date',
            'date_to' => 'required|date|after:date_from',
            'location' => 'required|string',
            'status' => 'required|in:strong-hire,wait-list,short-list,rejected',
        ];
    }
}
