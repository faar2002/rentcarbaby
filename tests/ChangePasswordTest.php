<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ChangePasswordTest extends TestCase
{
    use DatabaseTransactions;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->assertTrue(true);
    }
    
    public function testChangePassword()
    {
       $user = $this->createUser('superadmin');
       
       $this->actingAs($user)
               ->visit('account')
               ->click('Change Password')
               ->seePageIs('account/password')
               ->type('123456', 'current_password')
               ->type('newpassword','password')
               ->type('newpassword','password_confirmation')
               ->press('Change Password')
               ->seePageIs('account')
               ->see('Your Password has been changed');
       
       $this->assertTrue(
               Hash::check('newpassword', $user->password),
               'The user password was not change'
               );
               
    }
}
