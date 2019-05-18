<?php

namespace Tests\Unit;

use Tests\TestCase;


class ToDoTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testAllToDos()
    {
        $todos = factory('App\Model\ToDo', 3)->create();

        $this->get('/to-do-list')
            ->assertStatus(200)
            ->assertJson($todos->toArray());
    }

    public function testCreateToDO()
    {
        $todo = factory('App\Model\ToDo')->make()->toArray();

        $json = [];
        $json['success'] = true;
        $json['data'] = $todo;
        $json['errors'] = [];

        $this->post('/to-do-list', $todo)
            ->assertStatus(200)
            ->assertJson($json);

        $this->assertDatabaseHas('todo', $todo);
    }

    public function testDoValidation()
    {
        $responseJson = $this->post('/to-do-list', [])->decodeResponseJson();

        $this->assertFalse($responseJson['success']);
    }
}