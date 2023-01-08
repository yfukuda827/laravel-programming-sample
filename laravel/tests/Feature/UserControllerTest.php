<?php

namespace Tests\Feature;

use App\Mail\EditPasswordMail;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\Mail;

class UserControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * test my page
     *
     * @return void
     */
    public function testMypage()
    {
        $this->seed();

        $user = User::where('email', 'user_test@redoit.tech')->first();
        $response = $this->actingAs($user)->get('/mypage');
        $response->assertStatus(200);
    }

    /**
     * test show edit password
     *
     * @return void
     */
    public function testShowEditPassword()
    {
        $this->seed();

        $user = User::where('email', 'user_test@redoit.tech')->first();
        $response = $this->actingAs($user)->get('/mypage/edit-password');
        $response->assertStatus(200);
    }

    /**
     * test complete
     *
     * @return void
     */
    public function testEditPasswordComplete()
    {
        $this->seed();

        $user = User::where('email', 'user_test2@redoit.tech')->first();
 
        // 実際にメールを送信しない
        Mail::fake();

        $response = $this->actingAs($user)->post('/mypage/edit-password/complete', [
            'password' => '',
            'new_password' => '',
            'new_password_confirmation' => '',
        ]);
        $response->assertStatus(302)
            ->assertInvalid([
                "password" => "現在のパスワードは必ず指定してください。",
                "new_password" => "新しいパスワードは必ず指定してください。",
            ]);

        $response = $this->actingAs($user)->post('/mypage/edit-password/complete', [
            'password' => '123abcABC',
            'new_password' => 'kxb8rav-taj9pxm8EVM',
            'new_password_confirmation' => 'aaa',
        ]);
        $response->assertStatus(302)
            ->assertInvalid([
                "new_password" => "新しいパスワードと、確認フィールドとが、一致していません。",
            ]);

        $response = $this->actingAs($user)->post('/mypage/edit-password/complete', [
            'password' => '123abcABC',
            'new_password' => 'kxb8rav-taj9pxm8EVM',
            'new_password_confirmation' => 'kxb8rav-taj9pxm8EVM',
        ]);
        $response->assertStatus(302)
            ->assertRedirect('/mypage');

        // メールが queue に格納された 
        $email = 'user_test2@redoit.tech';
        Mail::assertQueued(EditPasswordMail::class, function ($mail) use ($email) {
            return $mail->hasTo($email);
        });
    }
}
