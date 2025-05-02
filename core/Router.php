<?php
// core/Router.php

class Router
{
    private array $routes = [];

    /**
     * Registra una ruta con controlador y acción.
     *
     * @param string $path       El URI (p.ej. "users" o "user/{id}")
     * @param string $controller Nombre de la clase controlador (p.ej. "UserController")
     * @param string $action     Nombre del método dentro del controlador (p.ej. "index")
     * @param string $method     Método HTTP (GET, POST, etc.). Por defecto GET.
     */
    public function add(string $path, string $controller, string $action, string $method = 'GET'): void
    {
        $pathPattern = '/' . trim($path, '/');
        $regex = preg_replace('#\{([\w]+)\}#', '(?P<\1>[^/]+)', $pathPattern);
        $this->routes[] = [
            'method'     => strtoupper($method),
            'pattern'    => "#^{$regex}$#",
            'controller' => $controller,
            'action'     => $action,
        ];
    }

    /**
     * Despacha la petición al controlador/acción correspondiente.
     *
     * @param string $requestUri    El URI de la petición (p.ej. "/users" o "/user/42")
     * @param string $requestMethod El método HTTP de la petición
     */
    public function dispatch(string $requestUri, string $requestMethod): void
    {
        foreach ($this->routes as $route) {
            if ($route['method'] !== strtoupper($requestMethod)) {
                continue;
            }
            if (preg_match($route['pattern'], $requestUri, $matches)) {
                // Extraemos sólo los parámetros nombrados
                $params = array_filter(
                    $matches,
                    fn($key) => !is_int($key),
                    ARRAY_FILTER_USE_KEY
                );

                // Instancia el controlador
                $controllerName = $route['controller'];
                if (!class_exists($controllerName)) {
                    header("HTTP/1.1 500 Internal Server Error");
                    echo "Error: Controlador {$controllerName} no encontrado.";
                    return;
                }
                $controller = new $controllerName();

                if (!method_exists($controller, $route['action'])) {
                    header("HTTP/1.1 500 Internal Server Error");
                    echo "Error: Método {$route['action']} no existe en {$controllerName}.";
                    return;
                }

                // Llamamos al método SIN devolver su valor
                call_user_func_array([$controller, $route['action']], $params);
                return; // Salimos del dispatch
            }
        }

        // Si ninguna ruta coincide
        header("HTTP/1.1 404 Not Found");
        echo "404 • Ruta no encontrada.";
    }
}
