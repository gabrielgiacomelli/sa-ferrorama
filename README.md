# SA-Ferrorama

## Sistema de Gerenciamento Ferroviário

### Equipe

* Gabriel da Costa Giacomelli
* Henrique Venso
* Lara Emilia Guzman
* Lucas Siedschlag Corrêa

---

## Sobre o Projeto

O SA-Ferrorama é um sistema desenvolvido com o objetivo de simular o gerenciamento de uma ferrovia. A plataforma permite o cadastro, visualização, edição e exclusão de informações relacionadas aos trens, sensores e usuários do sistema.

Além disso, o sistema busca oferecer uma experiência intuitiva para os usuários, disponibilizando informações importantes sobre a operação ferroviária, como localização dos trens, monitoramento dos sensores e outras informações relevantes para o gerenciamento da ferrovia.

---

## Objetivos

* Simular o gerenciamento de uma ferrovia.
* Permitir o controle de usuários cadastrados.
* Gerenciar informações de trens e sensores.
* Aplicar operações CRUD (Create, Read, Update e Delete).
* Desenvolver uma interface simples e intuitiva.
* Utilizar integração com banco de dados para armazenamento das informações.

---

## Tecnologias Utilizadas

* HTML5
* CSS3
* JavaScript
* Bootstrap 5
* GitHub

---

## Padrão de Nomenclatura

Durante o desenvolvimento do projeto foi adotado o padrão **Snake_Case** para variáveis, arquivos e funções.

---

## Funcionalidades

### Usuários

* Login de usuários.
* Cadastro de usuários.
* Visualização de usuários cadastrados.
* Edição de informações dos usuários.
* Exclusão de usuários.

### Trens

* Cadastro de trens.
* Visualização de trens cadastrados.
* Atualização das informações dos trens.

### Sensores

* Cadastro de sensores.
* Visualização dos sensores cadastrados.
* Atualização das informações dos sensores.

### Sistema

* Navegação por menu.
* Interface responsiva.
* Integração com banco de dados.
* Operações CRUD completas.

---

## Requisitos Funcionais

| ID   | Descrição                                                        
| ---- | ---------
| RF01 | O sistema deve permitir que o usuário realize login.             
| RF02 | O sistema deve permitir o cadastro de usuários.                  
| RF03 | O sistema deve permitir a visualização dos usuários cadastrados. 
| RF04 | O sistema deve permitir editar usuários cadastrados.             
| RF05 | O sistema deve permitir excluir usuários cadastrados.            
| RF06 | O sistema deve permitir cadastrar trens.                         
| RF07 | O sistema deve permitir visualizar trens cadastrados.            
| RF08 | O sistema deve permitir cadastrar sensores.                      
| RF09 | O sistema deve permitir visualizar sensores cadastrados.         
| RF10 | O sistema deve permitir alterar informações já cadastradas.      

---

## Requisitos Não Funcionais

| ID    | Descrição                                                       
| ----- | ---------
| RNF01 | O sistema deve possuir interface amigável ao usuário.           
| RNF02 | O sistema deve ser desenvolvido utilizando PHP.                 
| RNF03 | O sistema deve utilizar banco de dados MySQL.                   
| RNF04 | O sistema deve funcionar nos principais navegadores modernos.   
| RNF05 | O sistema deve utilizar Bootstrap para estilização das páginas. 

---

## Responsabilidades da Equipe

### Primeira Etapa

**Gabriel**

* Desenvolvimento inicial do index.
* Desenvolvimento da tela de login.
* Ajustes no mockup.

**Henrique e Lucas**

* Elaboração inicial do README.
* Organização das informações da equipe.

**Lara**

* Pesquisa sobre CRUD em PHP.
* Produção de documentação na pasta doc.

### Segunda Etapa

**Gabriel e Lara**

* Estilização da página index.
* Ajustes em HTML e JavaScript.

**Henrique**

* Pesquisa sobre SCRUM.
* Desenvolvimento inicial da tela de visualização de usuários.

**Lucas**

* Desenvolvimento da tela Home.
* Ajustes no mockup da Home.

### Terceira Etapa

**Gabriel**

* Pesquisa sobre o software XAMPP.
* Produção de documentação na pasta doc.

**Lara**

* Desenvolvimento das telas de cadastro de sensores e trens.

**Henrique**

* Desenvolvimento das telas de cadastro de usuários e rotas.
* Ajustes visuais do sistema.

**Lucas**

* Desenvolvimento da tela de visualização de sensores.

---

## Estrutura do Projeto

```text
SA-Ferrorama
│
├── assets
│   ├── css
│   ├── js
│   └── img
│
├── doc
│   └── Documentações e pesquisas
│
├── infra
│   └── Configurações do banco de dados
│
├── pages
│   └── Páginas do sistema
│
├── index.php
└── README.md
```

---

## Considerações Finais

O desenvolvimento do SA-Ferrorama permitiu que a equipe aplicasse conhecimentos de programação web, banco de dados, documentação, versionamento e trabalho colaborativo. O projeto representa uma simulação de um ambiente ferroviário, oferecendo funcionalidades que auxiliam no gerenciamento de informações de forma organizada e eficiente.
