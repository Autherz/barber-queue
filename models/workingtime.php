<?php
    class WorkingTime {
        public $id;
        public $date;
        public $start_time;
        public $end_time;
        public $status;
        public $hair_dressor_id;
        function __construct($date, $start_time, $end_time, $status, $hair_dressor_id) {
            $this->date = $date;
            $this->start_time = $start_time;
            $this->end_time = $end_time;
            $this->status = $status;
            $this->hair_dressor_id = $hair_dressor_id;
        }
        public function add() {
            try {

                $stmt = DB::get()->prepare("INSERT INTO hair_dressor_workingtime VALUES (NULL, '$this->date', '$this->start_time', '$this->end_time', '$this->status', '$this->hair_dressor_id');");
                $stmt->execute();
            } catch(PDOException $e){
                echo "Error: " . $e->getMessage();
            }
        }

        public static function get() {
            try {
                $stmt = DB::get()->prepare("SELECT * FROM hair_dressor_workingtime");
                $stmt->execute();
                $stmt->setFetchMode(PDO::FETCH_ASSOC);
                return $stmt;
            } catch(PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
        }
    }