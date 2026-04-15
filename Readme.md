# Sistema Copa

Sistema web desenvolvido em **PHP + MySQL** com arquitetura **MVC**, voltado para o cadastro e gerenciamento de seleções da Copa do Mundo e seus jogadores.

## Funcionalidades

- Cadastro de seleções.
- Listagem de seleções cadastradas.
- Edição e exclusão de seleções.
- Filtro por grupo.
- Paginação da listagem.
- Exibição automática da bandeira da seleção.
- Visualização do elenco de cada seleção.
- Cadastro, edição e exclusão de jogadores.
- Dashboard com indicadores gerais do sistema.

## Tecnologias utilizadas

- PHP
- MySQL
- PDO
- HTML5
- CSS3
- CRUD
- Arquitetura MVC

## Estrutura do projeto

```bash
sistema_copa/
├── config/
│   └── Database.php
│   └── helpers.php
├── Controller/
│   ├── SelecaoController.php
│   └── JogadorController.php
├── Model/
│   ├── Selecao.php
│   └── Jogador.php
├── Views/
│   ├── lista.php
│   ├── create.php
│   ├── edit.php
│   ├── elenco.php
│   ├── jogador-criar.php
│   ├── jogador-edit.php
│   └── dashboard.php
├── assets/
├── copa_db.sql
├── index.php
├── Readme.md
└── Roadmap.md
```

## Objetivo do projeto

Este projeto foi desenvolvido com o objetivo de praticar conceitos de desenvolvimento web com PHP, banco de dados MySQL e organização em arquitetura MVC. A proposta é simular um sistema de gerenciamento de seleções e jogadores de forma estruturada, funcional e visualmente organizada.

## Como executar o projeto

1. Clone ou baixe este repositório.
2. Coloque a pasta do projeto dentro do servidor local, como `htdocs` no XAMPP.
3. Crie o banco de dados no MySQL.
4. Importe o script SQL com as tabelas do projeto.
5. Configure as credenciais do banco em `config/Database.php`.
6. Inicie o Apache e o MySQL.
7. Acesse no navegador:

```txt
http://localhost/copa_db/
```

## Configuração do banco

No arquivo `config/Database.php`, configure:

```php
private $host = "localhost";
private $db_name = "copa_db";
private $user = "root";
private $password = "";
```

## Rotas principais

| Rota | Descrição |
|------|-----------|
| `index.php` | Lista as seleções |
| `index.php?action=novo` | Abre o formulário de nova seleção |
| `index.php?action=editar&id=1` | Edita uma seleção |
| `index.php?action=deletar&id=1` | Exclui uma seleção |
| `index.php?action=elenco&selecao_id=1` | Exibe o elenco da seleção |
| `index.php?action=novo-jogador&selecao_id=1` | Abre o formulário de jogador |
| `index.php?action=atualizar-jogador` | Edita o formulário de jogador |
| `index.php?action=dashboard` | Mostra o dashboard |

## Organização MVC

### Model
Responsável pela comunicação com o banco de dados, consultas SQL e regras de persistência.

### Controller
Responsável por receber as requisições, processar a lógica da aplicação e enviar os dados para as views.

### View
Responsável pela interface visual do sistema, exibindo formulários, tabelas e informações para o usuário.

## Recursos implementados

- CRUD completo de seleções.
- CRUD de jogadores.
- Relacionamento entre seleção e elenco.
- Exibição de bandeiras automaticamente.
- Tela de elenco por seleção.
- Layout personalizado com HTML e CSS.
- Dashboard com informações resumidas.

## Aprendizados

Durante o desenvolvimento deste projeto, foram praticados conceitos como:

- Estrutura MVC.
- Conexão com banco usando PDO.
- Rotas com `GET` e `POST`.
- Manipulação de formulários.
- Relacionamento entre tabelas.
- Organização de arquivos em projetos PHP.
- Estilização com CSS.

## Autor

**Rayane Fonseca**  
Projeto desenvolvido para prática acadêmica e aprimoramento em desenvolvimento web com PHP e MySQL.
