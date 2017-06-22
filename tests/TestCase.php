<?php

class TestCase extends Illuminate\Foundation\Testing\TestCase
{
    /**
     * The base URL to use while testing the application.
     *
     * @var string
     */
    protected $baseUrl = 'http://localhost';

    /**
     * Creates the application.
     *
     * @return \Illuminate\Foundation\Application
     */
    public function createApplication()
    {
        $app = require __DIR__.'/../bootstrap/app.php';

        $app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

        return $app;
    }
    
    public function createUser($role = 'user')
    {
        return factory(App\User::class)->create([
            'name' => 'Francisco A. Aponte R.',
            'username' => 'faar2002',
            'email' => 'faar2002@gmail.com',
            'role' => $role,
            'password' => bcrypt('123456'),
            'active' => true
        ]);
    }
    
    public function seeInField($selector, $expected) {
        parent::seeInField($selector, $expected);
        
        $this->assertSame(
                $expected,
                $this->getInputOrTextAreaValue($selector),
                "The input [{$selector}] has not the value [{$expected}].");
        return $this;
    }
    
    public function getInputOrTextAreaValue($selector) {
        parent::getInputOrTextAreaValue($selector);
        
        $field = $this->filterByNameOrId($selector);
        
        if ($field->count() == 0){
            throw new \Exception("There are no elements with the name or ID [$selector]");
        } 
        $element = $field->nodeName();
        
        if ($element == 'input'){
            return $field->attr('value');
        }
        
        if ($element=='textarea'){
            return $field->text();
        }
        
        throw new \Exception("[$selector] is neither an input no a textarea");     
        
    }
}
