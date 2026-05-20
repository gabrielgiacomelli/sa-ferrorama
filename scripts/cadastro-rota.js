function cadastroRota() {

    let nome = document.getElementById('nome').value
    localStorage.setItem('nomeRota', nome);


let saida = document.getElementById('saida').value
    localStorage.setItem('saidaRota', saida);

    let destino = document.getElementById('destino').value
    localStorage.setItem('destinoRota', destino);

}