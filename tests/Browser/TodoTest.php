<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class TodoTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->browse(function ($browser) {
            $browser->visit('login')
                ->type('email', 'jameskirira8@gmail.com')
                ->type('password', '12345')
                ->press('Register')
                ->assertPathIs('/laravel-todo.appp//todo');
        });

    }
}
