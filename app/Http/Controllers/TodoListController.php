<?php

namespace App\Http\Controllers;

use App\Models\TodoList;
use Illuminate\Http\Request;

class TodoListController extends Controller
{
    public function index()
    {
        $lists = TodoList::all();
        // return response()->json(['lists' => []]);
        // ou
        return response($lists);
    }

    public function show(TodoList $todolist)
    {
        return response($todolist);
    }
}

