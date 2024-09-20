<?php

    class Database
    {
        private static $dbHost = "localhost";
        private static $dbName = "burgercode";
        private static $dbUser = "root";
        private static $dbUserPassword = "";

        private static $connection = null;
        
        public static function connect(){
            if(self::$connection == null){
                try {
                    self::$connection = new PDO("mysql:host=". self::$dbHost .";dbname=" . self::$dbName,self::$dbUser,self::$dbUserPassword);
                }
                catch (PDOException $e) {
                    die($e->getMessage());
                }
            }
        
            return self::$connection;
        }
        
        public static function disconnect(){
            self::$connection = null;
        }
    }
