<?php

function connect_db($dbname, $username, $password) {
    try {
        $mbd = new PDO('mysql:host=localhost;dbname='.$dbname, 
                                                $username, 
                                                $password);
        
        return $mbd;
    } catch (\Throwable $th) {
        print "¡Error de conexión a la base de datos. Revise sus parámetros!";
        print $th->getMessage();
    }
}

?>