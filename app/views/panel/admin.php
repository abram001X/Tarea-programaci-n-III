<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Panel Administrador' ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/style.css">
</head>

<body class="min-h-screen flex flex-col">
    <?php $hideCart = true; include VIEW_PATH . '/layout/header.php'; ?>
    <main class="max-w-7xl mx-auto px-4 py-12 w-full">
        <h1 class="text-3xl font-black mb-2">Panel Administrador</h1>
        <p class="text-lg opacity-70 mb-8">Listado de usuarios y sus roles.</p>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b border-gray-300 text-sm uppercase text-gray-500">
                        <th class="py-3 px-4">ID</th>
                        <th class="py-3 px-4">Nombre</th>
                        <th class="py-3 px-4">Email</th>
                        <th class="py-3 px-4">Rol</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $u): ?>
                    <tr class="border-b border-gray-200">
                        <td class="py-3 px-4"><?= htmlspecialchars($u['id']) ?></td>
                        <td class="py-3 px-4"><?= htmlspecialchars($u['name']) ?></td>
                        <td class="py-3 px-4"><?= htmlspecialchars($u['email']) ?></td>
                        <td class="py-3 px-4">
                            <span class="px-2 py-1 rounded-lg bg-indigo-100 text-indigo-700 text-sm font-bold"><?= htmlspecialchars($u['role']) ?></span>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <h2 class="text-2xl font-black mt-12 mb-2">Compras realizadas</h2>
        <p class="text-lg opacity-70 mb-6">Registro de todos los productos comprados.</p>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b border-gray-300 text-sm uppercase text-gray-500">
                        <th class="py-3 px-4">ID</th>
                        <th class="py-3 px-4">Usuario</th>
                        <th class="py-3 px-4">Producto</th>
                        <th class="py-3 px-4">Cantidad</th>
                        <th class="py-3 px-4">Precio unitario</th>
                        <th class="py-3 px-4">Subtotal</th>
                        <th class="py-3 px-4">Fecha</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($purchases)): ?>
                    <tr><td colspan="7" class="py-4 px-4 text-center opacity-60">No hay compras registradas.</td></tr>
                    <?php else: ?>
                    <?php foreach ($purchases as $c): ?>
                    <tr class="border-b border-gray-200">
                        <td class="py-3 px-4"><?= htmlspecialchars($c['id']) ?></td>
                        <td class="py-3 px-4"><?= htmlspecialchars($c['user_name']) ?> <span class="text-xs text-gray-500">(<?= htmlspecialchars($c['user_email']) ?>)</span></td>
                        <td class="py-3 px-4"><?= htmlspecialchars($c['producto']) ?></td>
                        <td class="py-3 px-4"><?= htmlspecialchars($c['cantidad']) ?></td>
                        <td class="py-3 px-4">$<?= htmlspecialchars($c['precio_unitario']) ?></td>
                        <td class="py-3 px-4 text-indigo-600 font-bold">$<?= number_format($c['cantidad'] * $c['precio_unitario'], 2) ?></td>
                        <td class="py-3 px-4 text-sm text-gray-500"><?= htmlspecialchars($c['fecha_compra']) ?></td>
                    </tr>
                    <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </main>
</body>
<script src="<?= BASE_URL ?>/assets/js/changeTheme.js"></script>

</html>
