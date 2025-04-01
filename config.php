<?php
// Configurações do banco de dados
define('DB_HOST', 'localhost');      // Endereço do servidor de banco de dados
define('DB_USER', 'root');           // Usuário do banco de dados (no XAMPP, é 'root')
define('DB_PASS', '');               // Senha do banco de dados (deixe vazio no XAMPP, pois por padrão é sem senha)
define('DB_NAME', 'cadastro_imoveis_data'); // Nome do banco de dados

// Criando a conexão com o banco de dados
try {
    $pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS);
    // Definindo o charset para evitar problemas de codificação com caracteres especiais
    $pdo->exec("set names utf8");
} catch (PDOException $e) {
    // Caso ocorra erro na conexão
    die("Erro na conexão com o banco de dados: " . $e->getMessage());
}

// Configurações gerais do sistema (opcionais)
define('SITE_URL', 'http://localhost/cadastro_imoveis_data/'); // URL base do sistema

?>
