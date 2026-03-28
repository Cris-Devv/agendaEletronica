<h1 align="center">📅 Agenda Eletrônica</h1>

<p align="center">
  Uma agenda eletrônica para organizar a sua vida.
</p>

<p align="center">
  <img src="https://img.shields.io/badge/Feito%20Com-PHP%20-61dafb?style=flat&logo=php" />
  <img src="https://img.shields.io/badge/Status-Finalizado-green?style=flat" />
</p>

## 🧮 Sobre o Projeto

A **Agenda Eletrônica** é uma aplicação web que busca organizar seus afazeres, facilitando a gravação e gerenciamento de eventos ou atividades de forma simples, intuitiva e atraente.

## 🛠️ Tecnologias 

- PHP
- XAMPP
- MySQL
- FullCalendar JS
- Bootsrap
- CSS
- JavaScript

## 📖 Uso

<p>Para utilizar, basta baixar ou clonar o projeto e ligar o servidor Apache e o MySQL através do programa XAMPP, adicionando a pasta do projeto na pasta htdocs no local de instalação do XAMPP.</p>
<br>
<p>Para acessar, basta digitar [Localhost/agendaEletronica] e o projeto irá abrir.</p>
<p>Tenha certeza de ligar o MySQL na porta '3306', a porta padrão do MySQL.</p>

## 📁 Estrutura do projeto

```Código
agendaEletronica
├── index.php                 # Página inicial da aplicação
├── LICENSE                   # Licença do projeto
├── README.md                 # Documentação do projeto
├── app/                      # Diretório principal da aplicação
│   ├── metodos/              # Scripts PHP para operações específicas
│   │   ├── atvCriar.php      # Script para criar atividades
│   │   ├── atvDeletar.php    # Script para deletar atividades
│   │   ├── atvEditar.php     # Script para editar atividades
│   │   ├── atvListar.php     # Script para listar atividades
│   │   ├── auth.php          # Script para autenticação
│   │   ├── cadastro.php      # Script para cadastro de usuários
│   │   └── logout.php        # Script para logout
│   ├── pages/                # Páginas HTML/PHP da aplicação
│   │   ├── atividades/       # Páginas relacionadas a atividades
│   │   │   ├── atividadesCriar.php    # Página para criar atividades
│   │   │   └── atividadesEditar.php   # Página para editar atividades
│   │   └── dashboard/        # Páginas do painel de controle
│   │       └── dashboard.php # Página principal do dashboard
│   └── src/                  # Recursos estáticos
│       └── css/              # Arquivos de estilo CSS
│           ├── atvCriar.css  # Estilos para criação de atividades
│           ├── atvEditar.css # Estilos para edição de atividades
│           ├── dashboard.css # Estilos para o dashboard
│           └── index.css     # Estilos para a página inicial
├── config/                   # Configurações da aplicação
│   ├── conexao.php           # Configuração de conexão com banco de dados
│   └── setup.php             # Script de configuração inicial
└── database/                 # Scripts e esquemas do banco de dados
    ├── schema.sql            # Esquema do banco de dados
    └── tabelas.sql           # Definições das tabelas
```

## 📜 Licença

Este projeto está sob a licença MIT. Veja o arquivo [LICENSE] para mais detalhes.

---
