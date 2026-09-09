<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Panel Soporte' ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/style.css">
</head>

<body class="min-h-screen flex flex-col">
    <?php $hideCart = true; include VIEW_PATH . '/layout/header.php'; ?>
    <main class="max-w-3xl mx-auto px-4 py-12 w-full">
        <h1 class="text-3xl font-black mb-2">Panel Soporte</h1>
        <p class="text-lg opacity-70 mb-8">Atención al cliente.</p>

        <div class="dynamic-card rounded-2xl p-8">
            <h2 class="text-xl font-bold mb-4">Tickets de soporte</h2>
            <ul class="space-y-3">
                <li class="flex justify-between items-center border-b border-gray-200 pb-3">
                    <span>Consulta sobre envío #1</span>
                    <span class="text-sm text-indigo-600 font-bold">Abierto</span>
                </li>
                <li class="flex justify-between items-center border-b border-gray-200 pb-3">
                    <span>Devolución de pedido #2</span>
                    <span class="text-sm text-yellow-600 font-bold">En curso</span>
                </li>
                <li class="flex justify-between items-center border-b border-gray-200 pb-3">
                    <span>Problema con cuenta #3</span>
                    <span class="text-sm text-green-600 font-bold">Resuelto</span>
                </li>
            </ul>
            <p class="mt-6 text-sm opacity-60">Aquí podrías gestionar los tickets de soporte de los clientes.</p>
        </div>
    </main>
</body>
<script src="<?= BASE_URL ?>/assets/js/changeTheme.js"></script>

</html>
