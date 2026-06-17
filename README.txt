# ByteStore

## Trabalho Final – Tecnologias para Internet

Sistema completo de E-Commerce desenvolvido em PHP e MariaDB como trabalho final da disciplina **Tecnologias para Internet**.

O projeto foi construído com foco na aplicação prática dos conceitos estudados durante a disciplina, incluindo autenticação de usuários, manipulação de sessões, integração com banco de dados, operações CRUD, gerenciamento de pedidos, carrinho de compras e desenvolvimento de interfaces web responsivas.

---

# Objetivo

A ByteStore é uma loja virtual desenvolvida para permitir a comercialização de produtos de informática e tecnologia através de uma plataforma web moderna, organizada e segura.

O sistema contempla dois perfis distintos de usuários:

* Administrador
* Cliente

Cada perfil possui permissões específicas e funcionalidades próprias.

---

# Tecnologias Utilizadas

## Backend

* PHP 8+
* Sessões PHP
* MySQLi
* MariaDB

## Frontend

* HTML5
* CSS3
* JavaScript
* Design Responsivo

## Banco de Dados

* MariaDB

## Ambiente de Desenvolvimento

* GitHub Codespaces
* Linux
* VS Code

---

# Funcionalidades Implementadas

## Área Pública

### Vitrine de Produtos

A página principal da loja exibe:

* Produtos em promoção
* Todos os produtos cadastrados
* Imagens dos produtos
* Preços formatados
* Descrições
* Controle de quantidade
* Adição ao carrinho

---

### Filtro por Categorias

Os produtos podem ser filtrados por categoria:

* Hardware
* PC Gamer
* Escritório
* Acessórios

Isso permite ao cliente localizar rapidamente os produtos desejados.

---

## Carrinho de Compras

O sistema utiliza sessões PHP para armazenar os itens do carrinho.

### Funcionalidades

* Adicionar produtos
* Alterar quantidade
* Remover produto
* Limpar carrinho
* Calcular subtotal
* Calcular total da compra

O carrinho permanece disponível enquanto a sessão do usuário estiver ativa.

---

## Sistema de Login

O sistema possui autenticação completa.

### Funcionalidades

* Login
* Logout
* Controle de sessão
* Proteção de páginas restritas

---

## Perfis de Usuário

### Cliente

Pode:

* Navegar pela loja
* Adicionar produtos ao carrinho
* Finalizar compras
* Consultar histórico de pedidos

### Administrador

Pode:

* Gerenciar produtos
* Gerenciar usuários
* Gerenciar vendas
* Alterar status dos pedidos

---

# Checkout

Após finalizar o carrinho o usuário é direcionado para a tela de pagamento.

### Formas de Pagamento Simuladas

* PIX
* Boleto
* Cartão de Crédito

Após a confirmação:

* O pedido é registrado no banco
* Os itens são registrados em itens_pedido
* O carrinho é limpo automaticamente

---

# Histórico de Pedidos

Cada cliente possui uma área exclusiva para acompanhar suas compras.

### Informações exibidas

* Número do pedido
* Data
* Valor total
* Status
* Forma de pagamento

---

# Painel Administrativo

## CRUD de Produtos

Permite:

* Cadastrar produtos
* Listar produtos
* Editar produtos
* Excluir produtos
* Upload de imagens

### Informações dos Produtos

* Nome
* Descrição
* Preço
* Estoque
* Categoria
* Imagem
* Promoção

---

## CRUD de Usuários

Permite:

* Cadastrar usuários
* Listar usuários
* Editar usuários
* Excluir usuários

### Perfis

* Administrador
* Cliente

---

## Relatório de Vendas

Permite ao administrador:

* Visualizar pedidos realizados
* Consultar detalhes da compra
* Ver produtos comprados
* Alterar status do pedido

### Status Disponíveis

* Pendente
* Pago
* Enviado
* Entregue
* Cancelado

---

# Estrutura do Projeto

```text
Projeto/
│
├── admin/
│   ├── produtos/
│   ├── usuarios/
│   └── vendas/
│
├── usuario/
│   ├── destaques/
│   ├── hardware/
│   ├── pcgamer/
│   ├── escritorio/
│   ├── acessorios/
│   ├── carrinho/
│   ├── checkout/
│   └── perfil/
│
├── configs/
│   ├── banco.php
│   ├── header.php
│   ├── footer.php
│   ├── style.css
│   └── imgs/
│
├── uploads/
│
└── banco_byte.sql
```

---

# Banco de Dados

## Principais Tabelas

### usuarios

Armazena os usuários do sistema.

### produtos

Armazena os produtos disponíveis para venda.

### categorias

Armazena as categorias dos produtos.

### pedidos

Armazena os pedidos realizados.

### itens_pedido

Armazena os produtos pertencentes a cada pedido.

---

# Instalação

## 1. Iniciar o MariaDB

```bash
sudo service mariadb start
```

---

## 2. Importar o banco

```bash
mariadb -u root -p < Projeto/banco_byte.sql
```

Senha padrão:

```text
123456
```

---

## 3. Configurar conexão

Arquivo:

```text
Projeto/configs/banco.php
```

Verifique:

```php
$host = "localhost";
$usuario = "root";
$senha = "123456";
$banco = "banco_byte";
```

---

## 4. Executar o projeto

```bash
php -S 0.0.0.0:8000
```

---

# Credenciais de Teste

## Administrador

```text
Email: admin@bytestore.com
Senha: 123456
```

---

## Cliente

```text
Email: cliente@bytestore.com
Senha: 123456
```

---

# Segurança Implementada

* Senhas criptografadas com password_hash()
* Validação de login
* Controle de sessão
* Restrição de páginas administrativas
* Proteção básica contra acesso não autorizado
* Uso de prepared statements no MySQLi

---

# Responsividade

O sistema foi desenvolvido para funcionar em:

* Computadores
* Tablets
* Smartphones

---

# Autor

Harttur Oliveira Pimenta

