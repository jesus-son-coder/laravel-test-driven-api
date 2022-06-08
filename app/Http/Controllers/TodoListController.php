<?php

namespace App\Http\Controllers;

use App\Models\TodoList;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;

class TodoListController extends Controller
{
    public function index(): Response|Application|ResponseFactory
    {
        $lists = TodoList::all();

        return response($lists);
    }

    public function show(TodoList $todolist): Response|Application|ResponseFactory
    {
        return response($todolist);
    }

    public function store(Request $request)
    {
        $list = TodoList::create($request->all());

        // return response($list, 201);
        // return response($list, Response::HTTP_CREATED);
        return $list;
    }

}

