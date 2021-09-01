<?php 
    class DB {
        private static $instance = null;
        private static $servername = "localhost";
        private static $databasename = "barber";
        private static $username = "root";
        private static $password = "";

        public static function get() {
            if (self::$instance == null) {
                try {
                    self::$instance = new PDO("mysql:host=" . self::$servername . ";dbname=" . self::$databasename, self::$username, self::$password);
                    self::$instance->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
                    self::$instance->exec ( "SET NAMES \"utf8\"" );
                    // echo "Connected successfully";
                } catch(PDOException $e){
                    throw $e ;
                }
            }
            return self::$instance;
        }
    }