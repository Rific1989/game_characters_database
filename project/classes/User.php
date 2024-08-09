<?php

class User {

    /**
     * 
     * Create new user and add to database
     * 
     * @param object $connection - connection to database
     * @param string $first_name - first name of new user
     * @param string $second_name - surname of new user
     * @param string $email - email of new user (will be used as username for login as well)
     * @param string $password - password of new user
     * 
     * @return integer $id - id of new user
     * 
     */
    public static function createUser($connection, $first_name, $second_name, $email, $password, $role)
    {
        $sql = "INSERT INTO user(first_name, second_name, email, password, role)
                VALUES(:first_name, :second_name, :email, :password, :role)";

        $stmt = $connection->prepare($sql);

        $stmt->bindValue(":first_name", $first_name, PDO::PARAM_STR);
        $stmt->bindValue(":second_name", $second_name, PDO::PARAM_STR);
        $stmt->bindValue(":email", $email, PDO::PARAM_STR);
        $stmt->bindValue(":password", $password, PDO::PARAM_STR);
        $stmt->bindValue(":role", $role, PDO::PARAM_STR);

        try {
            if($stmt->execute())
            {
                $id = $connection->lastInsertId();
                return $id;
            } else 
            {
                throw new Exception("Registration was failed");
            }
        } catch (Exception $e) {
            error_log("Error in function createUser\n", 3, "../errors/error.log");
            echo "Error: " . $e->getMessage();
        }
    }



    /**
     * 
     * Verification of user using by email and password
     * 
     * @param object $connection - connection to database
     * @param string $user_email - user's email from form
     * @param string $paassword - user's password from form
     * 
     * @return bool - true if log-in is successful, false - if log-in is not successful
     * 
     */
    public static function authentication($connection, $user_email, $user_password)
    {
        $sql = "SELECT password
                FROM user
                WHERE email = :email";

        $stmt = $connection->prepare($sql);

        $stmt->bindValue(":email", $user_email, PDO::PARAM_STR);

        try {
            if($stmt->execute())
            {
                if($user = $stmt->fetch())
                {
                    return password_verify($user_password, $user[0]);
                }
            } else 
            {
                throw new Exception("Authentication was failed");
            }
        } catch (Exception $e) {
            error_log("Error in function authentication\n", 3, "../errors/error.log");
            echo "Error: " . $e->getMessage();
        }
    }



    /**
     * 
     * Get the user ID from database according to email address
     * 
     * @param $connection - connection to dabase
     * @param string $user_email - email of user 
     *
     * @return int $user_id - return user id associated with user email
     * 
     */
    public static function readUserId($connection, $user_email)
    {
        $sql = "SELECT id 
                FROM user
                WHERE email = :email";

        $stmt = $connection->prepare($sql);

        $stmt->bindValue(":email", $user_email, PDO::PARAM_STR);

        try {
            if($stmt->execute())
            {
                $result = $stmt->fetch(PDO::FETCH_NUM);
                $user_id = $result[0];
                return $user_id;
            } else 
            {
                throw new Exception("Read the id of user was failed");
            }
        } catch (Exception $e) {
            error_log("Error in function readUserId\n", 3, "../errors/error.log");
            echo "Error: " . $e->getMessage();
        }

    }

    

    /**
     * 
     * Get the role of registered user
     * 
     * @param object $connection - connection to database
     * @param int $id - id of registered user
     * 
     * @return string $result["role"] - type of specific role
     * 
     * */
    public static function readUserRole($connection, $id)
    {
        $sql = "SELECT role 
                FROM user
                WHERE id = :id";

        $stmt = $connection->prepare($sql);

        $stmt->bindValue(":id", $id, PDO::PARAM_INT);

        try {
            if($stmt->execute())
            {
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                return $result["role"];
            } else 
            {
                throw new Exception("Read the role of user was failed");
            }
        } catch (Exception $e) {
            error_log("Error in function readUserRole\n", 3, "../errors/error.log");
            echo "Error: " . $e->getMessage();
        }

    }

}


?>