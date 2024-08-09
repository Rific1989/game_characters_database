<?php

    require "../classes/Database.php";
    require "../classes/User.php";
    require "../classes/Redirect.php";

    session_start();

    if($_SERVER["REQUEST_METHOD"] === "POST"){
        
        $database = new Database();
        $connection = $database->connectionDB();

        $user_email = $_POST["user_email"];
        $user_password = $_POST["user_password"];

        if(User::authentication($connection, $user_email, $user_password)){
            $id = User::readUserId($connection, $user_email);

            //Protection against fixation attack
            session_regenerate_id(true);

            $_SESSION["is_logged_in"] = true;
            $_SESSION["logged_in_user_id"] = $id;
            $_SESSION["role"] = User::readUserRole($connection, $id);

            Redirect::redirect("/php/project/admin/characters.php");

        } else {
            echo "Přihlášení se nezdařilo, zadali jste špatný email nebo heslo";
        }

    }

?>