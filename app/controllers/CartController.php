<?php

class CartController extends Controller
{
    private function apiRequireLogin()
    {
        if (!$this->isLogged()) {
            http_response_code(401);
            echo json_encode(['error' => 'No autenticado']);
            exit;
        }
    }

    private function jsonBody()
    {
        $raw = file_get_contents('php://input');
        return json_decode($raw, true) ?? [];
    }

    public function index()
    {
        $this->apiRequireLogin();
        header('Content-Type: application/json');
        echo json_encode(CartItem::forUser($_SESSION['user_id']));
    }

    public function add()
    {
        $this->apiRequireLogin();
        $body = $this->jsonBody();
        $productId = (int) ($body['product_id'] ?? 0);
        $cantidad = (int) ($body['cantidad'] ?? 1);

        if ($productId <= 0 || $cantidad <= 0) {
            http_response_code(400);
            echo json_encode(['error' => 'Datos inválidos']);
            exit;
        }

        CartItem::add($_SESSION['user_id'], $productId, $cantidad);
        header('Content-Type: application/json');
        echo json_encode(['ok' => true, 'cart' => CartItem::forUser($_SESSION['user_id'])]);
    }

    public function update()
    {
        $this->apiRequireLogin();
        $body = $this->jsonBody();
        $productId = (int) ($body['product_id'] ?? 0);
        $cantidad = (int) ($body['cantidad'] ?? 0);

        CartItem::updateQuantity($_SESSION['user_id'], $productId, $cantidad);
        header('Content-Type: application/json');
        echo json_encode(['ok' => true, 'cart' => CartItem::forUser($_SESSION['user_id'])]);
    }

    public function remove()
    {
        $this->apiRequireLogin();
        $body = $this->jsonBody();
        $productId = (int) ($body['product_id'] ?? 0);

        CartItem::remove($_SESSION['user_id'], $productId);
        header('Content-Type: application/json');
        echo json_encode(['ok' => true, 'cart' => CartItem::forUser($_SESSION['user_id'])]);
    }

    public function checkout()
    {
        $this->apiRequireLogin();
        $userId = $_SESSION['user_id'];
        $items = CartItem::forUser($userId);

        if (empty($items)) {
            http_response_code(400);
            echo json_encode(['error' => 'Carrito vacío']);
            exit;
        }

        Purchase::create($userId, $items);
        CartItem::clear($userId);

        header('Content-Type: application/json');
        echo json_encode(['ok' => true]);
    }

    public function misCompras()
    {
        $this->requireLogin();
        $compras = Purchase::forUser($_SESSION['user_id']);
        $this->view('miscompras/index', [
            'title' => 'Mis compras',
            'compras' => $compras,
        ]);
    }
}
