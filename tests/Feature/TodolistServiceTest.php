<?php

namespace Tests\Feature;

use App\Services\TodolistService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Session;
use PDO;
use Tests\TestCase;

use function PHPUnit\Framework\assertNotNull;

class TodolistServiceTest extends TestCase
{

    private TodolistService $todolistService;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function setUp():void
    {
        parent::setUp();

        
        $this->todolistService = $this->app->make(TodolistService::class);
    }

    public function testTodoListNotNull(){
        self::assertNotNull($this->todolistService);
    }

    public function testSavetodo(){
        $this->todolistService->saveTodo('1','uji');
        $todolist = Session::get("todoList");
        foreach($todolist as $value){
            self::assertEquals("1", $value['id']);
            self::assertEquals('uji',$value['todo']);
        }
    }

    public function getTodoListEmpty(){
        self::assertEquals([], $this->todolistService->getTodo());
    }

    public function getTodoListNotEmpty(){
        $hasil =
        [
            [
            'id' => '1',
            'todo' => 'uji'
        ],
        [
            'id' => '2',
            'todo' => 'ujan'
        ]
    ];

    $this->todolistService->saveTodo("1","uji");
    $this->todolistService->saveTodo("2","ujan");

    self::assertEquals($hasil, $this->todolistService->getTodo());
    }

    public function getRemoveTodo(){
    $this->todolistService->saveTodo("1","uji");
    $this->todolistService->saveTodo("2","ujan");

    self::assertEquals(2, sizeof($this->todolistService->getTodo()));

    $this->todolistService->removeTodo("1");

    self::assertEquals(1, sizeof($this->todolistService->getTodo()));

    $this->todolistService->removeTodo("2");

    self::assertEquals(0, sizeof($this->todolistService->getTodo()));

        
    }
}
