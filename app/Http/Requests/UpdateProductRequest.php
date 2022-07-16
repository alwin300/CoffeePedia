<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
{
  
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'nama' => 'required|string',
            'jenis' => 'required|string',
            'asal' => 'required|string',
            'harga' => 'required|string',
            'stok' => 'required|numeric',
            'berat' => 'required|numeric',
            'deskripsi' => 'required|string',
            'diskon' => 'numeric|between:1,100|nullable',
            'image' => 'nullable|image'
        ];
    }

    protected function prepareForValidation()
    {
        
        $this->merge([
            'total' => $this->harga - ($this->harga * $this->diskon/100),
        ]);
    }
}
