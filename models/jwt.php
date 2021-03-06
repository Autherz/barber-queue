<?php 
    use Firebase\JWT\JWT;

    class Token {
        private static $publicKey = <<<EOD
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

        public static function verify() {

            if(isset($_SESSION['key'])){
                $decoded = JWT::decode($_SESSION["key"], self::$publicKey, array('RS256'));
                return $decoded;
            }
        }
    }