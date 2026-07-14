 <header class="dynamic-header shadow-md sticky top-0 z-40 transition-colors duration-400">
     <div class="max-w-7xl mx-auto px-4 h-16 flex justify-between items-center">
         <!-- Logo -->
         <div class="flex items-center space-x-2 title-logo">
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
                } else {
                    echo "
                    <button class='flex items-center space-x-1 px-4 py-2 rounded-lg hover:bg-black/5 transition font-medium'>
                    <svg class='w-5 h-5' fill='none' stroke='currentColor' viewBox='0 0 24 24'>
                        <path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z'></path>
                    </svg>
                    <a href='indexlogin.php'>
                        <span>Iniciar sesión</span>
                    </a>
                </button>
                    ";
                }
                ?>

         </div>
     </div>
 </header>