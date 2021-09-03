
# ตั้งค่ากับ xampp สำหรับ windows
1. โหลด xampp จาก  [Link xampp](https://www.apachefriends.org/index.html).
2. ติดตั้งแล้วเปิด apache tomcat และ mysql

    ![config_1](/readme/config_1.png)

3. นำโฟลเดอร์โปรเจคไปไว้ที่ C:\xampp\htdocs

    ![config_1](/readme/config_3.png)

# ตั้งค่า composer
1. โหลด composer จาก  [Link Composer](https://getcomposer.org/download/).
2. ไปที่ vscode และ เปิด project (C:\xampp\htdocs\barber-queue) ขึ้นมา
3. ไปที่ terminal และ รันคำสั่ง
    ```
    composer install
    ```
    ![config_2](/readme/config_2.png)

# ตั้งค่า database
1. เช็คก่อนว่า server ทำงานได้ปกติโดยไปที่ localhost/barber-queue
2. เข้าไปเซ็ตข้อมูลใน database/setting.inc.php ให้ตรงกับ database ที่เราสร้าง
3. สร้าง schema โดยเรียก (ถ้าทำงานได้ปกติจะขึ้น Database created successfully)
    ```
    http://localhost/barber-queue/database/create_db.php
    ```
4. สร้าง table โดยเรียก (ถ้าทำงานได้ปกติจะขึ้น Table created successfully)
    ```
    http://localhost/barber-queue/database/create_table.php
    ```
5. สร้าง data โดยเรียก (ถ้าทำงานได้ปกติจะขึ้น Data created successfully)
    ```
    http://localhost/barber-queue/database/create_db.php
    ```