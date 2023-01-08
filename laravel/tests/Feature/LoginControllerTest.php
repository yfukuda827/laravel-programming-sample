<?php

namespace Tests\Feature;

use App\Mail\RegisterUserMail;
use Database\Seeders\AdminSeeder;
use Illuminate\Support\Facades\Mail;
use Database\Seeders\PrefectureSeeder;
use Database\Seeders\UserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LoginControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * login
     *
     * @return void
     */
    public function testLogin()
    {
        $this->seed(UserSeeder::class);

        $response = $this->get('/login');
        $response->assertStatus(200);

        $response = $this->post('/login', [
            'email' => '',
            'password' => '',
        ]);
        $response->assertStatus(302)
            ->assertInvalid([
                "email" => "メールアドレスは必ず指定してください。",
                "password" => "パスワードは必ず指定してください。",
            ]);
    
        $response = $this->post('/login', [
            'email' => 'test@test.jp',
            'password' => 'aaa',
        ]);
        $response->assertStatus(302)
            ->assertInvalid([
                "email" => "ログイン情報が登録されていません。",
            ]);
 
        $response = $this->post('/login', [
            'email' => 'user_test@redoit.tech',
            'password' => 'password',
        ]);
        $response->assertStatus(302)
            ->assertRedirect('/mypage');
    }

    /**
     * admin login
     *
     * @return void
     */
    public function testAdminLogin()
    {
        $this->seed(AdminSeeder::class);

        $response = $this->get('/login/admin');
        $response->assertStatus(200);

        $response = $this->post('/login/admin', [
            'email' => '',
            'password' => '',
        ]);
        $response->assertStatus(302)
            ->assertInvalid([
                "email" => "メールアドレスは必ず指定してください。",
                "password" => "パスワードは必ず指定してください。",
            ]);

        $response = $this->post('/login/admin', [
            'email' => 'test@test.jp',
            'password' => 'aaa',
        ]);
        $response->assertStatus(302)
            ->assertInvalid([
                "password" => "パスワードは、8文字以上で指定してください。",
            ]);
 
        $response = $this->post('/login/admin', [
            'email' => 'admin_test@redoit.tech',
            'password' => 'password',
        ]);
        $response->assertStatus(302)
            ->assertRedirect('/admin/dashboard');
    }
}
