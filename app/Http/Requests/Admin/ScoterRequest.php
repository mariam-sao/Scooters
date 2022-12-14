<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ScoterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'scoter_number' => 'required',
            'floor' => 'max:2147483647|required|numeric',
            'description' => 'required',
            'category_id' => 'required|numeric',
            'price' => 'required|numeric',
            'capacity' => 'required|numeric'
        ];
    }
}
