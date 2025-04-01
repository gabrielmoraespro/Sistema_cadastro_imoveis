# 📌 Sistema de Cadastro de Imóveis

Este é um sistema para cadastro e gerenciamento de imóveis, desenvolvido com PHP e MySQL.

## 🚀 Instalação e Configuração

### 📥 1. Clonar o Repositório

Abra o terminal e execute o seguinte comando:

```bash
git clone https://github.com/gabrielmoraespro/Sistema_cadastro_imoveis.git
cd Sistema_cadastro_imoveis
```

### 🛠 2. Configurar o Ambiente

O projeto requer um servidor web com suporte a PHP. Recomendamos a instalação de um dos seguintes:

- [XAMPP](https://www.apachefriends.org/pt_br/index.html) (Windows, Linux, Mac)
- [WAMP](https://www.wampserver.com/en/) (Windows)

### 📦 3. Instalar Dependências

Se houver dependências gerenciadas pelo Composer, instale-as executando:

```bash
composer install
```

### 🗄 4. Configurar o Banco de Dados

1. Crie um banco de dados MySQL.
2. Importe o arquivo `cadastroimoveis.sql` localizado na raiz do projeto.
3. Atualize o arquivo `config.php` com as credenciais do banco de dados:

```php
<?php
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'seu_usuario');
define('DB_PASSWORD', 'sua_senha');
define('DB_NAME', 'nome_do_banco');
?>
```

### ▶️ 5. Executar o Projeto

1. Inicie o servidor web.
2. Acesse o sistema no navegador: [`http://localhost/Sistema_cadastro_imoveis`](http://localhost/Sistema_cadastro_imoveis).

## ✨ Recursos

✅ Cadastro de imóveis 🏠  
✅ Consulta e edição de registros 🔍  
✅ Sistema seguro e eficiente 🔐

## 📝 Licença

Este projeto está sob a licença MIT. Sinta-se livre para contribuir!

---
💡 *Desenvolvido por Gabriel Moraes*
