# Clínica — Cadastro de pacientes

Aplicação web acadêmica para gerenciamento de pacientes, desenvolvida como um **CRUD básico** com PHP e MySQL. O projeto utiliza o banco de dados `clinica.sql`, fornecido pelo professor da cadeira de Desenvolvimento Web, com dados fictícios para demonstração e aprendizado.

## Sobre o projeto

A aplicação permite cadastrar, consultar, editar e excluir pacientes. Os registros são apresentados em uma tabela, e os formulários de cadastro e edição são exibidos em janelas de diálogo (modal).

O script SQL também possui a tabela de consultas e inclui consultas fictícias relacionadas aos pacientes. Nesta versão, porém, a interface realiza operações CRUD apenas sobre pacientes.

## Funcionalidades

- **Create:** cadastro de pacientes com CPF, nome e data de nascimento; telefone e e-mail são opcionais.
- **Read:** listagem dos pacientes, incluindo identificador e data de criação.
- **Update:** edição dos dados de um paciente.
- **Delete:** exclusão de pacientes com confirmação.
- Persistência dos dados em MySQL por meio de PDO e consultas preparadas.

## Tecnologias

- PHP
- MySQL
- PDO
- HTML5
- XAMPP para o ambiente local de desenvolvimento

## Habilidades desenvolvidas

O desenvolvimento deste projeto permitiu praticar conceitos importantes de desenvolvimento web, da interface à persistência dos dados:

- **Desenvolvimento backend com PHP:** processamento de formulários enviados por `POST`, identificação das ações solicitadas e organização das operações de cadastro, edição e exclusão.
- **Operações CRUD:** implementação do ciclo completo de gerenciamento de pacientes e atualização da listagem após as alterações.
- **Integração com banco de dados:** conexão com MySQL usando PDO, execução de consultas e tratamento de resultados para exibição na página.
- **SQL e modelagem relacional:** criação de tabelas, definição de chave primária, restrição de unicidade para o CPF e relacionamento entre pacientes e consultas por chave estrangeira.
- **Acesso parametrizado aos dados:** uso de consultas preparadas e parâmetros para inserir, atualizar e excluir registros.
- **Formulários e interação com o usuário:** criação de formulários HTML, campos obrigatórios, validação básica de e-mail pelo navegador, caixas de diálogo para cadastro e edição e confirmação antes da exclusão.
- **Exibição segura de conteúdo:** escape dos valores apresentados no HTML com `htmlspecialchars`.
- **Configuração de ambiente local:** importação de um banco SQL e execução da aplicação com Apache, PHP e MySQL pelo XAMPP.

Além da implementação, o projeto exercita a leitura de um esquema existente e a documentação de uma aplicação para que outra pessoa consiga configurá-la e executá-la localmente.

## Como executar localmente

1. Instale e abra o [XAMPP](https://www.apachefriends.org/) e inicie os serviços **Apache** e **MySQL**.
2. Coloque a pasta do projeto no diretório `htdocs` do XAMPP. Por exemplo:

   ```text
   C:\xampp\htdocs\clinica
   ```

3. Acesse o phpMyAdmin em `http://localhost/phpmyadmin`.
4. Importe o arquivo `clinica.sql`. O script cria o banco `clinica`, suas tabelas e registros fictícios de exemplo.
5. Confira as credenciais em `conexao.php`. A configuração inicial usa `localhost`, banco `clinica`, usuário `root` e senha vazia — padrão comum em instalações locais do XAMPP. Ajuste os valores se o seu ambiente for diferente.
6. Abra a aplicação no navegador:

   ```text
   http://localhost/clinica/
   ```

## Estrutura do projeto

```text
clinica/
├── clinica.sql    # Criação e carga inicial do banco de dados
├── conexao.php    # Conexão PDO com o MySQL
├── index.php      # Interface e operações CRUD de pacientes
└── README.md      # Documentação do projeto
```

## Banco de dados

O banco `clinica` contém:

- `pacientes`: dados cadastrais e data de criação.
- `consultas`: consultas associadas a pacientes, com data, especialidade e observações.

O script inclui registros fictícios para facilitar a execução e a apresentação do projeto. **Não utilize esses dados como informações reais de pacientes.**

## Contexto acadêmico

Projeto desenvolvido para praticar integração entre PHP e MySQL, operações CRUD, formulários HTML e acesso a dados com PDO no contexto da disciplina de Desenvolvimento Web.
