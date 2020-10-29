<?php

namespace App\Http\Requests\Products;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
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
            'category_id' => 'required',
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
            'price.reuired' => 'Price cannot be blank',
            'price.mumeric' => 'Price must be number type',
            'description.required' => 'Description cannot be blank' 
        ];
    }
}
