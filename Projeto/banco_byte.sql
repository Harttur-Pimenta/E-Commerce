CREATE DATABASE IF NOT EXISTS banco_byte CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE banco_byte;

DROP TABLE IF EXISTS itens_pedido;
DROP TABLE IF EXISTS pedidos;
DROP TABLE IF EXISTS produtos;
DROP TABLE IF EXISTS categorias;
DROP TABLE IF EXISTS usuarios;

CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(150) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    senha VARCHAR(255) NOT NULL,
    tipo ENUM('admin','cliente') NOT NULL DEFAULT 'cliente',
    criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE categorias (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    slug VARCHAR(100) NOT NULL UNIQUE
);

CREATE TABLE produtos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(200) NOT NULL,
    descricao TEXT,
    preco DECIMAL(10,2) NOT NULL,
    estoque INT NOT NULL DEFAULT 0,
    imagem VARCHAR(255),
    promocao TINYINT(1) NOT NULL DEFAULT 0,
    categoria_id INT NOT NULL,
    criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_produtos_categorias FOREIGN KEY (categoria_id) REFERENCES categorias(id)
);

CREATE TABLE pedidos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT NOT NULL,
    valor_total DECIMAL(10,2) NOT NULL,
    forma_pagamento ENUM('PIX','Boleto','Cartão de Crédito') NOT NULL DEFAULT 'PIX',
    status ENUM('Pendente','Pago','Enviado','Cancelado') NOT NULL DEFAULT 'Pendente',
    criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_pedidos_usuarios FOREIGN KEY (usuario_id) REFERENCES usuarios(id)
);

CREATE TABLE itens_pedido (
    id INT AUTO_INCREMENT PRIMARY KEY,
    pedido_id INT NOT NULL,
    produto_id INT NOT NULL,
    quantidade INT NOT NULL,
    preco_unitario DECIMAL(10,2) NOT NULL,
    subtotal DECIMAL(10,2) NOT NULL,
    CONSTRAINT fk_itens_pedido FOREIGN KEY (pedido_id) REFERENCES pedidos(id) ON DELETE CASCADE,
    CONSTRAINT fk_itens_produto FOREIGN KEY (produto_id) REFERENCES produtos(id)
);

INSERT INTO categorias (id, nome, slug) VALUES
(1, 'Hardware', 'hardware'),
(2, 'PC Gamer', 'pcgamer'),
(3, 'Escritório', 'escritorio'),
(4, 'Acessórios', 'acessorios');

INSERT INTO usuarios (nome, email, senha, tipo) VALUES
('Administrador', 'admin@bytestore.com', '$2y$12$CWgzC.SfOVSjZPtjas/bPO/GvQhO4WiVAx83JEtQpITeR0NP1mxqu', 'admin'),
('Cliente Teste', 'cliente@bytestore.com', '$2y$12$CWgzC.SfOVSjZPtjas/bPO/GvQhO4WiVAx83JEtQpITeR0NP1mxqu', 'cliente');

INSERT INTO produtos (nome, descricao, preco, estoque, imagem, promocao, categoria_id) VALUES
('Mouse Gamer RGB', 'Mouse gamer com 7200 DPI', 129.90, 15, '../../configs/imgs/mouse.jpg', 1, 4),
('Teclado Mecânico', 'Switch Blue ABNT2', 249.90, 10, '../../configs/imgs/teclado.jpg', 1, 4),
('Headset Gamer', 'Headset com microfone', 199.90, 8, '../../configs/imgs/headset.jpg', 0, 4),
('Monitor 24"', 'Monitor Full HD 75Hz', 899.90, 5, '../../configs/imgs/monitor.jpg', 0, 3),
('SSD 1TB', 'SSD NVMe de alta velocidade', 499.90, 20, '../../configs/imgs/ssd.jpg', 1, 1);
