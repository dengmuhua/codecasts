<?php

namespace Tests\Feature\Code;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class CodeTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    #[Test]// sendEmailForVerificationAndValidation
    public function sendEmailForVerificationAndValidation(){
        $user = User::factory()->create();
        $this->post('/api/code/send', ['account' => $user->email])
            ->assertSuccessful();
    }

    #[Test]// sendMobileVerificationCode
    public function sendMobileVerificationCode(){
        $user = User::factory()->create();
        $this->post('/api/code/send', ['account' => $user->mobile])
            ->assertSuccessful();
    }

    #[Test]// emailFormatError
    public function emailFormatError(){
        $this->post('/api/code/send', ['account' => 'test'])
            ->assertJsonValidationErrors(['account']);
    }

    #[Test]// repeatSendingVerificationCode
    public function repeatSendingVerificationCode(){
        $user = User::factory()->create();
        $this->post('/api/code/send', ['account' => $user->email]);
        $this->post('/api/code/send', ['account' => $user->email])
            ->assertStatus(403);
    }

    #[Test]// currentUserSendsVerificationCode
    public function currentUserSendsVerificationCode(){
        $response = $this->postJson('/api/code/current_user/email')->assertSuccessful();

        $response->assertJson(['status' => 'success']);
    }
}
