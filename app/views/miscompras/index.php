<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Mis compras' ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/style.css">
    <link rel="icon" type="image/png" href="<?= BASE_URL ?>/assets/img/store.png">
</head>

<body class="min-h-screen flex flex-col">
    <?php $hideCart = true; include VIEW_PATH . '/layout/header.php'; ?>
    <main class="max-w-7xl mx-auto px-4 py-12 w-full">
        <h1 class="text-3xl font-black mb-2">Mis compras</h1>
        <p class="text-lg opacity-70 mb-8">Historial de los productos que has comprado.</p>

        <?php if (empty($compras)): ?>
            <div class="dynamic-card rounded-2xl p-10 text-center">
                <p class="text-lg opacity-60">Todavía no has realizado ninguna compra.</p>
                <a href="<?= BASE_URL ?>/" class="inline-block mt-6 bg-indigo-600 text-white font-bold px-6 py-3 rounded-xl hover:bg-indigo-700 transition">Explorar productos</a>
            </div>
        <?php else: ?>
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b border-gray-300 text-sm uppercase text-gray-500">
                            <th class="py-3 px-4">Producto</th>
                            <th class="py-3 px-4">Categoría</th>
                            <th class="py-3 px-4">Cantidad</th>
                            <th class="py-3 px-4">Precio unitario</th>
                            <th class="py-3 px-4">Subtotal</th>
                            <th class="py-3 px-4">Fecha</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($compras as $c): ?>
                        <?php $subtotal = $c['cantidad'] * $c['precio_unitario']; ?>
                        <tr class="border-b border-gray-200">
                            <td class="py-3 px-4">
                                <div class="flex items-center gap-3">
                                    <img src="<?= htmlspecialchars($c['imagen']) ?>" class="w-12 h-12 rounded-lg object-cover">
                                    <span class="font-bold"><?= htmlspecialchars($c['nombre']) ?></span>
                                </div>
                            </td>
                            <td class="py-3 px-4"><?= htmlspecialchars($c['categoria']) ?></td>
                            <td class="py-3 px-4"><?= htmlspecialchars($c['cantidad']) ?></td>
                            <td class="py-3 px-4">$<?= htmlspecialchars($c['precio_unitario']) ?></td>
                            <td class="py-3 px-4 text-indigo-600 font-bold">$<?= number_format($subtotal, 2) ?></td>
                            <td class="py-3 px-4 text-sm text-gray-500"><?= htmlspecialchars($c['fecha_compra']) ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </main>
</body>
<script src="<?= BASE_URL ?>/assets/js/changeTheme.js"></script>

</html>
