<?php

class Redirect {
    /**
     * 
     * Redirect on address which is stated as $path
     * 
     * @param string $path - address of redirection
     * 
     * @param void
     * 
     */
    public static function redirect($path)
    {
        if(isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] != "off"){
            $url_protocol = "https";
        } else {
            $url_protocol = "http";
        }

        header("location: $url_protocol://" . $_SERVER["HTTP_HOST"] . $path);
    }
}

?>