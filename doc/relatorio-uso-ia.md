# Relatório de Utilização de Inteligência Artificial

**Data:** 26/10/2026
**Projeto:** SA Ferrorama (CRUD para ferrovia) – Entrega 10
**Repositório:** https://github.com/gabrielgiacomelli/sa-ferrorama

## 1. Ferramentas utilizadas

- **Claude (Anthropic)**, em chat no claude.ai, com uso de pesquisa na web.

## 2. Objetivos da utilização

- Identificar quais APIs públicas poderiam ser usadas no projeto de CRUD da ferrovia.
- Entender como integrar as duas APIs exigidas na Entrega 10: clima (Open-Meteo) e CEP (ViaCEP).
- Produzir a documentação das APIs em Markdown, de forma breve e objetiva, conforme os critérios da atividade 10.

## 3. Prompts utilizados

1. "Gostaria que você sugerisse algumas API's que poderia ser utilizada nesse projeto de CRUD que estamos fazendo para uma ferrovia" (com o link do repositório).
2. "Consegue fazer um arquivo .md em forma de documentação para mim?"
3. "Pode aplicar nesse .md que eu tenho já e sem tantas informações, quero que seja breve e objetivo conforme os critérios da atividade 10 que te enviei."
4. "Faça um relatório de utilização da IA que foi feita nesse chat" e, em seguida, o pedido para preencher este modelo com as 11 seções.

## 4. Funcionalidades desenvolvidas com auxílio da IA

- **Escolha das APIs:** Open-Meteo (clima, na Home) e ViaCEP (CEP, nas telas de cadastro de usuário e funcionário).
- **Orientação para o bloco de clima:** consulta por latitude e longitude, temperatura atual, condições a partir do `weather_code` (com tabela de tradução para texto e ícone), localização, data e horário, e atribuição exigida pela Open-Meteo.
- **Orientação para a consulta de CEP:** validação de 8 dígitos antes da chamada, preenchimento de CEP, logradouro, bairro, cidade e UF, e tratamento de CEP inexistente (campo `erro`) e de falha de comunicação (`try/catch` com timeout).
- **Documentação:** arquivo `apis.md` e versão resumida do `pesquisa-apis.md`, com justificativa das APIs, endpoints, exemplos de resposta, tratamento de erros e links oficiais.
- **Relatório de uso da IA** (este documento).

## 5. Alterações realizadas pela equipe

- Adaptação do conteúdo gerado ao `.md` de pesquisa que o grupo já tinha, a pedido da equipe, para deixá-lo breve e objetivo conforme os critérios da atividade 10.
- Preenchimento dos campos marcados com `[PREENCHER]` nos documentos (localização do clima, IDs dos campos, telas e prints)

## 6. Testes realizados

- Os testes das integrações ainda precisam ser registrados pela equipe. Sugestão de casos:
  - CEP válido (preenche os campos);
  - CEP com formato inválido (aviso ao usuário);
  - CEP com formato válido e inexistente, como `99999999` (mensagem de CEP não encontrado);
  - falha de comunicação com o ViaCEP (mensagem de serviço indisponível e preenchimento manual liberado);
  - bloco de clima com internet e sem internet.

## 7. Problemas encontrados

- Nenhum problema técnico foi relatado nesta conversa. [PREENCHER se a equipe encontrou algum durante a implementação]
- Ponto de atenção levantado pela própria IA: o enunciado cita a pasta `docs/` para o relatório de IA, enquanto o repositório já usa `doc/`. É preciso confirmar com o professor qual pasta ele espera.

## 8. Correções realizadas

- Ajuste do foco da entrega após a leitura do enunciado: Open-Meteo e ViaCEP passaram a ser o núcleo, e as demais opções (Leaflet/OpenRailwayMap, PHPMailer, API REST de sensores) ficaram como extras opcionais.
- Redução do tamanho e do detalhamento da documentação, a pedido da equipe.

## 9. Contribuições da IA

- Pesquisa e comparação de APIs adequadas ao enunciado.
- Explicação do funcionamento de cada API (endpoints, parâmetros, formato da resposta, limites de uso e atribuição).
- Orientação sobre tratamento de erros e validação de dados.
- Redação e organização dos documentos em Markdown.
- Exemplos de código de referência em JavaScript.
- Lembrete sobre o registro da coautoria da IA nos commits (linha `Co-authored-by:`), conforme o enunciado.

## 10. Limitações da IA

- Os exemplos de código são de referência e precisam ser ajustados aos nomes e IDs reais do projeto.
- Os valores dos JSON de exemplo são ilustrativos, não respostas reais das APIs.
- A IA não executou nem testou o código no sistema da equipe; a validação é responsabilidade do grupo.
- Informações sobre limites de uso e regras de atribuição devem ser conferidas na documentação oficial de cada API.
- A IA não sabe o que o grupo mudou, testou ou decidiu fora do chat, por isso alguns campos ficam para a equipe preencher.

## 11. Conclusão

Em 26/10/2026, a IA foi usada como apoio à pesquisa. As decisões do projeto, a implementação no código e a validação dos resultados foram de responsabilidade da equipe.