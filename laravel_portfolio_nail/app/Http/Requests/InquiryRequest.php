<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InquiryRequest extends FormRequest
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
            'qna-name' => ['required', 'string', 'max:255'],
            'qna-description' => ['required', 'string', 'max:2000'],
            'qna-secret' => ['max:4'],
        ];
    }
}
