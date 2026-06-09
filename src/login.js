import { initLogin } from "./lib/api.js"

function sendFormLogin() {
    const formLogin = document.getElementById("loginForm")
    formLogin.addEventListener("submit", login)
}
async function login(e) {
    e.preventDefault()
    const email = document.getElementById("email").value
    const password = document.getElementById("password").value

    const res = await initLogin({ email, password })
    console.log(res)
}


window.onload = () => {
    sendFormLogin()
};