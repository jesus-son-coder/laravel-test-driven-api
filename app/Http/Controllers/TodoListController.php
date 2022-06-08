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
        $request->validate(['name' => ['required']]);

        $list = TodoList::create($request->all());

        // return response($list, Response::HTTP_CREATED);
        return $list;
    }

    public function destroy(TodoList $todolist)
    {
        $todolist->delete();

        return response('', Response::HTTP_NO_CONTENT);
    }

}

