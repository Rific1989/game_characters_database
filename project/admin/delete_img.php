<?php

    require "../classes/Database.php";
    require "../classes/Auth.php";
    require "../classes/Img.php";
    require "../classes/Redirect.php";

    session_start();

    if(!Auth::isLoggedIn()){
        die("Nepovolený přístup");
    }

    $database = new Database();
    $connection = $database->connectionDB();

    $user_id = $_GET["id"];
    $image_name = $_GET["img_name"];

    echo $user_id;
    echo "<br>";
    echo $image_name;

    
    $image_path = "../uploads/" . $user_id . "/" . $image_name;

    if(Img::deleteImgFromFile($image_path)){
        //Smazat obrázek z databáze
        Img::deleteImgFromDatabase($connection, $image_name);
        Redirect::redirect("php/project/admin/images.php");
    }

?>