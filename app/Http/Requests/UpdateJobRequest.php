<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Job;


class UpdateJobRequest extends FormRequest
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
            'title' => [ 'string'],
            'description' => ['string'],
            'salary' => ['integer'],
            'city_id' => ['exists:cities,id'],
            'country_id'=>['exists:countries,id'],
            'category_id' => ['exists:categories,id'],
            'type' => ['in:full time,part time,contract,freelance,remote'],
            'datePosted' => ['date'],
            'user_id' => ['exists:users,id'],
            'status' => ['in:draft,publish,closed'],
        ];
    }
}
