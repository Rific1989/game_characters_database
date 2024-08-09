<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/add_character.css">

    <title>Project</title>
</head>
<body>

<?php require "includes/header.php" ?>

<main>
    <section class="registration">
        <form action="admin/registration_process.php" method="post">
            <label for="">Jméno</label><br>
            <input type="text" name="first_name" required><br>
            <label for="">Příjmení</label><br>
            <input type="text" name="second_name" required><br>
            <label for="">Email</label><br>
            <input type="email" name="email" required><br>
            <label for="">Heslo</label><br>
            <input type="password" name="password" required><br>
            <label for="">Heslo znovu</label><br>
            <input type="password" name="password_again" required><br>
            <input type="submit" value="Zaregistrovat se">
        </form>
    </section>
</main>

<?php require "includes/footer.php" ?>
    
</body>
</html>