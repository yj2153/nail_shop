<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditRequest extends FormRequest
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
            'avatar' => ['file', 'image'],
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'numeric', 'regex:/(01)[0-9]{9}/'],
        ];
    }
}
