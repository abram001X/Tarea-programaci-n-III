const url = "/tarea/backend/";


export async function getProducts() {
    const res = await fetch(url + "dbApi.php", {
        method: "GET",
        headers: {
            "Content-type": "application/json"
        }
    }
    )
    const products = await res.json()
    return products;
}

export async function initLogin({ email, password }) {
    const res = await fetch(url + `session.php?email=${email}&password=${password}`, {
        method: "GET",
        headers: {
            "Content-type": "application/json"
        }
    }
    )
    const { message } = await res.json()
    return message;
}

export async function registerApi(body) {
    try {
        const res = await fetch(url + `session.php`, {
            method: "POST",
            headers: {
                "Content-type": "application/json"
            },
            body: JSON.stringify(body)
        })
        const { message } = await res.json()
        console.log("abrahamxd")
        console.log(message)
        return message;
    } catch (e) {
        console.log(e.message)
        return { message: e.message }
    }
}

export async function closeSession() {
    const res = await fetch(url + `session.php`, {
        method: "DELETE",
        headers: {
            "Content-type": "application/json"
        }
    })
}