<?php

class DatabaseHelper {
    // Create the connection to the database
    public static function createConnectionInfo($values=array()) {
        // pass in the connection string, username, and password as array
        $connString = $values[0];
        $user = $values[1];
        $password = $values[2];
        $pdo = new PDO($connString,$user,$password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
        }
        
        // run an SQL query and return the cursor to the database
        public static function runQuery($connection, $sql, $parameters=array()) {
        // Ensure parameters are in an array
        if (!is_array($parameters)) {
        $parameters = array($parameters);
        }
        $statement = null;
            if (count($parameters) > 0) {
            // Use a prepared statement if parameters
            $statement = $connection->prepare($sql);
            $executedOk = $statement->execute($parameters);
                if (! $executedOk) {
                throw new PDOException;
                }
            } 
            else {
            // Execute a normal query
            $statement = $connection->query($sql);
                if (!$statement) {
                throw new PDOException;
            }
        }
    return $statement;
    }
}


?>