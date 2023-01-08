<?php

namespace Tests\Feature;

use App\Mail\RegisterUserMail;
use Illuminate\Support\Facades\Mail;
use Database\Seeders\PrefectureSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RegisterControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * test show
     * 
     * @return void
     */
    public function testShow()
    {
        $response = $this->get('/register');
        $response->assertStatus(200);
    }

    /**
     * test confirm
     *
     * @return void
     */
    public function testConfirm()
    {
        $this->seed(PrefectureSeeder::class);

        // 実際にメールを送信しない
        Mail::fake();

        $response = $this->post('/register/confirm', [
            'RcyEjhgrjvQ9brh8aHQW' => '',
            'name' => '',
            'email' => '',
            'password' => '',
            'password_confirmation' => '',
            'tel' => '',
            'postcode' => '',
            'prefecture_id' => '',
            'address' => '',
            'building' => '',
        ]);
        $response->assertStatus(302)
            ->assertInvalid([
                "RcyEjhgrjvQ9brh8aHQW" => "お名前は必ず指定してください。",
                "email" => "メールアドレスは必ず指定してください。",
                "password" => "パスワードは必ず指定してください。",
                "tel" => "電話番号は必ず指定してください。",
                "postcode" => "郵便番号は必ず指定してください。",
                "prefecture_id" => "都道府県は必ず指定してください。",
                "address" => "住所（市区町村・番地）は必ず指定してください。",
                "kiyaku" => "利用規約に同意するは必ず指定してください。",
            ]);
        
        $response = $this->post('/register/confirm', [
            'RcyEjhgrjvQ9brh8aHQW' => '1234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456',
            'name' => 'ハニーポットチェック',
            'email' => 'aaa',
            'password' => 'abcdef',
            'password_confirmation' => 'abcdefg',
            'tel' => 'abcdefghigk',
            'postcode' => 'abcdefg',
            'prefecture_id' => 'aaa',
            'address' => '1234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456',
            'building' => '1234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456',
            'kiyaku' => 0,
        ]);
        $response->assertStatus(302)
            ->assertInvalid([
                "RcyEjhgrjvQ9brh8aHQW" => "お名前は、255文字以下で指定してください。",
                "name" => "nameは0文字で指定してください。",
                "email" => "メールアドレスには、有効なメールアドレスを指定してください。",
                "password" => "パスワードと、確認フィールドとが、一致していません。",
                "password" => "パスワードは、8文字以上で指定してください。",
                "tel" => "電話番号は数値で指定してください。",
                "tel" => "9桁から11桁の間で指定してください。",
                "postcode" => "郵便番号は数値で指定してください。",
                "postcode" => "郵便番号は7桁で指定してください。",
                "prefecture_id" => "選択された都道府県は正しくありません。",
                "address" => "住所（市区町村・番地）は、255文字以下で指定してください。",
                "building" => "住所（建物名・部屋番号）は、255文字以下で指定してください。",
                "kiyaku" => "利用規約に同意するを承認してください。",
            ]);
        $response = $this->post('/register/confirm', [
            'RcyEjhgrjvQ9brh8aHQW' => 'テスト太郎',
            'name' => '',
            'email' => 'test@redoit.tech',
            'password' => '123ABCabc!',
            'password_confirmation' => '123ABCabc!',
            'tel' => '08099009900',
            'postcode' => '1460082',
            'prefecture_id' => '13',
            'address' => '大田区池上99-1-1',
            'building' => '青空ビル101',
            'kiyaku' => 1,
        ]);
        $response->assertStatus(200);
    }

    /**
     * test complete
     *
     * @return void
     */
    public function testComplete()
    {
        $this->seed(PrefectureSeeder::class);

        // 実際にメールを送信しない
        Mail::fake();

        $response = $this->post('/register/complete', [
            'RcyEjhgrjvQ9brh8aHQW' => '',
            'name' => '',
            'email' => '',
            'password' => '',
            'password_confirmation' => '',
            'tel' => '',
            'postcode' => '',
            'prefecture_id' => '',
            'address' => '',
            'building' => '',
        ]);
        $response->assertStatus(302)
            ->assertInvalid([
                "RcyEjhgrjvQ9brh8aHQW" => "お名前は必ず指定してください。",
                "email" => "メールアドレスは必ず指定してください。",
                "password" => "パスワードは必ず指定してください。",
                "tel" => "電話番号は必ず指定してください。",
                "postcode" => "郵便番号は必ず指定してください。",
                "prefecture_id" => "都道府県は必ず指定してください。",
                "address" => "住所（市区町村・番地）は必ず指定してください。",
                "kiyaku" => "利用規約に同意するは必ず指定してください。",
            ]);
        
        $response = $this->post('/register/complete', [
            'RcyEjhgrjvQ9brh8aHQW' => '1234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456',
            'name' => 'ハニーポットチェック',
            'email' => 'aaa',
            'password' => 'abcdef',
            'password_confirmation' => 'abcdefg',
            'tel' => 'abcdefghigk',
            'postcode' => 'abcdefg',
            'prefecture_id' => 'aaa',
            'address' => '1234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456',
            'building' => '1234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456',
            'kiyaku' => 0,
        ]);
        $response->assertStatus(302)
            ->assertInvalid([
                "RcyEjhgrjvQ9brh8aHQW" => "お名前は、255文字以下で指定してください。",
                "name" => "nameは0文字で指定してください。",
                "email" => "メールアドレスには、有効なメールアドレスを指定してください。",
                "password" => "パスワードと、確認フィールドとが、一致していません。",
                "password" => "パスワードは、8文字以上で指定してください。",
                "tel" => "電話番号は数値で指定してください。",
                "tel" => "9桁から11桁の間で指定してください。",
                "postcode" => "郵便番号は数値で指定してください。",
                "postcode" => "郵便番号は7桁で指定してください。",
                "prefecture_id" => "選択された都道府県は正しくありません。",
                "address" => "住所（市区町村・番地）は、255文字以下で指定してください。",
                "building" => "住所（建物名・部屋番号）は、255文字以下で指定してください。",
                "kiyaku" => "利用規約に同意するを承認してください。",
            ]);

        $email = 'test@redoit.tech';
        $response = $this->post('/register/complete', [
            'RcyEjhgrjvQ9brh8aHQW' => 'テスト太郎',
            'name' => '',
            'email' => $email,
            'password' => '123ABCabc!',
            'password_confirmation' => '123ABCabc!',
            'tel' => '08099009900',
            'postcode' => '1460082',
            'prefecture_id' => '13',
            'address' => '大田区池上99-1-1',
            'building' => '青空ビル101',
            'kiyaku' => 1,
        ]);
        $response->assertStatus(200);

        $this->assertDatabaseHas('users', [
            'name' => 'テスト太郎',
            'email' => $email,
        ]);

        $this->assertDatabaseHas('profiles', [
            'tel' => '08099009900',
            'postcode' => '1460082',
            'prefecture_id' => '13',
            'address' => '大田区池上99-1-1',
            'building' => '青空ビル101',
        ]);

        // メールが queue に格納された 
        Mail::assertQueued(RegisterUserMail::class, function ($mail) use ($email) {
            return $mail->hasTo($email);
        });
    }
}
