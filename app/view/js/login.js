const alert_error = document.getElementById('alert_error');
const inp_username = document.getElementById('inp_username');
const inp_password = document.getElementById('inp_password');
const btn_submit = document.getElementById('btn_submit');

alert_error.hidden = true;
delete_cookie("token");

const valid_form = () => {
    return (inp_username.value && inp_password.value) ? true : false;
}

function get_token() {
    fetch('../../api/?endpoint=login', {
        method: 'POST',
        headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ username: inp_username.value, password: inp_password.value })
    })
        .then(response => {
            return response.json()
        })
        .then(response => {
            //console.log(response.token)
            if(response.token){
                let expiration_days= 2;
                let date = new Date();
                date.setTime(date.getTime() + (expiration_days * 24 * 60 * 60 * 1000));
                let expires = "expires=" + date.toGMTString();
                document.cookie = "token=" + response.token + "; " + expires;
                window.location.href = "./test.php";
            } else{
                alert_error.innerText = "Usuário e/ou Password inválido";
                alert_error.hidden = false;
            }
            
        })
        .catch(error => {
            //console.error("Requisição falhou:", error);
            alert_error.innerText = "Usuário e/ou Password inválido";
            alert_error.hidden = false;
        })


}

btn_submit.addEventListener('click', () => {

    if (valid_form()) {
        get_token()
    } else {
        alert_error.innerText = "Preencha todos os dados do formulário";
        alert_error.hidden = false;
    }
})

function delete_cookie(name) {
    document.cookie = name + '=; expires=Thu, 01 Jan 1970 00:00:01 GMT;';
}
