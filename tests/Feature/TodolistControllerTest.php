<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use PDO;
use Tests\TestCase;

class TodolistControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testTodolist()
    {
        $this->withSession([
            'user' => 'uji',
            'todoList' => [
                '1' => '1',
                'todo' => 'uji'
            ]
        ])->get('/todolist')
        ->assertSeeText('1')
        ->assertSeeText('uji');
    }

    public function testAddTodoFailed()
    {
        $this->withSession([
            'user' => 'uji',
            
        ])->post('/todolist',[])
        ->assertSeeText('Todo is Required!!!');
    }
    
    public function testAddTodoSuccsess()
    {
        $this->withSession([
            'user' => 'uji',
            
        ])->post('/todolist',[
            'todo' => "ea"
        ])
        ->assertRedirect('/todolist');
    }

    public function testRemoveTodoList(){
        $this->withSession([
            'user' => 'uji',
            'todoList' => [
                [
                'id' => '1',
                'todo' => 'uji'
                ],
                [
                    'id' => '2',
                    'todo' => 'ujian'
                ]
            ]
        ])->post('/todolist/1/delete')->assertRedirect('/todolist');

    }
}
