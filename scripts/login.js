document.getElementById("FormLogin").addEventListener("submit", function (e) {

    e.preventDefault();

    let email = document.getElementById("email").value;
    let senha = document.getElementById("senha").value;
    let erro = document.getElementById("problema");

    let emailCorreto = "adm@gmail.com";
    let senhaCorreta = "1234";

    if (email === "" || senha === "") {
        erro.textContent = "Preencha todos os campos!";
        return;
    }

    if (email !== emailCorreto || senha !== senhaCorreta) {
        erro.textContent = "Email ou senha incorretos!";
        return;
    }

    window.location.href = "";


});