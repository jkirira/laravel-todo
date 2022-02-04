<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class loginTest extends TestCase
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

    public function test_redirection()
    {
        $response = $this->get('/todo');

        $response->assertStatus(302);       //redirect statue 302
        $response->assertRedirect('/login');    //redirect to login

    }

    public function login_page()
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
        $response->assertSee('login');
        $response->assertDontSee('Beta');
    }
}
