<?php

namespace App\Http\Requests\Products;

use Illuminate\Foundation\Http\FormRequest;

class AddRequest extends FormRequest
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
            'name' => 'required',
            'price' => 'required',
            'image' => 'required | mimes:jpeg,jpg,png,svg',
            'description' => 'required'
        ];
    }
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => 'Name cannot be blank',
            'price.required' => 'Price cannot be blank',
            'image.required' => 'Image cannot be blank',
            'image.mines' => 'Image is invalid format',
            'description.required' => 'Description cannot be blank'
        ];
    }
}
