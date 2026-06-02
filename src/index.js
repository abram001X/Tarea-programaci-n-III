  /* * NOTA PARA PHP:
         * En una implementación real con PHP, este array 'productos' sería
         * generado dinámicamente desde tu base de datos MySQL usando json_encode()
         * Ejemplo en PHP: const productos = <?php echo json_encode($productos_db); ?>;
         */
        const productos = [
            { id: 1, nombre: "Camiseta Básica Blanca", precio: 19.99, categoria: "Hombre", imagen: "https://images.unsplash.com/photo-1521572163474-6864f9cf17ab?auto=format&fit=crop&w=400&q=80" },
            { id: 2, nombre: "Vaqueros Clásicos Azules", precio: 49.99, categoria: "Hombre", imagen: "https://images.unsplash.com/photo-1542272604-787c3835535d?auto=format&fit=crop&w=400&q=80" },
            { id: 3, nombre: "Chaqueta de Cuero", precio: 119.99, categoria: "Mujer", imagen: "https://images.unsplash.com/photo-1551028719-00167b16eac5?auto=format&fit=crop&w=400&q=80" },
            { id: 4, nombre: "Zapatillas Urbanas Blancas", precio: 59.99, categoria: "Accesorios", imagen: "https://images.unsplash.com/photo-1549298916-b41d501d3772?auto=format&fit=crop&w=400&q=80" },
            { id: 5, nombre: "Sudadera con Capucha", precio: 34.99, categoria: "Hombre", imagen: "https://images.unsplash.com/photo-1556821840-3a63f95609a7?auto=format&fit=crop&w=400&q=80" },
            { id: 6, nombre: "Vestido de Verano Floral", precio: 45.00, categoria: "Mujer", imagen: "https://images.unsplash.com/photo-1572804013309-59a88b7e92f1?auto=format&fit=crop&w=400&q=80" },
            { id: 7, nombre: "Gafas de Sol Vintage", precio: 24.50, categoria: "Accesorios", imagen: "https://images.unsplash.com/photo-1511499767150-a48a237f0083?auto=format&fit=crop&w=400&q=80" },
            { id: 8, nombre: "Bolso de Cuero Sintético", precio: 39.99, categoria: "Mujer", imagen: "https://images.unsplash.com/photo-1584916201218-f4242ceb4809?auto=format&fit=crop&w=400&q=80" }
        ];

        // Estado del Carrito
        let carrito = [];
        let cartOpen = false;

        // 1. Renderizar Productos
        function renderizarProductos() {
            const grid = document.getElementById('product-grid');
            grid.innerHTML = '';

            productos.forEach(producto => {
                // Crear tarjeta de producto
                const card = document.createElement('div');
                card.className = 'dynamic-card rounded-2xl overflow-hidden border flex flex-col group';
                
                card.innerHTML = `
                    <div class="relative overflow-hidden aspect-[4/5]">
                        <img src="${producto.imagen}" alt="${producto.nombre}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                        <div class="absolute top-3 left-3 bg-white/90 text-xs font-bold px-2 py-1 rounded text-gray-800">
                            ${producto.categoria}
                        </div>
                        <button onclick="agregarAlCarrito(${producto.id})" class="absolute bottom-4 left-1/2 transform -translate-x-1/2 bg-indigo-600 text-white px-6 py-2 rounded-full opacity-0 group-hover:opacity-100 transition-all duration-300 hover:bg-indigo-700 shadow-lg translate-y-4 group-hover:translate-y-0 font-semibold text-sm w-10/12 text-center flex justify-center items-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                            Añadir
                        </button>
                    </div>
                    <div class="p-5 flex flex-col flex-grow">
                        <h3 class="text-lg font-semibold mb-1 leading-tight">${producto.nombre}</h3>
                        <p class="text-indigo-600 font-bold text-xl mt-auto">$${producto.precio.toFixed(2)}</p>
                    </div>
                `;
                grid.appendChild(card);
            });
        }

        // 2. Lógica del Carrito
        function agregarAlCarrito(id) {
            const producto = productos.find(p => p.id === id);
            const itemEnCarrito = carrito.find(item => item.id === id);

            if (itemEnCarrito) {
                itemEnCarrito.cantidad++;
            } else {
                carrito.push({ ...producto, cantidad: 1 });
            }

            actualizarUI();
            mostrarToast(`¡${producto.nombre} añadido al carrito!`);
        }

        function quitarDelCarrito(id) {
            carrito = carrito.filter(item => item.id !== id);
            actualizarUI();
        }

        function actualizarUI() {
            // Actualizar contador
            const totalItems = carrito.reduce((sum, item) => sum + item.cantidad, 0);
            document.getElementById('cart-count').innerText = totalItems;

            // Actualizar lista en el sidebar
            const cartItemsContainer = document.getElementById('cart-items');
            const emptyMsg = document.getElementById('empty-cart-msg');
            
            cartItemsContainer.innerHTML = '';
            
            if (carrito.length === 0) {
                cartItemsContainer.appendChild(emptyMsg);
                emptyMsg.style.display = 'block';
            } else {
                emptyMsg.style.display = 'none';
                
                carrito.forEach(item => {
                    const div = document.createElement('div');
                    div.className = 'flex items-center gap-4 mb-4 pb-4 border-b border-gray-200/20';
                    div.innerHTML = `
                        <img src="${item.imagen}" class="w-16 h-16 object-cover rounded-md">
                        <div class="flex-grow">
                            <h4 class="font-semibold text-sm line-clamp-1">${item.nombre}</h4>
                            <p class="opacity-70 text-sm">$${item.precio.toFixed(2)} x ${item.cantidad}</p>
                        </div>
                        <div class="text-right">
                            <p class="font-bold text-indigo-600">$${(item.precio * item.cantidad).toFixed(2)}</p>
                            <button onclick="quitarDelCarrito(${item.id})" class="text-red-500 text-xs hover:underline mt-1">Eliminar</button>
                        </div>
                    `;
                    cartItemsContainer.appendChild(div);
                });
            }

            // Actualizar total
            const totalCosto = carrito.reduce((sum, item) => sum + (item.precio * item.cantidad), 0);
            document.getElementById('cart-total').innerText = `$${totalCosto.toFixed(2)}`;
        }

        // 3. UI y Efectos Visuales
        function toggleCart() {
            cartOpen = !cartOpen;
            const sidebar = document.getElementById('cart-sidebar');
            const overlay = document.getElementById('cart-overlay');
            
            if (cartOpen) {
                sidebar.classList.remove('translate-x-full');
                overlay.classList.remove('hidden');
                setTimeout(() => document.body.style.overflow = 'hidden', 10);
            } else {
                sidebar.classList.add('translate-x-full');
                overlay.classList.add('hidden');
                document.body.style.overflow = '';
            }
        }

        function changeTheme(themeName) {
            // Elimina clases de temas anteriores
            document.body.classList.remove('theme-dark', 'theme-warm');
            
            // Aplica el nuevo tema si no es 'light' (por defecto)
            if (themeName !== 'light') {
                document.body.classList.add(`theme-${themeName}`);
            }
        }

        function mostrarToast(mensaje) {
            const container = document.getElementById('toast-container');
            const toast = document.createElement('div');
            toast.className = 'toast flex items-center';
            toast.innerHTML = `
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                ${mensaje}
            `;
            container.appendChild(toast);
            
            // Eliminar del DOM después de la animación
            setTimeout(() => {
                toast.remove();
            }, 3000);
        }

        function checkout() {
            if (carrito.length === 0) return;
            
            /* * NOTA PARA PHP:
             * Aquí enviarías mediante un POST (usando fetch o un formulario form) 
             * el array 'carrito' a un archivo checkout.php para procesar el pago.
             */
            alert("En un entorno real con PHP, esto te redirigiría a la pasarela de pago.");
            
            carrito = [];
            actualizarUI();
            toggleCart();
            mostrarToast("¡Compra procesada con éxito!");
        }

        // Inicializar al cargar
        window.onload = () => {
            renderizarProductos();
            actualizarUI();
        };


        