<?php

class DB{

    protected static $connec;

    public static function getConnection()
    {

        if (empty(self::$connec)) {

            $param = array(
                "host" => "localhost",
                "port" => "3306",
                "user" => "root",
                "pass" => "root",
                "db" => "desarrollo_web",
                "charset" => "UTF-8"
            );

            try {
                // self::$connec = new PDO("mysql:host=" . $param['host'] . ";dbname=" . $param['db'] . ", " . $param['user'] . ", " . $param['pass']);
                self::$connec = new PDO('mysql:host=localhost;dbname=digicertificados', 'root', 'root');
            } catch (PDOException $error) {
                echo $error->getMessage();
            }
        }

        return self::$connec;
    }


}