<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateApplicationRequest extends FormRequest
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
            'job_id' => 'exists:jobs,id',
            'seeker_id' => 'exists:users,id',
            'specialist_id' => 'exists:users,id',
            'application_status' => 'in:screening,in-review,interview-scheduled,on-hold,rejected,offered,offer-accepted,offer-declined,hired',
            'Matching_percentage' => 'numeric',
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
            'Matching_percentage.numeric' => 'The matching percentage must be a number.',
         "application_status"=>"The application status must be one of the following: screening, in-review, interview-scheduled, on-hold, rejected, offered, offer-accepted, offer-declined, hired"
        ];
    }
}