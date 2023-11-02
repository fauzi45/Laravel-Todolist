<?php

namespace App\Http\Controllers;

use App\Services\TodolistService;
use Illuminate\Http\Request;

class TodoListController extends Controller
{
    private TodolistService $todolistService;

    public function __construct(TodolistService $todolistService)
    {
        $this->todolistService = $todolistService;
    }

    public function todoList(Request $request)
    {
        $todolist = $this->todolistService->getTodo("todoList");
        return response()->view('todolist.todolist',[
            'title' => 'Todolist',
            "todoList" => $todolist
        ]);
    }

    public function addTodo(Request $request)
    {
        $todo = $request->input('todo');

        if(empty($todo)){
            $todoList = $this->todolistService->getTodo("todoList");
            return response()->view('todolist.todolist',[
                'title' => 'Todolist',
                "todoList" => $todoList,
                "error" => "Todo is Required!!!"
            ]);
        }
        $this->todolistService->saveTodo(uniqid(),$todo);

        return redirect()->action([TodoListController::class,'todoList']);
    }

    public function removeTodo(Request $request, string $todoId)
    {
        $this->todolistService->removeTodo($todoId);
        return redirect()->action([TodoListController::class,'todoList']);
    }
}
