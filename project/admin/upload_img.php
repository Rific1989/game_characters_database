<?php

    require "../classes/Database.php";
    require "../classes/Auth.php";
    require "../classes/Redirect.php";
    require "../classes/Img.php";

    session_start();

    if(!Auth::isLoggedIn()){
        die("Nepovolený přístup");
    }

    //ID of logged user
    $user_id = $_SESSION["logged_in_user_id"];

    if(isset($_POST["submit"]) && isset($_FILES["image"])){
        
        $database = new Database();
        $connection = $database->connectionDB();

        //Basic info about picture
        $image_name = $_FILES["image"]["name"];
        $image_size = $_FILES["image"]["size"];
        $image_tmp_name = $_FILES["image"]["tmp_name"];
        $error = $_FILES["image"]["error"];

        if($error === 0){
            //check img size
            if($image_size > 9000000){
                Redirect::redirect("/php/project/errors/error-page.php?error_text=Váš soubor je příliš velký");
            } else {
                //get the type of extension
                $image_extension = pathinfo($image_name, PATHINFO_EXTENSION);
                //transfer to lowercase
                $image_extension_lower_case = strtolower($image_extension);

                $allowed_extensions = ["jpg", "jpeg", "png"];

                //verification that extension is in $allowed_extension array
                if(in_array($image_extension_lower_case, $allowed_extensions)){
                    //composing of uniq name of img
                    $new_image_name = uniqid("IMG-", true) . "." . $image_extension;

                    //creating file of users to save images and check if this file exists already
                    if(!file_exists("../uploads/" . $user_id)){
                        mkdir("../uploads/" . $user_id, 0777, true);
                    }

                    //save img to specific file
                    $image_upload_path = "../uploads/" . $user_id . "/" . $new_image_name;
                    move_uploaded_file($image_tmp_name, $image_upload_path);

                    //insert images to database
                    if(Img::insertImg($connection, $user_id, $new_image_name)){
                        Redirect::redirect("/php/project/admin/images.php");
                    }

                } else {
                    Redirect::redirect("/php/project/errors/error-page.php?error_text=Koncovka Vašeho souboru není povolená");
                }
            }
            
        } else {
            Redirect::redirect("/php/project/errors/error-page.php?error_text=Vložit obrázek se bohužel nepodařilo");
        }

    }

?>