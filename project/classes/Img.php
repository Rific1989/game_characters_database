<?php

class Img {
    /**
     * 
     * Insert img to database
     * 
     * @param object $connection - connection to database
     * @param integer $user_id - id of user who put img to database
     * @param string - img_name - the name of the img being uploaded
     * 
     * @return bool - true if img was successfully inserted into database
     * 
     */
    public static function insertImg($connection, $user_id, $img_name)
    {
        $sql = "INSERT INTO img(user_id, img_name)
                VALUES(:user_id, :img_name)";

        $stmt = $connection->prepare($sql);

        $stmt->bindValue(":user_id", $user_id, PDO::PARAM_INT);
        $stmt->bindValue(":img_name", $img_name, PDO::PARAM_STR);

        if($stmt->execute()){
            return true;
        }
    }



    /**
     * 
     * Get all images associated with a specific user ID
     * 
     * @param object $connection - connection to database
     * @param integer $user_id - user ID who gets the img
     * 
     * @return array $images - array of associatvie arrays with image names
     * 
     */
    public static function readImgByUserId($connection, $user_id)
    {
        $sql = "SELECT img_name
                FROM img
                WHERE user_id = :user_id";

        $stmt = $connection->prepare($sql);

        $stmt->bindValue(":user_id", $user_id, PDO::PARAM_INT);

        $stmt->execute();

        $images = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $images;
        
    }



    /**
     * 
     * Delete img from filesystem only
     * 
     * @param string $path - path to the file with img
     * 
     * @return bool - true if the file was deleted successfully, false if not
     * 
     */
    public static function deleteImgFromFile($path)
    {
        try {
            if(!file_exists($path))
            {
                throw new Exception("The file doesn't exist");
            } 

            if(unlink($path))
            {
                return true;
            } else 
            {
                throw new Exception("Delete of img from file was failed");
            }

        } catch (Exception $e) {
            error_log("Error in function deleteImgFromFile\n", 3, "../errors/error.log");
            echo "Error: " . $e->getMessage();
        }
    }



    /**
     * 
     * Delete img from database only
     * 
     * @param object $connection - connection to database
     * @param string $img_name - name of image that supposed to be deleted
     * 
     * @return void
     * 
     */
    public static function deleteImgFromDatabase($connection, $img_name)
    {
        $sql = "DELETE FROM img
                WHERE img_name = :img_name";

        $stmt = $connection->prepare($sql);

        try {
            $stmt->bindValue(":img_name", $img_name, PDO::PARAM_STR);

            if(!$stmt->execute())
            {
                throw new Exception("Delete of img from database was failed");
            } else 
            {
                return true;
            }
        } catch (Exception $e) {
            error_log("Error in function deleteImgFromDatabase\n", 3, "../errors/error.log");
            echo "Error: " . $e->getMessage();
        }
    }

}

?>