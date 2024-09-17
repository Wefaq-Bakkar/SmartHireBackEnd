<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOfferRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // Adjust the authorization logic based on your application's requirements
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'interview_id' => 'required|exists:interviews,id',
            'seeker_id' => 'required|exists:users,id',
            'specialist_id' => 'required|exists:users,id',
            'status' => 'required|in:sent,accepted,rejected',
            'salary' => 'required|numeric|min:0',
            'startdate' => 'required|date',
            'expiredate' => 'required|date',
            'employment_type' => 'required|in:full time,part time,contract,freelance,remote',
        ];
    }
}