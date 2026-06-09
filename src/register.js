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
    const body = { email, name, password } 
    const res = await registerApi(body)
    console.log(res)
}


window.onload = () => {
    sendFormRegister()
};