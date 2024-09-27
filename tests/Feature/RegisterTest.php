<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    //use RefreshDatabase;

    protected function data(){
        $user = User::factory()->make();
        app('code')->clear($user->email);
        return [
            'account' => $user->email,
            //'account' => ,
            'password' => 'admin888',
            'password_confirmation' => 'admin888',
            'code' => app('code')->email($user->email)
        ];
    }

    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    /**
     * 用户注册
     * @test
     * @return void
     */
    public function userRegister(){
        $response = $this->post('/api/register', $this->data());
        $response->assertSuccessful();
    }

}
