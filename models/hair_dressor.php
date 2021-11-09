<?php
    class HairDressor {
        public $id;
        public $name;
        public $phone;
        public $image;
        public $work_detail;
        function __construct($name, $phone, $image, $work_detail) {
            $this->name = $name;
            $this->phone = $phone;
            $this->image = $image;
            $this->work_detail = $work_detail;
        }
        public function add() {
            try {

                $stmt = DB::get()->prepare("INSERT INTO hair_dressor VALUES (NULL, '$this->name', '$this->phone', '$this->image', '$this->work_detail', 0);");
                $stmt->execute();
            } catch(PDOException $e){
                echo "Error: " . $e->getMessage();
            }
        }

        public static function get() {
            try {
                $stmt = DB::get()->prepare("SELECT * FROM hair_dressor WHERE disable != 1");
                $stmt->execute();
                $stmt->setFetchMode(PDO::FETCH_ASSOC);
                return $stmt;
            } catch(PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
        }

        public static function getById($id) {
            try {
                $stmt = DB::get()->prepare("SELECT * FROM hair_dressor WHERE hair_dressor_id = $id AND disable != 1");
                $stmt->execute();
                $stmt->setFetchMode(PDO::FETCH_ASSOC);
                return $stmt;
            } catch(PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
        }

        public function update($id) {
            try {
                $stmt = DB::get()->prepare("UPDATE hair_dressor SET hair_dressor_name = '$this->name', hair_dressor_image = '$this->image', hair_dressor_phone = '$this->phone', hair_dressor_work_detail = '$this->work_detail' WHERE hair_dressor_id = $id");
                $stmt->execute();
                // return DB::get()->lastInsertId();
            } catch(PDOException $e){
                echo "Error: " . $e->getMessage();
            }
        }

        public function delete($id) {
            try {
                $stmt = DB::get()->prepare("UPDATE hair_dressor SET disable = 1 WHERE hair_dressor_id = $id");
                $stmt->execute();
                // return DB::get()->lastInsertId();
            } catch(PDOException $e){
                echo "Error: " . $e->getMessage();
            }
        }
    }