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
                $stmt = DB::get()->prepare("INSERT INTO booking_detail VALUES (NULL, '$this->booking_date', '$this->tot_price', '$this->amount_price', '$this->paid_date', '$this->paid_time', '$this->booking_status', '$this->customer_id', '$this->slip_file', '$this->amount_lelt', '$this->booking_time');");
                $stmt->execute();
                return DB::get()->lastInsertId();
            } catch(PDOException $e){
                echo "Error: " . $e->getMessage();
            }
        }
    }