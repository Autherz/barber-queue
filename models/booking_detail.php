<?php
    class BookingDetail {
        public $booking_id;
        public $hair_service_id;
        public $hair_dressor_id;
        public $hair_dressor_date;
        public $start_time;
        public $end_time;
        public $price;
        function __construct($booking_id, $hair_service_id, $hair_dressor_id, $hair_dressor_date, $start_time, $end_time, $price  ) {
            $this->booking_id = $booking_id;
            $this->hair_service_id = $hair_service_id;
            $this->hair_dressor_id = $hair_dressor_id;
            $this->hair_dressor_date = $hair_dressor_date;
            $this->start_time = $start_time;
            $this->end_time = $end_time;
            $this->price = $price;
        }
        public function add() {
            try {
                $this->start_time = str_replace(".", ":", $this->start_time);
                $this->end_time = str_replace(".", ":", $this->end_time);
                $stmt = DB::get()->prepare("INSERT INTO booking_detail VALUES (NULL, '$this->booking_id', '$this->hair_service_id', '$this->hair_dressor_id', '$this->hair_dressor_date', '$this->start_time', '$this->end_time', '$this->price');");
                $stmt->execute();
                return DB::get()->lastInsertId();
            } catch(PDOException $e){
                echo "Error: " . $e->getMessage();
            }
        }

        public static function get() {
            try {
                $stmt = DB::get()->prepare("SELECT * FROM booking_detail 
                INNER JOIN booking ON booking_detail.booking_id = booking.booking_id
                INNER JOIN hair_service ON booking_detail.hair_service_id = hair_service.hair_service_id
                INNER JOIN hair_dressor ON booking_detail.hair_dressor_id = hair_dressor.hair_dressor_id 
                ORDER BY booking_date DESC;");
                $stmt->execute();
                $stmt->setFetchMode(PDO::FETCH_ASSOC);
                return $stmt;
            } catch(PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
        }

        public static function getByCustomerId($customer_id) {
            try {
                $stmt = DB::get()->prepare("SELECT * FROM booking_detail 
                INNER JOIN booking ON booking_detail.booking_id = booking.booking_id
                INNER JOIN hair_service ON booking_detail.hair_service_id = hair_service.hair_service_id
                INNER JOIN hair_dressor ON booking_detail.hair_dressor_id = hair_dressor.hair_dressor_id
                WHERE customer_id = $customer_id
                ORDER BY booking_date DESC;");
                $stmt->execute();
                $stmt->setFetchMode(PDO::FETCH_ASSOC);
                return $stmt;
            } catch(PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
        }
    }