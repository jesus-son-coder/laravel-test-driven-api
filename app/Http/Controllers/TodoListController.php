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
        // LE "TYPED-HINT" :
        // ----------------

        // Grâce au type de l'argument dans la signature de la méthode
        // -> pas besoin du code ci-dessous :
            //$list = TodoList::findOrFail($id);

        // on peut récupérer directement l'argument et l'envoyer dans la réponse :
        return response($todolist);
    }
}

