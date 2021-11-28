<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;

class AuthTest extends TestCase
{

    public function test_guest_user_can_access_login_and_registration_form(){
        $response = $this->get(route('login'));
        $response->assertStatus(200)->assertSee('Sign in to your account');
        $response = $this->get(route('register'));
        $response->assertStatus(200)->assertSee('Create a new account');
    }

    public function test_new_user_can_create_an_account()
    {
        $user = User::factory()->make();
        $userData = $user->toArray();
        $userData['password'] = $user->password;
        $userData['password_confirmation'] = $user->password;
        $this->post(route('registerUser'), $userData);
        $this->assertDatabaseHas('users',['email' => $userData['email']]);
    }

    public function test_existing_user_can_login()
    {
        $user = User::factory()->make();
        $userData = $user->toArray();
        $userData['password'] = $user->password;
        $userData['password_confirmation'] = $user->password;
        $response = $this->post(route('loginUser'), $userData);
        $response->assertRedirect(route('todo'));
    }
}
