document.getElementById("FormLogin").addEventListener("submit", function (e) {

    e.preventDefault();

    let email = document.getElementById("email").value;
    let senha = document.getElementById("senha").value;
    let confirm_senha = document.getElementById("confirm_senha").value;
    let estado = document.getElementById("EstadoCivil").value;
    let nome = document.getElementById("nome").value;
    let cpf = document.getElementById("cpf").value;
    let data = document.getElementById("data").value;
    let cep = document.getElementById("cep").value;
    let rua = document.getElementById("rua").value;
    let comp = document.getElementById("comp").value;
    let cidade = document.getElementById("cidade").value;
    let ramal = document.getElementById("ramal").value;
    let erro = document.getElementById("resultado").value;


     if (email === "" || senha === "" || confirm_senha === "" || estado === "" || nome === "" || cpf === "" || data === "" || cep === "" || rua === "" || comp === "" || cidade === "" || ramal === "") {
        erro.textContent = "Preencha todos os campos!";
        return;
    }

     if (nome < 3){
        erro.textContent = "Informe o nome completo!";
        return;
    }

     if (cpf < 8 || cpf > 8){
        erro.textContent = "CPF inválido!";
        return;
    }

     if (data){
        erro.textContent = "Informe o nome completo!";
        return;
    }

    if (cep < 8 ){
        
    }

    if ( nome >= 3 && cpf < 11 && cpf > 11 && data < 2 && cep < 8 && cep > 8 )
});