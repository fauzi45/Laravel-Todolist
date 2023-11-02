<?php

namespace Tests\Feature;

use App\Services\UserService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserServiceTest extends TestCase
{
    private UserService $userService;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    
     protected function setUp():void
    {
        parent::setUp();
        
        $this->userService = $this->app->make(UserService::class);
    }

    public function testSample(){
        self::assertTrue(true);
    }

    public function testLoginSuccess(){
        self::assertTrue($this->userService->login("uji","123"));
    }

    public function testLoginUserMissing(){
        self::assertFalse($this->userService->login("ujian","123"));
    }

    public function testPasswordFailed(){
        self::assertFalse($this->userService->login("uji","12345"));
    }
}
