<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class AccessHandlerTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testCheck()
    {
        // El alias Access fue declarado el archivo app.php que esta en la carpeta config
        $this->assertTrue(
                Access::check('superadmin','editor'),
                'Los usuarios superadmin deberían tener acceso a los módulos de editors '
        );
        
        $this->assertTrue(
                Access::check('editor','user'),
                'Los usuarios editors deben tener acceso a los módulos de usuario '
        );
        
        $this->assertTrue(
                Access::check('superadmin','superadmin'),
                'Los usuarios de superadmin deberían tener acceso a módulos superadmin '
        );
        
        $this->assertFalse(
                Access::check('user','superadmin'),
                'Los users no deben tener acceso a módulos superadmin, rutas, etc.'
        );
    }
}
