<?php
    date_default_timezone_set("Asia/Bangkok");
    class Booking {
        public $id;
        public $booking_date;
        public $tot_price;
        public $amount_price;
        public $paid_date;
        public $paid_time;
        public $booking_status;
        public $customer_id;
        public $slip_file;
        public $amount_lelt;
        public $booking_time;
        function __construct($booking_date, $booking_time, $tot_price, $amount_price, $paid_date, $paid_time, $booking_status, $customer_id, $slip_file, $amount_lelt) {
            $this->booking_date = $booking_date;
            $this->tot_price = $tot_price;
            $this->amount_price = $amount_price;
            $this->paid_date = $paid_date;
            $this->paid_time = $paid_time;

            $this->booking_status = $booking_status;
            $this->customer_id = $customer_id;
            $this->slip_file = $slip_file;
            $this->amount_lelt = $amount_lelt;
            $this->booking_time = $booking_time;

        }
        public function add() {
            try {
                $stmt = DB::get()->prepare("INSERT INTO booking VALUES (NULL, '$this->booking_date', '$this->tot_price', '$this->amount_price', '$this->paid_date', '$this->paid_time', '$this->booking_status', '$this->customer_id', '$this->slip_file', '$this->amount_lelt', '$this->booking_time');");
                $stmt->execute();
                return DB::get()->lastInsertId();
            } catch(PDOException $e){
                echo "Error: " . $e->getMessage();
            }
        }

        public static function updateSlip($path, $booking_id) {
            try {
                $currentDate = date("Y-m-d");
                $currentTime = date("h:i");
                $stmt = DB::get()->prepare("UPDATE booking SET slip_file = '$path', paid_date = '$currentDate', paid_time = '$currentTime', booking_status = 'ชำระแล้ว' WHERE booking_id = $booking_id");
                $stmt->execute();
                // return DB::get()->lastInsertId();
            } catch(PDOException $e){
                echo "Error: " . $e->getMessage();
            }
        }
    }