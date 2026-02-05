<?php

namespace App\Controllers;

use App\Models\UsuarioModel;
use App\Models\PersonaModel;

class Auth extends BaseController
{
    public function index(): string
    {
        return view('auth/login');
    }

    public function login()
    {
        // Acepta FormData (POST) enviado desde el frontend
        if (! $this->request->isAJAX()) {
            // Si no es AJAX, intentar igualmente leer POST
            $email = $this->request->getPost('email');
            $clave = $this->request->getPost('password');
        } else {
            $email = $this->request->getPost('email');
            $clave = $this->request->getPost('password');
        }

        // Validación básica
        if (empty($email) || empty($clave)) {
            return $this->response->setStatusCode(400)->setJSON([
                'success' => false,
                'message' => 'Email y contraseña son requeridos'
            ]);
        }

        try {
            // Buscar usuario y datos de persona con INNER JOIN
            $db = \Config\Database::connect();
            $user = $db->table('usuarios u')
                ->select('u.id, u.usuario, u.clave, u.persona_id, u.rol_id, p.nombres, p.apellidos, p.email as persona_email, p.celular')
                ->join('personas p', 'u.persona_id = p.id', 'INNER')
                ->where('u.usuario', $email)
                ->get()
                ->getRowArray();

            if ($user && $clave === $user['clave']) {
                // Credenciales válidas — crear sesión
                session()->set([
                    'id' => $user['id'],
                    'persona_id' => $user['persona_id'],
                    'email' => $user['usuario'],
                    'nombre' => $user['nombres'] ?? '',
                    'apellidos' => $user['apellidos'] ?? '',
                    'rol_id' => $user['rol_id'] ?? null,
                    'isLoggedIn' => true,
                ]);

                return $this->response->setJSON([
                    'success' => true,
                    'message' => 'Inicio de sesión exitoso',
                    'user' => [
                        'id' => $user['id'],
                        'nombre' => $user['nombre'] ?? '',
                        'apellidos' => $user['apellidos'] ?? '',
                        'email' => $user['usuario']
                    ]
                ]);
            }

            // Credenciales inválidas
            return $this->response->setStatusCode(401)->setJSON([
                'success' => false,
                'message' => 'Credenciales inválidas'
            ]);
        } catch (\Exception $e) {
            return $this->response->setStatusCode(500)->setJSON([
                'success' => false,
                'message' => 'Error del servidor: ' . $e->getMessage()
            ]);
        }
    }

    public function logout()
    {
        // Destroy session and redirect to login page
        $session = session();
        $session->destroy();

        // If request is AJAX, return JSON; otherwise redirect
        if ($this->request->isAJAX()) {
            return $this->response->setJSON([
                'success' => true,
                'message' => 'Sesión cerrada'
            ]);
        }

        // Redirigir a la URL base del sitio para evitar mostrar "index.php/"
        return redirect()->to(base_url());
    }
}
