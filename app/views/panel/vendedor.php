<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Panel Vendedor' ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/style.css">
</head>

<body class="min-h-screen flex flex-col">
    <?php $hideCart = true; include VIEW_PATH . '/layout/header.php'; ?>
    <main class="max-w-7xl mx-auto px-4 py-12 w-full">
        <h1 class="text-3xl font-black mb-2">Panel Vendedor</h1>
        <p class="text-lg opacity-70 mb-8">Listado de productos disponibles.</p>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b border-gray-300 text-sm uppercase text-gray-500">
                        <th class="py-3 px-4">ID</th>
                        <th class="py-3 px-4">Nombre</th>
                        <th class="py-3 px-4">Categoría</th>
                        <th class="py-3 px-4">Precio</th>
                        <th class="py-3 px-4">Stock</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($products as $p): ?>
                    <tr class="border-b border-gray-200">
                        <td class="py-3 px-4"><?= htmlspecialchars($p['id']) ?></td>
                        <td class="py-3 px-4"><?= htmlspecialchars($p['nombre']) ?></td>
                        <td class="py-3 px-4"><?= htmlspecialchars($p['categoria']) ?></td>
                        <td class="py-3 px-4">$<?= htmlspecialchars($p['precio']) ?></td>
                        <td class="py-3 px-4"><?= htmlspecialchars($p['stock']) ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </main>
</body>
<script src="<?= BASE_URL ?>/assets/js/changeTheme.js"></script>

</html>
