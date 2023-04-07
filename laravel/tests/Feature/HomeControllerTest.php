<?php

namespace Tests\Feature;

use App\Mail\OrderMail;
use App\Models\Admin;
use App\Models\Order;
use App\Models\Postcode;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\Mail;

class HomeControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * test postcode 
     *
     * @return void
     */
    public function testPostcode()
    {
        $this->seed();

        // 実際にメールを送信しない
        Mail::fake();

        $response = $this->post('/postcode', [
            'postcode' => '',
        ]);
        $response->assertStatus(302)
            ->assertInvalid([
                "postcode" => "郵便番号は必ず指定してください。",
            ]);

        $response = $this->post('/postcode', [
            'postcode' => '12345678',
        ]);
        $response->assertStatus(302)
            ->assertInvalid([
                "postcode" => "郵便番号は7桁で指定してください。",
            ]);
        
        $response = $this->post('/postcode', [
            'postcode' => 'abcdefgh',
        ]);
        $response->assertStatus(302)
            ->assertInvalid([
                "postcode" => "郵便番号には、数字を指定してください。",
                "postcode" => "郵便番号は7桁で指定してください。",
            ]);
        
        $postcode = Postcode::first();
        $response = $this->post('/postcode', [
            'postcode' => $postcode->postcode,
        ]);
        $response->assertStatus(200);
    }
}
