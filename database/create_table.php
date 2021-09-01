<?php 

    $servername = "localhost";
    $username = "root";
    $password = "";
    $databasename = "barber";

    $statements = [
        // 'CREATE TABLE customers(
        //     customer_id INT AUTO_INCREMENT,
        //     name VARCHAR(100) NOT NULL,
        //     username VARCHAR(100) NOT NULL,
        //     email  VARCHAR(100) NOT NULL,
        //     phone VARCHAR(100) NULL,
        //     address VARCHAR(100) NULL,
        //     password VARCHAR(100) NOT NULL,
        //     admin BOOLEAN  NOT NULL,
        //     PRIMARY KEY(customer_id)
        // );',
        // 'CREATE TABLE service_type(
        //     service_type_id INT AUTO_INCREMENT,
        //     service_type_name VARCHAR(100) NOT NULL,
        //     service_file VARCHAR(100) NOT NULL,
        //     PRIMARY KEY(service_type_id)
        // );',
        // 'CREATE TABLE hair_service(
        //     hair_service_id INT AUTO_INCREMENT,
        //     hair_service_name VARCHAR(100) NOT NULL,
        //     hair_service_price DOUBLE NOT NULL,
        //     hair_service_file VARCHAR(100) NOT NULL,
        //     service_type_id INT,
        //     PRIMARY KEY(hair_service_id),
        //     FOREIGN KEY(service_type_id) REFERENCES service_type(service_type_id)
        // );',
        // 'CREATE TABLE hair_dressor(
        //     hair_dressor_id INT AUTO_INCREMENT,
        //     hair_dressor_name VARCHAR(100) NOT NULL,
        //     hair_dressor_phone INT NOT NULL,
        //     hair_dressor_image VARCHAR(100),
        //     PRIMARY KEY(hair_dressor_id)
        // );'
        'CREATE TABLE hair_dressor_workingtime(
            working_time_id INT AUTO_INCREMENT,
            date VARCHAR(100) NOT NULL,
            start_time VARCHAR(100) NOT NULL,
            end_time VARCHAR(100) NOT NULL,
            status VARCHAR(100) NOT NULL,
            hair_dressor_id INT,
            PRIMARY KEY(working_time_id),
            FOREIGN KEY(hair_dressor_id) REFERENCES hair_dressor(hair_dressor_id)
        );'
    ];

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$databasename", $username, $password);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        foreach ($statements as $statement) {
            $conn->exec($statement);
        }
        
        echo "Table created successfully<br>";
      } catch(PDOException $e) {
        echo "<br>" . $e->getMessage();
      }
      
      $conn = null;