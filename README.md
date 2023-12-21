# API REST MVC em PHP 7.4.33 - Contatos

Esta é uma API REST simples desenvolvida em PHP nativo (versão 7.4.33) utilizando o banco de dados MySQL. A API gerencia um banco de dados simples com uma tabela de contatos. O desenvolvedor responsável por esta API é **Patrik Pereira dos Santos**, estudante da Fatec Carapicuíba.

## Configuração do Ambiente

Para utilizar esta API, siga os passos abaixo:

1. Instale o XAMPP 7.4.33 disponível [neste link](https://sourceforge.net/projects/xampp/files/XAMPP%20Windows/7.4.33/).
2. Coloque o arquivo da API na pasta `htdocs` do XAMPP.
3. Execute o script de criação do banco de dados no MySQL.
4. Modifique as configurações de host, usuário e senha no arquivo `bootstrap.php` para conectar a API ao seu banco de dados.
5. Se o seu servidor estiver em uma porta diferente, ajuste a base da URI `http://localhost` conforme necessário.

## Estrutura da Tabela

A tabela de contatos possui os seguintes campos:

- `id` (int)
- `nome` (string)
- `profissao` (string)
- `nascimento` (string)
- `email` (string)
- `telefone` (string)
- `celular` (string)
- `celular_whatsapp` (boolean)
- `recebe_email` (boolean)
- `recebe_sms` (boolean)

## Operações CRUD

### Listar Contatos (DTO Simplificado)

- **URI:** `GET http://localhost/api_alphacode/contatos/listar`

### Mostrar Dados de um Contato

- **URI:** `GET http://localhost/api_alphacode/contatos/mostrar/{id}`

### Cadastrar Novo Contato

- **URI:** `POST http://localhost/api_alphacode/contatos/cadastrar`

### Editar Contato Existente

- **URI:** `PUT http://localhost/api_alphacode/contatos/editar/{id}`

### Excluir Contato Existente

- **URI:** `DELETE http://localhost/api_alphacode/contatos/excluir/{id}`

## Testando a API

Utilize o Postman, Insomnia ou as aplicações [frontend css puro](https://github.com/kaitbunny/teste-frontend-patrik) e [frontend bootstrap](https://github.com/kaitbunny/teste-frontend-bootstrap-patrik) disponíveis em outros repositórios. Certifique-se de ajustar as URIs de consumo se necessário.

## Contato do Desenvolvedor

- **Desenvolvedor:** Patrik Pereira dos Santos
  - **LinkedIn:** [patrik santos](https://www.linkedin.com/in/patriksantos1/)
- **Instituição:** Fatec Carapicuíba
