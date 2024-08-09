<?php

    require "../classes/Database.php";
    require "../classes/Character.php";
    require "../classes/Auth.php";

    session_start();

    if(!Auth::isLoggedIn()){
        die("Nepovolený přístup");
    }

    $role = $_SESSION["role"];

    $database = new Database();
    $connection = $database->connectionDB();

    $one_character = new Character();
    
    if(is_numeric($_GET["id"]) && isset($_GET["id"])){
        $character = $one_character->readCharacter($connection, $_GET["id"]);
    } else {
        $character = null;
    }

?>

<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/header_footer.css">
    <link rel="stylesheet" href="../assets/css/characters.css">
    <title>Detail postavy</title>
</head>
<body>
    
    <?php require "admin_header.php" ?>

    <main>
        <section class="one-character">
            <?php if($character === null): ?>
                <p>Postava nenalezena</p>
            <?php else: ?>
                <div class="character-info">
                    <h2><?= htmlspecialchars($character["first_name"] . " " . htmlspecialchars($character["second_name"])) ?></h2>
                    <p><span class="legend">Národnost:</span> <?= htmlspecialchars($character["nationality"]) ?></p>
                    <p><span class="legend">Název hry: </span> <?= htmlspecialchars($character["game_name"]) ?></p>
                    <p><span class="legend">Základní informace:</span> <?= htmlspecialchars($character["basic_info"]) ?></p>
                </div>
                
                <!-- Buttons are available only to admin -->
                <?php if($role === "admin"): ?>
                    <div class="buttons-update-delete">
                    <a class="update" href="update_character.php?id=<?= $character['id'] ?>">Aktualizovat</a>
                    <a class="delete" href="delete_character.php?id=<?= $character['id'] ?>">Vymazat</a>
                </div>
                <?php endif ?>
            <?php endif ?>
        </section>
    </main>

    <?php require "../includes/footer.php" ?>
    
</body>
</html>