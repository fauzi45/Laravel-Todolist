<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testLoginPage()
    {
        $this->get('/login')->assertSeeText('Login');
    }

    public function testLoginPageForMember(){
        $this->withSession([
            "user" => "123"
        ])->get('/login')->assertRedirect('/');
    }

    public function testLoginForUserAlreadyLogin()
    {
        $this->withSession([
            'user' => '123'
        ])
        ->post('/login',[
            'user' => 'uji',
            'password' => '123'
        ])->assertRedirect('/');
    }

    public function testLoginSuccess()
    {
        $this->post('/login',[
            'user' => 'uji',
            'password' => '123'
        ])->assertRedirect('/')
        ->assertSessionHas('user','uji');
    }

    public function testLoginValidationError()
    {
        $this->post('/login',[
        ])
        ->assertSeeText('User or Password is required');
    }

    public function testLoginFailed()
    {
        $this->post('/login',[
            'user' => 'wrong',
            'password' => 'wrong'
        ])
        ->assertSeeText('User or Password is wrong');
    }

    public function testLogout()
    {
        $this->withSession([
            "user" => "uji"
        ])->post('/logout')
        ->assertRedirect('/')
        ->assertSessionMissing('user');
    }

    public function testLogoutGuest()
    {
        $this->post('/logout')
        ->assertRedirect('/');
    }
}
