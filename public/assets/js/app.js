const BASE_URL = window.BASE_URL || '';
const IS_LOGIN = window.IS_LOGIN === true;
let productosDisponibles = window.PRODUCTS || [];
let cart = [];

const filtroCategoria = document.getElementById('filtro-categoria');
const buscador = document.getElementById('buscador');

async function apiPost(path, body) {
    const res = await fetch(BASE_URL + path, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(body)
    });
    return res.json();
}

async function loadCart() {
    if (!IS_LOGIN) {
        cart = [];
        updateCartUI();
        return;
    }
    try {
        const res = await fetch(BASE_URL + '/api/cart');
        if (res.ok) {
            cart = await res.json();
            updateCartUI();
        }
    } catch (e) {
        console.error(e);
    }
}

async function addToCart(productId) {
    if (!IS_LOGIN) {
        location.href = BASE_URL + '/login';
        return;
    }

    const producto = productosDisponibles.find(p => p.id == productId);
    if (!producto) return;

    const data = await apiPost('/api/cart/add', { product_id: productId, cantidad: 1 });
    if (data.cart) {
        cart = data.cart;
        updateCartUI();
        alert(`${producto.nombre} agregado al carrito!`);
    }
}

async function removeFromCart(productId) {
    const data = await apiPost('/api/cart/remove', { product_id: productId });
    if (data.cart) {
        cart = data.cart;
        updateCartUI();
    }
}

async function updateQuantity(productId, change) {
    const item = cart.find(i => i.producto_id == productId);
    const nuevaCantidad = (item ? item.cantidad : 0) + change;

    const data = await apiPost('/api/cart/update', { product_id: productId, cantidad: nuevaCantidad });
    if (data.cart) {
        cart = data.cart;
        updateCartUI();
    }
}

function filterProducts() {
    if (filtroCategoria) {
        filtroCategoria.addEventListener('change', (e) => productsUI(e.target.value));
    }
    if (buscador) {
        buscador.addEventListener('change', (e) => productsUI(e.target.value, true));
    }
}

function productsUI(tag = 'todos', isSearch = false) {
    const container = document.getElementById('product-grid');
    if (!container) return;

    const component = (p) => `
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
    `;

    container.innerHTML = productosDisponibles.map(p => {
        if (!isSearch) {
            if (p.categoria == tag || tag == 'todos') {
                return component(p);
            }
        } else if (p.nombre.toLowerCase().includes(tag.toLowerCase().trimEnd()) || tag.trimEnd() == '') {
            return component(p);
        }
    }).join('');
}

function updateCartUI() {
    const cartCount = document.getElementById('cart-count');
    const cartTotal = document.getElementById('cart-total');
    const items = document.getElementById('cart-items');

    const totalItems = cart.reduce((sum, item) => sum + item.cantidad, 0);
    if (cartCount) cartCount.innerText = totalItems;

    const total = cart.reduce((s, x) => s + (x.precio * x.cantidad), 0);
    if (cartTotal) cartTotal.innerText = `$${total.toFixed(2)}`;

    if (!items) return;

    if (cart.length === 0) {
        items.innerHTML = '<p class="text-center opacity-50 py-10">Tu carrito está vacío</p>';
    } else {
        items.innerHTML = cart.map(x => `
            <div class="flex items-center gap-4 mb-4 p-2 rounded-lg dynamic-card">
                <img src="${x.imagen}" class="w-16 h-16 rounded-lg object-cover">
                <div class="flex-grow">
                    <h4 class="font-bold text-sm">${x.nombre}</h4>
                    <p class="text-indigo-600 font-bold">$${x.precio}</p>
                    <div class="flex items-center gap-2 mt-1">
                        <button onclick="updateQuantity(${x.producto_id}, -1)" class="w-6 h-6 rounded-full bg-yellow-200 flex items-center justify-center text-xs font-bold">-</button>
                        <span class="font-bold text-sm">${x.cantidad}</span>
                        <button onclick="updateQuantity(${x.producto_id}, 1)" class="w-6 h-6 rounded-full bg-yellow-200 flex items-center justify-center text-xs font-bold">+</button>
                    </div>
                </div>
                <button onclick="removeFromCart(${x.producto_id})" class="text-red-400 hover:text-red-600 p-2">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
                </button>
            </div>
        `).join('');
    }
}

function toggleCart() {
    const sidebar = document.getElementById('cart-sidebar');
    const overlay = document.getElementById('cart-overlay');
    if (sidebar) sidebar.classList.toggle('translate-x-full');
    if (overlay) overlay.classList.toggle('hidden');
}

function openCheckoutModal() {
    if (cart.length === 0) {
        alert('Tu carrito está vacío');
        return;
    }

    const checkoutItems = document.getElementById('checkout-items');
    checkoutItems.innerHTML = cart.map(item => `
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

    const total = cart.reduce((sum, item) => sum + (item.precio * item.cantidad), 0);
    document.getElementById('checkout-total').innerText = `$${total.toFixed(2)}`;

    const overlay = document.getElementById('checkout-overlay');
    const modal = document.getElementById('checkout-modal');
    const content = document.getElementById('checkout-content');

    overlay.classList.remove('hidden');
    modal.classList.remove('hidden');

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

    overlay.classList.add('opacity-0');
    content.classList.remove('scale-100', 'opacity-100');
    content.classList.add('scale-95', 'opacity-0');

    setTimeout(() => {
        overlay.classList.add('hidden');
        modal.classList.add('hidden');
    }, 300);
}

async function confirmPurchase() {
    const data = await apiPost('/api/cart/checkout', {});
    if (!data.ok) {
        alert(data.error || 'No se pudo completar la compra');
        return;
    }

    closeCheckoutModal();
    cart = [];
    updateCartUI();
    toggleCart();
    showSuccessModal();
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

window.addToCart = addToCart;
window.removeFromCart = removeFromCart;
window.updateQuantity = updateQuantity;
window.toggleCart = toggleCart;
window.openCheckoutModal = openCheckoutModal;
window.closeCheckoutModal = closeCheckoutModal;
window.confirmPurchase = confirmPurchase;
window.closeSuccessModal = closeSuccessModal;

document.addEventListener('DOMContentLoaded', () => {
    loadCart();
    productsUI('todos');
    filterProducts();

    const buttClCart = document.querySelector('.butt-cl-cart');
    if (buttClCart) buttClCart.addEventListener('click', toggleCart);

    const overlay = document.getElementById('cart-overlay');
    if (overlay) overlay.addEventListener('click', toggleCart);
});
