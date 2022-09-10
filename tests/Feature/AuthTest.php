<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class AuthTest extends TestCase
{

    /**
     * @test
     * Test login success
     */
    public function testLoginSuccess()
    {
        //Create user
        User::create([
            'name' => 'test',
            'email'=>'test@gmail.com',
            'password' => bcrypt('secret1234')
        ]);
        //attempt login
        $response = $this->json('POST',route('api.authenticate'),[
            'email' => 'test@gmail.com',
            'password' => 'secret1234',
        ]);
        //Assert it was successful and a access_token was received
        $response->assertStatus(200);
        $this->assertArrayHasKey('access_token',$response->json());
        //Delete the user
        User::where('email','test@gmail.com')->delete();
    }

    /**
     * @test
     * Test login failure
     */
    public function testLoginfailure()
    {
        //attempt login
        $response = $this->json('POST',route('api.authenticate'),[
            'email' => 'test@gmail.com',
            'password' => 'secret1234',
        ]);
        $response->assertStatus(401);
    }


    /**
     * @test
     * Negative Scenarios.....
     */
     //..........

}
