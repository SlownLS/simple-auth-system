<?php

namespace SlownLS\Auth;

if( session_status() == PHP_SESSION_NONE ){
    session_start();
}

use \PDO;

class User{
    private static $instance = null;
    private $db;

    use Traits\Notification;
    use Traits\Login;
    use Traits\Register;
    use Traits\Util;

    /**
     * Set database reference
     *
     * @param PDO $db
     * @return void
     */
    protected function SetDatabase(PDO $db) 
    {
        $this->db = $db;
    }

    /**
     * Redirect user to last page
     *
     * @return void
     */
    protected function RedirectBack()
    {
        header("Location: " . $_SERVER["HTTP_REFERER"]);
        exit();
    }

    /**
     * Get instance of user
     *
     * @param PDO $db
     * @return SlownLS\Auth\User
     */
    protected static function GetInstance()
    {
        if( \is_null(self::$instance) ){
            self::$instance = new self();
        }
  
        return self::$instance;
    }    

    public static function __callStatic($name, $arguments)
    {
        $instance = self::GetInstance();
        
        if( method_exists($instance, $name) ){
            return call_user_func_array( array($instance, $name), $arguments);
        }
    }
}