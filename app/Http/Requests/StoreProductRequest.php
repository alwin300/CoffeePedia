<?php

namespace App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
            'nama' => 'required|string',
            'jenis' => 'required|string',
            'asal' => 'required|string',
            'harga' => 'required|numeric',
            'stok' => 'required|numeric',
            'berat' => 'required|numeric',
            'deskripsi' => 'required|string',
            'diskon' => 'nullable|numeric|between:1,100',
            'image' => 'required|image|file',
        ];
    }
    protected function prepareForValidation()
    {
        $this->merge([
            'user_id' => Auth::user()->id,
			'username' => Auth::user()->username,
            'total' => $this->harga - ($this->harga * $this->diskon/100),
        ]);
    }
}
