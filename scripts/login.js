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

<<<<<<< HEAD
    window.location.href = "../public/home.php";


=======
    window.location.href = "home.php";
>>>>>>> 66066d3b7775a7a8685175c0e8a0c4ecb34ad6aa
});


function esqueceuSenha() {
    alert("Entre em contato com o suporte para recuperar sua senha.");
}