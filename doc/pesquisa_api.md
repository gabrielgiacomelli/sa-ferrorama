# Pesquisa sobre APIs

### O que é uma API e qual é sua finalidade?

A API (Interface de Programação de Aplicações) são regras, protocolos ou padrões seguidos que permitem uma interação segura e eficiente entre softwares.

### Como funciona a comunicação entre sistemas por meio de APIs?

A comunicação realizada entre os sistemas por meio de APIs segue o padrão de requisição e resposta. A requisição será uma solicitação iniciada no navegador a fim de receber uma ação do servidor, como **GET** ou **POST**. No momento que o servidor recebe uma requisição, ele irá processá-la e retornar os dados ao cliente em formato de resposta.

### O que são APIs REST?

O API REST é um dos padrões seguidos dentro de uma API que segue o princípio REST (Representational State Transfer), utilizado em sistemas web a fim de priorizar a escalabilidade e eficiência. Para estruturar corretamente uma API REST em seu sistema web, é necessário seguir os seus seis princípios fundamentais:

- Interface uniforme;
- Separação cliente-servidor;
- Stateless (Sem estado definido);
- Capacidade de armazenamento em cache;
- Arquitetura de sistema em camadas;
- Código sob demanda.


### O papel dos métodos HTTP, como GET, POST, PUT, PATCH e DELETE

Os métodos HTTP estão diretamente relacionados com as APIs no quesito de comunicação entre os sistemas. Eles são as ações realizadas no navegador após as solicitações iniciadas no navegador, também chamada de requisição. Dentre os exemplos é possível citar **GET**, **POST**, **PUT**, **PATCH** e **DELETE**:

- GET: Método utilizado para solicitar uma ou várias informações de dentro do servidor.

- POST: Envia as informações para o servidor, em grande parte dos casos sendo utilizado em formulários de cadastro ou que exijam informações.

- PUT: Utilizado para editar informações que já foram inseridas dentro do servidor, sendo necessário referenciar a chave única do elemento para editá-lo.
PATCH: Semelhante ao PUT, entretanto, enquanto o PUT realiza substituições completas, o PATCH é utilizado para modificar elementos específicos, alterando apenas uma parte das informações.

- DELETE: Utilizado para apagar informações dentro do banco de dados.

### O que são requisições e respostas HTTP?

As requisições e respostas representam a comunicação entre o navegador web e o servidor. Para a requisição, o navegador estará solicitando uma ação ao servidor, e como resposta, o servidor irá executá-la e enviar a informação resposta.

### O que são endpoints?

O endpoint será o local que receberá chamadas de API. Os endpoints em grande parte dos casos estão no formato de URL, representando o endereço que receberá a requisição.

### Como funciona a troca de dados no formato JSON?

O formato JSON organiza a troca de dados em formato de pares de chave-valor, utilizando chaves e colchetes para separar objetos e formar listas de informações.

### Diferenças entre uma API e um sistema web tradicional

A API funciona nos bastidores transmitindo dados brutos entre softwares, sem nenhuma interface visual. Já o sistema web tradicional entrega uma interface gráfica completa diretamente no navegador para o usuário humano interagir.

### Como uma aplicação PHP pode consumir uma API?

Uma aplicação PHP consome uma API utilizando a biblioteca cURL ou funções como file_get_contents() para enviar requisições HTTP a um servidor. O PHP dispara o pedido, recebe a resposta com os dados brutos (geralmente JSON) e usa json_decode() para transformá-los em arrays utilizáveis. Na prática, o código age como um cliente que solicita informações externas para exibi-las em sua própria página.

### Como uma API pode disponibilizar informações para outros sistemas?

Uma API disponibiliza informações criando endpoints (rotas de URL) que aceitam requisições HTTP (como GET ou POST) enviadas por outros sistemas. Quando uma requisição autorizada chega, o servidor processa o pedido, busca os dados no banco e os devolve formatados em JSON ou XML. Esse fluxo padronizado permite que qualquer software externo acesse os recursos de forma segura e imediata.

### Importância da autenticação, autorização e segurança no consumo de APIs

A autenticação confirma a identidade de quem acessa a API, enquanto a autorização define quais recursos e ações aquele usuário ou sistema específico pode acessar. A segurança, aplicada por criptografia (HTTPS) e limites de requisições (rate limiting), impede interceptações de dados, vazamentos e ataques cibernéticos maliciosos. Sem essa tríade, dados confidenciais ficam expostos publicamente, gerando brechas legais e prejuízos financeiros graves para os sistemas conectados.

### Exemplos de utilização de APIs em sistemas empresariais

1. GitHub

O GitHub disponibiliza uma API REST que permite que outros sistemas consultem informações de repositórios, usuários, issues e outros recursos. Por exemplo, um sistema empresarial poderia consultar automaticamente os dados de um repositório para acompanhar projetos de desenvolvimento.

Uma requisição poderia utilizar:
GET /repos/empresa/projeto/issues

A API processaria a solicitação e retornaria os dados, normalmente em JSON. A documentação oficial do GitHub apresenta os métodos HTTP, endpoints, parâmetros, autenticação e exemplos de requisições e respostas.

2. Sistema de pagamentos

Empresas podem utilizar APIs de serviços de pagamento para integrar pagamentos diretamente aos seus sistemas. Por exemplo, um sistema de vendas pode enviar uma solicitação para uma API de pagamentos quando um cliente realiza uma compra. A API recebe as informações, processa a operação e devolve uma resposta indicando se o pagamento foi aprovado ou recusado.

Esse tipo de integração permite que o sistema da empresa utilize um serviço externo sem precisar desenvolver toda a infraestrutura de pagamentos internamente.

Um exemplo simplificado seria:
POST /api/pagamentos

{
  "valor": 150.00,
  "pedido": 12345,
  "metodo": "cartao"
}

A API poderia retornar:
{
  "pedido": 12345,
  "status": "aprovado"
}

### Exemplos de utilização de APIs na nossa SA

Na Entrega 10, o Ferrorama integra duas APIs externas, consultadas em tempo real.

#### 1. API de clima: Open-Meteo (Home)

- **Finalidade:** Mostrar na tela inicial o clima do local de operação: temperatura, condição climática, localização e horário da consulta.
- **Por que foi escolhida:** Gratuita para uso não comercial, sem cadastro e sem chave de API, com resposta simples em JSON.
- **Como os dados são obtidos:** Requisição GET (JavaScript `fetch`) para `https://api.open-meteo.com/v1/forecast?latitude=...&longitude=...&current=temperature_2m,weather_code&timezone=auto`.
- **Como são apresentados:**
  - Temperatura em °C (`temperature_2m`);
  - Condição traduzida a partir do `weather_code` (ex.: 0 = céu limpo, 3 = nublado, 61 = chuva);
  - Local consultado: `[Joinville]`;
  - Data e horário: "Atualizado em dd/mm/aaaa hh:mm".
- **Tratamento de erros:** Se a API falhar, a Home continua carregando e o bloco mostra "Clima indisponível no momento."
- **Licença:** Dados sob CC BY 4.0, por isso o bloco exibe "Weather data by Open-Meteo.com".
- **Documentação oficial:** https://open-meteo.com/en/docs

#### 2. API de CEP: ViaCEP (cadastros)

- **Finalidade:** Consultar o CEP digitado e preencher automaticamente CEP, logradouro, bairro, cidade e UF.
- **Por que foi escolhida:** Gratuita, sem chave, endereço de consulta simples e retorna exatamente os campos necessários.
- **Como os dados são obtidos:** Requisição GET para `https://viacep.com.br/ws/{CEP}/json/`, com o CEP de 8 dígitos, quando o usuário sai do campo CEP.
- **Campos preenchidos:** `logradouro`, `bairro`, `localidade` (cidade) e `uf`.
- **Tratamento de erros:**
  - *CEP inválido:* Se não tiver 8 dígitos, o sistema avisa o usuário e nem consulta a API;
  - *CEP inexistente:* A API devolve o campo `erro`, e o sistema mostra "CEP não encontrado.";
  - *falha de comunicação:* o `fetch` está em `try/catch`, o sistema mostra "Não foi possível consultar o CEP agora." e o preenchimento manual continua liberado.
- **Documentação oficial:** https://viacep.com.br


## Referências

https://www.alura.com.br/artigos/api?utm_term=&utm_campaign=&utm_source=google&utm_medium=cpc&campaign_id=23805973578__&utm_id=23805973578__&hsa_acc=7964138385&hsa_cam=&hsa_grp=&hsa_ad=&hsa_src=x&hsa_tgt=&hsa_kw=&hsa_mt=&hsa_net=google&hsa_ver=3&gad_source=1&gad_campaignid=23815806613&gbraid=0AAAAADpqZIBl1_auUC126pAQ6BmZco7SL&gclid=CjwKCAjw_9bWBhBGEiwAomyTIixwf2ZcxkUN3UpNIcl3iQwRlsRbo0jkecyhv9ygvgXbmzs1jfWsRRoCql0QAvD_BwE

https://www.ibm.com/think/topics/rest-apis

https://medium.com/@renejr03/m%C3%A9todos-http-quais-s%C3%A3o-e-qual-a-funcionalidade-deles-491b1cc5d5b4

https://tecnoblog.net/responde/o-que-e-json-conheca-o-formato-padrao-para-a-troca-de-dados-na-web/

https://blog.idwall.co/qual-a-diferenca-entre-api-e-web-service/ 
https://imasters.com.br/apis-microsservicos/como-consumir-apis-em-aplicacoes-php-de-forma-simples 

https://www.ibm.com/br-pt/think/topics/api-integration 
https://www.ibm.com/br-pt/think/topics/api-authentication 
https://docs.github.com/en/rest  
 
https://open-meteo.com/en/docs
https://viacep.com.br
