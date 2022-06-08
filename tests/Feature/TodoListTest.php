<?php

namespace Tests\Feature;

use App\Models\TodoList;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TodoListTest extends TestCase
{
    use RefreshDatabase; // this will re-run all the migrations and clean the tables in database
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_fetch_todo_list()
    {
        // preparation / prepare
        TodoList::factory()->create();
        // TodoList::create(['name' => 'my list']);

        // action / perform
        // $response = $this->getJson('api/todo-list');
        $response = $this->getJson(route('todo-list.store'));

        // assertion / predict
        $this->assertEquals(1, count($response->json()));
    }
}
