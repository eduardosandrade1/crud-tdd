<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Tests\TestCase;

class AuthTest extends TestCase
{

    use RefreshDatabase;

    public function test_user_can_view_a_login_form(): void
    {
        $response = $this->get(route('login.create'));

        $response->assertSuccessful();
        $response->assertViewIs('login');
    }

    public function test_user_can_login_with_correct_credentials_and_is_authenticated(): void
    {
        $user = User::factory()->create([
            'name' => 'Eduardo Andrade',
            'email' => 'eduardo@gmail.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
            'remember_token' => Str::random(10),
        ]);

        $response = $this->post(route('login.store'), [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $response->assertRedirect(route('home'));
        $this->assertAuthenticatedAs($user);
    }

    public function test_user_can_not_login_with_incorrect_email_and_or_password(): void
    {

        $response = $this->post(route('login.store'), [
            'email' => 'mail@incorrect.com',
            'password' => 'password',
        ]);


        $response->assertRedirect(route('login.create'));
        $response->assertSessionHasErrors();

    }

    public function test_user_can_not_login_with_incorrect_password(): void
    {
        $user = User::factory()->create([
            'name' => 'Eduardo Andrade',
            'email' => 'eduardo@gmail.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
            'remember_token' => Str::random(10),
        ]);

        $response = $this->post(route('login.store'), [
            'email' => $user->email,
            'password' => 'incorrectpassword',
        ]);

        $response->assertRedirect(route('login.create'));
        $response->assertSessionHasErrors();
    }

    public function test_user_can_not_login_with_incorrect_email_and_password(): void
    {

        $response = $this->post(route('login.store'), [
            'email' => 'mail@incorrect.com',
            'password' => 'passwordincorrect',
        ]);


        $response->assertRedirect(route('login.create'));
        $response->assertSessionHasErrors();

    }

    public function test_user_can_do_logout_authenticated(): void
    {
        $user = User::factory()->create([
            'name' => 'Eduardo Andrade',
            'email' => 'eduardo@gmail.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
            'remember_token' => Str::random(10),
        ]);

        $response = $this->post(route('login.store'), [
            'email' => $user->email,
            'password' => 'incorrectpassword',
        ]);
        $response->assertRedirect(route('login.create'));


        $response = $this->post(route('logout'));
        $this->assertGuest();
    }

    public function test_user_can_not_do_logout_not_authenticated(): void
    {

        $response = $this->post(route('logout'));
        $response->assertRedirect(route('login.create'));
    }
}
