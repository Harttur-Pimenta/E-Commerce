# ByteStore

Sistema completo de E-Commerce desenvolvido em PHP e MariaDB para gerenciamento de vendas online, controle de produtos, administração de usuários e processamento de pedidos.

A plataforma foi projetada para fornecer uma experiência completa de comércio eletrônico, contemplando tanto a área de vendas para clientes quanto um painel administrativo para gerenciamento da operação.

---

# Visão Geral

A ByteStore é uma aplicação web que permite a comercialização de produtos através de uma interface moderna, intuitiva e responsiva.

O sistema oferece recursos de catálogo de produtos, carrinho de compras, autenticação de usuários, processamento de pedidos, gerenciamento de vendas e administração completa do ambiente de comércio eletrônico.

---

# Principais Funcionalidades

## Catálogo de Produtos

A vitrine principal da loja exibe os produtos disponíveis para venda de forma organizada e intuitiva.

### Recursos

* Exibição de produtos em destaque
* Produtos em promoção
* Imagens dos produtos
* Descrições detalhadas
* Controle de estoque
* Organização por categorias
* Layout responsivo

---

## Categorias de Produtos

Os produtos são organizados em categorias para facilitar a navegação e localização de itens.

### Categorias Disponíveis

* Hardware
* PC Gamer
* Escritório
* Acessórios

Cada categoria possui sua própria página de listagem e filtragem.

---

## Carrinho de Compras

O carrinho utiliza sessões PHP para armazenar os itens selecionados pelo cliente.

### Recursos

* Adicionar produtos
* Remover produtos
* Atualizar quantidades
* Limpar carrinho
* Cálculo automático de subtotais
* Cálculo do valor total do pedido
* Persistência durante a sessão do usuário

---

## Sistema de Autenticação

A plataforma possui um sistema completo de autenticação e controle de acesso.

### Funcionalidades

* Login
* Logout
* Controle de sessão
* Diferenciação de perfis
* Proteção de páginas restritas

---

## Perfis de Usuário

### Cliente

Permissões:

* Navegar pelos produtos
* Utilizar o carrinho de compras
* Finalizar pedidos
* Consultar histórico de compras
* Gerenciar dados pessoais

### Administrador

Permissões:

* Gerenciar produtos
* Gerenciar usuários
* Gerenciar pedidos
* Alterar status de vendas
* Acessar relatórios administrativos

---

# Processo de Compra

O fluxo de compra foi desenvolvido para simular uma operação real de comércio eletrônico.

## Etapas

1. Seleção dos produtos
2. Inclusão no carrinho
3. Revisão do pedido
4. Login ou cadastro
5. Escolha da forma de pagamento
6. Confirmação da compra
7. Registro do pedido

---

# Formas de Pagamento

O sistema possui um módulo de pagamento simulado com as seguintes opções:

* PIX
* Boleto Bancário
* Cartão de Crédito

Após a confirmação do pagamento, o pedido é registrado automaticamente no banco de dados.

---

# Histórico de Pedidos

Cada cliente possui acesso ao histórico completo de compras realizadas.

### Informações Disponíveis

* Número do pedido
* Data da compra
* Valor total
* Forma de pagamento
* Status do pedido

---

# Painel Administrativo

## Gerenciamento de Produtos

Permite o gerenciamento completo do catálogo da loja.

### Funcionalidades

* Cadastro de produtos
* Edição de produtos
* Exclusão de produtos
* Upload de imagens
* Controle de estoque
* Definição de promoções
* Organização por categoria

---

## Gerenciamento de Usuários

Permite o controle dos usuários cadastrados na plataforma.

### Funcionalidades

* Cadastro de usuários
* Edição de informações
* Exclusão de registros
* Definição de perfil de acesso

---

## Gerenciamento de Vendas

Permite acompanhar todas as vendas realizadas na plataforma.

### Funcionalidades

* Listagem de pedidos
* Consulta de detalhes da compra
* Visualização dos itens vendidos
* Controle de status

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

O sistema utiliza MariaDB para armazenamento persistente das informações.

## Principais Entidades

### Usuários

Responsável pelo gerenciamento dos perfis de acesso.

### Produtos

Armazena informações dos produtos comercializados.

### Categorias

Organiza os produtos por segmento.

### Pedidos

Registra todas as compras realizadas.

### Itens do Pedido

Armazena os produtos pertencentes a cada pedido.

---

# Tecnologias Utilizadas

## Backend

* PHP 8+
* MySQLi
* Sessões PHP

## Banco de Dados

* MariaDB

## Frontend

* HTML5
* CSS3
* JavaScript

## Ambiente

* Linux
* GitHub Codespaces
* Visual Studio Code

---

# Instalação

## Iniciar o Banco de Dados

```bash
sudo service mariadb start
```

## Importar a Estrutura do Banco

```bash
mariadb -u root -p < Projeto/banco_byte.sql
```

## Configurar a Conexão

Arquivo:

```text
Projeto/configs/banco.php
```

## Executar o Projeto

```bash
php -S 0.0.0.0:8000
```

---

# Credenciais de Demonstração

## Administrador

Email: [admin@bytestore.com](mailto:admin@bytestore.com)

Senha: 123456

## Cliente

Email: [cliente@bytestore.com](mailto:cliente@bytestore.com)

Senha: 123456

---

# Segurança

Recursos implementados:

* Criptografia de senhas com password_hash()
* Verificação com password_verify()
* Controle de sessão
* Restrição de acesso por perfil
* Prepared Statements
* Proteção de páginas administrativas
* Validação de autenticação

---

# Responsividade

A interface foi desenvolvida para funcionar adequadamente em:

* Desktop
* Tablet
* Smartphone

---

# Licença

Projeto desenvolvido para fins educacionais e demonstração de conceitos de desenvolvimento web utilizando PHP e MariaDB.
