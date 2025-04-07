<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Configurações do banco de dados
$host = 'localhost';
$dbname = 'cadastro_imoveis_data';
$username = 'root';
$password = '';

try {
    // Criando a conexão com PDO
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // Exibindo erro de conexão
    die('Erro na conexão com o banco de dados: ' . $e->getMessage());
}
?>
