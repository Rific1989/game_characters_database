<?php

class Character {

    /**
     * 
     * Add character to database
     * 
     * @param object $connection - connection to database
     * @param string $first_name - name of character
     * @param string $second_name - surname of character
     * @param string $nationality - nationality of character
     * @param string $game_name - name of game series or single game
     * @param string $basic_info - description of character features, life etc.
     * 
     * @return int $id - id of added character to database
     * 
     */
    public function createCharacter($connection, $first_name, $second_name, $nationality, $game_name, $basic_info)
    {
        $sql = "INSERT INTO gamecharacter(first_name, second_name, nationality, game_name, basic_info) 
                VALUES(:first_name, :second_name, :nationality, :game_name, :basic_info)";

        $stmt = $connection->prepare($sql);

        $stmt->bindValue(":first_name", $first_name, PDO::PARAM_STR);
        $stmt->bindValue(":second_name", $second_name, PDO::PARAM_STR);
        $stmt->bindValue(":nationality", $nationality, PDO::PARAM_STR);
        $stmt->bindValue(":game_name", $game_name, PDO::PARAM_STR);
        $stmt->bindValue(":basic_info", $basic_info, PDO::PARAM_STR);

        try {
            if($stmt->execute())
            {
                $id = $connection->lastInsertId();
                return $id;
            } else 
            {
                throw new Exception("Insert new character was failed");
            }
        } catch (Exception $e) 
        {
            error_log("Error in function createCharacter\n", 3, "../errors/error.log");
            echo "Error: " . $e->getMessage();
        }
    }



    /** 
     * 
     * Read only one character from database according to id number
     * 
     * @param object $connection - connection to database
     * @param integer $id - id of character from database
     * 
     * @return mixed - associative array with info about only one specific character according to his id in database
     * 
    */
    public function readCharacter($connection, $id, $columns="*")
    {
        $sql = "SELECT $columns 
                FROM gamecharacter
                WHERE id = :id";
        
        $stmt = $connection->prepare($sql);

        $stmt->bindValue(":id", $id, PDO::PARAM_INT);

        try {
            if($stmt->execute())
            {
                return $stmt->fetch();
            } else 
            {
                throw new Exception("Character from database wasn't read successfully");
            }
        } catch (Exception $e) 
        {
            error_log("Error in function readCharacter\n", 3, "../errors/error.log");
            echo "Error: " . $e->getMessage();
        }
    }


    
    /**
     * 
     * Read all characters from database
     * 
     * @param object $connection - connection to database
     * 
     * @return mixed - associative array of objects (all records from database)
     * 
     */
    public function readAllCharacters($connection, $columns = "*")
    {
        $sql = "SELECT $columns
                FROM gamecharacter";

        $stmt = $connection->prepare($sql);

        try {
            if($stmt->execute())
            {
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            } else 
            {
                throw new Exception("Read all characters from database was failed");
            }
        } catch (Exception $e) {
            error_log("Error in function readAllCharacters\n", 3, "../errors/error.log");
            echo "Error: " . $e->getMessage();
        }
    }



    /**
     * 
     * Update all inputs about one character
     * 
     * @param object $connection - connection to database
     * @param string $first_name - name of character
     * @param string $second_name - surname of character
     * @param string $nationality - nationality of character
     * @param string $game_name - name of game series or single game
     * @param string $basic_info - description of character features, life etc.
     * 
     * @return bool true - return true if update was made successfully
     * 
     */
    public function updateCharacter($connection, $first_name, $second_name, $nationality, $game_name, $basic_info, $id)
    {
        $sql = "UPDATE gamecharacter
                SET first_name = :first_name,
                    second_name = :second_name,
                    nationality = :nationality,
                    game_name = :game_name,
                    basic_info = :basic_info
                WHERE id = :id";

        $stmt = $connection->prepare($sql);

        $stmt->bindValue(":first_name", $first_name, PDO::PARAM_STR);
        $stmt->bindValue(":second_name", $second_name, PDO::PARAM_STR);
        $stmt->bindValue(":nationality", $nationality, PDO::PARAM_STR);
        $stmt->bindValue(":game_name", $game_name, PDO::PARAM_STR);
        $stmt->bindValue(":basic_info", $basic_info, PDO::PARAM_STR);
        $stmt->bindValue(":id", $id, PDO::PARAM_INT);

        try {
            if($stmt->execute())
            {
                return true;
            } else 
            {
                throw new Exception("Update of character was failed");
            }
        } catch (Exception $e) {
            error_log("Error in function updateCharacter\n", 3, "../errors/error.log");
            echo "Error: " . $e->getMessage();
        }
    }



    /**
     * 
     * Delete character from database according to his ID
     * 
     * @param object $connection - connection to database
     * @param integer $id - id of character we want to delete
     * 
     * @return void
     * 
     */
    public function deleteCharacter($connection, $id){

        $sql = "DELETE 
                FROM gamecharacter 
                WHERE id = :id";

        $stmt = $connection->prepare($sql);

        $stmt->bindValue(":id", $id, PDO::PARAM_INT);

        try {
            if($stmt->execute())
            {
                return true;
            } else 
            {
                throw new Exception("Delete of character was failed");
            }
        } catch (Exception $e) {
            error_log("Error in function deleteCharacter\n", 3, "../errors/error.log");
            echo "Error: " . $e->getMessage();
        }

    }

}

?>