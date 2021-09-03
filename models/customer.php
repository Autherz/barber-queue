<?php
    class Customer {
        public $id;
        public $name;
        public $username;
        public $email;
        public $phone;
        public $address;
        private $password;

        function __construct($name, $username, $email, $phone, $address, $password) {
            $this->name = $name;
            $this->username = $username;
            $this->email = $email;
            $this->phone = $phone;
            $this->address = $address;
            $this->password = $password;
        }

        public function add() {
            try {
                $options = [
                    'cost' => 12,
                ];
                $this->password = password_hash($this->password, PASSWORD_BCRYPT, $options);
                $stmt = DB::get()->prepare("INSERT INTO customers VALUES (NULL, '$this->name', '$this->username', '$this->email','$this->phone','$this->address', '$this->password', false);");
                $stmt->execute();
            } catch(PDOException $e){
                echo "Error: " . $e->getMessage();
            }
        }

        public static function usernameExist($username) {
            try {
                $stmt = DB::get()->prepare("SELECT username FROM customers WHERE username = '$username'");
                $stmt->execute();
                if ($stmt->rowCount() > 0) {
                    return true;
                }
                return false;
            } catch(PDOException $e){
                echo "Error: " . $e->getMessage();
            }
        }

        public static function emailExist($email) {
            try {
                $stmt = DB::get()->prepare("SELECT email FROM customers WHERE email = '$email'");
                $stmt->execute();
                if ($stmt->rowCount() > 0) {
                    return true;
                }
                return false;
            } catch(PDOException $e){
                echo "Error: " . $e->getMessage();
            }
        }
    }