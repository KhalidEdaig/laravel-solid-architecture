<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Tests\TestCase;

class AuthTest extends TestCase
{

    /**
     * @test 
     * Test registration
     */
    public function testRegister()
    {
        //User's data
        $data = [
            'email' => 'test@gmail.com',
            'username' => 'Test',
            'password' => 'secret1234',
            'password_confirmation' => 'secret1234',
        ];
        //Send post request
        $response = $this->postJson('/api/auth/register', $data);
        //Assert it was successful
        $response->assertStatus(200);
        //Assert we received a token
        $this->assertArrayHasKey('token', $response->json());
        //Delete data
        User::where('email', 'test@gmail.com')->delete();
    }
    /**
     * @test
     * Test login
     */
    public function testLogin()
    {
        //Create user
        User::create([
            'username' => 'test',
            'email' => 'test@gmail.com',
            'password' => bcrypt('secret1234')
        ]);
        //attempt login
        $response = $this->postJson('/api/auth/login', [
            'email' => 'test@gmail.com',
            'password' => 'secret1234',
        ]);
        //Assert it was successful and a token was received
        $response->assertStatus(200);
        $this->assertArrayHasKey('token', $response->json());
        //Delete the user
        User::where('email', 'test@gmail.com')->delete();
    }
}
