<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acceso denegado</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/style.css">
</head>

<body class="min-h-screen flex flex-col items-center justify-center text-center p-6">
    <h1 class="text-6xl font-black text-indigo-600 mb-4">403</h1>
    <p class="text-xl mb-6">No tienes permiso para acceder a esta página.</p>
    <a href="<?= BASE_URL ?>/" class="bg-indigo-600 text-white font-bold px-6 py-3 rounded-xl hover:bg-indigo-700 transition">Volver al inicio</a>
</body>

</html>
