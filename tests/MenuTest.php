<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class MenuTest extends TestCase
{
    use DatabaseTransactions;
    
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testAccountLink()
    {
        // guest a user 
        $this->visit('/')->dontSee('Account');
        
        $user = $this->createUser('superadmin');
        
        $this->actingAs($user)
                ->visit('/')
                ->see('Account');
        
        $this->click('Account')
                ->seePageIs('account')
                ->see('My account');         
    }
}
