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

        public static function get($hair_dressor_id, $date) {
            try {
                // $temp_time = date('Y-m-d', strtotime($date));
                $stmt = DB::get()->prepare("SELECT * FROM hair_dressor_workingtime  WHERE hair_dressor_id = $hair_dressor_id AND worktime_date >= '$date' ORDER BY worktime_date, start_time ASC");
                $stmt->execute();
                $stmt->setFetchMode(PDO::FETCH_ASSOC);
                return $stmt;
            } catch(PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
        }

        public static function getInner($id) {
            try {
                // $temp_time = date('Y-m-d', strtotime($date));
                $stmt = DB::get()->prepare("SELECT * FROM hair_dressor_workingtime INNER JOIN hair_dressor ON hair_dressor_workingtime.hair_dressor_id = hair_dressor.hair_dressor_id WHERE working_time_id = $id");
                $stmt->execute();
                $stmt->setFetchMode(PDO::FETCH_ASSOC);
                return $stmt;
            } catch(PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
        }


        public function update($id) {
            try {
                $stmt = DB::get()->prepare("UPDATE hair_dressor_workingtime SET hair_dressor_status = '$this->status' WHERE working_time_id = $id");
                $stmt->execute();
                // return DB::get()->lastInsertId();
            } catch(PDOException $e){
                echo "Error: " . $e->getMessage();
            }
        }
        
    }