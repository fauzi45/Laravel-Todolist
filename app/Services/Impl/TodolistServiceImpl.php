<?php

namespace App\Services\Impl;

use App\Services\TodolistService;
use Illuminate\Support\Facades\Session;

class TodolistServiceImpl implements TodolistService{
    public function saveTodo(string $id, string $todo): void
    {
        if(!Session::exists("todoList")){
            Session::put("todoList",[]);
        }

        Session::push("todoList",[
            "id" => $id,
            "todo" => $todo
        ]);
    }

    public function getTodo(): array
    {
        return Session::get("todoList",[]);
    }

    public function removeTodo(string $todoId)
    {
        $todoList = Session::get("todoList");

        foreach($todoList as $index => $value){
            if($value['id'] == $todoId){
                unset($todoList[$index]);
                break;
            }
        }

        Session::put("todoList",$todoList); 
    }
}