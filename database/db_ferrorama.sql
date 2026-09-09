CREATE DATABASE sa_ferrorama_db;
USE sa_ferrorama_db;

CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) NOT NULL,
    senha VARCHAR(100) NOT NULL,
    confirm_senha VARCHAR(100) NOT NULL,
    nome VARCHAR(255) NOT NULL,
    cpf VARCHAR(255) NOT NULL,
    data_nascimento DATE NOT NULL,
    cep VARCHAR(9) NOT NULL,
    complemento VARCHAR(100) NOT NULL, 
    telefone VARCHAR(15) NOT NULL
);

CREATE TABLE rotas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    saida VARCHAR(255) NOT NULL,
    destino VARCHAR (255) NOT NULL
);

CREATE TABLE trens (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_rotas INT NOT NULL,
    tipo VARCHAR(255) NOT NULL,
    instalacao VARCHAR(255) NOT NULL,
    FOREIGN KEY (id_rotas) REFERENCES rotas(id)
);

CREATE TABLE sensores (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_trens INT NOT NULL,
    nome VARCHAR(255) NOT NULL,
    tipo VARCHAR(100) NOT NULL,
    instalacao VARCHAR(200) NOT NULL,
    FOREIGN KEY (id_trens) REFERENCES trens(id)
);

CREATE TABLE relatorios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_usuarios INT NOT NULL,
    conteudo VARCHAR(255) NOT NULL,
    FOREIGN KEY (id_usuarios) REFERENCES usuarios(id)
);