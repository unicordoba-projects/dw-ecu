<?php
namespace Core;

class View
{

    public static function render($view, $data = [])
    {
        echo "Vista";
    }

    public static function render2($view, $data = [])
    {
        extract($data);
        
        $viewFile = __DIR__ . "/../app/Views/{$view}.php";
        
        if (is_readable($viewFile)) {
            ob_start();
            require_once $viewFile;
            $content = ob_get_clean();
            
            require_once __DIR__ . "/../app/Views/layouts/main.php";
        } else {
            throw new \Exception("La vista $viewFile no existe");
        }
    }
}
