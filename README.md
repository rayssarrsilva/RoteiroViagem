# 📍 Sistema de Roteiros de Viagens Compartilhados – API RESTful em PHP

Este projeto consiste em uma API RESTful desenvolvida em PHP com MySQL, utilizando o padrão MVC e uma arquitetura em camadas (Controller, Service e DAO). O sistema tem como objetivo permitir que os usuários criem roteiros de viagem, adicionem atividades, deixem comentários e interajam com roteiros de outros viajantes. Tudo isso seguindo boas práticas de organização, separação de responsabilidades e desenvolvimento

---

## 📐 Arquitetura

O sistema foi desenvolvido seguindo a arquitetura MVC com separação clara de responsabilidades:

- *Model*: Representa as entidades do sistema.
- *DAO (Data Access Object)*: Responsável pela comunicação direta com o banco de dados.
- *Service*: Contém as regras de negócio e validações.
- *Controller*: Recebe as requisições e retorna respostas JSON.

---

## 🧩 Funcionalidades

- Cadastro, listagem, atualização e exclusão de *usuários*
- Criação e gestão de *roteiros de viagem*
- Adição e listagem de *atividades por roteiro*
- Registro de *comentários* sobre roteiros

## 🔗 Endpoints Disponíveis

viagens = nome da minha pasta onde está toda a estrutura MVC e seus respectivos arquivos (variavel)
public = nome da pasta onde está localizado o acesso aos endpoints (fixo)

### ▶️ Usuários 

| Método | Rota                                                    | Descrição         |
|--------|---------------------------------------------------------|-------------------|
| GET    | http://localhost/viagens/public/usuarios                | Listar todos      |
| GET    | http://localhost/viagens/public/usuarios/{id}           | Buscar por ID     |
| POST   | http://localhost/viagens/public/usuarios                | Criar usuário     |
| PUT    | http://localhost/viagens/public/usuarios/{id}           | Atualizar usuário |
| DELETE | http://localhost/viagens/public/usuarios/{id}           | Deletar usuário   |

### ▶️ Roteiros

| Método | Rota                                                    | Descrição         |
|--------|---------------------------------------------------------|-------------------|
| GET    | http://localhost/viagens/public/roteiros                | Listar todos      |
| GET    | http://localhost/viagens/public/roteiros/{id}           | Buscar por ID     |
| POST   | http://localhost/viagens/public/roteiros                | Criar roteiro     |
| PUT    | http://localhost/viagens/public/roteiros/{id}           | Atualizar roteiro |
| DELETE | http://localhost/viagens/public/roteiros/{id}           | Deletar roteiro   |

### ▶️ Atividades

| Método | Rota                                                     | Descrição           |
|--------|----------------------------------------------------------|---------------------|
| GET    | http://localhost/viagens/public/atividades               | Listar todas        |
| GET    | http://localhost/viagens/public/atividades/{id}          | Buscar por ID       |
| POST   | http://localhost/viagens/public/atividades               | Criar atividade     |
| PUT    | http://localhost/viagens/public/atividades/{id}          | Atualizar atividade |
| DELETE | http://localhost/viagens/public/atividades/{id}          | Deletar atividade   |

### ▶️ Comentários

| Método | Rota                                                     | Descrição            |
|--------|----------------------------------------------------------|----------------------|
| GET    | http://localhost/viagens/public/comentarios              | Listar todos         |
| GET    | http://localhost/viagens/public/comentarios/{id}         | Buscar por ID        |
| POST   | http://localhost/viagens/public/comentarios              | Criar comentário     |
| PUT    | http://localhost/viagens/public/comentarios/{id}         | Atualizar comentário |
| DELETE | http://localhost/viagens/public/comentarios/{id}         | Deletar comentário   |

---
## 💾 Banco de Dados

Banco: roteiros_viagens (MySQL)

### 📜 Script SQL para criação do banco:

sql
CREATE DATABASE IF NOT EXISTS roteiros_viagens;
USE roteiros_viagens;

CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100),
    email VARCHAR(100)
);

CREATE TABLE roteiros (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT,
    destino VARCHAR(100),
    dias INT,
    descricao TEXT,
    criado_em DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id)
);

CREATE TABLE atividades (
    id INT AUTO_INCREMENT PRIMARY KEY,
    roteiro_id INT,
    nome VARCHAR(100),
    horario TIME,
    descricao TEXT,
    FOREIGN KEY (roteiro_id) REFERENCES roteiros(id) ON DELETE CASCADE
);

CREATE TABLE comentarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    roteiro_id INT,
    autor VARCHAR(100),
    comentario TEXT,
    criado_em DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (roteiro_id) REFERENCES roteiros(id) ON DELETE CASCADE
);
 

## ▶️ Como Rodar Localmente

1. Instale o [XAMPP](https://www.apachefriends.org/pt_br/index.html)
2. Crie uma pasta dentro de xampp/htdocs 
3. Clone o repositório
4. Ative o apache + MySql + FileZila no XAMPP Control Panel
5. Criar o banco e as tabelas no MySql Local. (http://localhost/phpmyadmin)
