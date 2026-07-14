import { registerApi } from "./lib/api.js"

function sendFormRegister() {
    const formReg = document.getElementById("registro-form")
    formReg.addEventListener("submit", register)
}
async function register(e) {
    e.preventDefault()
    const email = document.getElementById("emailReg").value
    const name = document.getElementById("nameReg").value
    const password = document.getElementById("passwordReg").value
    const passwordConfirm = document.getElementById("confirmPass").value
    if (password == passwordConfirm) {
        const body = { email, name, password }
        const res = await registerApi(body)
        if (res == "usuario registrado con exito") {
            window.location.href = "index.php";
        } else {
            document.querySelector('.msg-reg').textContent = res;
        }
    }else document.querySelector('.msg-reg').textContent = 'Las contraseñas no coinciden';
}

window.onload = () => {
    sendFormRegister()
};