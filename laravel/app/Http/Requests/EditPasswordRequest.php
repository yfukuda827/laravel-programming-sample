<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class EditPasswordRequest extends FormRequest
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
            'password' => ['required', Password::min(8)->mixedCase()->numbers()],
            'new_password' => ['required', 'confirmed', Password::min(8)->mixedCase()->numbers()],
        ];
    }

    /**
     * 定義済みバリデーションルールのエラーメッセージ取得
     *
     * @return array
     */
    public function messages()
    {
        return [
            'password.mixed' => '現在のパスワードは半角英字の大文字と小文字、半角数字を少なくとも1つずつ含める必要があります。',
            'new_password.mixed' => '新しいパスワードは半角英字の大文字と小文字、半角数字を少なくとも1つずつ含める必要があります。',
        ];
    }

    /**
     * バリデーションエラーのカスタム属性の取得
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'password' => '現在のパスワード',
            'new_password' => '新しいパスワード',
        ];
    }
}
