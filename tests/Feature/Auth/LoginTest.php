<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function data(){
        $user =User::factory()->create();
        return [
            'account' => $user->email,
            'password' => 'password'
        ];
    }

    #[Test]
    public function loginTest(){
        $this->withoutExceptionHandling();
        $user = User::factory()->create();
        //$response = $this->post('/api/login', ['account' => $user->email, 'password' => $user->password]);
        $response = $this->post('/api/login', $this->data());
        $response->assertSee('token');
    }

    #[Test] // Email Illegal Test[邮箱不合法]
    public function loginEmailIllegal(){
        $response = $this->post('/api/login', ['account' => 'illegal_email', 'password' => 'password']);
        $response->assertSessionHasErrors('account');
    }

    #[Test] // Password Input Wrong Test[密码输入错误]
    public function passwordInputWrong(){
        $user =User::factory()->create();
        $response = $this->post('/api/login', ['account' => $user->email, 'password' => 'wrong_password']);
        $response->assertSessionHasErrors('password');
    }

    #[Test] // Account Not Exist Test[账户不存在]
    public function accountNotExist(){
        $response = $this->post('/api/login', ['account' => '3345678@qq.com', 'password' => 'password']);
        $response->assertSessionHasErrors('account');
    }
}
