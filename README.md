# 💅 CRUD Esmalteria

Um sistema web desenvolvido em **PHP** para o gerenciamento de uma **esmalteria**, permitindo o controle completo de esmaltes, estoque e movimentações — tudo de forma simples e intuitiva.

---

## 🌸 Sobre o Projeto

O **CRUD Esmalteria** foi criado com o objetivo de facilitar o controle de produtos de uma esmalteria.
A aplicação permite cadastrar, visualizar, editar e excluir esmaltes, além de registrar movimentações de estoque (entrada e saída).

O sistema também conta com uma tela de login, garantindo que apenas usuários autorizados possam acessar e gerenciar as informações.

---

## ⚙️ Funcionalidades Principais

* 🧴 **Gerenciamento de esmaltes:** cadastro, listagem, edição e exclusão de produtos.
* 📦 **Controle de estoque:** movimentações de entrada e saída de esmaltes.
* 🔐 **Autenticação de usuário:** acesso restrito ao painel administrativo.
* 🕒 **Registro de movimentações:** histórico de alterações e movimentações no estoque.
* 💻 **Interface simples e responsiva:** navegação fácil e organizada para o usuário.

---

## 💻 Tecnologias Utilizadas

* **PHP** — Linguagem principal para o backend.
* **MySQL** — Banco de dados relacional para armazenar informações dos esmaltes e usuários.
* **HTML5 & CSS3** — Estrutura e estilização das páginas.
* **XAMPP / WAMP / LAMP** — Servidores locais compatíveis para execução do projeto.

---

## 🚀 Como Executar o Projeto

### 🔧 Requisitos

* PHP **7.4+** (recomendado PHP 8.x)
* Servidor web (Apache, Nginx, XAMPP, WAMP ou LAMP)
* MySQL ou MariaDB
* Extensão **mysqli** habilitada no PHP

---

### 🪄 Passo a Passo

#### 1️⃣ Clonar o repositório

```bash
git clone https://github.com/Isa-Paiola/CRUD_Esmalteria.git
```

#### 2️⃣ Mover o projeto para o diretório do servidor

* **XAMPP (Windows):** `C:/xampp/htdocs/CRUD_Esmalteria`
* **WAMP:** `C:/wamp64/www/CRUD_Esmalteria`
* **Linux (LAMP):** `/var/www/html/CRUD_Esmalteria`

---

#### 3️⃣ Criar o banco de dados

Abra o **phpMyAdmin** ou o terminal do MySQL e execute:

```sql
CREATE DATABASE CRUD_Esmalteria CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

---

#### 4️⃣ Importar o arquivo SQL

No phpMyAdmin:

* Vá até o banco **CRUD_Esmalteria**
* Clique em **Importar**
* Envie o arquivo **`CRUD_Esmalteria.sql`** (incluso no repositório, se disponível)

Ou via terminal:

```bash
mysql -u root -p CRUD_Esmalteria < caminho/para/CRUD_Esmalteria.sql
```

---

#### 5️⃣ Configurar a conexão com o banco

No arquivo `config.php` (ou `conexao.php`, conforme o projeto), ajuste os dados conforme o ambiente local:

```php
<?php
define('DB_HOST', 'localhost');
define('DB_NAME', 'CRUD_Esmalteria');
define('DB_USER', 'root');
define('DB_PASS', '');

// Criar conexão
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
if ($conn->connect_error) {
    die('Erro de conexão: ' . $conn->connect_error);
}
$conn->set_charset('utf8mb4');
?>
```

---

#### 6️⃣ Executar o sistema

Abra o navegador e acesse:

```
http://localhost/CRUD_Esmalteria/
```

Se tudo estiver configurado corretamente, você verá a tela de login do sistema.

---

### 🧩 Solução de Problemas

* **Tela em branco:** habilite a exibição de erros PHP adicionando no topo do `index.php`:

  ```php
  ini_set('display_errors', 1);
  error_reporting(E_ALL);
  ```
* **Erro de conexão:** verifique se o banco existe e se o usuário/senha estão corretos.
* **Banco vazio:** confira se o arquivo `CRUD_Esmalteria.sql` foi importado corretamente.

---

## 🎨 Design e Experiência do Usuário

A interface foi desenvolvida com foco em **simplicidade e usabilidade**, apresentando menus claros e páginas diretas para cada funcionalidade.
O layout é minimalista, ideal para aplicações administrativas que priorizam a eficiência.

---

## 🧠 Conceitos Aplicados

* Estrutura **CRUD (Create, Read, Update, Delete)**
* Manipulação de banco de dados com PHP e MySQL
* Uso de sessões para controle de login
* Separação lógica entre **backend** (PHP) e **frontend** (HTML/CSS)
* Princípios básicos de **segurança e validação** de dados

---

## 📸 Prévia do Sistema

* **Tela de Login**

  <img width="700" alt="Tela de Login" src="https://github.com/user-attachments/assets/1a6980e2-a94f-45eb-8a40-0c067fbc4c91" />

---

* **Página Inicial / Dashboard**

  <img width="700" alt="Dashboard" src="https://github.com/user-attachments/assets/64fb7d49-4378-4a20-89e1-55bab74ca658" />

---

* **Cadastro de Esmalte**

  <img width="700" alt="Cadastro de Esmalte 1" src="https://github.com/user-attachments/assets/68e2924f-0416-4780-a8c9-481b83b51def" />

<img width="700" alt="Cadastro de Esmalte 2" src="https://github.com/user-attachments/assets/94306e30-7af8-4fb0-b2ac-845035a5ffa3" />

---

* **Movimentações de Estoque**

  <img width="700" alt="Movimentações de Estoque 1" src="https://github.com/user-attachments/assets/74ce889e-8a93-428a-bd70-a29f62562521" />

<img width="700" alt="Movimentações de Estoque 2" src="https://github.com/user-attachments/assets/4c58e017-672b-49fd-8512-08e62f09f9b6" />

---

* **Histórico**

  <img width="700" alt="Histórico" src="https://github.com/user-attachments/assets/22385f99-d663-424a-ab0a-701c2e4c9d11" />

---

## 👩‍💻 Autora

**Isa Paiola**
Desenvolvedora e criadora do projeto **CRUD Esmalteria.** 💌

---

## 📄 Licença

Este projeto é de código aberto e pode ser usado para fins educacionais ou pessoais.
