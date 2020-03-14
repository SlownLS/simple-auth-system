<?php

namespace SlownLS\Auth\Traits;

trait Login {
    /**
     * Check if user is logged
     *
     * @return boolean
     */
    protected function IsLogged() : bool
    {
        return isset($_SESSION["user"]);
    }

    /**
     * Logout user
     *
     * @return void
     */
    protected function Logout(){
        unset($_SESSION["user"]);
    }

    /**
     * Login user on session
     *
     * @param string $username
     * @param string $password
     * @return boolean
     */
    protected function Login(string $username, string $password) : bool
    {
        // Check if username is taken
        $user = $this->GetBy("username", "email", $username);

        if( !$user ){
            $this->AddNotification("danger", "Incorrect username or password.");
            return false;
        }

        if( !password_verify($password, $user->password) ){
            $this->AddNotification("danger", "Incorrect username or password.");
            return false;        
        }

        $_SESSION["user"] = $user;

        return true;
    }
}