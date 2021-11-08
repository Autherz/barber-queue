<?php 
    include('setting.inc.php');

    $statements = [
        "LOCK TABLES `customers` WRITE;",
        "INSERT INTO `customers` VALUES (1,'atisit thongbai','admin','bom_144440@outlook.co.th','0641461114','ห้อง 105 paradise orchid 191 หมู่ 12\r\n, ต.ศิลา','$2y$12$1EinTx8Kf5rJ53nIjnCoNe4YJj6oHmQTpH.H.bab5T2WPjInfkRjm',1),(2,'ต้น','papawit','papawit@hotmail.com','0825350072','88/7 ต.ศิลา อ.เมือง จ.ขอนแก่น','$2y$12\$zwkf6Dm30a1gFInlvy2bWuhmY3DfR596txMsjwtfjvIHMC6DxDqt2',0),(3,'ต้น','asdton','asdjit@gmail.com','0891574896','847/39 ต.ศิลา อ.เมือง จ.ขอนแก่น','$2y$12\$p6QOsMuoW.Fy6ERWxV9hBugTRXAoNmOqVTi2CaDulK77da61Jgzse',0),(4,'มาร์ค','orochi','orochi@hotmail.com','0831259647','91/4 ต.ศิลา อ.เมือง จ.ขอนแก่น','$2y$12\$NXiVaY6jrYEMMiq7hOOUY.TCKH.LlHbp3kHPKvsuHVzsy1qWS1QW2',0),(5,'ลีโอ','leonado','leonado@gmail.com','0971549863','125/9 ต.ศิลา อ.เมือง จ.ขอนแก่น','$2y$12\$ZGJH2bYV0GNQczuVt3Bu4uK3N7gHHBLvurFF0LXrq6Ke5bVbSKXF6',0);",
        "UNLOCK TABLES;",

        'LOCK TABLES `service_type` WRITE;',
        "INSERT INTO `service_type` VALUES (1,'ตัดผมชาย','assets/images/7.jpg',0),(2,'ทำสีผม','assets/images/15.jpg',0),(3,'โกนหนวด','assets/images/18.jpg',0),(4,'สระ-ไดร์','assets/images/17.jpg',0);",
        "UNLOCK TABLES;",

        "LOCK TABLES `hair_service` WRITE;",
        "INSERT INTO `hair_service` VALUES (1,'ตัดผมหน้าม้า',150,'',1,0),(2,'ตัดผมทรงนักเรียน',100,'assets/images/2.jpg',1,0),(3,'ทำสีผม',500,'assets/images/15.jpg',2,0),(4,'โกนหนวด',50,'assets/images/18.jpg',3,0),(5,'สระ-ไดร์',100,'assets/images/17.jpg',4,0);",
        "UNLOCK TABLES;",

        "LOCK TABLES `hair_dressor` WRITE;",
        "INSERT INTO `hair_dressor` VALUES (1,'ช่างตุ๊ก','0825350072','assets/images/203331331_992936954774302_4121936201705172510_n.jpg',0),(2,'ช่างบูม','0864789654','assets/images/203331331_992936954774302_4121936201705172510_n.jpg',0);",
        "UNLOCK TABLES;",

        "LOCK TABLES `hair_dressor_workingtime` WRITE;",
        "INSERT INTO `hair_dressor_workingtime` VALUES (1,'2021-09-07','10.00','11.00','ว่าง',1),(2,'2021-09-07','09.00','10.00','ว่าง',1),(3,'2021-09-07','11.00','12.00','ว่าง',1),(4,'2021-09-06','12.00','13.00','ว่าง',1),(5,'2021-09-06','13.00','14.00','ไม่ว่าง',1),(6,'2021-09-06','14.00','15.00','ว่าง',1),(7,'2021-09-06','15.00','16.00','ว่าง',1),(8,'2021-09-06','16.00','17.00','ว่าง',1),(9,'2021-09-09','09.00','10.00','ว่าง',2),(10,'2021-09-09','10.00','11.00','ว่าง',2),(11,'2021-09-07','09.00','10.00','ว่าง',2),(12,'2021-09-07','10.00','11.00','ไม่ว่าง',2),(13,'2021-09-07','12.00','13.00','ว่าง',2),(14,'2021-09-07','11.00','12.00','ว่าง',2),(15,'2021-09-07','13.00','14.00','ว่าง',2);",
        "UNLOCK TABLES;",

        "LOCK TABLES `booking` WRITE;",
        "INSERT INTO `booking` VALUES (1,'2021-09-04',100,100,'2021-09-04','12:03:00','ดำาเนินการเสร็จสิ้น',2,'',0,'12:03:00'),(2,'2021-09-04',50,50,'0000-00-00','00:00:00','รอดำาเนินการ',3,'',0,'12:05:00');",
        "UNLOCK TABLES;",

        "LOCK TABLES `booking_detail` WRITE;",
        "INSERT INTO `booking_detail` VALUES (1,1,2,1,'2021-09-06','12:00:00','13:00:00',100),(2,2,4,1,'2021-09-06','16:00:00','17:00:00',50);",
        "UNLOCK TABLES;",
    ];

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$databasename", $username, $password);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        foreach ($statements as $statement) {
            $conn->exec($statement);
        }
        
        echo "Data created successfully<br>";
      } catch(PDOException $e) {
        echo "<br>" . $e->getMessage();
      }
      
      $conn = null;