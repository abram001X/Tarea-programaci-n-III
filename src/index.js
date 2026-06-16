import { closeSession} from "./lib/api.js";

// Temas
function changeTheme() {
    const butts = document.querySelectorAll(".butt-theme")
    butts.forEach(comp => {
        comp.addEventListener("click", () => {
            const theme = comp.id
            document.body.classList.remove('theme-dark', 'theme-warm');
            if (theme !== 'light') document.body.classList.add('theme-' + theme);
            localStorage.setItem('theme', theme);
        })
    })

}
function addToCart(id) {
    const p = productos.find(x => x.id === id);
    carrito.push(p);
    updateCartUI();
    showToast(`Añadido: ${p.nombre}`);
}



function cerrarSesion() {
    const butt = document.querySelector(".cl-sesion")
    if (butt) butt.addEventListener("click", async (e) => {
        console.log("hola")
        await closeSession()
        location.reload()
    })
}

window.onload = () => {
    cerrarSesion()
    // Cargar tema guardado
    changeTheme()
    if (localStorage.getItem('theme')) changeTheme();
};
