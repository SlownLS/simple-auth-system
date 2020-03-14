<?php

namespace SlownLS\Auth\Traits;

trait Register {
    /**
     * Register user
     *
     * @param string $username
     * @param string $email
     * @param string $password
     * @param string $password_confirm
     * @return boolean
     */
    protected function Register(string $username, string $email, string $password, string $password_confirm) : bool
    {
        // Check if password match
        if( $password !== $password_confirm ){
            $this->AddNotification("danger", "The passwords don't match.");
            return false;
        }

        // Check if username is taken
        $boolUsernameTaken = $this->GetBy("username", $username);

        if( $boolUsernameTaken ){
            $this->AddNotification("danger", "This username is already taken");
            return false;
        }

        // Check if email is taken
        $boolEmailTaken = $this->GetBy("email", $email);

        if( $boolEmailTaken ){
            $this->AddNotification("danger", "This e-mail is already taken");
            return false;
        }

        $this->Create($username, $email, $password);

        $this->AddNotification("success", "Registration successfully completed.");

        return true;
    }
}