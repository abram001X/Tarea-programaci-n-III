<?php
session_start();
?>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vangwear</title>
    <!-- Tailwind CSS para el diseño moderno y responsivo -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="style/style.css">
</head>

<body class="min-h-screen flex flex-col">
    <!-- NAVEGACIÓN -->
    <header class="dynamic-header shadow-md sticky top-0 z-40 transition-colors duration-400">
        <div class="max-w-7xl mx-auto px-4 h-16 flex justify-between items-center">
            <!-- Logo -->
            <div class="flex items-center space-x-2">
                <div class="bg-indigo-600 p-1.5 rounded-lg">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                    </svg>
                </div>
                <span class="font-bold text-xl tracking-tighter">VANG<span class="text-indigo-600">WEAR</span></span>
            </div>

            <!-- Acciones -->
            <div class="flex items-center space-x-3">
                <!-- Temas -->
                <div class="hidden md:flex space-x-1 px-3 border-r border-gray-300">
                    <button id="light" class="butt-theme w-5 h-5 rounded-full bg-gray-200 border border-gray-400" title="Claro"></button>
                    <button id="dark" class="butt-theme w-5 h-5 rounded-full bg-gray-800 border border-gray-400" title="Oscuro"></button>
                    <button id="warm" class="butt-theme w-5 h-5 rounded-full bg-orange-200 border border-gray-400" title="Cálido"></button>
                </div>

                <!-- Botón Login -->
                <button class="flex items-center space-x-1 px-4 py-2 rounded-lg hover:bg-black/5 transition font-medium">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                    <a href="indexlogin.html">
                        <span>Iniciar sesión</span>
                    </a>
                </button>
                <?php
                if (isset($_SESSION["name"]) && isset($_SESSION["email"])) {
                    echo "
                    <button class='cl-sesion flex items-center space-x-1 px-4 py-2 rounded-lg hover:bg-black/5 transition font-medium'>
                        <span>Cerrar sesión</span>
                    </button>
                    <button onclick='toggleCart()' class='relative p-2 bg-indigo-600 text-white rounded-full hover:bg-indigo-700 transition shadow-lg'>
                        <svg class='w-5 h-5' fill='none' stroke='currentColor' viewBox='0 0 24 24'><path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z'></path></svg>
                        <span id='cart-count' class='absolute -top-1 -right-1 bg-red-500 text-[10px] font-bold rounded-full h-4 w-4 flex items-center justify-center'>0</span>
                    </button>";
                }
                ?>

            </div>
        </div>
    </header>

    <!-- HERO -->
    <section class="relative h-[400px] flex items-center justify-center text-white text-center bg-gray-900">
        <img src="https://images.unsplash.com/photo-1441986300917-64674bd600d8?auto=format&fit=crop&w=1200&q=80" class="absolute inset-0 w-full h-full object-cover opacity-40">
        <div class="relative z-10 px-4">
            <h1 class="text-5xl font-black mb-4 uppercase tracking-tighter">Estilo sin límites</h1>
            <p class="text-lg opacity-90 mb-6">Explora nuestra colección exclusiva de temporada.</p>
            <a href="#tienda" class="bg-indigo-600 px-8 py-3 rounded-full font-bold hover:bg-indigo-500 transition shadow-xl">Comprar ahora</a>
        </div>
    </section>

    <!-- TIENDA -->
    <main id="tienda" class="max-w-7xl mx-auto px-4 py-12 w-full">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-10 gap-4">
            <h2 class="text-3xl font-black">PRODUCTOS</h2>

            <!-- SELECTOR CORREGIDO -->
            <div class="flex items-center space-x-2">
                <span class="text-sm font-bold opacity-60">Filtrar por:</span>
                <select class="dynamic-input border rounded-lg px-4 py-2 outline-none focus:ring-2 focus:ring-indigo-500 font-medium">
                    <option value="todos">Todos los estilos</option>
                    <option value="hombre">Colección Hombre</option>
                    <option value="mujer">Colección Mujer</option>
                    <option value="accesorios">Accesorios</option>
                </select>
            </div>
        </div>

        <div id="product-grid" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
            <!-- Inyectado por JS -->
        </div>
    </main>

    <!-- CARRITO SIDEBAR (Simplificado) -->
    <div id="cart-overlay" onclick="togglecart()" class="fixed inset-0 bg-black/50 z-40 hidden "></div>
    <div id="cart-sidebar" class="fixed top-0 right-0 h-full w-full sm:w-96 dynamic-card z-50 transform translate-x-full transition-transform duration-300 p-6 flex flex-col shadow-2xl">
        <div class="flex justify-between items-center mb-8">
            <h2 class="text-2xl font-black">CARRITO</h2>
            <button onclick="toggleCart()" class="p-2 rounded-full hover:bg-black/5 butt-cl-cart">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
        <div id="cart-items" class="flex-grow overflow-y-auto">
            <!-- Items -->
        </div>
        <div class="border-t border-gray-200/20 pt-6 mt-4">
            <div class="flex justify-between items-center mb-6">
                <span class="font-bold">Total estimado:</span>
                <span id="cart-total" class="text-2xl font-black text-indigo-600">$0.00</span>
            </div>
            <button class="w-full bg-indigo-600 text-white font-bold py-4 rounded-xl hover:bg-indigo-700 transition">PAGAR AHORA</button>
        </div>
    </div>
</body>
<script src="src/index.js" type="module"></script>
<script type="module">
    import {
        getProducts
    } from "./src/lib/api.js";
    let isLogin = "<?php
                    $isLogin = isset($_SESSION["name"]) && isset($_SESSION["email"]) ? "true" : null;
                    echo $isLogin; ?>"
    isLogin = Boolean(isLogin)
    async function render() {
        //Se puede colocar también que se muestre un modal para iniciaar sesión si no está logeado.
        const productos = await getProducts()
        const container = document.getElementById('product-grid');
        container.innerHTML = productos.map(p => `  
                <div class="dynamic-card rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 group">
                    <div class="relative overflow-hidden aspect-square">
                        <img src="${p.imagen}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        <button onclick="if(${isLogin}) { addToCart(${p.id}) } else { location.href='indexlogin.html' }" class="absolute bottom-4 right-4 bg-indigo-600 text-white p-3 rounded-xl shadow-lg transform translate-y-12 opacity-0 group-hover:translate-y-0 group-hover:opacity-100 transition-all duration-300">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                        </button>
                    </div>
                    <div class="p-4">
                        <p class="text-xs font-bold uppercase opacity-50 mb-1">${p.categoria}</p>
                        <h3 class="font-bold text-lg">${p.nombre}</h3>
                        <p class="text-indigo-600 font-black text-xl mt-2">$${p.precio.toFixed(2)}</p>
                    </div>
                </div>
            `).join('');
    }

    function toggleCart() {
        document.getElementById('cart-sidebar').classList.toggle('translate-x-full');
        document.getElementById('cart-overlay').classList.toggle('hidden');
    }


    function updateCartUI() {
        const carrito = []
        const cartCount = document.getElementById('cart-count')
        const cartTotal = document.getElementById('cart-total')
        const items = document.getElementById('cart-items');
        if (cartCount) cartCount.innerText = carrito.length;
        const total = carrito.reduce((s, x) => s + x.precio, 0);
        if (cartTotal) cartTotal.innerText == `$${total.toFixed(2)}`;
        if (carrito.length === 0) {
            items.innerHTML = '<p class="text-center opacity-50 py-10">Vacío</p>';
        } else {
            items.innerHTML = carrito.map((x, i) => `
            <div class="flex items-center gap-4 mb-4">
                <img src="${x.img}" class="w-16 h-16 rounded-lg object-cover">
                <div class="flex-grow">
                    <h4 class="font-bold text-sm">${x.nombre}</h4>
                    <p class="text-indigo-600 font-bold">$${x.precio}</p>
                </div>
                <button  class="text-red-400 ">
                     <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
                </button>
            </div>
        `).join('');
        }
    }
    window.toggleCart = toggleCart
    updateCartUI()
    render()
</script>


</html>