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
    public function test_fetch_all_todo_list()
    {
        // preparation / prepare
        TodoList::factory()->create(['name' => 'my list']);

        // action / perform
        // $response = $this->getJson('api/todo-list');
        $response = $this->getJson(route('todo-list.store'));

        // assertion / predict
        $this->assertEquals(1, count($response->json()));
        $this->assertEquals('my list', $response->json()[0]['name']);
    }

    public function test_fetch_single_todo_list()
    {
        // Preperation
        $list = TodoList::factory()->create(); // crée un élément en base de données

        // Action
        $response = $this->getJson(route('todo-list.show', 1));

        // Assertion
        $response->assertStatus(200);
        $this->assertEquals($response->json()['name'], $list->name);
    }
}
