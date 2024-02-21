<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TransactionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $totalHarga = $this->input('total_harga');
        $totalUang = $this->input('total_uang');

        if ($totalHarga > $totalUang) {
            return false;
        }

        return TRUE;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'nama_barang' => 'required',
            'product_code' => 'required',
            'jlh_barang' => 'required|numeric|min:0',
            'total_harga' => 'required|numeric|min:0',
            'kembalian' => 'required|numeric|min:0',
        ];
    }

    protected function failedAuthorization()
    {
        throw new \Illuminate\Auth\Access\AuthorizationException('Uang tidak cukup untuk membayar total harga.');
    }
}
