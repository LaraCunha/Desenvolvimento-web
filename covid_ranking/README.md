# Ranking COVID-19

Aplicação web que consulta dados públicos sobre a COVID-19 e permite visualizar rankings de países por cobertura vacinal e por percentual de mortes em relação à população.

## Funcionalidades

- Consulta dados de países e mortes pela API pública [disease.sh](https://disease.sh/).
- Consulta dados de cobertura vacinal por país.
- Combina os dados das duas consultas para considerar países presentes em ambas as fontes.
- Calcula o percentual de mortes em relação à população de cada país.
- Calcula o percentual de cobertura vacinal em relação à população, com base nos dados fornecidos pela API.
- Exibe os países em ordem decrescente nos rankings de vacinação e de mortes.
- Permite alternar entre os rankings pelos botões da página.

## Tecnologias e habilidades

- **HTML5:** estruturação da página e dos controles da aplicação.
- **CSS3:** estilização dos elementos e organização visual básica.
- **JavaScript:** manipulação do DOM, tratamento de arrays e criação dos rankings.
- **Fetch API e Promises:** consumo de APIs e coordenação de consultas assíncronas com `Promise.all`.
- **Métodos de array:** uso de `map`, `filter`, `find`, `forEach` e `sort` para transformar, combinar e ordenar os dados.
- **Cálculos com dados:** comparação de indicadores em relação à população de cada país.

## Como executar

1. Clone ou baixe este repositório.
2. Abra o arquivo `index.html` em um navegador.
3. Use os botões para consultar o ranking de vacinação ou o ranking de mortes.

É necessária uma conexão com a internet para carregar os dados das APIs.

## Fonte dos dados

Os dados são obtidos dos endpoints públicos do [disease.sh](https://disease.sh/), incluindo informações de países e dados de cobertura vacinal. Os resultados dependem da disponibilidade e da atualização dessas fontes.

## Contexto acadêmico

Este projeto foi desenvolvido como atividade para uma cadeira de Desenvolvimento Web.
