<?php

namespace Tests\Feature\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;


class LoginTest extends TestCase
{

    use RefreshDatabase;

    public function testUserCanViewLoginForm()
    {
        $response = $this->get('/login');

        $response->assertSuccessful();
        $response->assertViewIs('auth.login');
    }

    public function testUserCannotViewLoginFormWhenAuthenticated()
    {
        $user = User::factory()->make();
        $response = $this->actingAs($user)->get('/login');

        $response->assertRedirect('/home');
    }

    public function testUserLoginWithCorrectCredentials()
    {
        $password = "password";

        $user = User::factory()->create([
            'password' => bcrypt($password),
        ]);

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => $password,
        ]);

        $response->assertRedirect('/home');
        $this->assertAuthenticatedAs($user);
    }


    public function test_user_cannot_login_with_incorrect_password()
    {
        $user = User::factory()->create([
            'password' => bcrypt('password'),
        ]);

        $response = $this->from('/login')->post('/login', [
            'email' => $user->email,
            'password' => 'wrong-password',
        ]);

        $response->assertRedirect('/login');
        $response->assertSessionHasErrors('email');
        $this->assertTrue(session()->hasOldInput('email'));
        $this->assertFalse(session()->hasOldInput('password'));
        $this->assertGuest();
    }

    public function test_it_can_not_login_if_user_doesnt_exist()
    {
        $response = $this->from(route('login'))
            ->post(route('login'), [
                'email' => 'doesnt-exist-email',
                'password' => 'wrong-password',
            ]);

        $response->assertRedirect(route('login'));
        $response->assertSessionHasErrors('email');
        $this->assertGuest();
    }


    public function testUserLogout()
    {
        // Given
        $user = User::factory()->create();
        $this->be($user);

        // When
        $this->post(route('logout'));

        // Then
        $this->assertGuest();
    }


}
