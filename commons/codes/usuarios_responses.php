<?PHP

class UserResponses {

    static $usuario_response = [
        "READ" => [
            "code"=> "READ",
            "message"=> "Datos obtenidos de forma satisfactoria",
            "status" => 200
        ],
        "READ_ERROR" => [
            "code"=> "READ_ERROR",
            "message"=> "No existen datos registrados",
            "status" => 404
        ],
        "CREATE" => [
            "code"=> "CREATE",
            "message"=> "Datos registrados satisfactoriamente",
            "status" => 201
        ],
        "ERROR" => [
            "code"=> "ERROR",
            "message"=> "Error al ejecutr la consulta",
            "status" => 400
        ],
    ];
    public static function getCode($code) {
        return self::$usuario_response[$code];
    }
}


