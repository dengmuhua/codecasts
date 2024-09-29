<?php

namespace Tests\Feature\Config;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class ConfigTest extends TestCase
{
    //use WithFaker;

    #[Test] // get config data [获取配置数据]
    public function getConfigData(){
        $response = $this->getJson('/api/configs');
        $response->assertSuccessful();
    }

    #[Test] // update config data [更新配置数据]
    public function updateConfigData(){
        $response =$this->putJson('/api/configs/1', [
            'title' => 'Demo Site',
            'email' => 'test@test.com',
        ]);
        $response->assertStatus(422);
    }
}
