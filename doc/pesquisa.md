# Pesquisa sobre CRUD em PHP

### O que é CRUD?
CRUD vem do inglês e é um acrônimo para as operações fundamentais em qualquer sistema que interage com um banco de dados: **Create (Criar)**, **Read (Ler)**, **Update (Atualizar)** e **Delete (Apagar)**.

Essas quatro ações formam a base da maioria dos softwares de banco de dados, permitindo aos usuários criar registros novos, ler ou recuperar dados existentes, atualizar informações previamente armazenadas e, finalmente, excluir registros quando necessário.

Historicamente, o conceito de CRUD surgiu com os primeiros sistemas de gerenciamento de banco de dados. À medida que esses sistemas evoluíam, a necessidade de operações padrão para interagir com dados tornou-se tornou evidente. O CRUD, portanto, representa essas operações essenciais, servindo como um framework básico para a interação de dados em inúmeras aplicações.

### Create (Criar)
Esta etapa envolve a criação de novos dados em um sistema. Por exemplo, quando um usuário se registra em um site, um novo registro é criado em um banco de dados. Essa função é fundamental para iniciar qualquer interação em sistemas que dependem de dados, seja em um site de e-commerce ao adicionar um novo produto ou em um sistema de gerenciamento de usuários ao criar um novo perfil.

### Read (Ler)
A função “Read” é o que permite aos sistemas acessar e exibir dados. Ela é usada cada vez que solicitamos informações, como ao verificar o saldo em uma conta bancária online. Essencialmente, essa função garante que os dados armazenados possam ser recuperados e visualizados quando necessário.

### Update (Atualizar)
“Update” refere-se à atualização de dados existentes. Esta função é crucial para manter a relevância e a precisão das informações em um banco de dados. Um exemplo clássico seria a atualização de um perfil de usuário em uma rede social, onde as informações pessoais são alteradas.

### Delete (Apagar)
Esta função é usada para remover dados de um sistema. Ela deve ser manuseada com cuidado, pois uma vez que os dados são apagados, pode não ser possível recuperá-los. Um exemplo seria a exclusão de uma conta de usuário, que remove permanentemente os dados do usuário do sistema.

### CRUD em PHP
- Create: Em aplicativos de banco de dados relacional SQL, a função Criar é chamada de INSERT. Os usuários podem criar novas linhas e preenchê-las com dados correspondentes a cada atributo, mas somente os administradores podem adicionar novos atributos à própria tabela.

**Exemplo prático (Inserir registro):** 

    <?php
    include 'connection.php';

    $nome = "João Silva";
    $email = "joao@email.com";

    try {
        $sql = "INSERT INTO funcionarios (nome, email) VALUES (:nome, :email)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['nome' => $nome, 'email' => $email]);

        echo "Funcionário adicionado! ID: " . $pdo->lastInsertId();
    } catch (PDOException $e) {
        echo "Erro: " . $e->getMessage();
    }
    ?>

- Read: Os usuários podem usar palavras-chave ou filtrar dados com base em critérios personalizados para localizar as informações desejadas. Por exemplo, um banco de dados de carros pode permitir que os usuários digitem "Toyota Corolla 2022" ou pode oferecer a opção de filtrar os resultados da pesquisa por marca, modelo e ano.

**Exemplo prático (Consultar registros):** 

    <?php
    include 'connection.php';

    try {
        $sql = "SELECT id, nome, email FROM funcionarios";
        $stmt = $pdo->query($sql);

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "ID: " . $row['id'] . " - Nome: " . $row['nome'] . " - Email: " . $row['email'] . "<br>";
        }
    } catch (PDOException $e) {
        echo "Erro: " . $e->getMessage();
    }
    ?>

- Update: Para alterar completamente o registro, o usuário pode ter que modificar as informações em vários campos. Por exemplo, um restaurante que armazena receitas de itens de menu em um banco de dados pode ter uma tabela com os atributos "prato", "tempo de cozimento", "custo" e "preço". Um dia o chef decide substituir um ingrediente do prato por algo diferente. Portanto, os registros existentes no banco de dados devem ser alterados e todos os valores dos atributos alterados para refletir as características do novo prato. No SQL Cloud a função de atualização é simplesmente chamada de "Update".

**Exemplo prático (Atualizar registro):** 

    <?php
    include 'connection.php';

    $id = 1;
    $novoEmail = "novo_email@email.com";

    try {
        $sql = "UPDATE funcionarios SET email = :email WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['email' => $novoEmail, 'id' => $id]);

        echo "Registros atualizados: " . $stmt->rowCount();
    } catch (PDOException $e) {
        echo "Erro: " . $e->getMessage();
    }
    ?>

- Delete: O SQL têm recursos de exclusão que permitem que os usuários excluam um ou mais registros do banco de dados. Alguns aplicativos de banco de dados relacional podem permitir que os usuários executem exclusões temporárias ou definitivas. Uma exclusão definitiva exclui permanentemente um registro do banco de dados, enquanto uma exclusão reversível pode simplesmente atualizar o estado da linha para indicar que ela foi excluída, deixando os dados como estão.

**Exemplo prático (Excluir registro):** 

    <?php
    include 'connection.php';

    $id = 1;

    try {
        $sql = "DELETE FROM funcionarios WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['id' => $id]);

        echo "Registros excluídos: " . $stmt->rowCount();
    } catch (PDOException $e) {
        echo "Erro: " . $e->getMessage();
    }
    ?>

## Referências
> [Link | Crud: o que é e como funciona na programação - QueroBolsa](https://querobolsa.com.br/revista/crud-o-que-e)

> [Link | CRUD com PHP PDO - DevMedia](https://www.devmedia.com.br/crud-com-php-pdo/28873)

> [Link | O que é CRUD? Exemplos em PHP e MySQL - Programadores Deprê](https://programadoresdepre.com.br/o-que-e-crud/)