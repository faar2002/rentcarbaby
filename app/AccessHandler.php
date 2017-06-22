<?php

namespace App;

class AccessHandler
{
    protected static $hierarchy = [
        'superadmin' => 5,
        'admin' => 4,
        'supervisor' => 3,
        'editor' => 2,
        'user' => 1
    ];
    
    public static function check($userRole, $requiredRole){
        
        return static::$hierarchy[$userRole] >= static::$hierarchy[$requiredRole];
    }
}

