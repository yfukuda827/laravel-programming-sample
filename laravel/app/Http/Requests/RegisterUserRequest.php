<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class RegisterUserRequest extends FormRequest
{
    protected $redirect = '/register';

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
            'RcyEjhgrjvQ9brh8aHQW' => 'required|max:255', // name
            'name' => 'present|size:0', // ハニーポット
            'email' => 'required|email:rfc|unique:users',
            'password' => ['required', 'confirmed', Password::min(8)->mixedCase()->numbers()],
            'tel' => 'required|numeric|digits_between:9,11',
            'postcode' => 'required|numeric|digits:7',
            'prefecture_id' => 'required|exists:prefectures,id',
            'address' => 'required|max:255',
            'building' => 'max:255',
            'kiyaku' => 'required|accepted',
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
            'password.mixed' => 'パスワードは半角英字の大文字と小文字、半角数字を少なくとも1つずつ含める必要があります。',
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
            'RcyEjhgrjvQ9brh8aHQW' => 'お名前',
            'email' => 'メールアドレス',
            'password' => 'パスワード',
            'tel' => '電話番号',
            'postcode' => '郵便番号',
            'prefecture_id' => '都道府県',
            'address' => '住所（市区町村・番地）',
            'building' => '住所（建物名・部屋番号）',
            'kiyaku' => '利用規約に同意する',
        ];
    }
}
