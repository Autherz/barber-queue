<?php
    class HairDressor {
        public $id;
        public $name;
        public $phone;
        public $image;
        function __construct($name, $phone, $image) {
            $this->name = $name;
            $this->phone = $phone;
            $this->image = $image;
        }
        public function add() {
            try {

                $stmt = DB::get()->prepare("INSERT INTO hair_dressor VALUES (NULL, '$this->name', '$this->phone', '$this->image');");
                $stmt->execute();
            } catch(PDOException $e){
                echo "Error: " . $e->getMessage();
            }
        }

        public static function get() {
            try {
                $stmt = DB::get()->prepare("SELECT * FROM hair_dressor");
                $stmt->execute();
                $stmt->setFetchMode(PDO::FETCH_ASSOC);
                return $stmt;
            } catch(PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
        }

        public function update($id) {
            try {
                $stmt = DB::get()->prepare("UPDATE hair_dressor SET hair_dressor_name = '$this->name', hair_dressor_image = '$this->image', hair_dressor_phone = '$this->phone' WHERE hair_dressor_id = $id");
                $stmt->execute();
                // return DB::get()->lastInsertId();
            } catch(PDOException $e){
                echo "Error: " . $e->getMessage();
            }
        }
    }