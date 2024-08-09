<?php

class Auth {
    /**
     * 
     * Verification if user is logged in or not
     * 
     * This function checks whether the user is currently logged in by verifying
     * if the session variable `is_logged_in` is set and true.
     * 
     * @return bool - true if user is logged in, false if user is not logged in
     * 
     */
    public static function isLoggedIn()
    {
        return isset($_SESSION["is_logged_in"]) && $_SESSION["is_logged_in"];
    }
}

?>