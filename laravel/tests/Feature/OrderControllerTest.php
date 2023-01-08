<?php

namespace Tests\Feature;

use App\Mail\OrderMail;
use App\Models\Admin;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\Mail;

class OrderControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testIndex()
    {
        $this->seed();

        $admin = Admin::first();
        $response = $this->actingAs($admin, 'admin')->get('/admin/dashboard');
        $response->assertStatus(200);
    }

    /**
     * test show
     * 
     * @return void
     */
    public function testShow()
    {
        $this->seed();

        $product = Product::first();
        $response = $this->get('/order/'.$product->id);
        $response->assertStatus(200);
    }

    /**
     * test confirm
     *
     * @return void
     */
    public function testConfirm()
    {
        $this->seed();

        // 実際にメールを送信しない
        Mail::fake();

        $response = $this->post('/order/confirm', [
            'ibTEcJ8uRTVsKCWrtW7R' => '',
            'name' => '',
            'email' => '',
            'password' => '',
            'password_confirmation' => '',
            'tel' => '',
            'postcode' => '',
            'prefecture_id' => '',
            'address' => '',
            'building' => '',
            'payment' => '',
            'product_id' => '',
            'orders' => '',
        ]);
        $response->assertStatus(302)
            ->assertInvalid([
                "ibTEcJ8uRTVsKCWrtW7R" => "お名前は必ず指定してください。",
                "email" => "メールアドレスは必ず指定してください。",
                "password" => "パスワードは必ず指定してください。",
                "tel" => "電話番号は必ず指定してください。",
                "postcode" => "郵便番号は必ず指定してください。",
                "prefecture_id" => "都道府県は必ず指定してください。",
                "address" => "住所（市区町村・番地）は必ず指定してください。",
                "kiyaku" => "利用規約に同意するは必ず指定してください。",
                "product_id" => "商品は必ず指定してください。",
                "orders" => "購入点数は必ず指定してください。",
                "payment" => "支払方法は必ず指定してください。",
            ]);
        
        $response = $this->post('/order/confirm', [
            'ibTEcJ8uRTVsKCWrtW7R' => '1234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456',
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
            'payment' => 'aaa',
            'product_id' => Product::first()->id,
            'orders' => 'aaa',
        ]);
        $response->assertStatus(302)
            ->assertInvalid([
                "ibTEcJ8uRTVsKCWrtW7R" => "お名前は、255文字以下で指定してください。",
                "name" => "nameは0文字で指定してください。",
                "email" => "メールアドレスには、有効なメールアドレスを指定してください。",
                "password" => "パスワードと、確認フィールドとが、一致していません。",
                "password" => "パスワードは、8文字以上で指定してください。",
                "tel" => "電話番号には、数字を指定してください。",
                "tel" => "9桁から11桁の間で指定してください。",
                "postcode" => "郵便番号には、数字を指定してください。",
                "postcode" => "郵便番号は7桁で指定してください。",
                "prefecture_id" => "選択された都道府県は正しくありません。",
                "address" => "住所（市区町村・番地）は、255文字以下で指定してください。",
                "building" => "住所（建物名・部屋番号）は、255文字以下で指定してください。",
                "kiyaku" => "利用規約に同意するを承認してください。",
                "orders" => "購入点数は整数で指定してください。",
                'payment' => "選択された支払方法は正しくありません。",
            ]);
        $response = $this->post('/order/confirm', [
            'ibTEcJ8uRTVsKCWrtW7R' => 'テスト太郎',
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
            'payment' => 'bank',
            'product_id' => Product::first()->id,
            'orders' => 1,
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
        $this->seed();

        // 実際にメールを送信しない
        Mail::fake();

        $response = $this->post('/order/complete', [
            'ibTEcJ8uRTVsKCWrtW7R' => '',
            'name' => '',
            'email' => '',
            'password' => '',
            'password_confirmation' => '',
            'tel' => '',
            'postcode' => '',
            'prefecture_id' => '',
            'address' => '',
            'building' => '',
            'payment' => '',
            'product_id' => '',
            'orders' => '',
        ]);
        $response->assertStatus(302)
            ->assertInvalid([
                "ibTEcJ8uRTVsKCWrtW7R" => "お名前は必ず指定してください。",
                "email" => "メールアドレスは必ず指定してください。",
                "password" => "パスワードは必ず指定してください。",
                "tel" => "電話番号は必ず指定してください。",
                "postcode" => "郵便番号は必ず指定してください。",
                "prefecture_id" => "都道府県は必ず指定してください。",
                "address" => "住所（市区町村・番地）は必ず指定してください。",
                "kiyaku" => "利用規約に同意するは必ず指定してください。",
            ]);
        
        $response = $this->post('/order/complete', [
            'ibTEcJ8uRTVsKCWrtW7R' => '1234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456',
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
            'payment' => 'aaa',
            'product_id' => Product::first()->id,
            'orders' => 'aaa',
        ]);
        $response->assertStatus(302)
            ->assertInvalid([
                "ibTEcJ8uRTVsKCWrtW7R" => "お名前は、255文字以下で指定してください。",
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
        $response = $this->post('/order/complete', [
            'ibTEcJ8uRTVsKCWrtW7R' => 'テスト太郎',
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
            'payment' => 'bank',
            'product_id' => Product::first()->id,
            'orders' => 1,
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
        Mail::assertQueued(OrderMail::class, function ($mail) use ($email) {
            return $mail->hasTo($email);
        });
    }
}
