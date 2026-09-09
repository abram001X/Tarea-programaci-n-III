<?php

class PanelController extends Controller
{
    public function admin()
    {
        $this->requireRole(ROLE_ADMIN);
        $this->view('panel/admin', [
            'title' => 'Panel Administrador',
            'users' => $this->allUsers(),
            'purchases' => Purchase::all(),
        ]);
    }

    public function vendedor()
    {
        $this->requireRole([ROLE_ADMIN, ROLE_VENDEDOR]);
        $products = Product::all();
        $this->view('panel/vendedor', [
            'title' => 'Panel Vendedor',
            'products' => $products,
        ]);
    }

    public function soporte()
    {
        $this->requireRole([ROLE_ADMIN, ROLE_SOPORTE]);
        $this->view('panel/soporte', [
            'title' => 'Panel Soporte',
        ]);
    }

    private function allUsers()
    {
        $db = Database::getInstance();
        return $db->query(
            'SELECT u.id, u.name, u.email, r.nombre AS role
             FROM users u
             INNER JOIN roles r ON r.id = u.role_id
             ORDER BY u.id'
        );
    }
}
