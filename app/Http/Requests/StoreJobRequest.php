<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreJobRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function prepareForValidation()
    {
        $this->merge(
            ['user_id' => $this->user()->id]
        );
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['required', 'string'],
            'description' => ['required', 'string'],
            'salary' => ['required', 'numeric'],
            'city_id' => ['required', 'exists:cities,id'],
            'country_id' => ['required', 'exists:countries,id'],
            'category_id' => ['required', 'exists:categories,id'],
            'type' => ['required', 'in:full time,part time,contract,freelance,remote'],
            'datePosted' => ['required', 'date'],
            'user_id' => ['required', 'exists:users,id'],
            'status' => ['required', 'in:draft,publish,closed'],
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