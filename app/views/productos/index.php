<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Vangwear' ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/style.css">
    <link rel="icon" type="image/png" href="<?= BASE_URL ?>/assets/img/store.png">
</head>

<body class="min-h-screen flex flex-col">
    <?php include VIEW_PATH . '/layout/header.php'; ?>

    <section class="relative h-[400px] flex items-center justify-center text-white text-center bg-gray-900">
        <img src="https://images.unsplash.com/photo-1441986300917-64674bd600d8?auto=format&fit=crop&w=1200&q=80" class="absolute inset-0 w-full h-full object-cover opacity-40">
        <div class="relative z-10 px-4">
            <h1 class="text-5xl font-black mb-4 uppercase tracking-tighter">Estilo sin límites</h1>
            <p class="text-lg opacity-90 mb-6">Explora nuestra colección exclusiva de temporada.</p>
            <a href="#tienda" class="bg-indigo-600 px-8 py-3 rounded-full font-bold hover:bg-indigo-500 transition shadow-xl">Comprar ahora</a>
        </div>
    </section>

    <main id="tienda" class="max-w-7xl mx-auto px-4 py-12 w-full">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-10 gap-4">
            <h2 class="text-3xl font-black">PRODUCTOS</h2>
            <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3 w-full md:w-auto">
                <input type="text" id="buscador" placeholder="Buscar productos..."
                    class="dynamic-input border rounded-lg px-4 py-2 outline-none focus:ring-2 focus:ring-indigo-500 font-medium text-sm flex-grow md:w-64">
                <div class="flex items-center space-x-2">
                    <span class="text-sm font-bold opacity-60 shrink-0">Filtrar por:</span>
                    <select id="filtro-categoria"
                        class="dynamic-input border rounded-lg px-4 py-2 outline-none focus:ring-2 focus:ring-indigo-500 font-medium text-sm">
                        <option value="todos">Todos los estilos</option>
                        <option value="hombre">Colección Hombre</option>
                        <option value="mujer">Colección Mujer</option>
                        <option value="accesorios">Accesorios</option>
                    </select>
                </div>
            </div>
        </div>

        <div id="product-grid" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
            <?php foreach ($products as $p): ?>
            <div class="dynamic-card rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 group">
                <div class="relative overflow-hidden aspect-square">
                    <img src="<?= htmlspecialchars($p['imagen']) ?>" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    <button onclick="addToCart(<?= $p['id'] ?>)"
                        class="absolute bottom-4 right-4 bg-indigo-600 text-white p-3 rounded-xl shadow-lg transform translate-y-12 opacity-0 group-hover:translate-y-0 group-hover:opacity-100 transition-all duration-300">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                    </button>
                </div>
                <div class="p-4">
                    <p class="text-xs font-bold uppercase opacity-50 mb-1"><?= htmlspecialchars($p['categoria']) ?></p>
                    <h3 class="font-bold text-lg"><?= htmlspecialchars($p['nombre']) ?></h3>
                    <p class="text-indigo-600 font-black text-xl mt-2">$<?= htmlspecialchars($p['precio']) ?></p>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </main>

    <div id="cart-overlay" onclick="toggleCart()" class="fixed inset-0 bg-black/50 z-40 hidden"></div>
    <div id="cart-sidebar" class="fixed top-0 right-0 h-full w-full sm:w-96 dynamic-card z-50 transform translate-x-full transition-transform duration-300 p-6 flex flex-col shadow-2xl">
        <div class="flex justify-between items-center mb-8">
            <h2 class="text-2xl font-black">CARRITO</h2>
            <button class="p-2 rounded-full hover:bg-black/5 butt-cl-cart">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
        <div id="cart-items" class="flex-grow overflow-y-auto"></div>
        <div class="border-t border-gray-200/20 pt-6 mt-4">
            <div class="flex justify-between items-center mb-6">
                <span class="font-bold">Total estimado:</span>
                <span id="cart-total" class="text-2xl font-black text-indigo-600">$0.00</span>
            </div>
            <button onclick="openCheckoutModal()" class="w-full bg-indigo-600 text-white font-bold py-4 rounded-xl hover:bg-indigo-700 transition">PAGAR AHORA</button>
        </div>
    </div>

    <div id="checkout-overlay" class="fixed inset-0 bg-black/60 backdrop-blur-sm z-[60] hidden opacity-0 transition-opacity duration-300"></div>
    <div id="checkout-modal" class="fixed inset-0 z-[70] hidden flex items-center justify-center p-4">
        <div class="dynamic-card rounded-2xl shadow-2xl w-full max-w-2xl max-h-[90vh] overflow-hidden transform scale-95 opacity-0 transition-all duration-300" id="checkout-content">
            <div class="flex justify-between items-center p-6 border-b border-gray-200/20">
                <div class="flex items-center gap-3">
                    <div class="bg-indigo-600 p-2 rounded-lg">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                    </div>
                    <h2 class="text-2xl font-black">Confirmar Compra</h2>
                </div>
                <button onclick="closeCheckoutModal()" class="p-2 rounded-full hover:bg-black/5 transition">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            <div class="p-6 overflow-y-auto max-h-[60vh]">
                <div id="checkout-items" class="space-y-4"></div>
            </div>
            <div class="border-t border-gray-200/20 p-6 bg-gray-50/5 dark:bg-gray-800/30">
                <div class="flex justify-between items-center mb-6">
                    <span class="text-lg font-bold">Total a pagar:</span>
                    <span id="checkout-total" class="text-3xl font-black text-indigo-600">$0.00</span>
                </div>
                <div class="flex gap-3">
                    <button onclick="closeCheckoutModal()" class="flex-1 px-6 py-3 rounded-xl border-2 border-gray-300 dark:border-gray-600 font-bold hover:bg-gray-100 dark:hover:bg-gray-700 transition">Cancelar</button>
                    <button onclick="confirmPurchase()" class="flex-1 px-6 py-3 rounded-xl bg-indigo-600 text-white font-bold hover:bg-indigo-700 transition shadow-lg">Confirmar Compra</button>
                </div>
            </div>
        </div>
    </div>

    <div id="success-overlay" class="fixed inset-0 bg-black/60 backdrop-blur-sm z-[80] hidden opacity-0 transition-opacity duration-300"></div>
    <div id="success-modal" class="fixed inset-0 z-[90] hidden flex items-center justify-center p-4">
        <div class="dynamic-card rounded-2xl shadow-2xl w-full max-w-md p-8 text-center transform scale-95 opacity-0 transition-all duration-300" id="success-content">
            <div class="w-20 h-20 bg-green-500 rounded-full flex items-center justify-center mx-auto mb-6 animate-bounce">
                <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                </svg>
            </div>
            <h3 class="text-3xl font-black mb-3">¡Compra Exitosa!</h3>
            <p class="text-lg opacity-70 mb-6">Tu pedido ha sido procesado correctamente.</p>
            <p class="text-sm opacity-60 mb-6">Recibirás un correo con los detalles de tu compra.</p>
            <button onclick="closeSuccessModal()" class="w-full px-6 py-3 rounded-xl bg-indigo-600 text-white font-bold hover:bg-indigo-700 transition">Continuar Comprando</button>
        </div>
    </div>

    <script>
        window.BASE_URL = '<?= BASE_URL ?>';
        window.PRODUCTS = <?= json_encode($products, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_AMP | JSON_HEX_QUOT) ?>;
        window.IS_LOGIN = <?= $this->isLogged() ? 'true' : 'false' ?>;
    </script>
    <script src="<?= BASE_URL ?>/assets/js/app.js"></script>
    <script src="<?= BASE_URL ?>/assets/js/changeTheme.js"></script>
</body>

</html>
