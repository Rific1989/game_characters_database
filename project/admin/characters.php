<?php

    require "../classes/Database.php";
    require "../classes/Character.php";
    require "../classes/Auth.php";

    session_start();

    if(!Auth::isLoggedIn()){
        die("Nepovolený přístup");
    }

    $database = new Database();
    $connection = $database->connectionDB();

    $character = new Character();
    $characters = $character->readAllCharacters($connection, "id, first_name, second_name");

?>

<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/header_footer.css">
    <link rel="stylesheet" href="../assets/css/characters.css">
    <title>Seznam postav</title>
</head>
<body>
    
<?php require "admin_header.php" ?>

<main>
    <section class="heading">
        <h1>Seznam herních postav</h1>
    </section>
    <section class="character-list">  
        <?php if(empty($characters)): ?>
            <p>Žádné záznamy nebyly nalezeny</p>
        <?php else: ?>
                <?php foreach($characters as $character): ?>
                    <div class="one-character">
                        <h2><?= htmlspecialchars($character["first_name"]) . " " . htmlspecialchars($character["second_name"]) ?></h2>
                        <a href="one_character.php?id=<?= $character['id'] ?>">Přejít na detail</a>
                    </div>
                <?php endforeach ?>
        <?php endif ?>
    </section>
</main>

<?php require "../includes/footer.php" ?>

</body>
</html>