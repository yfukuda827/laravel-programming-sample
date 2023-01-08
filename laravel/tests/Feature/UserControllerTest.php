<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testMypage()
    {
        $this->seed();

        $user = User::find(1);
        $response = $this->actingAs($user)->get('/mypage');
        $response->assertStatus(200);
    }
}
