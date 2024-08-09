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

    $character = new Character();

    if($_SERVER["REQUEST_METHOD"] === "POST"){
        if($character->deleteCharacter($connection, $_GET["id"])){
            Redirect::redirect("/php/project/admin/characters.php");
        }
    }

?>

<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/add_character.css">
    <title>Vymazat postavu</title>
</head>
<body>
<?php require "admin_header.php" ?>

<main>
    <!-- Protection againts get on the page delete_character using url address -->
    <?php if($role === "admin"): ?>
        <section class="delete-character">
            <form action="" method="post">
                <p>Skutečně vymazat herní postavu?</p>
                <div class="buttons-delete-back">
                    <button>Vymazat</button>
                    <a href="one_character.php?id=<?= $_GET["id"] ?>">Zpět</a>
                </div>
            </form>
        </section>
    <?php else: ?>
        <h1>Obsah této stránky je pouze pro administrátory</h1>
    <?php endif ?>
</main>

<?php require "../includes/footer.php" ?>
</body>
</html>