<?php

class Controller
{
    protected function view($path, $data = [])
    {
        extract($data);
        require VIEW_PATH . '/' . $path . '.php';
    }

    protected function redirect($path)
    {
        header('Location: ' . BASE_URL . $path);
        exit;
    }

    // ---- Helpers de autenticación y roles ----

    protected function isLogged()
    {
        return isset($_SESSION['user_id']);
    }

    protected function currentUser()
    {
        return [
            'id' => $_SESSION['user_id'] ?? null,
            'name' => $_SESSION['name'] ?? null,
            'email' => $_SESSION['email'] ?? null,
            'role' => $_SESSION['role'] ?? null,
        ];
    }

    protected function hasRole($role)
    {
        return isset($_SESSION['role']) && $_SESSION['role'] === $role;
    }

    // Redirige a /login si no hay sesión activa
    protected function requireLogin()
    {
        if (!$this->isLogged()) {
            $this->redirect('/login');
        }
    }

    // Redirige si el usuario no tiene uno de los roles permitidos
    protected function requireRole($roles)
    {
        $this->requireLogin();

        $roles = (array) $roles;
        if (!in_array($_SESSION['role'], $roles, true)) {
            http_response_code(403);
            $this->view('layout/forbidden');
            exit;
        }
    }
}
