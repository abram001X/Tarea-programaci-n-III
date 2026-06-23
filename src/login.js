import {  initLogin } from "./lib/api.js"

function sendFormLogin() {
    const formLogin = document.getElementById("loginForm")
    if(formLogin)formLogin.addEventListener("submit", login)
}
async function login(e) {
    e.preventDefault()
    const email = document.getElementById("email").value
    const password = document.getElementById("password").value

    const res = await initLogin({ email, password })
    if (res == "Usuario logeado con éxito: ") {
        window.location.href = "index.php";
    } else {
        //mostrar en UI: Error, datos no válidos
    }
}


window.onload = () => {
    sendFormLogin()
};