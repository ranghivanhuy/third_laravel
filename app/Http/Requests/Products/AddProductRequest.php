<?php

namespace App\Http\Requests\Products;

use Illuminate\Foundation\Http\FormRequest;

class AddProductRequest extends FormRequest
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
            'price' => 'required | numeric',
            'image' => 'required',
            'photo' => 'required',
            'description' => 'required',
            'category_id' => 'required'
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
            'price.numeric' => 'Price must be number',
            'image.required' => 'Image has not been selected',
            'photo.required' => 'Product photo has not been selected',
            'description.required' => 'Description cannot be blank',
            'category_id.required' => 'Please tick category of product'
        ];
    }
}
