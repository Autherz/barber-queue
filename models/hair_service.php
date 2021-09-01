<?php
    class HairService {
        public $id;
        public $name;
        public $price;
        public $file;
        public $service_type_id;
        function __construct($name, $price, $file, $service_type_id) {
            $this->name = $name;
            $this->price = $price;
            $this->file = $file;
            $this->service_type_id = $service_type_id;
        }
        public function add() {
            try {

                $stmt = DB::get()->prepare("INSERT INTO hair_service VALUES (NULL, '$this->name', '$this->price', '$this->file', '$this->service_type_id');");
                $stmt->execute();
            } catch(PDOException $e){
                echo "Error: " . $e->getMessage();
            }
        }

        public static function get() {
            try {
                $stmt = DB::get()->prepare("SELECT * FROM hair_service");
                $stmt->execute();
                $stmt->setFetchMode(PDO::FETCH_ASSOC);
                return $stmt;
            } catch(PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
        }

        public static function getOne($service_type_id) {
            try {
                $stmt = DB::get()->prepare("SELECT * FROM hair_service WHERE service_type_id = $service_type_id");
                $stmt->execute();
                $stmt->setFetchMode(PDO::FETCH_ASSOC);
                return $stmt;
            } catch(PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
        }
    }