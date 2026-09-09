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

    // ---- Gestión de productos (solo administrador) ----

    public function productos()
    {
        $this->requireRole(ROLE_ADMIN);
        $this->view('panel/productos', [
            'title' => 'Gestión de productos',
            'products' => Product::all(),
            'categories' => ['hombre', 'mujer', 'accesorios'],
        ]);
    }

    public function storeProduct()
    {
        $this->requireRole(ROLE_ADMIN);

        $data = [
            'nombre' => trim($_POST['nombre'] ?? ''),
            'precio' => $_POST['precio'] ?? '',
            'categoria' => $_POST['categoria'] ?? '',
            'imagen' => trim($_POST['imagen'] ?? ''),
            'descripcion' => trim($_POST['descripcion'] ?? ''),
            'stock' => (int) ($_POST['stock'] ?? 0),
            'activo' => isset($_POST['activo']) ? 1 : 0,
        ];

        if ($data['imagen'] === '') {
            $data['imagen'] = 'https://via.placeholder.com/500';
        }

        $error = $this->validateProduct($data);

        if ($error) {
            $this->view('panel/productos', [
                'title' => 'Gestión de productos',
                'products' => Product::all(),
                'categories' => ['hombre', 'mujer', 'accesorios'],
                'error' => $error,
                'old' => $data,
            ]);
            return;
        }

        Product::create($data);
        $this->redirect('/panel/productos');
    }

    public function deleteProduct()
    {
        $this->requireRole(ROLE_ADMIN);
        $id = (int) ($_POST['id'] ?? 0);
        if ($id > 0) {
            Product::delete($id);
        }
        $this->redirect('/panel/productos');
    }

    // ---- Gestión de usuarios y roles (solo administrador) ----

    public function usuarios()
    {
        $this->requireRole(ROLE_ADMIN);
        $this->view('panel/usuarios', [
            'title' => 'Gestión de usuarios',
            'users' => $this->allUsers(),
            'roles' => Role::all(),
        ]);
    }

    public function updateUserRole()
    {
        $this->requireRole(ROLE_ADMIN);

        $userId = (int) ($_POST['user_id'] ?? 0);
        $roleId = (int) ($_POST['role_id'] ?? 0);

        $user = User::find($userId);
        $role = Role::find($roleId);

        $error = null;
        if (!$user) {
            $error = 'El usuario no existe.';
        } elseif (!$role) {
            $error = 'El rol seleccionado no es válido.';
        }

        if ($error) {
            $this->view('panel/usuarios', [
                'title' => 'Gestión de usuarios',
                'users' => $this->allUsers(),
                'roles' => Role::all(),
                'error' => $error,
            ]);
            return;
        }

        User::updateRole($userId, $roleId);
        $this->redirect('/panel/usuarios');
    }

    private function validateProduct($data)
    {
        $categories = ['hombre', 'mujer', 'accesorios'];

        if ($data['nombre'] === '') {
            return 'El nombre es obligatorio.';
        }
        if (!is_numeric($data['precio']) || (float) $data['precio'] < 0) {
            return 'El precio debe ser un número válido.';
        }
        if (!in_array($data['categoria'], $categories, true)) {
            return 'Selecciona una categoría válida.';
        }
        return null;
    }

    private function allUsers()
    {
        $db = Database::getInstance();
        return $db->query(
            'SELECT u.id, u.name, u.email, u.role_id, r.nombre AS role
             FROM users u
             INNER JOIN roles r ON r.id = u.role_id
             ORDER BY u.id'
        );
    }
}
