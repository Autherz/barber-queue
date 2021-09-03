<?php
    class ServiceType {
        public $id;
        public $name;
        public $file;
        function __construct($name, $file) {
            $this->name = $name;
            $this->file = $file;
        }
        public function add() {
            try {
                $stmt = DB::get()->prepare("INSERT INTO service_type VALUES (NULL, '$this->name', '$this->file');");
                $stmt->execute();
            } catch(PDOException $e){
                echo "Error: " . $e->getMessage();
            }
        }

        public static function get() {
            try {
                $stmt = DB::get()->prepare("SELECT * FROM service_type");
                $stmt->execute();
                $stmt->setFetchMode(PDO::FETCH_ASSOC);
                return $stmt;
            } catch(PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
        }

        public function update($id) {
            try {
                $stmt = DB::get()->prepare("UPDATE service_type SET service_type_name = '$this->name', service_file = '$this->file' WHERE service_type_id = $id");
                $stmt->execute();
                // return DB::get()->lastInsertId();
            } catch(PDOException $e){
                echo "Error: " . $e->getMessage();
            }
        }
    }