<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateOfferRequest extends FormRequest
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
            'interview_id' => 'exists:interviews,id',
            'seeker_id' => 'exists:users,id',
            'specialist_id' => 'exists:users,id',
            'status' => 'in:sent,accepted,rejected',
            'salary' => 'numeric|min:0',
            'startdate' => 'date',
            'expiredate' => 'date',
            'employment_type' => 'in:full time,part time,contract,freelance,remote',

        ];
    }
}
