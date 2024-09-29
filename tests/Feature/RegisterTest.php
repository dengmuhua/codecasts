<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    use RefreshDatabase, WithFaker;

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

    #[Test] // user register test[用户注册]
    public function userRegister(){
        $response = $this->post('/api/register', $this->data());
        $response->assertSuccessful();
    }

    #[Test] // account required validation[账号不能为空]
    public function accountRequiredValidation(){
        $data = $this->data();
        unset($data['account']);
        $response = $this->postJson('/api/register', $data);
        $response->assertJsonValidationErrors(['account']);
    }

    #[Test] // captcha input error[错误的验证码]
    public function captchaInputError(){
        $response = $this->postJson('/api/register', ['code' => '334567'] +$this->data());
        $response->assertJsonValidationErrors(['code']);
    }

    #[Test] // register account validation[非法邮箱验证]
    public function registerAccountValidation(){
        $response = $this->postJson('/api/register', ['account' => 'test.com'] +$this->data());
        $response->assertJsonValidationErrors(['account']);
    }

    #[Test] // account unique validation[账号已存在]
    public function accountUniqueValidation(){
        $data = $this->data();
        $this->postJson('/api/register', $data);
        $response2 = $this->postJson('/api/register', $data);
        $response2->assertJsonValidationErrors(['account']);
    }

    #[Test] // input password error[密码有误]
    public function inputPasswordError(){
        $response = $this->postJson('/api/register', ['password' => ''] +$this->data());
        $response->assertJsonValidationErrors(['password']);
    }

    #[Test] // Login by mobile[手机登录]
    public function loginByMobile(){
        $user = User::factory()->create(['phone' => '136' . $this->faker()->randomNumber(8)]);
        $response = $this->postJson('/api/login', ['account' => $user->phone, 'password' => 'password']);
        $response->assertOk();
    }

}
