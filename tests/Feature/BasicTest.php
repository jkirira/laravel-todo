<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\Models\ToDo;

class BasicTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    # Test function for Box class
    public function testToDoModel()
    {
        $todo = new ToDo();
        $todo->text = "Hello";
        $this->assertEquals("Hello", $todo->text);
        $this->assertNull($todo->description);
    }

}
