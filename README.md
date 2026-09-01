#  SA-Ferrorama

**Equipe:** HLGL
**Turma:** 3 TDES M1

##  Integrantes

* Gabriel da Costa Giacomelli
* Lucas Corrêa
* Henrique Venso
* Lara Emilia Guzman Baratto

---

##  Sobre o Projeto

O **SA-Ferrorama** é um sistema de gestão ferroviária desenvolvido para auxiliar no controle e gerenciamento de uma rede de trens. O sistema tem como foco o monitoramento de diferentes tipos de sensores, o gerenciamento de trens e rotas e o controle dos funcionários envolvidos na operação.

A proposta é centralizar essas informações em um único sistema, facilitando o acompanhamento das operações ferroviárias e permitindo que os responsáveis tenham acesso rápido e organizado aos dados necessários para o gerenciamento da rede.

---

##  Objetivo

O principal objetivo do **SA-Ferrorama** é desenvolver um sistema capaz de organizar e facilitar a gestão de uma operação ferroviária, permitindo o controle de **trens, rotas, sensores e funcionários**.

O sistema busca melhorar a organização das informações, facilitar o monitoramento dos sensores e auxiliar os responsáveis na tomada de decisões, proporcionando uma visão mais centralizada, organizada e eficiente das operações ferroviárias.

---

##  Usuários do Sistema

O sistema será utilizado por dois principais tipos de usuários:

### Gerentes

Os gerentes terão acesso às principais funcionalidades de gerenciamento e acompanhamento do sistema, podendo administrar informações relacionadas aos **trens, rotas, sensores e funcionários**.

###  Funcionários

Os funcionários terão acesso às funcionalidades necessárias para realizar suas atividades dentro do sistema, podendo consultar e acompanhar informações relacionadas à operação ferroviária, de acordo com suas permissões de acesso.

---

##  Funcionalidades

Entre as principais funcionalidades previstas para o sistema estão:

*  Login e autenticação de usuários;
*  Cadastro e gerenciamento de usuários;
*  Cadastro e visualização de trens;
*  Cadastro e gerenciamento de rotas;
*  Cadastro e visualização de sensores;
*  Controle de funcionários;
*  Alteração de informações cadastradas;
*  Exclusão de registros;
*  Visualização e consulta das informações do sistema.

---

##  Tecnologias

O projeto será desenvolvido utilizando as seguintes tecnologias:

* **PHP** — Desenvolvimento do sistema e funcionalidades do backend;
* **MySQL** — Armazenamento e gerenciamento do banco de dados;
* **HTML** — Estrutura das páginas;
* **CSS** — Estilização e personalização da interface;
* **JavaScript** — Interatividade e funcionalidades do sistema;
* **Bootstrap** — Desenvolvimento e estilização da interface;
* **XAMPP** — Ambiente de desenvolvimento local;
* **Git e GitHub** — Versionamento e colaboração da equipe.

---

##  Estrutura do Projeto

```text
SA-Ferrorama/
│
├── assets/
│   ├── css/
│   ├── js/
│   └── img/
│
├── doc/
│   └── Documentações e pesquisas
│
├── infra/
│   └── Configurações do banco de dados
│
├── pages/
│   └── Páginas do sistema
│
├── index.php
└── README.md
```

###  Organização das Pastas

| Pasta/Arquivo | Descrição                                               |
| ------------- | ------------------------------------------------------- |
| `assets/`     | Arquivos utilizados pela interface do sistema           |
| `assets/css/` | Arquivos de estilização                                 |
| `assets/js/`  | Scripts JavaScript                                      |
| `assets/img/` | Imagens e recursos visuais                              |
| `doc/`        | Documentações, pesquisas e materiais do projeto         |
| `infra/`      | Arquivos relacionados à infraestrutura e banco de dados |
| `pages/`      | Páginas e telas do sistema                              |
| `index.php`   | Página inicial do sistema                               |
| `README.md`   | Documentação principal do projeto                       |

---

##  Padrão de Nomenclatura

Para manter o projeto organizado e facilitar o trabalho colaborativo, serão adotados padrões de nomenclatura:

* **Arquivos:** utilizar nomes em minúsculo, separados por `_` quando necessário.
* **Pastas:** utilizar nomes em minúsculo.
* **Variáveis PHP:** utilizar nomes descritivos em `snake_case`.
* **Classes:** utilizar nomes descritivos seguindo um padrão consistente.
* **Banco de dados:** utilizar nomes em minúsculo e descritivos.
* **IDs e classes HTML/CSS:** utilizar nomes relacionados à função ou ao elemento.

Exemplos:

```text
cadastro_usuario.php
visualizar_trens.php
conexao.php
```

---

## Responsabilidades da Equipe

###  Primeira Etapa

**Gabriel**

* Desenvolvimento inicial do `index`;
* Desenvolvimento da tela de login;
* Ajustes no mockup.

**Henrique e Lucas**

* Elaboração inicial do README;
* Organização das informações da equipe.

**Lara**

* Pesquisa sobre CRUD em PHP;
* Produção de documentação na pasta `doc`.

### 🔹 Segunda Etapa

**Gabriel e Lara**

* Estilização da página `index`;
* Ajustes em HTML e JavaScript.

**Henrique**

* Pesquisa sobre SCRUM;
* Desenvolvimento inicial da tela de visualização de usuários.

**Lucas**

* Desenvolvimento da tela Home;
* Ajustes no mockup da Home.

### 🔹 Terceira Etapa

**Gabriel**

* Pesquisa sobre o software XAMPP;
* Produção de documentação na pasta `doc`.

**Lara**

* Desenvolvimento das telas de cadastro de sensores e trens.

**Henrique**

* Desenvolvimento das telas de cadastro de usuários e rotas;
* Ajustes visuais do sistema.

**Lucas**

* Desenvolvimento da tela de visualização de sensores.

---

## Identidade Visual

A identidade visual do **SA-Ferrorama** será desenvolvida com base no conceito ferroviário e tecnológico do sistema, buscando transmitir organização, segurança, tecnologia e eficiência.

###  Cores

A paleta de cores será definida considerando a temática ferroviária e a necessidade de proporcionar uma boa experiência de uso e leitura.

###  Tipografia

Será utilizada uma tipografia moderna e de fácil leitura, priorizando a clareza das informações apresentadas ao usuário.

###  Estilo

O sistema terá uma proposta visual **moderna, organizada e tecnológica**, utilizando elementos que façam referência ao ambiente ferroviário.

###  Logo

A identidade do projeto contará com uma representação visual relacionada ao conceito de ferrovias, trens e gerenciamento.

###  Referências

As referências visuais serão utilizadas para definir elementos como disposição dos componentes, cores, tipografia, navegação e organização das informações, servindo como base para a criação do layout do sistema.

---

##  CRUD em PHP

CRUD é uma sigla utilizada para representar as quatro operações básicas realizadas sobre dados em um sistema:

| Operação   | Significado | Aplicação no SA-Ferrorama                      |
| ---------- | ----------- | ---------------------------------------------- |
| **Create** | Criar       | Cadastrar usuários, trens, sensores e rotas    |
| **Read**   | Ler         | Visualizar e consultar informações cadastradas |
| **Update** | Atualizar   | Alterar informações existentes                 |
| **Delete** | Excluir     | Remover registros do sistema                   |

No **SA-Ferrorama**, o CRUD será utilizado principalmente para o gerenciamento das informações armazenadas no banco de dados.

Por meio dessas operações, será possível **cadastrar, visualizar, alterar e excluir** registros de usuários, trens, sensores e outros elementos do sistema.

O desenvolvimento do CRUD em PHP será integrado ao banco de dados **MySQL**, permitindo que as informações sejam armazenadas e gerenciadas de forma organizada.

Além do desenvolvimento das operações, a equipe também considera aspectos de **segurança, organização do código e manutenção do sistema**, buscando tornar a aplicação mais confiável e preparada para futuras melhorias.

---

##  Requisitos Funcionais

| ID       | Descrição                                                        |
| -------- | ---------------------------------------------------------------- |
| **RF01** | O sistema deve permitir que o usuário realize login.             |
| **RF02** | O sistema deve permitir o cadastro de usuários.                  |
| **RF03** | O sistema deve permitir a visualização dos usuários cadastrados. |
| **RF04** | O sistema deve permitir editar usuários cadastrados.             |
| **RF05** | O sistema deve permitir excluir usuários cadastrados.            |
| **RF06** | O sistema deve permitir cadastrar trens.                         |
| **RF07** | O sistema deve permitir visualizar trens cadastrados.            |
| **RF08** | O sistema deve permitir cadastrar sensores.                      |
| **RF09** | O sistema deve permitir visualizar sensores cadastrados.         |
| **RF10** | O sistema deve permitir alterar informações já cadastradas.      |

---

##  Requisitos Não Funcionais

| ID        | Descrição                                                       |
| --------- | --------------------------------------------------------------- |
| **RNF01** | O sistema deve possuir uma interface amigável ao usuário.       |
| **RNF02** | O sistema deve ser desenvolvido utilizando PHP.                 |
| **RNF03** | O sistema deve utilizar banco de dados MySQL.                   |
| **RNF04** | O sistema deve funcionar nos principais navegadores modernos.   |
| **RNF05** | O sistema deve utilizar Bootstrap para estilização das páginas. |

---

## Segurança

O sistema deverá considerar boas práticas de segurança durante seu desenvolvimento, especialmente no gerenciamento de usuários e no acesso ao banco de dados.

Entre as práticas consideradas estão:

* Controle de acesso por tipo de usuário;
* Proteção das informações de login;
* Validação dos dados recebidos;
* Organização adequada da conexão com o banco de dados;
* Utilização de práticas seguras para operações no banco de dados.

---

## Trabalho em Equipe

O desenvolvimento do **SA-Ferrorama** será realizado de forma colaborativa, utilizando o **GitHub** para versionamento e compartilhamento do código.

Cada integrante será responsável por determinadas partes do projeto, permitindo a divisão das tarefas e facilitando o acompanhamento do desenvolvimento.

A organização do projeto busca incentivar a colaboração, a divisão de responsabilidades e a aplicação de boas práticas de desenvolvimento de software.

---

## Considerações Finais

O desenvolvimento do **SA-Ferrorama** permite que a equipe aplique conhecimentos de **programação web, PHP, banco de dados, desenvolvimento de interfaces, documentação, versionamento e trabalho colaborativo**.

O projeto representa uma simulação de um ambiente de gestão ferroviária, reunindo funcionalidades para o gerenciamento de **trens, rotas, sensores e funcionários** em uma única aplicação.

A partir das etapas de desenvolvimento, a equipe pretende construir um sistema organizado, funcional e de fácil utilização, aplicando os conhecimentos adquiridos durante o curso técnico em Desenvolvimento de Sistemas.
