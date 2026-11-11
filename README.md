# SA-Ferrorama

> Sistema web de gestão ferroviária desenvolvido pela equipe HLGL para organização e gerenciamento de trens, rotas, sensores e usuários.

**Equipe:** HLGL  
**Turma:** 3 TDES M1  
**Versão:** v1.0.0

---

## Sumário

1. [Sobre o projeto](#sobre-o-projeto)
2. [Objetivo](#objetivo)
3. [Problema que o sistema resolve](#problema-que-o-sistema-resolve)
4. [Usuários do sistema](#usuários-do-sistema)
5. [Funcionalidades](#funcionalidades)
6. [Tecnologias utilizadas](#tecnologias-utilizadas)
7. [Requisitos para execução](#requisitos-para-execução)
8. [Instalação e configuração](#instalação-e-configuração)
9. [Banco de dados](#banco-de-dados)
10. [Como iniciar o sistema](#como-iniciar-o-sistema)
11. [Estrutura do projeto](#estrutura-do-projeto)
12. [CRUD](#crud)
13. [Padrão de nomenclatura](#padrão-de-nomenclatura)
14. [Identidade visual](#identidade-visual)
15. [Segurança](#segurança)
16. [APIs utilizadas](#apis-utilizadas)
17. [Requisitos funcionais](#requisitos-funcionais)
18. [Requisitos não funcionais](#requisitos-não-funcionais)
19. [Responsabilidades da equipe](#responsabilidades-da-equipe)
20. [Capturas de tela](#capturas-de-tela)
21. [Limitações conhecidas](#limitações-conhecidas)
22. [Documentação adicional](#documentação-adicional)
23. [Considerações finais](#considerações-finais)
24. [Licença](#licença)

---

## Sobre o projeto

O **SA-Ferrorama** é um sistema web de gestão ferroviária desenvolvido como uma Situação de Aprendizagem do curso Técnico em Desenvolvimento de Sistemas.

O sistema tem como proposta centralizar informações relacionadas à operação ferroviária em uma única plataforma, permitindo o gerenciamento de **trens, rotas, sensores, usuários e relatórios**.

A aplicação foi desenvolvida com foco em organização, facilidade de acesso às informações e aplicação prática dos conhecimentos adquiridos durante o curso.

---

## Objetivo

O principal objetivo do **SA-Ferrorama** é desenvolver um sistema capaz de organizar e facilitar o gerenciamento de uma operação ferroviária.

Entre os principais objetivos estão:

- Organizar informações sobre trens, rotas e sensores;
- Facilitar o gerenciamento de usuários;
- Permitir consultas e alterações dos dados cadastrados;
- Facilitar o acompanhamento das informações da operação;
- Centralizar os dados em um único sistema;
- Aplicar conhecimentos de programação web;
- Utilizar banco de dados para armazenamento das informações;
- Aplicar conceitos de segurança, documentação e versionamento;
- Desenvolver uma aplicação organizada e responsiva.

---

## Problema que o sistema resolve

Em uma operação ferroviária, informações sobre trens, rotas, sensores e funcionários podem ficar distribuídas em diferentes locais, dificultando o acompanhamento das operações.

O **SA-Ferrorama** busca solucionar esse problema centralizando essas informações em uma única aplicação.

Dessa forma, os usuários autorizados podem consultar e gerenciar os dados de maneira mais organizada, facilitando o acompanhamento das informações e a tomada de decisões.

---

## Usuários do sistema

O sistema possui diferentes níveis de acesso, de acordo com a função do usuário.

### Administrador

O administrador possui acesso às funcionalidades de gerenciamento do sistema.

Entre suas principais permissões estão:

- Gerenciar usuários;
- Gerenciar trens;
- Gerenciar rotas;
- Gerenciar sensores;
- Gerenciar relatórios;
- Consultar informações;
- Acessar o monitoramento;
- Cadastrar, editar, desativar e excluir registros.

### Funcionário

O funcionário possui acesso às funcionalidades disponibilizadas de acordo com suas permissões.

Seu acesso é destinado principalmente à consulta e acompanhamento das informações relacionadas à operação ferroviária.

---

## Funcionalidades

### Autenticação

- Login utilizando e-mail e senha;
- Controle de sessão;
- Logout;
- Controle de acesso conforme o perfil do usuário.

### Usuários

- Cadastro de usuários;
- Listagem de usuários;
- Consulta por ID;
- Edição de informações;
- Exclusão de usuários.

### Trens

- Cadastro de trens;
- Listagem de trens;
- Consulta por ID;
- Edição de informações;
- Desativação temporária;
- Remoção de registros.

### Rotas

- Cadastro de rotas;
- Listagem de rotas;
- Consulta por ID;
- Edição de informações;
- Associação com trens;
- Desativação temporária;
- Remoção de registros.

### Sensores

- Cadastro de sensores;
- Listagem de sensores;
- Consulta por ID;
- Edição de informações;
- Associação com rotas;
- Desativação temporária;
- Remoção de registros.

### Monitoramento

- Consulta do trem que será monitorado;
- Pesquisa por ID;
- Visualização de informações;
- Apresentação de gráficos e análises visuais de desempenho.

### Relatórios

- Cadastro de relatórios;
- Listagem;
- Consulta;
- Busca por ID;
- Visualização;
- Edição;
- Exclusão.

---

## Tecnologias utilizadas

| Tecnologia | Utilização |
|---|---|
| **PHP** | Desenvolvimento do backend e regras do sistema |
| **MySQL** | Armazenamento e gerenciamento dos dados |
| **HTML** | Estrutura das páginas |
| **CSS** | Estilização da interface |
| **JavaScript** | Interatividade e funcionalidades |
| **Bootstrap** | Componentes e responsividade da interface |
| **XAMPP** | Ambiente de desenvolvimento local |
| **Git** | Controle de versão |
| **GitHub** | Versionamento e colaboração da equipe |

---

## Requisitos para execução

Para executar o sistema localmente, é necessário possuir:

- **XAMPP** instalado;
- Apache habilitado;
- MySQL habilitado;
- PHP disponibilizado pelo XAMPP;
- Navegador atualizado;
- Git, caso seja utilizado o repositório.

O projeto foi desenvolvido para execução em ambiente local utilizando o XAMPP.

---

## Instalação e configuração

### 1. Clonar o projeto

```bash
git clone https://github.com/gabrielgiacomelli/sa-ferrorama.git
```

### 2. Colocar o projeto no XAMPP

Após baixar ou clonar o projeto, coloque a pasta dentro do diretório:

```text
C:\xampp\htdocs\
```

A estrutura deverá ficar:

```text
C:\xampp\htdocs\sa-ferrorama\
```

### 3. Iniciar o XAMPP

Abra o painel de controle do XAMPP e inicie:

- Apache
- MySQL

### 4. Configurar a conexão

A conexão com o banco de dados está centralizada no arquivo:

```text
infra/conn.php
```

Exemplo:

```php
$host = 'localhost';
$usuario = 'root';
$senha = '';
$banco = 'sa_ferrorama_db';
```

> Os dados de acesso podem variar de acordo com a configuração do ambiente local.

---

## Banco de dados

O projeto utiliza **MySQL** para armazenamento das informações.

O script do banco está localizado em:

```text
database/db_ferorama.sql
```

### Importação pelo phpMyAdmin

1. Inicie o MySQL pelo XAMPP.
2. Acesse:

```text
http://localhost/phpmyadmin
```

3. Crie ou selecione o banco de dados utilizado pelo projeto.
4. Acesse a opção **Importar**.
5. Selecione:

```text
database/db_ferorama.sql
```

6. Execute a importação.

O banco de dados armazena informações relacionadas aos usuários, trens, rotas, sensores e relatórios.

---

## Como iniciar o sistema

Depois de iniciar o Apache e o MySQL:

1. Abra o navegador;
2. Acesse:

```text
http://localhost/sa-ferrorama/
```

3. Realize o login;
4. Após a autenticação, acesse as funcionalidades disponíveis para o perfil do usuário.

---

## Estrutura do projeto

```text
SA-FERRORAMA/
│
├── assets/
│   ├── icons/
│   │   ├── ambiente.png
│   │   ├── logo.png
│   │   ├── sair.png
│   │   └── temperatura.png
│   │
│   └── img/
│       ├── funcionarios.jpg
│       ├── imagem_de_trens_na_ferrovia.jpg
│       ├── imagem_trem_parado.jpg
│       ├── imagem_trilhos_de_trem.jpg
│       ├── info1.png
│       ├── info2.png
│       └── telainicial.png
│
├── database/
│   └── db_ferorama.sql
│
├── doc/
│   ├── pesquisa_crud.md
│   ├── pesquisa_scrum.md
│   └── pesquisa_xampp.md
│
├── infra/
│   └── conn.php
│
├── public/
│   ├── cadastro-relatorio.php
│   ├── cadastro-rota.php
│   ├── cadastro-sensor.php
│   ├── cadastro-trem.php
│   ├── cadastro-usuario.php
│   ├── home.php
│   ├── login.php
│   ├── relatorios.php
│   ├── rota.php
│   ├── sensores.php
│   ├── trem.php
│   └── usuarios.php
│
├── scripts/
│   ├── botao-sair.js
│   ├── cadastro-rota.js
│   ├── calendario.js
│   └── login.js
│
├── styles/
│
├── index.php
├── navbar.php
├── LICENSE
└── README.md
```

---

## CRUD

O projeto utiliza o conceito de **CRUD**, que representa as quatro operações básicas de manipulação de dados:

| Operação | Significado | Aplicação |
|---|---|---|
| **Create** | Criar | Cadastrar registros |
| **Read** | Ler | Visualizar e consultar registros |
| **Update** | Atualizar | Alterar informações |
| **Delete** | Excluir | Remover registros |

No SA-Ferrorama, o CRUD é utilizado principalmente no gerenciamento de:

- Usuários;
- Trens;
- Rotas;
- Sensores;
- Relatórios.

---

## Padrão de nomenclatura

### Arquivos

Utilizar nomes em minúsculo e separados por hífen.

Exemplos:

```text
cadastro-usuario.php
cadastro-trem.php
cadastro-rota.php
```

### Pastas

Utilizar nomes em minúsculo.

### Variáveis PHP

Utilizar nomes descritivos.

Exemplo:

```php
$nome_usuario
$data_nascimento
```

### Banco de dados

Utilizar nomes em minúsculo e descritivos.

### IDs e classes

Os nomes devem estar relacionados à função ou ao elemento utilizado.

---

## Identidade visual

A identidade visual do **SA-Ferrorama** possui uma proposta moderna, tecnológica e relacionada ao ambiente ferroviário.

### Cores

A paleta utiliza principalmente tons de azul profundo, como azul-marinho e azul-cobalto, combinados com uma base clara.

A escolha busca transmitir:

- Segurança;
- Tecnologia;
- Organização;
- Informação;
- Confiabilidade.

### Estilo

A interface possui uma proposta:

- Moderna;
- Organizada;
- Tecnológica;
- Responsiva;
- De fácil leitura.

### Logo

A identidade visual utiliza a marca **HLGL**, relacionada às iniciais dos integrantes da equipe.

---

## Segurança

Durante o desenvolvimento do sistema foram considerados princípios de segurança para proteção das informações e controle de acesso.

Entre as práticas utilizadas ou consideradas estão:

- Controle de acesso por perfil;
- Proteção das informações de login;
- Validação dos dados recebidos;
- Organização da conexão com o banco de dados;
- Utilização de consultas seguras;
- Controle de sessão;
- Encerramento da sessão ao realizar logout.

---

## APIs utilizadas

### Open-Meteo

A **Open-Meteo** é utilizada para obter informações meteorológicas apresentadas na página inicial do sistema.

A integração tem como objetivo disponibilizar informações como:

- Temperatura;
- Condições meteorológicas;
- Localização;
- Umidade;
- Informações relacionadas ao clima.

### ViaCEP

A **ViaCEP** é utilizada para auxiliar o preenchimento dos dados de endereço durante o cadastro de usuários.

A partir de um CEP válido, a API pode fornecer:

- Logradouro;
- Bairro;
- Cidade;
- Estado.

---

## Requisitos funcionais

| ID | Descrição |
|---|---|
| **RF01** | Permitir login utilizando e-mail e senha. |
| **RF02** | Criar e manter uma sessão ativa após o login. |
| **RF03** | Permitir solicitação de redefinição de senha. |
| **RF04** | Permitir encerramento seguro da sessão. |
| **RF05** | Exibir a Home após o login realizado com sucesso. |
| **RF06** | Permitir cadastro de usuários. |
| **RF07** | Permitir listagem e visualização de usuários. |
| **RF08** | Permitir busca de usuários por ID. |
| **RF09** | Permitir edição de usuários. |
| **RF10** | Permitir exclusão de usuários. |
| **RF11** | Permitir cadastro de rotas. |
| **RF12** | Permitir visualização das rotas cadastradas. |
| **RF13** | Permitir busca de rotas por ID. |
| **RF14** | Permitir edição de rotas. |
| **RF15** | Permitir desativação temporária de rotas. |
| **RF16** | Permitir remoção de rotas. |
| **RF17** | Permitir cadastro de trens. |
| **RF18** | Permitir visualização dos trens cadastrados. |
| **RF19** | Permitir busca de trens por ID. |
| **RF20** | Permitir edição de trens. |
| **RF21** | Permitir desativação temporária de trens. |
| **RF22** | Permitir remoção de trens. |
| **RF23** | Permitir cadastro de sensores. |
| **RF24** | Permitir visualização dos sensores cadastrados. |
| **RF25** | Permitir busca de sensores por ID. |
| **RF26** | Permitir edição de sensores. |
| **RF27** | Permitir desativação temporária de sensores. |
| **RF28** | Permitir remoção de sensores. |
| **RF29** | Permitir acesso à tela de monitoramento. |
| **RF30** | Permitir informar o ID do trem a ser monitorado. |
| **RF31** | Permitir consultar o trem selecionado para monitoramento. |
| **RF32** | Apresentar gráficos e análises visuais do trem selecionado. |
| **RF33** | Permitir cadastro de relatórios. |
| **RF34** | Permitir listagem dos relatórios cadastrados. |
| **RF35** | Permitir visualização do conteúdo de um relatório. |
| **RF36** | Permitir busca de relatórios por ID. |
| **RF37** | Permitir edição de relatórios. |
| **RF38** | Permitir remoção de relatórios. |

---

## Requisitos não funcionais

| ID | Descrição |
|---|---|
| **RNF01** | O sistema deve responder às requisições em menos de 3 segundos. |
| **RNF02** | O sistema deve possuir estrutura capaz de trabalhar com grande volume de dados. |
| **RNF03** | O sistema deve permitir acesso simultâneo de múltiplos usuários. |
| **RNF04** | A interface deve ser responsiva para diferentes tamanhos de tela. |
| **RNF05** | O sistema deve considerar as diretrizes da LGPD para tratamento de dados pessoais. |
| **RNF06** | A aplicação deve utilizar comunicação segura quando disponibilizada em ambiente de produção. |
| **RNF07** | Os dados armazenados devem possuir mecanismos adequados de proteção. |
| **RNF08** | O sistema deve buscar disponibilidade e estabilidade durante sua utilização. |

---

## Responsabilidades da equipe

### Gabriel

- Desenvolvimento inicial do `index`;
- Desenvolvimento da tela de login;
- Ajustes no mockup;
- Estilização da página inicial;
- Ajustes em HTML e JavaScript;
- Pesquisa sobre XAMPP;
- Produção de documentação.

### Henrique

- Elaboração inicial do README;
- Organização das informações da equipe;
- Pesquisa sobre SCRUM;
- Desenvolvimento da tela de visualização de usuários;
- Desenvolvimento das telas de cadastro de usuários e rotas;
- Ajustes visuais do sistema.

### Lara

- Pesquisa sobre CRUD em PHP;
- Produção de documentação;
- Estilização da página inicial;
- Desenvolvimento das telas de cadastro de sensores e trens.

### Lucas

- Elaboração inicial do README;
- Desenvolvimento da tela Home;
- Ajustes no mockup da Home;
- Desenvolvimento da tela de visualização de sensores.

---

## Capturas de tela

### Login

```text
Adicione aqui a imagem da tela de login.
```

### Home

```text
Adicione aqui a imagem da Home.
```

### Usuários

```text
Adicione aqui a imagem da tela de usuários.
```

### Trens

```text
Adicione aqui a imagem da tela de trens.
```

### Rotas

```text
Adicione aqui a imagem da tela de rotas.
```

### Sensores

```text
Adicione aqui a imagem da tela de sensores.
```

### Monitoramento

```text
Adicione aqui a imagem da tela de monitoramento.
```

---

## Limitações conhecidas

O SA-Ferrorama foi desenvolvido como um projeto acadêmico e possui algumas limitações relacionadas ao ambiente de execução.

- O sistema é executado localmente utilizando XAMPP;
- A aplicação não foi dimensionada para ambientes reais de grande escala;
- Recursos de infraestrutura como alta disponibilidade 24/7 dependem do servidor utilizado;
- Recursos avançados de segurança podem exigir configuração adicional em ambiente de produção;
- O sistema representa uma simulação de uma operação ferroviária.

---

## Documentação adicional

Os documentos relacionados ao projeto estão disponíveis na pasta `doc/`.

- `doc/pesquisa_crud.md` — pesquisa sobre CRUD;
- `doc/pesquisa_scrum.md` — pesquisa sobre SCRUM;
- `doc/pesquisa_xampp.md` — pesquisa sobre XAMPP.

---

## Considerações finais

O desenvolvimento do **SA-Ferrorama** permitiu à equipe aplicar conhecimentos adquiridos durante o curso Técnico em Desenvolvimento de Sistemas.

O projeto reúne conceitos de:

- Programação web;
- PHP;
- MySQL;
- HTML;
- CSS;
- JavaScript;
- Bootstrap;
- APIs;
- CRUD;
- Segurança;
- Versionamento;
- Documentação;
- Trabalho colaborativo.

A aplicação representa uma simulação de um ambiente de gestão ferroviária, centralizando informações sobre **trens, rotas, sensores, usuários e relatórios** em um único sistema.

---

## Licença

Este projeto é distribuído sob a licença **MIT**.

Consulte o arquivo [`LICENSE`](LICENSE) para obter mais informações sobre os termos de utilização.