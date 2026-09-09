<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Gestión de usuarios' ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/style.css">
</head>

<body class="min-h-screen flex flex-col">
    <?php $hideCart = true; include VIEW_PATH . '/layout/header.php'; ?>
    <main class="max-w-7xl mx-auto px-4 py-12 w-full">
        <div class="flex items-center justify-between mb-8">
            <div>
                <h1 class="text-3xl font-black mb-1">Gestión de usuarios</h1>
                <p class="text-lg opacity-70">Asigna los roles de cada usuario desde el sistema.</p>
            </div>
            <a href="<?= BASE_URL ?>/panel/admin" class="px-4 py-2 rounded-lg border font-medium hover:bg-black/5 transition">← Volver al panel</a>
        </div>

        <?php if (!empty($error)): ?>
            <div class="mb-6 px-4 py-3 rounded-lg bg-red-100 text-red-700 font-medium"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <p class="mb-4 text-sm opacity-70">Roles: <?php
            $names = array_map(fn($r) => ucfirst(htmlspecialchars($r['nombre'])), $roles);
            echo implode(', ', $names);
        ?></p>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b border-gray-300 text-sm uppercase text-gray-500">
                        <th class="py-3 px-4">ID</th>
                        <th class="py-3 px-4">Nombre</th>
                        <th class="py-3 px-4">Email</th>
                        <th class="py-3 px-4">Rol actual</th>
                        <th class="py-3 px-4">Asignar rol</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $u): ?>
                    <tr class="border-b border-gray-200">
                        <td class="py-3 px-4"><?= htmlspecialchars($u['id']) ?></td>
                        <td class="py-3 px-4 font-bold"><?= htmlspecialchars($u['name']) ?></td>
                        <td class="py-3 px-4"><?= htmlspecialchars($u['email']) ?></td>
                        <td class="py-3 px-4">
                            <span class="px-2 py-1 rounded-lg bg-indigo-100 text-indigo-700 text-sm font-bold"><?= htmlspecialchars($u['role']) ?></span>
                        </td>
                        <td class="py-3 px-4">
                            <form method="POST" action="<?= BASE_URL ?>/panel/usuarios/role" class="flex items-center gap-2">
                                <input type="hidden" name="user_id" value="<?= $u['id'] ?>">
                                <select name="role_id" class="dynamic-input border rounded-lg px-3 py-1.5 text-sm outline-none focus:ring-2 focus:ring-indigo-500">
                                    <?php foreach ($roles as $r): ?>
                                        <option value="<?= $r['id'] ?>" <?= ($u['role_id'] == $r['id']) ? 'selected' : '' ?>><?= ucfirst(htmlspecialchars($r['nombre'])) ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <button type="submit" class="px-3 py-1.5 rounded-lg bg-indigo-600 text-white text-sm font-bold hover:bg-indigo-700 transition">Guardar</button>
                            </form>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </main>
</body>
<script src="<?= BASE_URL ?>/assets/js/changeTheme.js"></script>

</html>
