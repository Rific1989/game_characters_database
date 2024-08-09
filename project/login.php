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
    <section class="login-form">
        <form action="admin/login_process.php" method="post">
            <label for="">Email</label><br>
            <input type="email" name="user_email" required><br>
            <label for="">Heslo</label><br>
            <input type="password" name="user_password" required><br>
            <input type="submit" value="Přihlásit se">
        </form>
    </section>
</main>

<?php require "includes/footer.php" ?>
    
</body>
</html>