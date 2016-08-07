<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\User;

class UserTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
       //$this->assertTrue(true);
    
    $this->json('POST', '/api/users',
        ['firstname' => '',
        'lastname'=>'Daddy',
        'email' =>'e@e.com',
        'password' => '123',
        'role' => 'reader'
    ])
        ->assertResponseStatus('406');
    
    $this->json('POST', '/api/users',
        ['firstname' => '1212',
        'lastname'=>'Daddy',
        'email' =>'e@e.com',
        'password' => '123',
        'role' => 'reader'
    ])
        ->assertResponseStatus('406');
    
    
    $this->json('POST', '/api/users',
        ['firstname' => 'ASD',
        'lastname'=>'',
        'email' =>'e@e.com',
        'password' => '123',
        'role' => 'reader'
    ])
        ->assertResponseStatus('406');
    
    $this->json('POST', '/api/users',
        ['firstname' => 'ASD',
        'lastname'=>'1212',
        'email' =>'e@e.com',
        'password' => '123',
        'role' => 'reader'
    ])
        ->assertResponseStatus('406');
    
    $this->json('POST', '/api/users',
        ['firstname' => 'ASD',
        'lastname'=>'ASD',
        'email' =>'e@e.com',
        'password' => '',
        'role' => 'reader'
    ])
        ->assertResponseStatus('406');
    
    $this->json('POST', '/api/users',
        ['firstname' => 'ASD',
        'lastname'=>'ASD',
        'email' =>'e@e.com',
        'password' => '123',
        'role' => ''
    ])
        ->assertResponseStatus('406');

    $this->json('POST', '/api/users',
        ['firstname' => 'Sally',
        'lastname'=>'Daddy',
        'email' =>'e@e.com',
        'password' => '123',
        'role' => 'reader,'
        ])
    ->seeJson([
        'firstname' => 'Sally',
        'lastname'=>'Daddy',
        'email' =>'e@e.com'
        ])
    ->assertResponseStatus('201');
        
    $this->json('POST', '/api/users',
        ['firstname' => 'Sally',
        'lastname'=>'Daddy',
        'email' =>'e@e.com',
        'password' => '123',
        'role' => 'reader,'
    ])
        ->assertResponseStatus('406');
        
    $user = App\User::where('email', 'e@e.com')->first();
    $id = $user->id;

    $this->json('PUT', '/api/users/'.$id,
        ['firstname' => 'Ann',
        'lastname'=>'Daddy',
        'email' =>'e@e.com',

    ])  
        ->seeJson([
        'firstname' => 'Ann',
        'lastname'=>'Daddy',
        'email' =>'e@e.com',
    ])
        ->assertResponseStatus('200');
        
    $this->json('PUT', '/api/users/'.$id,
        ['firstname' => '',
            'lastname'=>'Daddy',
            'email' =>'e@e.com',

        ])
        ->assertResponseStatus('406');
    
    $this->json('PUT', '/api/users/'.$id,
        ['firstname' => 'Ann',
            'lastname'=>'',
            'email' =>'e@e.com',

        ])
        ->assertResponseStatus('406');

    $this->json('PUT', '/api/users/'.$id,
        ['firstname' => 'Ann',
            'lastname'=>'Daddy',
            'email' =>'',

        ])
        ->assertResponseStatus('406');

    $this->json('PUT', '/api/users/'.$id,
        ['firstname' => 'Add',
            'lastname'=>'Daddy',
            'email' =>'e@e.com',

        ])
        ->seeJson([
            'firstname' => 'Add',
            'lastname'=>'Daddy',
            'email' =>'e@e.com',
        ])
        ->assertResponseStatus('200');


    $response = $this->call('GET', '/api/users/'.$id);
    $this->assertEquals(200, $response->status());


    $response = $this->call('DELETE', '/api/users/'.$id);
    $this->assertEquals(204, $response->status());


    $this->get('/api/users')
        ->seeJsonStructure([
            '*' => [
               'id', 'firstname', 'email'
            ]
        ])
        ->assertResponseStatus('200');

    $response = $this->call('GET', '/api/users/'.$id);
    $this->assertEquals(404, $response->status());

    }
}
