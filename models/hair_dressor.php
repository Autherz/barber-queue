<?php
    class HairDressor {
        public $id;
        public $name;
        public $phone;
        public $image;
        function __construct($name, $phone, $image) {
            $this->name = $name;
            $this->price = $phone;
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
    }