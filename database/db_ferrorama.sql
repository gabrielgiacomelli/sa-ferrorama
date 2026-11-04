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
    telefone VARCHAR(15) NOT NULL,
    acesso VARCHAR(25) NOT NULL DEFAULT 'Funcionário'
);

CREATE TABLE rotas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    saida VARCHAR(255) NOT NULL,
    destino VARCHAR (255) NOT NULL,
    status VARCHAR(100) NOT NULL DEFAULT 'Ativo'
);

CREATE TABLE trens (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_usuarios INT NOT NULL,
    id_rota INT NULL,
    peso DECIMAL(8, 2) NOT NULL,
    quantidade_vagoes INT NOT NULL,
    status VARCHAR(100) NOT NULL DEFAULT 'Ativo',
    FOREIGN KEY (id_usuarios) REFERENCES usuarios(id),
    FOREIGN KEY (id_rota) REFERENCES rotas(id)
    
);

CREATE TABLE sensores (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    instalacao VARCHAR(200) NOT NULL,
    funcao VARCHAR(100) NOT NULL,
    zona VARCHAR(100) NOT NULL,
    status VARCHAR(100) NOT NULL DEFAULT 'Ativo'
);

CREATE TABLE relatorios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_usuarios INT NOT NULL,
    conteudo VARCHAR(255) NOT NULL,
    CONSTRAINT fk_relatorios_usuarios 
    FOREIGN KEY (id_usuarios) REFERENCES usuarios(id)
);


INSERT INTO usuarios 
(email, senha, confirm_senha, nome, cpf, data_nascimento, cep, complemento, telefone, acesso) 
VALUES

('lucas@gmail.com', 'a123456', 'a123456', 'Lucas Correa', '00000000000', '2000-01-01', '89200000', 'Casa 01', '47990000000', 'Administrador'),
('lara@gmail.com ', 'a123456', 'a123456', 'Lara Guzman', '00000000001', '1995-05-15', '89200001', 'Apartamento 101', '47990000001', 'Administrador'),
('gabriel@gmail.com', '12345678a', '12345678a', 'Gabriel Giacomelli', '00000000002', '1990-10-20', '89200002', 'Casa 02', '47990000002', 'Administrador'),
('venso@gmail.com', 'a123456', 'a123456', 'Henrique Venso', '00000000003', '1985-03-30', '89200003', 'Apartamento 202', '47990000003', 'Administrador'),

('joao.silva@email.com', 'Joao@2026', 'Joao@2026', 'João Pedro Silva', '00000000191', '1990-05-14', '89201000', 'Casa 01', '47990001111', 'Administrador'),
('mariana.costa@email.com', 'Maria#123', 'Maria#123', 'Mariana Costa', '00000000272', '1998-11-23', '89202000', 'Apartamento 202', '47990002222', 'Funcionario'),
('pedro.santos@email.com', 'Pedro@456', 'Pedro@456', 'Pedro Henrique Santos', '00000000353', '1987-02-09', '89203000', 'Casa 15', '47990003333', 'Funcionario'),
('ana.oliveira@email.com', 'AnaOliveira1', 'AnaOliveira1', 'Ana Clara Oliveira', '00000000434', '1995-08-17', '89204000', 'Apartamento 101', '47990004444', 'Administrador'),
('gabriel.rocha@email.com', 'Gabriel#89', 'Gabriel#89', 'Gabriel Rocha', '00000000515', '2001-01-30', '89205000', 'Bloco B', '47990005555', 'Funcionario'),
('beatriz.lima@email.com', 'Beatriz@7', 'Beatriz@7', 'Beatriz Lima', '00000000696', '1992-06-12', '89206000', 'Casa 08', '47990006666', 'Funcionario'),
('felipe.almeida@email.com', 'Felipe#2026', 'Felipe#2026', 'Felipe Almeida', '00000000777', '1985-09-04', '89207000', 'Apartamento 303', '47990007777', 'Administrador'),
('camila.ribeiro@email.com', 'Camila@123', 'Camila@123', 'Camila Ribeiro', '00000000858', '1999-03-21', '89208000', 'Casa 12', '47990008888', 'Funcionario'),
('lucas.martins@email.com', 'Lucas#2026', 'Lucas#2026', 'Lucas Martins', '00000000939', '1996-12-05', '89209000', 'Fundos', '47990009999', 'Funcionario'),
('isabela.ferreira@email.com', 'Isabela@9', 'Isabela@9', 'Isabela Ferreira', '00000001010', '1993-04-19', '89210000', 'Apartamento 404', '47990010101', 'Administrador'),
('rafael.gomes@email.com', 'Rafael#123', 'Rafael#123', 'Rafael Gomes', '00000001191', '1989-07-26', '89211000', 'Casa 20', '47990011111', 'Funcionario'),
('julia.barros@email.com', 'Julia@2026', 'Julia@2026', 'Júlia Barros', '00000001272', '2000-10-08', '89212000', 'Bloco A', '47990012121', 'Funcionario'),
('matheus.cardoso@email.com', 'Matheus#8', 'Matheus#8', 'Matheus Cardoso', '00000001353', '1994-02-15', '89213000', 'Casa 05', '47990013131', 'Administrador'),
('laura.mendes@email.com', 'Laura@2026', 'Laura@2026', 'Laura Mendes', '00000001434', '1997-05-29', '89214000', 'Apartamento 105', '47990014141', 'Funcionario'),
('bruno.nunes@email.com', 'Bruno#123', 'Bruno#123', 'Bruno Nunes', '00000001515', '1986-11-11', '89215000', 'Casa 17', '47990015151', 'Funcionario'),
('amanda.pereira@email.com', 'Amanda@89', 'Amanda@89', 'Amanda Pereira', '00000001696', '1991-08-03', '89216000', 'Bloco C', '47990016161', 'Administrador'),
('thiago.moura@email.com', 'Thiago#26', 'Thiago#26', 'Thiago Moura', '00000001777', '1999-01-22', '89217000', 'Casa 09', '47990017171', 'Funcionario'),
('leticia.dias@email.com', 'Leticia@123', 'Leticia@123', 'Letícia Dias', '00000001858', '1995-06-16', '89218000', 'Apartamento 201', '47990018181', 'Funcionario'),
('vinicius.araujo@email.com', 'Vinicius#9', 'Vinicius#9', 'Vinícius Araújo', '00000001939', '1988-03-07', '89219000', 'Casa 03', '47990019191', 'Administrador'),
('sophia.teixeira@email.com', 'Sophia@2026', 'Sophia@2026', 'Sophia Teixeira', '00000002010', '2002-12-14', '89220000', 'Apartamento 302', '47990020202', 'Funcionario');