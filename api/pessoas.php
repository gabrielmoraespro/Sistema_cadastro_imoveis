<?php
// Configuração do cabeçalho para retornar JSON
header('Content-Type: application/json');

// Configuração do banco de dados
$host = 'localhost';
$dbname = 'seu_banco_de_dados'; // Substitua pelo nome do seu banco de dados
$username = 'root'; // Usuário do banco de dados
$password = ''; // Senha do banco de dados

try {
    // Conexão com o banco de dados usando PDO
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Consulta SQL para buscar os dados das pessoas
    $sql = "SELECT id, nome, data_nascimento, cpf, sexo, telefone, email FROM pessoas ORDER BY nome ASC";
    $stmt = $pdo->query($sql);

    // Obter os resultados como um array associativo
    $pessoas = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Retornar os dados no formato JSON
    echo json_encode($pessoas);
} catch (PDOException $e) {
    // Retornar um erro no formato JSON
    echo json_encode(['error' => 'Erro ao buscar os dados: ' . $e->getMessage()]);
}