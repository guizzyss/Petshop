-- Active: 1761867984837@@127.0.0.1@3306@petshop
-- Cria o banco de dados se ele não existir
CREATE DATABASE IF NOT EXISTS petshop;

-- Usa o banco de dados petshop
USE petshop;

-- Cria a tabela de usuários
CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    senha VARCHAR(255) NOT NULL,
    data_cadastro TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB; -- Define o mecanismo de armazenamento como InnoDB