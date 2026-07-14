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
    <?php include_once 'header.php' ?>

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
            <button  class="p-2 rounded-full hover:bg-black/5 butt-cl-cart">
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
            <button onclick="openCheckoutModal()" class="w-full bg-indigo-600 text-white font-bold py-4 rounded-xl hover:bg-indigo-700 transition">PAGAR AHORA</button>
        </div>
    </div>
    <!-- ============================================ -->
<!-- MODAL DE CONFIRMACIÓN DE COMPRA              -->
<!-- ============================================ -->
<div id="checkout-overlay" class="fixed inset-0 bg-black/60 backdrop-blur-sm z-[60] hidden opacity-0 transition-opacity duration-300"></div>

<div id="checkout-modal" class="fixed inset-0 z-[70] hidden flex items-center justify-center p-4">
    <div class="dynamic-card rounded-2xl shadow-2xl w-full max-w-2xl max-h-[90vh] overflow-hidden transform scale-95 opacity-0 transition-all duration-300" id="checkout-content">
        <!-- Header del modal -->
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

        <!-- Contenido del modal -->
        <div class="p-6 overflow-y-auto max-h-[60vh]">
            <div id="checkout-items" class="space-y-4">
                <!-- Items inyectados por JS -->
            </div>
        </div>

        <!-- Footer del modal -->
        <div class="border-t border-gray-200/20 p-6 bg-gray-50/5 dark:bg-gray-800/30">
            <div class="flex justify-between items-center mb-6">
                <span class="text-lg font-bold">Total a pagar:</span>
                <span id="checkout-total" class="text-3xl font-black text-indigo-600">$0.00</span>
            </div>
            <div class="flex gap-3">
                <button onclick="closeCheckoutModal()" class="flex-1 px-6 py-3 rounded-xl border-2 border-gray-300 dark:border-gray-600 font-bold hover:bg-gray-100 dark:hover:bg-gray-700 transition">
                    Cancelar
                </button>
                <button onclick="confirmPurchase()" class="flex-1 px-6 py-3 rounded-xl bg-indigo-600 text-white font-bold hover:bg-indigo-700 transition shadow-lg">
                    Confirmar Compra
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal de éxito -->
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
        <button onclick="closeSuccessModal()" class="w-full px-6 py-3 rounded-xl bg-indigo-600 text-white font-bold hover:bg-indigo-700 transition">
            Continuar Comprando
        </button>
    </div>
</div>
</body>
<script src="src/index.js" type="module"></script>
<script src="src/changeTheme.js"></script>
<script type="module">
import { getProducts } from "./src/lib/api.js";

// ✅ Inyección limpia de PHP a JS (Devuelve true o false como booleano real)
let isLogin = <?php echo (isset($_SESSION["name"]) && isset($_SESSION["email"])) ? 'true' : 'false'; ?>;

// Variable global para guardar los productos cargados (necesario para addToCart)
let productosDisponibles = [];

// ==========================================
// FUNCIONES DEL CARRITO (LOCALSTORAGE)
// ==========================================

function addToCart(productId) {
    if (!isLogin) {
        location.href = 'indexlogin.php'; // ✅ Corregido de .html a .php
        return;
    }

    // Buscar el producto en la lista cargada
    const producto = productosDisponibles.find(p => p.id == productId);
    if (!producto) return;

    // Obtener carrito de localStorage
    let carrito = JSON.parse(localStorage.getItem('carrito')) || [];
    
    // Buscar si el producto ya está en el carrito
    const itemExistente = carrito.find(item => item.id == productId);

    if (itemExistente) {
        itemExistente.cantidad += 1; // Si existe, suma 1
    } else {
        // Si no existe, lo agrega con cantidad 1
        carrito.push({
            id: producto.id,
            nombre: producto.nombre,
            precio: producto.precio,
            imagen: producto.imagen,
            categoria: producto.categoria,
            cantidad: 1
        });
    }

    // Guardar en localStorage
    localStorage.setItem('carrito', JSON.stringify(carrito));
    updateCartUI();
    
    // Feedback visual rápido
    alert(`${producto.nombre} agregado al carrito!`); 
}

function removeFromCart(productId) {
    let carrito = JSON.parse(localStorage.getItem('carrito')) || [];
    carrito = carrito.filter(item => item.id != productId);
    localStorage.setItem('carrito', JSON.stringify(carrito));
    updateCartUI();
}

function updateQuantity(productId, change) {
    let carrito = JSON.parse(localStorage.getItem('carrito')) || [];
    const item = carrito.find(i => i.id == productId);
    
    if (item) {
        item.cantidad += change;
        if (item.cantidad <= 0) {
            removeFromCart(productId); // Si llega a 0, lo elimina
            return;
        }
    }
    
    localStorage.setItem('carrito', JSON.stringify(carrito));
    updateCartUI();
}

// ==========================================
// RENDERIZADO Y UI
// ==========================================

async function render() {
    productosDisponibles = await getProducts(); // Guardamos los productos en la variable global
    const container = document.getElementById('product-grid');
    
    container.innerHTML = productosDisponibles.map(p => `
        <div class="dynamic-card rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 group">
            <div class="relative overflow-hidden aspect-square">
                <img src="${p.imagen}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                <button onclick="addToCart(${p.id})" class="absolute bottom-4 right-4 bg-indigo-600 text-white p-3 rounded-xl shadow-lg transform translate-y-12 opacity-0 group-hover:translate-y-0 group-hover:opacity-100 transition-all duration-300">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                </button>
            </div>
            <div class="p-4">
                <p class="text-xs font-bold uppercase opacity-50 mb-1">${p.categoria}</p>
                <h3 class="font-bold text-lg">${p.nombre}</h3>
                <p class="text-indigo-600 font-black text-xl mt-2">$${p.precio}</p>
            </div>
        </div>
    `).join('');
}

function updateCartUI() {
    // ✅ Leemos el carrito real desde localStorage
    const carrito = JSON.parse(localStorage.getItem('carrito')) || [];
    
    const cartCount = document.getElementById('cart-count');
    const cartTotal = document.getElementById('cart-total');
    const items = document.getElementById('cart-items');
    
    // Contar total de artículos (sumando cantidades)
    const totalItems = carrito.reduce((sum, item) => sum + item.cantidad, 0);
    if (cartCount) cartCount.innerText = totalItems;
    
    // Calcular precio total
    const total = carrito.reduce((s, x) => s + (x.precio * x.cantidad), 0);
    if (cartTotal) cartTotal.innerText = `$${total.toFixed(2)}`; // ✅ Corregido: era == en lugar de =
    
    // Renderizar items
    if (carrito.length === 0) {
        items.innerHTML = '<p class="text-center opacity-50 py-10">Tu carrito está vacío</p>';
    } else {
        items.innerHTML = carrito.map(x => `
            <div class="flex items-center gap-4 mb-4 p-2 rounded-lg dynamic-card">
                <img src="${x.imagen}" class="w-16 h-16 rounded-lg object-cover">
                <div class="flex-grow">
                    <h4 class="font-bold text-sm">${x.nombre}</h4>
                    <p class="text-indigo-600 font-bold">$${x.precio}</p>
                    <div class="flex items-center gap-2 mt-1">
                        <button onclick="updateQuantity(${x.id}, -1)" class="w-6 h-6 rounded-full bg-gray-200 dark:bg-gray-700 flex items-center justify-center text-xs font-bold">-</button>
                        <span class="font-bold text-sm">${x.cantidad}</span>
                        <button onclick="updateQuantity(${x.id}, 1)" class="w-6 h-6 rounded-full bg-gray-200 dark:bg-gray-700 flex items-center justify-center text-xs font-bold">+</button>
                    </div>
                </div>
                <button onclick="removeFromCart(${x.id})" class="text-red-400 hover:text-red-600 p-2">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
                </button>
            </div>
        `).join('');
    }
}

function toggleCart() {
    document.getElementById('cart-sidebar').classList.toggle('translate-x-full');
    document.getElementById('cart-overlay').classList.toggle('hidden');
}

// ==========================================
// INICIALIZACIÓN Y EVENTOS
// ==========================================

// Hacer las funciones accesibles para los onclick del HTML
window.addToCart = addToCart;
window.removeFromCart = removeFromCart;
window.updateQuantity = updateQuantity;
window.toggleCart = toggleCart;

// Cargar datos al iniciar
updateCartUI();
render();

// Configurar botón de cerrar carrito (La "X")
const buttClCart = document.querySelector('.butt-cl-cart');
if (buttClCart) {
    buttClCart.addEventListener('click', toggleCart);
}

// Configurar overlay oscuro para cerrar carrito
const overlay = document.getElementById('cart-overlay');
if (overlay) {
    overlay.addEventListener('click', toggleCart);
}
// ============================================
// FUNCIONES DEL MODAL DE COMPRA
// ============================================

function openCheckoutModal() {
    const carrito = JSON.parse(localStorage.getItem('carrito')) || [];
    
    if (carrito.length === 0) {
        alert('Tu carrito está vacío');
        return;
    }
    
    // Renderizar items en el modal
    const checkoutItems = document.getElementById('checkout-items');
    checkoutItems.innerHTML = carrito.map(item => `
        <div class="flex items-center gap-4 p-4 rounded-xl dynamic-card">
            <img src="${item.imagen}" class="w-20 h-20 rounded-lg object-cover">
            <div class="flex-grow">
                <h4 class="font-bold text-lg">${item.nombre}</h4>
                <p class="text-sm opacity-60">${item.categoria}</p>
                <div class="flex items-center gap-2 mt-2">
                    <span class="text-sm opacity-70">Cantidad:</span>
                    <span class="font-bold">${item.cantidad}</span>
                </div>
            </div>
            <div class="text-right">
                <p class="text-indigo-600 font-black text-xl">$${(item.precio * item.cantidad).toFixed(2)}</p>
                <p class="text-xs opacity-50">$${item.precio} c/u</p>
            </div>
        </div>
    `).join('');
    
    // Calcular total
    const total = carrito.reduce((sum, item) => sum + (item.precio * item.cantidad), 0);
    document.getElementById('checkout-total').innerText = `$${total.toFixed(2)}`;
    
    // Mostrar modal con animación
    const overlay = document.getElementById('checkout-overlay');
    const modal = document.getElementById('checkout-modal');
    const content = document.getElementById('checkout-content');
    
    overlay.classList.remove('hidden');
    modal.classList.remove('hidden');
    
    // Forzar reflow para que la animación funcione
    setTimeout(() => {
        overlay.classList.remove('opacity-0');
        content.classList.remove('scale-95', 'opacity-0');
        content.classList.add('scale-100', 'opacity-100');
    }, 10);
}

function closeCheckoutModal() {
    const overlay = document.getElementById('checkout-overlay');
    const modal = document.getElementById('checkout-modal');
    const content = document.getElementById('checkout-content');
    
    // Animación de salida
    overlay.classList.add('opacity-0');
    content.classList.remove('scale-100', 'opacity-100');
    content.classList.add('scale-95', 'opacity-0');
    
    setTimeout(() => {
        overlay.classList.add('hidden');
        modal.classList.add('hidden');
    }, 300);
}

function confirmPurchase() {
    // Aquí podrías enviar los datos al servidor
    // Por ahora, solo vaciamos el carrito
    
    const carrito = JSON.parse(localStorage.getItem('carrito')) || [];
    const total = carrito.reduce((sum, item) => sum + (item.precio * item.cantidad), 0);
    
    // Simular procesamiento (puedes agregar un loading aquí)
    console.log('Procesando compra:', { carrito, total });
    
    // Cerrar modal de confirmación
    closeCheckoutModal();
    
    // Vaciar carrito después de un breve delay
    setTimeout(() => {
        localStorage.removeItem('carrito');
        updateCartUI();
        toggleCart(); // Cerrar el sidebar del carrito
        
        // Mostrar modal de éxito
        showSuccessModal();
    }, 400);
}

function showSuccessModal() {
    const overlay = document.getElementById('success-overlay');
    const modal = document.getElementById('success-modal');
    const content = document.getElementById('success-content');
    
    overlay.classList.remove('hidden');
    modal.classList.remove('hidden');
    
    setTimeout(() => {
        overlay.classList.remove('opacity-0');
        content.classList.remove('scale-95', 'opacity-0');
        content.classList.add('scale-100', 'opacity-100');
    }, 10);
}

function closeSuccessModal() {
    const overlay = document.getElementById('success-overlay');
    const modal = document.getElementById('success-modal');
    const content = document.getElementById('success-content');
    
    overlay.classList.add('opacity-0');
    content.classList.remove('scale-100', 'opacity-100');
    content.classList.add('scale-95', 'opacity-0');
    
    setTimeout(() => {
        overlay.classList.add('hidden');
        modal.classList.add('hidden');
    }, 300);
}

// Hacer funciones accesibles globalmente
window.openCheckoutModal = openCheckoutModal;
window.closeCheckoutModal = closeCheckoutModal;
window.confirmPurchase = confirmPurchase;
window.closeSuccessModal = closeSuccessModal;
</script>

</html>