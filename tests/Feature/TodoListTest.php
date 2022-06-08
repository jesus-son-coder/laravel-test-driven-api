<?php

namespace Tests\Feature;

use App\Models\TodoList;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TodoListTest extends TestCase
{
    use RefreshDatabase; // this will re-run all the migrations and clean the tables in database

    private TodoList $list;

    public function setUp(): void
    {
        parent::setUp();

        $this->list = TodoList::factory()->create(['name' => 'my list']);

    }

    public function test_fetch_all_todo_list(): void
    {
        // Action / Perform :
        $response = $this->getJson(route('todo-list.index'));

        // Assertion / Predict
        $this->assertCount(1, $response->json());
        $this->assertEquals('my list', $response->json()[0]['name']);
    }

    public function test_fetch_single_todo_list()
    {
        // Action / Perform :
        $response = $this->getJson(route('todo-list.show', $this->list->id));

        // Assertion / Predict :
        $response->assertOk();
        $this->assertEquals($response->json()['name'], $this->list->name);
    }

    public function test_fetch_single_todo_list_optimized()
    {
        // Action / Perform :
        $response = $this->getJson(route('todo-list.show', $this->list->id))
                    ->assertOk()
                    ->json();

        // Assertion / Predict :
        $this->assertEquals($response['name'], $this->list->name);
    }

    public function test_store_new_todo_list()
    {
        // Preperation :
        //$list = TodoList::factory()->create(['name' => 'my NEW list']);
        $list = TodoList::factory()->make(); // "make" crée la Data, mais ne la stocke pas en Base de données !!

        // Action / Perform :
        $response = $this->postJson(route('todo-list.store'), ['name' => $list->name])
            ->assertCreated()
            ->json();

        // Assertion / Predict :
        $this->assertEquals($list->name, $response['name']);
        /*
         * We expect to have the data "['name' => 'my NEW list']"
         * in the Table called "todo_lists" :
         */
        $this->assertDatabaseHas('todo_lists', ['name' => $list->name]);
    }

    public function test_while_storing_list_name_field_is_required()
    {
        // Preperation :

        // Action / Perform :
        $this->withExceptionHandling();

        $response = $this->postJson(route('todo-list.store'))
                    //->assertStatus(422);
                    ->assertUnprocessable();

    }
}
