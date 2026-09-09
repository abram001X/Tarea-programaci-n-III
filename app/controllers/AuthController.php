<?php

class AuthController extends Controller
{
    public function loginForm()
    {
        if ($this->isLogged()) {
            $this->redirect('/');
        }
        $this->view('auth/login', ['title' => 'Iniciar Sesión']);
    }

    public function registerForm()
    {
        if ($this->isLogged()) {
            $this->redirect('/');
        }
        $this->view('auth/registro', ['title' => 'Registro']);
    }

    public function login()
    {
        $email = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';

        $user = User::findByCredentials($email, $password);

        if ($user) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['name'] = $user['name'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['role'] = $user['role'];
            $this->redirect('/');
        }

        $this->view('auth/login', [
            'title' => 'Iniciar Sesión',
            'error' => 'Datos no válidos',
        ]);
    }

    public function register()
    {
        $name = trim($_POST['name'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';
        $confirm = $_POST['confirmPassword'] ?? '';

        if ($password !== $confirm) {
            $this->view('auth/registro', [
                'title' => 'Registro',
                'error' => 'Las contraseñas no coinciden',
            ]);
            return;
        }

        if (User::exists($email)) {
            $this->view('auth/registro', [
                'title' => 'Registro',
                'error' => 'Email ya existe',
            ]);
            return;
        }

        User::create($name, $email, $password);

        $user = User::findByCredentials($email, $password);
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['name'] = $user['name'];
        $_SESSION['email'] = $user['email'];
        $_SESSION['role'] = $user['role'];

        $this->redirect('/');
    }

    public function logout()
    {
        session_unset();
        session_destroy();
        $this->redirect('/login');
    }
}
