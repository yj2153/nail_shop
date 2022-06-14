<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ItemRequest extends FormRequest
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
            'sell-name' => ['required', 'string', 'max:255'],
            // 'sell-image'  => ['file', 'image'],
            'sell-description' => ['required', 'string', 'max:2000'],
            'sell-category' => ['required', 'integer'],
            'sell-price' => ['required', 'integer', 'min:10', 'max:9999999'],
        ];
    }
}
