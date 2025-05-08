<?php

namespace App\Models;

use Illuminate\Database\Capsule\Manager as Capsule;


class DBORM
{
    protected static $connec;

    public static function getConnection()
    {
        if (empty(self::$connec)) {
            $capsule = new Capsule;

            $capsule->addConnection([
                'driver' => 'mysql',
                'host' => 'localhost',
                'database' => 'digicertificados',
                'username' => 'root',
                'password' => 'root',
                'charset' => 'utf8',
                'collation' => 'utf8_unicode_ci',
                'prefix' => '',
            ]);

            $capsule->setAsGlobal();
        }

        return self::$connec;
        
    }
}