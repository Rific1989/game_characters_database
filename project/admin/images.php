<?php

    require "../classes/Database.php";
    require "../classes/Auth.php";
    require "../classes/Img.php";

    session_start();

    if(!Auth::isLoggedIn()){
        die("Nepovolený přístup");
    }

    $role = $_SESSION["role"];

    $database = new Database();
    $connection = $database->connectionDB();

    $user_id = $_SESSION["logged_in_user_id"];

    $images = Img::readImgByUserId($connection, $user_id);

?>

<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/header_footer.css">
    <link rel="stylesheet" href="../assets/css/images.css">
    <title>Galerie</title>
</head>
<body>
    <?php require "admin_header.php" ?>

    <main>
        <?php if($role === "admin"): ?>
        <section class="upload-img">
            <form action="upload_img.php" method="POST" enctype="multipart/form-data">
                <label for="choose-file" id="choose-file-text">Vybrat obrázek</label>
                <input type="file" id="choose-file" name="image" require><br>
                <input type="submit" class="upload-file" name="submit" value="Nahrát obrázek">
            </form>
        </section>
        <?php else: ?>
            <h1>Obsah této stránky je pouze pro administrátory</h1>
        <?php endif ?>

        <section class="images">
            <article>
                <?php foreach($images as $image): ?>
                    <div>
                        <div>
                            <img src=<?= "../uploads/" . $user_id . "/" . $image["img_name"] ?> alt="">
                        </div>
                        <div class="images-btn">
                            <a class="images-btn-download" href=<?= "../uploads/" . $user_id . "/" . $image["img_name"] ?> download>Stáhnout</a>
                            <a class="images-btn-delete" href="delete_img.php?id=<?= $user_id ?>&img_name=<?= $image["img_name"] ?>">Smazat</a>
                        </div>
                    </div>
                <?php endforeach ?>
            </article>
        </section>
    </main>

    <?php require "../includes/footer.php" ?>
</body>
</html>