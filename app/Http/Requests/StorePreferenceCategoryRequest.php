<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePreferenceCategoryRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'user_id' => 'required|exists:users,id',
            'category_id' => 'required|exists:categories,id',
        ];
    }
}