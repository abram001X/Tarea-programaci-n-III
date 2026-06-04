const url = "/tarea/backend/dbApi.php"; //Se va a cambiar esta url
export async function getproducts() {
    const res = await fetch(url, {
        method: "GET",
        headers: {
            "Content-type": "application/json"
        }
    }
    )

    const { products } = await res.json()
    return products;
}