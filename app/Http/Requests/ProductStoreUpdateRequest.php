<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductStoreUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // sem validação de rotas
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = null;
        if (request()->isMethod('post')) {
            $rules =
            [
                'name' => 'required|string|unique:products',
                'price' => 'required|numeric',
                'description' => 'required|string',
                'category' => 'required|string',
                'image_url' => 'string'
            ];
        } elseif (request()->isMethod('PUT') || request()->isMethod('PATCH')) {
            $rules =
            [
                'name' => 'string|unique:products',
                'price' => 'numeric',
                'description' => 'string',
                'category' => 'string',
                'image_url' => 'string'
            ];
        }

        return $rules;
    }
}
