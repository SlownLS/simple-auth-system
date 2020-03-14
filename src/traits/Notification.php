<?php

namespace SlownLS\Auth\Traits;

trait Notification {
    /**
     * Check if user has notifications
     *
     * @return boolean
     */
    protected function HasNotifications() : bool
    {
        return isset($_SESSION["notifications"]) && !empty($_SESSION["notifications"]);
    }

    /**
     * Get notifications of user
     *
     * @return array
     */
    protected function GetNotifications() : array
    {
        return $_SESSION["notifications"];
    }
    
    /**
     * Add notification to user
     *
     * @param string $type
     * @param string $message
     * @return boolean
     */
    protected function AddNotification(string $type, string $message) : bool
    {        
        if( !isset($_SESSION["notifications"]) ){
            $_SESSION["notifications"] = [];
        }

        $_SESSION["notifications"][] = [
            "type" => $type,
            "message" => $message
        ];

        return true;
    }

    /**
     * Destroy user notifications
     *
     * @param int $key
     * @return boolean
     */
    protected function DestroyNotification(int $key) : bool
    {
        unset($_SESSION["notifications"][$key]);
        return true;
    }
}