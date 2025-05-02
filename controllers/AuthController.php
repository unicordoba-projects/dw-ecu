<?php
// controllers/AuthController.php

use Firebase\JWT\JWT;

class AuthController
{
    private string $jwtSecret = 'TU_CLAVE_SECRETA_AQUI';  // Debe ser la misma que en index.php
    private int    $tokenTTL  = 3600;                     // segundos de validez (1 hora)

    /**
     * POST /login
     * {
     *   "username": "admin",
     *   "password": "secreto"
     * }
     */
    public function login(): void
    {
        // 1. Leemos JSON de cuerpo
        $input = json_decode(file_get_contents('php://input'), true);
        $user  = $input['username'] ?? '';
        $pass  = $input['password'] ?? '';

        // 2. Valida credenciales (aquí tu lógica real: BD, LDAP, etc.)
        if ($user === 'admin' && $pass === 'secreto123') {
            $now       = time();
            $payload   = [
                'iat'      => $now,
                'exp'      => $now + $this->tokenTTL,
                'sub'      => 1,        // id de usuario
                'username' => $user,
            ];
            $jwt = JWT::encode($payload, $this->jwtSecret, 'HS256');

            header('Content-Type: application/json');
            echo json_encode(['token' => $jwt], JSON_UNESCAPED_UNICODE);
        } else {
            header('HTTP/1.1 401 Unauthorized');
            echo 'Credenciales inválidas';
        }
    }
}
