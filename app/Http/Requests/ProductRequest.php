<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {

        return TRUE;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {

        $productCode = $this->input('product_code');
        $productCodeOld = $this->input('product_code_old');

        $isSame = $productCode === $productCodeOld;

        return [
            'product_name' => 'required',
            'product_description' => 'required',
            'product_code' => [
                'required',
                $isSame ? '' : \Illuminate\Validation\Rule::unique('products')->ignore($this->input('id')),
            ],
            'product_price_capital' => 'required|integer',
            'product_price_sell' => 'required|integer',
        ];
    }
}
