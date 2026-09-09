# Pesquisa sobre PDO

### Oque é PDO?

O PHP Data Objects é uma extensão do PHP que define uma interface leve e consistente para conectar e manipular bancos de dados em aplicações. 
Ele padroniza os comandos de acesso e busca de dados, mas exige drivers específicos para cada banco e não altera o código SQL escrito.

### Para que ele é utilizado no PHP?

O PDO é utilizado principalmente para três finalidades no PHP:

**1. Conexão unificada com múltiplos bancos de dados**

Permite conectar a aplicação a diferentes sistemas de banco de dados utilizando exatamente a mesma estrutura de código.

**2. Segurança contra SQL Injection**

É usado para executar prepared statements. Esse recurso separa os dados dos comandos SQL, impedindo de forma nativa que códigos maliciosos inseridos por usuários quebrem ou roubem dados do sistema.

**3. Padronização na manipulação de dados**

Fornece métodos padronizados para realizar as operações do CRUD. O processo de enviar dados para o banco e receber os resultados em formato de objetos ou arrays é sempre o mesmo, independentemente do banco escolhido.

### Como funciona uma conexão utilizando PDO?

As conexões são estabelecidas criando instâncias da classe base PDO. Independentemente do driver a ser utilizado, sempre se usa o nome da classe PDO. O construtor aceita parâmetros para especificar a fonte do banco de dados (conhecida como DSN) e opcionalmente para o nome de usuário e senha (se houver).

**Exemplo 01:** Conectando-se ao MySQL

    <?php
    $dbh = new PDO('mysql:host=localhost;dbname=test', $user, $pass);
    ?>

A linha de código realiza a abertura da conexão com o banco de dados através dos seguintes componentes:

- `$dbh` (Database Handle): Variável que armazena o objeto da conexão.
- `new PDO(...)`: Cria uma nova instância da classe base PDO, invocando o seu construtor para iniciar o processo de comunicação.
- O primeiro parâmetro (`'mysql:...'`): Define a string DSN (Data Source Name). Ela indica ao PHP que o driver do MySQL deve ser ativado, aponta a localização do servidor (`host=localhost`) e seleciona o banco de dados chamado test (`dbname=test`).
- `$user` e `$pass`: São as variáveis que contêm o nome de usuário e a senha necessários para a autenticação no servidor MySQL.

Se houver algum erro de conexão, um objeto PDOException será lançado. A exceção pode ser capturada para lidar com a condição de erro, ou pode-se optar por deixá-la para um manipulador de exceção global do aplicativo configurado via set_exception_handler().

**Exemplo 02:** Tratando erros de conexão

    <?php
    try {
        $dbh = new PDO('mysql:host=localhost;dbname=test', $user, $pass);
    } catch (PDOException $e) {
        // tentar reconectar após algum intervalo, por exemplo
    }

A estrutura utiliza um mecanismo de captura de falhas estruturado em dois blocos principais:

- Bloco `try`: Envolve o código que pode gerar uma falha crítica (neste caso, a tentativa de conexão com o banco de dados). O sistema tenta executar as linhas internas normalmente. Se a conexão for bem-sucedida, o bloco catch é completamente ignorado.
- Bloco `catch`: É acionado imediatamente e de forma automática caso ocorra uma falha dentro do bloco try.
- Classe `PDOException`: Representa o tipo específico de erro gerado pelo PDO. O sistema interrompe o fluxo normal e isola a falha dentro dessa classe.
- Variável `$e`: Funciona como um objeto que armazena os detalhes técnicos do erro ocorrido.

**Aviso sobre falhas não capturadas:**

- Risco de vazamento de dados: Caso a exceção não seja capturada por um bloco catch ou por um manipulador global (`set_exception_handler`), o PHP gerará um erro fatal (`E_FATAL_ERROR`). Esse erro exibe uma rastreabilidade (stack trace) que expõe detalhes sensíveis da conexão.
- Configuração recomendada: Para proteção em ambiente de produção, a diretiva `display_errors` no arquivo `php.ini` deve ser configurada como `0`.

Após a conexão ser estabelecida com sucesso, o ciclo de vida e o encerramento da comunicação seguem as seguintes regras:

- Tempo de vida:  A conexão permanece ativa na memória durante todo o tempo em que o objeto PDO existir.
- Fechamento automático: Caso o encerramento não seja feito manualmente, o PHP fechará a conexão de forma automática assim que a execução do script chegar ao fim.
- Fechamento explícito: Para encerrar a conexão antes do fim do script, é necessário destruir o objeto atribuindo o valor `null` à variável correspondente.
- Remoção de referências: Se houver outras variáveis ou objetos vinculados à mesma conexão (como instâncias de `PDOStatement`), estes também devem receber `null` para garantir que a liberação ocorra com sucesso.

**Exemplo 03:** Fechando uma conexão

    <?php
    $dbh = new PDO('mysql:host=localhost;dbname=test', $user, $pass);
    // use a conexão aqui
    $sth = $dbh->query('SELECT * FROM foo');

    // e agora terminamos; feche-a
    $sth = null;
    $dbh = null;
    ?>

A linha de código realiza o encerramento seguro através dos seguintes componentes:

-  `$sth = null`: Destrói o objeto gerado pela consulta SQL, removendo o vínculo com os resultados da tabela.
- `$dbh = null`: Elimina o objeto principal da conexão, liberando o slot de comunicação com o servidor de banco de dados.

Muitas aplicações se beneficiam do uso de conexões persistentes para otimizar o desempenho do sistema:

- Funcionamento: Conexões persistentes não fecham ao final do script; elas ficam salvas em cache e são reaproveitadas em requisições futuras com as mesmas credenciais.
- Vantagem técnica: Evita o desperdício de tempo e processamento gerado ao abrir e fechar conexões repetidas vezes, tornando a aplicação mais rápida.

**Exemplo 04:** Conexões persistentes

    <?php
    $dbh = new PDO('mysql:host=localhost;dbname=test', $user, $pass, array(
        PDO::ATTR_PERSISTENT => true
    ));
    ?>

A linha de código modifica o comportamento de persistência através dos seguintes componentes:

- O quarto parâmetro (array): Uma lista de opções de configuração enviada diretamente ao construtor do PDO.
- `PDO::ATTR_PERSISTENT => true`: Atributo que instrui o driver a manter o canal de comunicação ativo em cache após o término do script.

Regras e avisos importantes sobre o uso de persistência:

- Configuração obrigatória: O atributo `PDO::ATTR_PERSISTENT` deve ser passado exclusivamente no momento da criação do objeto. Tentar ativá-lo posteriormente via `PDO::setAttribute()` fará com que o driver ignore a persistência.
- Reutilização de estados: O PDO não limpa o histórico de conexões persistentes. Tabelas temporárias, bloqueios de registros ou transações inacabadas do uso anterior permanecem ativos, exigindo cuidado na programação.
- Pools de conexões: Caso o valor passado seja uma string não numérica em vez de um booleano, o sistema permite criar grupos separados de conexões para configurações diferentes.
- Restrição para drivers `ODBC:` Se for utilizado o driver PDO ODBC com suporte próprio a pools de conexões, recomenda-se desativar a persistência do PDO para que as conexões sejam gerenciadas corretamente pela camada do sistema operacional.

### Quais são suas principais características?

O PDO destaca-se por um conjunto de propriedades que modernizam o acesso a dados no ecossistema PHP:

**1. Interface orientada a objetos**

Substitui as antigas funções procedimentais por uma estrutura baseada em classes, métodos e propriedades, tornando o código mais limpo e legível.

**2. Suporte extensível a drivers**

Atua como uma casca genérica que aceita plug-ins (drivers) para se comunicar com cerca de 12 sistemas de bancos de dados diferentes, sem alterar a sintaxe dos métodos principais.

**3. Sistema de tratamento baseado em exceções**

Permite o uso de blocos try-catch para capturar falhas de banco de dados, integrando os erros diretamente ao fluxo de controle de exceções nativo do PHP.

### Diferenças entre PDO e MySQLi

Embora ambas as extensões sirvam para conectar o PHP a bancos de dados, elas possuem focos e recursos distintos:

| Recurso / Critério | PDO (PHP Data Objects) | MySQLi (MySQL Improved) |
| :--- | :--- | :--- |
| **Compatibilidade** | Suporta múltiplos bancos (MySQL, PostgreSQL, Oracle, etc.). | Suporta exclusivamente o MySQL. |
| **Paradigma** | Apenas Orientado a Objetos. | Orientado a Objetos e Procedimental. |
| **Prepared Statements** | Suporta consultas preparadas no lado do cliente e do servidor. | Suporta consultas preparadas apenas no lado do servidor. |
| **Performance** | Ligeiramente mais lento devido à camada extra de abstração. | Ligeiramente mais rápido ao trabalhar puramente com MySQL. |
| **Parâmetros Nomeados** | Permite vincular parâmetros por nome (`:id`, `:nome`). | Permite vincular parâmetros apenas por posição (`?`). |

### Vantagens e desvantagens de utilizar PDO

A escolha pelo PDO envolve ponderar os seguintes pontos positivos e limitações:

**Vantagens:**

- **Portabilidade do código:** Facilita a migração de um sistema de banco de dados para outro, exigindo pouca ou nenhuma alteração nas funções de chamada do PHP.
- **Parâmetros nomeados:** Torna a associação de dados em consultas grandes muito mais organizada e fácil de ler em comparação com o uso de interrogações.
- **Flexibilidade de resultados:** Permite mapear os dados retornados do banco diretamente para classes personalizadas do projeto automaticamente.

**Desvantagens:**

- **Curva de aprendizado inicial:** Exige conhecimento prévio em Programação Orientada a Objetos (POO) e manipulação de exceções.
- **Abstração incompleta:** Não reescreve comandos SQL. Caso a aplicação mude do MySQL para o Oracle, as consultas que utilizam funções exclusivas do MySQL ainda precisarão ser refeitas manualmente.

### O que são Prepared Statements e por que são importantes?

Prepared Statements (ou consultas preparadas) são recursos que dividem a execução de uma consulta SQL em duas etapas distintas: o envio do comando estruturado e, posteriormente, o envio dos dados.

- **Como funciona:** O PHP envia o modelo da consulta ao banco de dados com marcadores de posição (como `:usuario` ou `?`). O banco compila essa estrutura. Depois, o PHP envia apenas os dados isolados, que são encaixados nos marcadores sem chance de alterar a lógica do comando original.
- **Importância para a segurança:** Bloqueia ataques de SQL Injection. Como os dados enviados pelo usuário nunca são misturados diretamente na string de comando, o banco de dados trata qualquer tentativa de código malicioso puramente como texto comum, neutralizando a invasão.
- **Importância para a performance:** Se a mesma consulta precisar ser executada várias vezes com dados diferentes (como em um loop de inserção), o banco de dados compila a estrutura apenas uma vez e apenas substitui os parâmetros, tornando o processo muito mais rápido.

### Em quais situações o PDO pode ser uma boa escolha?

O uso do PDO torna-se a decisão ideal nos seguintes cenários de desenvolvimento:

**1. Projetos de médio a grande porte**

Sistemas que tendem a crescer e evoluir se beneficiam da estrutura limpa, segura e padronizada que o PDO impõe ao código.

**2. Aplicações que necessitam de portabilidade**

Sistemas comerciais ou produtos de software (SaaS) que precisam rodar em diferentes ambientes de clientes, operando ora em PostgreSQL, ora em MySQL ou SQL Server.

**3. Integração com frameworks e arquiteturas modernas**

Projetos que seguem padrões como MVC ou utilizam ORMs proprietários, onde a orientação a objetos e o mapeamento de entidades são obrigatórios.


## Referências

> [Link | PHP: PHP Data Objects - Manual - php.net](https://www.php.net/manual/pt_BR/book.pdo.php)

> [Link | Tudo sobre o PHP Data Object PDO – Hospedagem de Sites - locaweb.com.br](https://www.locaweb.com.br/ajuda/wiki/tudo-sobre-o-php-data-object-pdo-hospedagem-de-sites/)

> [Link | PHP: PHP Data Objects - Manual - php.net](https://www.php.net/manual/en/book.pdo.php)

> [Link | Prevenção SQL Injection no PHP com PDO - sentry.io](https://sentry.io/answers/how-can-i-prevent-sql-injection-in-php/)
