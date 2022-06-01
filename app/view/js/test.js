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
                console.log(response);
                //response = JSON.parse(response)
                //console.log(response.error)
                if(!response.error){
                    document.getElementById("texto").innerHTML = response.text;
                } else{
                    document.getElementById("texto").innerHTML = response.error;
                }
                
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