<?php
namespace App\Controllers;

use App\Models\User;
use Core\View;

class UserController
{
    private $userModel;
    
    public function __construct()
    {
        $this->userModel = new User();
    }
    
    // GET /users - Listar todos los usuarios
    public function index()
    {
        $users = $this->userModel->getAll();
        return View::render('users/index', ['users' => $users]);
    }
    
    // GET /users/create - Formulario para crear usuario
    public function create()
    {
        return View::render('users/create');
    }
    
    // POST /users - Guardar nuevo usuario
    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'name' => $_POST['name'] ?? '',
                'email' => $_POST['email'] ?? '',
                'password' => $_POST['password'] ?? ''
            ];
            
            // Validación simple
            if (empty($data['name']) || empty($data['email']) || empty($data['password'])) {
                $errors = ['Todos los campos son obligatorios'];
                return View::render('users/create', ['errors' => $errors, 'data' => $data]);
            }
            
            if ($this->userModel->create($data)) {
                header('Location: /users');
                exit;
            } else {
                $errors = ['Error al crear el usuario'];
                return View::render('users/create', ['errors' => $errors, 'data' => $data]);
            }
        }
    }
    
    // GET /users/{id} - Ver un usuario específico
    public function show($id)
    {
        $user = $this->userModel->findById($id);
        
        if (!$user) {
            header("HTTP/1.0 404 Not Found");
            return View::render('errors/404');
        }
        
        return View::render('users/show', ['user' => $user]);
    }
    
    // GET /users/{id}/edit - Formulario para editar usuario
    public function edit($id)
    {
        $user = $this->userModel->findById($id);
        
        if (!$user) {
            header("HTTP/1.0 404 Not Found");
            return View::render('errors/404');
        }
        
        return View::render('users/edit', ['user' => $user]);
    }
    
    // PUT /users/{id} - Actualizar usuario
    public function update($id)
    {
        // Para manejar método PUT en HTML forms
        parse_str(file_get_contents("php://input"), $putData);
        
        $data = [
            'name' => $putData['name'] ?? '',
            'email' => $putData['email'] ?? ''
        ];
        
        // Validación simple
        if (empty($data['name']) || empty($data['email'])) {
            $errors = ['Nombre y email son obligatorios'];
            $user = $this->userModel->findById($id);
            return View::render('users/edit', ['errors' => $errors, 'user' => $user]);
        }
        
        if ($this->userModel->update($id, $data)) {
            header('Location: /users/' . $id);
            exit;
        } else {
            $errors = ['Error al actualizar el usuario'];
            $user = $this->userModel->findById($id);
            return View::render('users/edit', ['errors' => $errors, 'user' => $user]);
        }
    }
    
    // DELETE /users/{id} - Eliminar usuario
    public function delete($id)
    {
        if ($this->userModel->delete($id)) {
            header('Location: /users');
            exit;
        } else {
            $errors = ['Error al eliminar el usuario'];
            $user = $this->userModel->findById($id);
            return View::render('users/show', ['errors' => $errors, 'user' => $user]);
        }
    }
}
