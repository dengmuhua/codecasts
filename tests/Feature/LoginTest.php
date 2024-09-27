<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase, WithFaker;
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    protected function data(){
        $user =User::factory()->create();
        return [
            'account' => $user->email,
            'password' => 'password'
        ];
    }

    /**
     * 登录
     * @test
     * @return void
     */
    public function loginTest(){
        $this->withoutExceptionHandling();
        $user = User::factory()->create();
        //$response = $this->post('/api/login', ['account' => $user->email, 'password' => $user->password]);
        $response = $this->post('/api/login', $this->data());
        $response->assertSee('token');
    }
}
