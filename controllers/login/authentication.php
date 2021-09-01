<?php 
    session_start();
    require_once '../../vendor/autoload.php';
    require_once "../../database/connect.php";
    use Firebase\JWT\JWT;
    header('Content-Type: application/json');

    $privateKey = <<<EOD
    -----BEGIN RSA PRIVATE KEY-----
    MIIEpQIBAAKCAQEAyyR4pxEhFtbkvXtNyc5c9KUUVtFz5vtnzcJRakv57wG3RRdc
    JiSo+UYwyKhGwxEgTktbwgtjczukHTQfwglX0qjEFSMLReWMwfCo/qheSYzYTiI6
    Hkk46VWVcYqiJVGWZElJN+f6H+Ro5pZqbOeoKbzC0gV5A7An25kUIGIVWU+fQb1Q
    /ZaiQQ6k2dPs26h6LLu+q9TzqIIxvBDJ0yd2DwYq0zXiKCr6ozH7mqVgZeotSOCy
    7QABi0a0uY9dV63Df2Q9uTeSjV+kti30v5Of5F3PmO0RkPImgIwPvP15vjowI68P
    M3QRkfkwaFC5Vv0TIvRN/FGFarJgYfHRuWi7ewIDAQABAoIBAQC1d28QTwzwCidr
    3KowjFgdcxooNBMFU6/27o8sFZK/HxlIbwWyTS1lAH6zwR71QmdJiaf+P44nci+4
    psd33kDFvlzrRNLdLaH/3awZUO5pZZgUtB6Wz3I3fmxxcRZHoApoq87sUh3uP2w2
    EEgh4Q8nuaePVbQ0xzfTw3tnMjc//3hNMXZ50xmkVTXUawGby3U+aPMLOby4OId0
    Nilg3AFhwTim8MNRB9oe/UtCRfMAb97bASGS+sP0/8GHYC7bcnM/KKd3iBZfeR12
    DNktRxTfCth2OsE1q6fkC4uhar6JN7N9eHywmy6tHke5Af9zr8k4EfsXgqRSdjfz
    LSm2eb8BAoGBAPM/51oONNccjoaXCbRaSwyy6SiymkxyevSXPM2g9SIyxKFIp1pL
    XYDiDCx08MsZUrw3A+f+xzmtqNEXe/IG2smjJw2t/bjcB8mjPM54lrN0SO6n5I7m
    nPfJ2mhDuRfYs0qMLnk8vch5tc20M8XNmiKQATj72xzSDR1YBUdUQzvpAoGBANXK
    YZj+UAHkawOzx2VSpDomFUFwLstfxixd3Aql5O/kFKUAZ92PpygBjXOiugRx3r0S
    149xWenelHxDr7FMntuy1oVUaSfPXDT7Y4t4u0majR1i2fOWDoduDknf4IsWnV6t
    fRz0lCVgaO9wsd5h7grqkOh2gKRA7xlMgf+R1rHDAoGBAKJiWKlProqjr6m9jmbt
    mAhEL05R3JuIGPjLNXX4K2zHA2i/vaiTgzoUrRfIgS60Gv02pM7s0EZ63aWnzcBG
    Pyw4VEvXiPctO62p4V/cNI5b5IwdXIDhBoyMHddYzmlS6m2royKgH/mC9pD56U30
    8R59j7NgvmdA+ixKpEt3vuJxAoGAEC4g9NNKetouvzj7/k8i3sPDGBDFed7lwLXZ
    0XR8vysj5NkDA2G75Os5KWdHbM6xbN3gMpsBkxGla0I0KdcCrt36Hl0lGD45XEkq
    X4PjqM5pn6+7jxPsRZOuwSiQdfZgMqoureJU0/9X8cc1rv76ZRkbnnxZgBTqA6Am
    tpDzDsECgYEAyJ+MXTYhqrJgOFwsleh44JLYWJrp8+WcK39WuekXQ1HjjTGZ/wz4
    AwvRWVw6Ev0VIIBYj2xMF17QT2JCB1z+sWkUmsaRYhxsVW4M/IhHIyfWshnrRFCp
    4fL67FIQ+cY1gdzHALaUdCzT4nxCPh80qEAwW7oQY9UucHRWCcXMRiA=
    -----END RSA PRIVATE KEY-----
    EOD;

    $publicKey = <<<EOD
    -----BEGIN PUBLIC KEY-----
    MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAyyR4pxEhFtbkvXtNyc5c
    9KUUVtFz5vtnzcJRakv57wG3RRdcJiSo+UYwyKhGwxEgTktbwgtjczukHTQfwglX
    0qjEFSMLReWMwfCo/qheSYzYTiI6Hkk46VWVcYqiJVGWZElJN+f6H+Ro5pZqbOeo
    KbzC0gV5A7An25kUIGIVWU+fQb1Q/ZaiQQ6k2dPs26h6LLu+q9TzqIIxvBDJ0yd2
    DwYq0zXiKCr6ozH7mqVgZeotSOCy7QABi0a0uY9dV63Df2Q9uTeSjV+kti30v5Of
    5F3PmO0RkPImgIwPvP15vjowI68PM3QRkfkwaFC5Vv0TIvRN/FGFarJgYfHRuWi7
    ewIDAQAB
    -----END PUBLIC KEY-----
    EOD;

    $data = json_decode(file_get_contents("php://input"), TRUE);
    $username = $data['username'];
    $password = $data['password'];
    
    $stmt = DB::get()->prepare("SELECT * FROM customers WHERE username = '$username'");
    $stmt->execute();
    $row = $stmt->fetch();

    $date = new DateTime();
    if($row) {
        if (password_verify($password, $row["password"])) {

            $payload = array(
                "name" => $row["name"],
                "username" => $row["username"],
                "email" => $row["email"],
                "address" => $row["address"],
                "phone" => $row["phone"],
                "admin" => $row["admin"],
                "iat" => $date->getTimestamp(),
            );
            
            $jwt = JWT::encode($payload, $privateKey, 'RS256');
            // $decoded = JWT::decode($jwt, $publicKey, array('RS256'));

            $_SESSION["key"] = $jwt;
            http_response_code(200);
            echo json_encode([
                'status' => 'success',
                'msg' => 'login success',
                "key" => $jwt,
                'isAdmin' => $row["admin"]
            ]);
        } else {
            http_response_code(400);
            echo json_encode([
                'status' => 'error',
                'msg' => 'username or password is incorrent!'
            ]);
        }
    } else {
        http_response_code(400);
        echo json_encode([
            'status' => 'error',
            'msg' => 'username or password is incorrent!'
        ]);
    }