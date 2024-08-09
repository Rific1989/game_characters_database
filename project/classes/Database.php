<?php

class Database {

    /**
     * 
     * Database connection
     * 
     * @return object $db - for connection to database
     * 
     */
    public function connectionDB()
    {
        $db_host = "127.0.0.1";
        $db_name = "gamecharacters";
        $db_user = "tester";
        $db_password = "admin123";

        $connection = "mysql:host=" . $db_host . ";dbname=" . $db_name . ";charset=utf8";

        try {
            $db = new PDO($connection, $db_user, $db_password);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $db;
        } catch (PDOException $e) {
            echo $e->getMessage();
            exit();
        }
    }
}

?>