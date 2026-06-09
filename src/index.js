import { getproducts } from "./lib/api.js";

 async function render() {
            const productos = await getproducts()
            const container = document.getElementById('product-grid');
            container.innerHTML = productos.map(p => `
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
                        <p class="text-indigo-600 font-black text-xl mt-2">$${p.precio.toFixed(2)}</p>
                    </div>
                </div>
            `).join('');
        }

        // Temas
        function changeTheme() {
            const butts = document.querySelectorAll(".butt-theme")
            console.log("hola pa")
            butts.forEach(comp=>{
                comp.addEventListener("click",()=>{
                    const theme = comp.id
                    document.body.classList.remove('theme-dark', 'theme-warm');
                    if(theme !== 'light') document.body.classList.add('theme-' + theme);
                    localStorage.setItem('theme', theme);
                })
            })
            
        }

        /*function toggleCart() {
            document.getElementById('cart-sidebar').classList.toggle('translate-x-full');
            document.getElementById('cart-overlay').classList.toggle('hidden');
        }

            function addToCart(id) {
            const p = productos.find(x => x.id === id);
            carrito.push(p);
            updateCartUI();
            showToast(`Añadido: ${p.nombre}`);
        }

        function updateCartUI() {
            document.getElementById('cart-count').innerText = carrito.length;
            const total = carrito.reduce((s, x) => s + x.precio, 0);
            document.getElementById('cart-total').innerText = `$${total.toFixed(2)}`;
            
            const items = document.getElementById('cart-items');
            if(carrito.length === 0) {
                items.innerHTML = '<p class="text-center opacity-50 py-10">Vacío</p>';
            } else {
                items.innerHTML = carrito.map((x, i) => `
                    <div class="flex items-center gap-4 mb-4">
                        <img src="${x.img}" class="w-16 h-16 rounded-lg object-cover">
                        <div class="flex-grow">
                            <h4 class="font-bold text-sm">${x.nombre}</h4>
                            <p class="text-indigo-600 font-bold">$${x.precio}</p>
                        </div>
                        <button onclick="carrito.splice(${i},1); updateCartUI();" class="text-red-400">
                             <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
                        </button>
                    </div>
                `).join('');
            }
        }*/


        window.onload = () => {
            render();
            // Cargar tema guardado
            changeTheme()
            if(localStorage.getItem('theme')) changeTheme();

            
        };
