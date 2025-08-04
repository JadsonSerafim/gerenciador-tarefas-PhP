# Gerenciador-tarefas-PhP
Um gerenciador de tarefas com uma APIRESTFUL escrita em PhP e com pagina assíncrona feita com Ajax/Jquery, aplicação feita como forma de estudo para exercicio dos conhecimentos adquiridos



# 🚀 Gerenciador de Tarefas | PHP e API RESTful


> Um sistema completo de gerenciamento de tarefas com autenticação de usuários. Construído com um backend PHP que serve uma API RESTful e um frontend dinâmico com jQuery/AJAX para uma experiência de usuário totalmente assíncrona.

---

### 📖 Índice

* [Visão Geral](#-visão-geral)
* [Funcionalidades](#-funcionalidades)
* [Tecnologias Utilizadas](#-tecnologias-utilizadas)
* [Como Instalar e Executar](#-como-instalar-e-executar)
* [Estrutura dos Arquivos](#-estrutura-dos-arquivos)
* [Endpoints da API](#-endpoints-da-api)

---

### 👁️ Visão Geral

Este projeto é uma aplicação web completa para gerenciamento de tarefas. Ele permite que usuários se cadastrem, façam login e gerenciem suas próprias listas de tarefas. O backend, desenvolvido em PHP, utiliza o `bramus/router` para criar uma API RESTful robusta. Toda a interação do usuário no frontend é feita de forma assíncrona com AJAX e jQuery, o que significa que as tarefas podem ser criadas, visualizadas, concluídas e deletadas sem nenhum recarregamento de página.

---

### ✨ Funcionalidades

* **Autenticação de Usuário:**
    * ✅ Sistema de Registro de novos usuários.
    * ✅ Login seguro com verificação de senha.
    * ✅ Sessão de usuário para visualização de tarefas individuais.
    * ✅ Funcionalidade de Logout.
* **Gerenciamento de Tarefas:**
    * ✅ Criação de novas tarefas com título, descrição e data de conclusão.
    * ✅ Listagem de tarefas pendentes e concluídas separadamente.
    * ✅ Marcar tarefas como concluídas.
    * ✅ Exclusão de tarefas.
* **Interface:**
    * ✅ Interface 100% assíncrona construída com AJAX/jQuery.
    * ✅ Design responsivo utilizando Bootstrap.

---

### 💻 Tecnologias Utilizadas

* **Backend:** `PHP`
* **Banco de Dados:** `MySQL / MariaDB`
* **Roteamento (API):** `Bramus/Router`
* **Frontend:** `HTML5`, `CSS3`, `JavaScript`
* **Requisições Assíncronas:** `AJAX`, `jQuery`
* **Framework CSS:** `Bootstrap`

---

### 🚀 Como Instalar e Executar

Siga os passos abaixo para configurar e rodar o projeto no seu ambiente local.

**Pré-requisitos:**

* [Git](https://git-scm.com)
* [PHP](https://www.php.net/) 7.4 ou superior
* [Composer](https://getcomposer.org/)
* Um servidor de banco de dados (MySQL ou MariaDB)

**Passo a passo:**

1.  **Clone o repositório:**
    ```bash
    git clone [https://github.com/JadsonSerafim/gerenciador-tarefas-php]
    ```

2.  **Acesse a pasta do projeto:**
    ```bash
    cd [gerenciador-tarefas-php]
    ```

3.  **Instale as dependências do PHP:**
    (O `bramus/router` será instalado a partir do seu arquivo `composer.json`)
    ```bash
    composer install
    ```

4.  **Configure o Banco de Dados:**
    * No seu servidor de banco de dados, crie um novo banco de dados. O nome utilizado no código é `gerenciador-app`.
        ```sql
        CREATE DATABASE `gerenciador-app`;
        ```
    * Abra o arquivo `src/conexao.php` e **edite as credenciais** (`$host`, `$username`, `$password`, `$dbname`) para que correspondam à sua configuração local.
    * Execute os seguintes comandos SQL no seu novo banco de dados para criar as tabelas `login` e `tarefas`:

        ```sql
        -- Tabela para autenticação dos usuários
        CREATE TABLE login (
          id INT AUTO_INCREMENT PRIMARY KEY,
          nome VARCHAR(255) NOT NULL,
          email VARCHAR(255) NOT NULL UNIQUE,
          senha VARCHAR(255) NOT NULL,
        );

        -- Tabela para armazenar as tarefas
        CREATE TABLE tarefas (
          id INT AUTO_INCREMENT PRIMARY KEY,
          id_usuario INT NOT NULL,
          titulo VARCHAR(255) NOT NULL,
          descricao VARCHAR(255) DEFAULT NULL,
          data_criacao TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
          data_vencimento DATE DEFAULT NULL,
          data_conclusao DATETIME,
          concluida BOOLEAN DEFAULT 0,
          FOREIGN KEY (id_usuario) REFERENCES login(id) ON DELETE CASCADE
        );
        ```

5.  **Configure o Servidor Web:**
    * O arquivo `.htaccess` fornecido já está configurado para redirecionar todas as requisições para `API.php`, o que é ideal para a API.
    * Coloque a pasta do projeto no diretório do seu servidor web local (como `htdocs` no XAMPP).
    * Acesse o projeto pelo seu navegador. A URL base para as chamadas da API é `http://localhost/gerenciador-tarefas-php/`.


### 🌐 Endpoints da API

Toda a API é gerenciada pelo arquivo `src/index.php`.

#### Autenticação

| Método | Rota               | Descrição                                         |
|--------|--------------------|---------------------------------------------------|
| `POST` | `/registro`        | Registra um novo usuário.                         |
| `POST` | `/processa-login`  | Autentica um usuário e cria uma sessão.           |
| `GET`  | `/logout`          | Destrói a sessão do usuário e faz o logout.       |

#### Tarefas

| Método   | Rota                         | Descrição                                                 |
|----------|------------------------------|-----------------------------------------------------------|
| `GET`    | `/tarefas`                   | Lista todas as tarefas **pendentes** do usuário logado.    |
| `GET`    | `/tarefas/concluidas`        | Lista todas as tarefas **concluídas** do usuário logado.   |
| `POST`   | `/tarefas/adicionar`         | Cria uma nova tarefa.                                     |
| `PUT`    | `/tarefas/{id}/concluir`     | Marca uma tarefa específica como concluída.               |
| `DELETE` | `/tarefas/{id}`              | Deleta uma tarefa específica.                             |

