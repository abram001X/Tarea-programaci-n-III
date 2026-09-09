<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Gestión de productos' ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/style.css">
</head>

<body class="min-h-screen flex flex-col">
    <?php $hideCart = true; include VIEW_PATH . '/layout/header.php'; ?>
    <main class="max-w-7xl mx-auto px-4 py-12 w-full">
        <div class="flex items-center justify-between mb-8">
            <div>
                <h1 class="text-3xl font-black mb-1">Gestión de productos</h1>
                <p class="text-lg opacity-70">Agrega o elimina productos del sistema.</p>
            </div>
            <a href="<?= BASE_URL ?>/panel/admin" class="px-4 py-2 rounded-lg border font-medium hover:bg-black/5 transition">← Volver al panel</a>
        </div>

        <!-- Formulario para agregar producto -->
        <div class="dynamic-card rounded-2xl p-8 mb-12">
            <h2 class="text-2xl font-black mb-6">Agregar producto</h2>

            <?php if (!empty($error)): ?>
                <div class="mb-6 px-4 py-3 rounded-lg bg-red-100 text-red-700 font-medium"><?= htmlspecialchars($error) ?></div>
            <?php endif; ?>

            <form method="POST" action="<?= BASE_URL ?>/panel/productos" class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <label class="block">
                    <span class="font-bold text-sm">Nombre</span>
                    <input type="text" name="nombre" value="<?= htmlspecialchars($old['nombre'] ?? '') ?>" required
                        class="dynamic-input mt-1 w-full border rounded-lg px-4 py-2 outline-none focus:ring-2 focus:ring-indigo-500 font-medium text-sm">
                </label>

                <label class="block">
                    <span class="font-bold text-sm">Precio</span>
                    <input type="number" step="0.01" min="0" name="precio" value="<?= htmlspecialchars($old['precio'] ?? '') ?>" required
                        class="dynamic-input mt-1 w-full border rounded-lg px-4 py-2 outline-none focus:ring-2 focus:ring-indigo-500 font-medium text-sm">
                </label>

                <label class="block">
                    <span class="font-bold text-sm">Categoría</span>
                    <select name="categoria" class="dynamic-input mt-1 w-full border rounded-lg px-4 py-2 outline-none focus:ring-2 focus:ring-indigo-500 font-medium text-sm">
                        <?php foreach ($categories as $cat): ?>
                            <option value="<?= htmlspecialchars($cat) ?>" <?= (($old['categoria'] ?? '') === $cat) ? 'selected' : '' ?>><?= ucfirst(htmlspecialchars($cat)) ?></option>
                        <?php endforeach; ?>
                    </select>
                </label>

                <label class="block">
                    <span class="font-bold text-sm">Imagen (URL)</span>
                    <input type="text" name="imagen" value="<?= htmlspecialchars($old['imagen'] ?? '') ?>" placeholder="https://..."
                        class="dynamic-input mt-1 w-full border rounded-lg px-4 py-2 outline-none focus:ring-2 focus:ring-indigo-500 font-medium text-sm">
                </label>

                <label class="block">
                    <span class="font-bold text-sm">Descripción</span>
                    <input type="text" name="descripcion" value="<?= htmlspecialchars($old['descripcion'] ?? '') ?>"
                        class="dynamic-input mt-1 w-full border rounded-lg px-4 py-2 outline-none focus:ring-2 focus:ring-indigo-500 font-medium text-sm">
                </label>

                <label class="block">
                    <span class="font-bold text-sm">Stock</span>
                    <input type="number" min="0" name="stock" value="<?= htmlspecialchars($old['stock'] ?? 0) ?>"
                        class="dynamic-input mt-1 w-full border rounded-lg px-4 py-2 outline-none focus:ring-2 focus:ring-indigo-500 font-medium text-sm">
                </label>

                <label class="flex items-center gap-3 md:col-span-2">
                    <input type="checkbox" name="activo" value="1" <?= isset($old['activo']) && $old['activo'] ? 'checked' : '' ?> class="w-4 h-4">
                    <span class="font-bold text-sm">Producto activo (visible en la tienda)</span>
                </label>

                <div class="md:col-span-2">
                    <button type="submit" class="bg-indigo-600 text-white font-bold px-6 py-3 rounded-xl hover:bg-indigo-700 transition">Agregar producto</button>
                </div>
            </form>
        </div>

        <!-- Tabla de productos -->
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b border-gray-300 text-sm uppercase text-gray-500">
                        <th class="py-3 px-4">ID</th>
                        <th class="py-3 px-4">Producto</th>
                        <th class="py-3 px-4">Categoría</th>
                        <th class="py-3 px-4">Precio</th>
                        <th class="py-3 px-4">Stock</th>
                        <th class="py-3 px-4">Activo</th>
                        <th class="py-3 px-4">Acción</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($products as $p): ?>
                    <tr class="border-b border-gray-200">
                        <td class="py-3 px-4"><?= htmlspecialchars($p['id']) ?></td>
                        <td class="py-3 px-4">
                            <div class="flex items-center gap-3">
                                <img src="<?= htmlspecialchars($p['imagen']) ?>" class="w-12 h-12 rounded-lg object-cover">
                                <span class="font-bold"><?= htmlspecialchars($p['nombre']) ?></span>
                            </div>
                        </td>
                        <td class="py-3 px-4"><?= htmlspecialchars($p['categoria']) ?></td>
                        <td class="py-3 px-4">$<?= htmlspecialchars($p['precio']) ?></td>
                        <td class="py-3 px-4"><?= htmlspecialchars($p['stock']) ?></td>
                        <td class="py-3 px-4">
                            <?= $p['activo'] ? '<span class="px-2 py-1 rounded-lg bg-green-100 text-green-700 text-xs font-bold">Sí</span>' : '<span class="px-2 py-1 rounded-lg bg-gray-100 text-gray-500 text-xs font-bold">No</span>' ?>
                        </td>
                        <td class="py-3 px-4">
                            <form method="POST" action="<?= BASE_URL ?>/panel/productos/delete" class="inline" onsubmit="return confirm('¿Seguro que deseas eliminar este producto?')">
                                <input type="hidden" name="id" value="<?= $p['id'] ?>">
                                <button type="submit" class="px-3 py-1.5 rounded-lg bg-red-600 text-white text-sm font-bold hover:bg-red-700 transition">Eliminar</button>
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
