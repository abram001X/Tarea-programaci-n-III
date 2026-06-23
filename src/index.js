import { closeSession} from "./lib/api.js";


function addToCart(id) {
    const p = productos.find(x => x.id === id);
    carrito.push(p);
    updateCartUI();
    showToast(`Añadido: ${p.nombre}`);
}



function cerrarSesion() {
    const butt = document.querySelector(".cl-sesion")
    if (butt) butt.addEventListener("click", async (e) => {
        await closeSession()
        location.reload()
    })
}

window.onload = () => {
    cerrarSesion()
    if (localStorage.getItem('theme')) changeTheme();
};
