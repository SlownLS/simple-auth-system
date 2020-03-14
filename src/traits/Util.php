<?php

namespace SlownLS\Auth\Traits;

trait Util {
    /**
     * Get user infos by key
     *
     * @param string $type
     * @param string $name
     * @return void
     */
    protected function GetBy(string ...$args)
    {
        
        $value = $args[array_key_last($args)];
        $request = "";

        for ($i=0; $i < count($args) - 1; $i++) { 
            $request .= $args[$i] . " = :value OR ";
        }
        
        $request = substr($request, 0, strlen($request) - 3);

        $req = $this->db->prepare("SELECT * FROM users WHERE $request");
        $req->bindParam(":value", $value);
        $req->execute();

        $user = $req->fetch();

        return $user;
    }

    /**
     * Insert user in database
     *
     * @param string $username
     * @param string $email
     * @param string $password
     * @return int
     */
    protected function Create(string $username, string $email, string $password) : int
    { 
        $password_crypted = password_hash($password, PASSWORD_BCRYPT);
        
        $req = $this->db->prepare("INSERT INTO users(username, email, password, register_at) VALUES(?, ?, ?, NOW())");
        $req->execute([$username, $email, $password_crypted]);

        return $this->db->lastInsertId();
    }

    /**
     * Get current info of session
     *
     * @param string $key
     * @return string
     */
    protected function GetLocalInfo(string $key) : String
    {
        return $_SESSION["user"]->$key;
    }
}