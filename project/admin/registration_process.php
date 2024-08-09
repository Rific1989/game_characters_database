<?php

    require "../classes/Database.php";
    require "../classes/User.php";
    require "../classes/Redirect.php";

    session_start();

    if($_SERVER["REQUEST_METHOD"] === "POST"){

        $database = new Database();
        $connection = $database->connectionDB();

        $first_name = $_POST["first_name"];
        $second_name = $_POST["second_name"];
        $email = $_POST["email"];
        $password = $_POST["password"];
        $role = "user";

        $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

        $id = User::createUser($connection, $first_name, $second_name, $email, $password, $role);

        if(!empty($id)){

            //Protection against fixation attack
            session_regenerate_id(true);

            $_SESSION["is_logged_in"] = true;
            $_SESSION["logged_in_user_id"] = $id;
            $_SESSION["role"] = $role;

            Redirect::redirect("/php/project/admin/characters.php");

        } else {
            echo "Registrace se nezdařila";
        }

    } else {
        echo "Nepovolený přístup";
    }

?>