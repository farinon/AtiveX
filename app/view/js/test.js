if (!access_cookie("token")) {
    logout();
}

function test() {
    const token = access_cookie("token");
    if (token) {
        url = '../../api/?endpoint=test';
        fetch(url, get_fetch_params(token))
            .then(response => {
                return response.json()
            })
            .then(response => {
                response = JSON.parse(response)
                console.log(response.error)
                
                document.getElementById("texto").innerHTML = "Oi meu amigo";
            })
            .catch(error => {
                console.error("Requisição falhou:", error);
                alert_error.innerText = "Username e/ou Password inválido";
                alert_error.hidden = false;
            })

    } else {
        logout();
    }
}
test()