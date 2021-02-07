<?php

namespace Tests\Unit\Http\Controllers\API\V01\Auth;


use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class AuthControllerTest extends TestCase
{
    use RefreshDatabase;

    // Test Register

    public function test_register_should_be_validate()
    {
        $response = $this->post(Route('auth.register'));
        $response->assertStatus(302);
    }

    public function test_new_user_can_register()
    {
        $response = $this->post(Route('auth.register'),[
            'name'=>'parisa mobaraki'
        ]);
        $response->assertStatus(302);
    }


    // Test Login

    public function test_login_should_be_validate()
    {
        $response = $this->post(Route('auth.login'));
        $response->assertStatus(302);
    }

    public function test_user_can_login_with_true_credentials()
    {
        $user = factory(User::class)->create();

        $response = $this->post(Route('auth.login'),[

            'email'=> $user->email  ,
            'password'=>'password'
        ]);
        $response->assertStatus(200);
    }



    // Test logged in user

    public function test_show_user_info_if_logged_in()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)->get(Route('auth.user'));
        $response->assertStatus(200);

    }



    // Test Logout

    public function test_logged_in_user_can_logout()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)->postJson(Route('auth.logout'));
        $response->assertStatus(200);
    }
}
