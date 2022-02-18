<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TicketRequest extends FormRequest
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
            'name' => ['required', Rule::unique('tickets')->where(function ($query) {
                $query->where('email', $this->email);  // nameとの複合ユニーク
            })],
            'email' => [
                'required', 'email',
            ],
            'tel' => ['required', 'regex:/^(0{1}\d{1,4}-{0,1}\d{1,4}-{0,1}\d{4})$/'],
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'name' => '氏名',
            'email' => 'メールアドレス',
            'tel' => '電話番号',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'required' => ':attributeは必須です',
            'unique' => "その:attributeは既に登録されています",
            'email' => ':attributeを正しく入力してください',
            'regex' => ':attributeを正しく入力してください',
        ];
    }
}
