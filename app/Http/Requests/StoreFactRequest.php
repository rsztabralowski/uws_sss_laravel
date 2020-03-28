<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Fact;

class StoreFactRequest extends FormRequest
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
            'description' => 'required',
            'fact_image' => 'image|required|max:1999'
        ];
    }
}
