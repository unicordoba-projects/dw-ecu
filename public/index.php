<?php
// código estricto
declare(strict_types=1);

require __DIR__ . '/../vendor/autoload.php';


use Core\Router;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Illuminate\Database\Capsule\Manager as Capsule;

// composer require illuminate/database
// Inicializa la conexión a la base de datos
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
$capsule->bootEloquent();






// 2. Autocarga de controladores (asume que cada controlador es una clase en controllers/NombreController.php)
spl_autoload_register(function (string $className) {
    $file = __DIR__ . '/../src/Controllers/' . $className . '.php';
    if (file_exists($file)) {
        require $file;
    }
});

// 3. Instanciamos el router
$router = new Router();
$jwtSecret = 'rgjjYtrrfGhjiuYtrDFGhjKoiuYTrfgHJkoiuYTGHjOiuYtGHjI';  // Debe ser la misma que en index.php


// 4. Definición de rutas
include __DIR__ . '/../routes/web.php'; // Rutas de la API REST


// — puedes seguir añadiendo más rutas aquí —

// 5. Disparamos el router
$requestUri    = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$requestMethod = $_SERVER['REQUEST_METHOD'];


if (!($requestUri === '/login' && $requestMethod === 'POST')) {
    // Esperamos cabecera: Authorization: Bearer <token>
    $authHeader = $_SERVER['HTTP_AUTHORIZATION'] ?? '';
    if (!preg_match('/Bearer\s(\S+)/', $authHeader, $matches)) {
        header('HTTP/1.1 401 Unauthorized');
        echo 'Token no proporcionado';
        exit;
    }

    $token = $matches[1];
    try {
        // Decodificamos y validamos firma/expiración
        $decoded = JWT::decode($token, new Key($jwtSecret, 'HS256'));
        // Opcional: podrías inyectar $decoded->sub o $decoded->username
        // p.ej. define('AUTH_USER_ID', $decoded->sub);
    } catch (\Firebase\JWT\ExpiredException $e) {
        header('HTTP/1.1 401 Unauthorized');
        echo 'Token expirado';
        exit;
    } catch (\Firebase\JWT\SignatureInvalidException $e) {
        header('HTTP/1.1 401 Unauthorized');
        echo 'Firma de token inválida';
        exit;
    } catch (\DomainException | \UnexpectedValueException $e) {
        header('HTTP/1.1 401 Unauthorized');
        echo 'Token inválido';
        exit;
    }
}

$router->dispatch($requestUri, $requestMethod);




// pm.test("SetSessionToken", function () {
//     if(pm.response.to.have.status(200)){
//         var jsonData = pm.response.json();
//         pm.globals.unset("SESSION_TOKEN")
//         pm.globals.set("SESSION_TOKEN", `${jsonData.token}`);
//     }
// });