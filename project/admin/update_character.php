<?php

    require "../classes/Database.php";
    require "../classes/Character.php";
    require "../classes/Auth.php";
    require "../classes/Redirect.php";

    session_start();

    if(!Auth::isLoggedIn()){
        die("Nepovolený přístup");
    }

    $role = $_SESSION["role"];

    $database = new Database();
    $connection = $database->connectionDB();

    $read_and_update_character = new Character();
    
    //Upload data from database
    if(isset($_GET["id"])){

        $character = $read_and_update_character->readCharacter($connection, $_GET["id"]);

        if($character){
            $first_name = $character["first_name"];
            $second_name = $character["second_name"];
            $nationality = $character["nationality"];
            $game_name = $character["game_name"];
            $basic_info = $character["basic_info"];
            $id = $character["id"];
        } else {
            die("Postava nenalezena");
        }

    } else {
        die("ID není k dispozici, postava nebyla nalezena");
    }

    //Send updated data to database
    if($_SERVER["REQUEST_METHOD"] === "POST"){
        $first_name = $_POST["first_name"];
        $second_name = $_POST["second_name"];
        $nationality = $_POST["nationality"];
        $game_name = $_POST["game_name"];
        $basic_info = $_POST["basic_info"];

        if($read_and_update_character->updateCharacter($connection, $first_name, $second_name, $nationality, $game_name, $basic_info, $id)){
            Redirect::redirect("/php/project/admin/one_character.php?id=$id");
        }
    }

?>

<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/add_character.css">
    <title>Aktualizovat postavu</title>
</head>
<body>

<?php require "admin_header.php" ?>

    <?php if($role === "admin"): ?>
        <main>
            <?php require "add_form.php" ?>
        </main>
    <?php else: ?>
        <h1>Obsah této stránky je pouze pro administrátory</h1>
    <?php endif ?>
<?php require "../includes/footer.php" ?>
    
</body>
</html>