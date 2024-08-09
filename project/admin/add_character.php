<?php

    require "../classes/Database.php";
    require "../classes/Character.php";
    require "../classes/Auth.php";
    require "../classes/Redirect.php";

    //start session and check if user is logged in
    session_start();

    if(!Auth::isLoggedIn()){
        die("Nepovolený přístup");
    }

    //empty inputs in form
    $first_name = "";
    $second_name = "";
    $nationality = "";
    $game_name = "";
    $basic_info = "";

    if($_SERVER["REQUEST_METHOD"] === "POST"){
        
        $first_name = $_POST["first_name"];
        $second_name = $_POST["second_name"];
        $nationality = $_POST["nationality"];
        $game_name = $_POST["game_name"];
        $basic_info = $_POST["basic_info"];

        $database = new Database();
        $connection = $database->connectionDB();

        $character = new Character();
        $id = $character->createCharacter($connection, $first_name, $second_name, $nationality, $game_name, $basic_info);

        if($id){
            Redirect::redirect("/php/project/admin/one_character.php?id=$id");
        } else {
            echo "Vložení nové postavy do databáze se nezdařilo";
        }

    }

?>

<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/add_character.css">
    <title>Přidat postavu</title>
</head>
<body>

<?php require "admin_header.php" ?>

<main>
    <?php require "add_form.php" ?>
</main>

<?php require "../includes/footer.php" ?>

</body>
</html>