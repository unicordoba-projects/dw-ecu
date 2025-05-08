<?php


include ("validator.php");

class ValidateUserRequest extends Validator
{
    public static function validate_user_request($data): array
    {
        $errors = [];

        if (empty($data['username'])) {
            $errors['username'] = 'El nombre es requerido.';
        }

        // validar 12 caracteres en el username
        if (strlen($data['username']) > 12) {
            $errors['username'] = 'La longitud supera el máximo de caracteres permitidos.';
        }

        // validar que el username no contenga caracteres especiales
        if (!preg_match('/^[a-zA-Z0-9_]+$/', $data['username'])) {
            $errors['username'] = 'El nombre de usuario solo puede contener letras, números y guiones bajos.';
        }

        // validar que el username no contenga espacios en blanco
        if (preg_match('/\s/', $data['username'])) {
            $errors['username'] = 'El nombre de usuario no puede contener espacios en blanco.';
        }
        
        if ( ! Validator::validate_email($data['email']))  {
            $errors['email'] = "Email  no es válido";
        }
        
        if ( ! Validator::validate_date($data['birhdate']))  {
            $errors['birhdate'] = "Fecha no es válida";
        }
        
        if ( ! Validator::validate_int($data['age']))  {
            $errors['age'] = "Edad no es válida";
        }
        return $errors;
    }

    public static function sanitise($data): array
    {
        $data['username'] = Validator::sanitize($data['username']);
        $data['email'] = Validator::sanitize($data['email']);
        $data['birhdate'] = Validator::sanitize($data['birhdate']);
        $data['age'] = Validator::sanitize($data['age']);
        $data['observation'] = Validator::sanitize($data['observation']);
        return $data;
    }
}