<form action="" method="post">
    <label for="">Jméno</label><br>
    <input type="text" 
            name="first_name" 
            required 
            value="<?= htmlspecialchars($first_name) ?>"><br>

    <label for="">Příjmení</label><br>
    <input type="text"
            name="second_name" 
            required
            value="<?= htmlspecialchars($second_name) ?>" ><br>
            
    <label for="">Národnost</label><br>
    <input type="text" 
            name="nationality"
            required
            value="<?= htmlspecialchars($nationality) ?>"><br>

    <label for="">Název hry</label><br>
    <input type="text" 
            name="game_name"
            required
            value="<?= htmlspecialchars($game_name) ?>"><br>

    <label for="">Základní informace</label><br>
    <textarea name="basic_info" 
                id=""
                required><?= htmlspecialchars($basic_info)?></textarea>

    <input type="submit" value="Uložit">
</form>