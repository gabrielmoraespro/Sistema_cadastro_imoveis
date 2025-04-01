<?php
// Defina os parâmetros de conexão com o banco de dados
$servidor = "localhost";  // Normalmente 'localhost' se for local
$usuario = "root";        // O nome de usuário do banco (geralmente 'root' para localhost)
$senha = "";              // Senha do banco de dados (deixe vazio se for 'root' no localhost)
$banco = "armazenar_cadastro"; // Nome do banco de dados que você criou

// Criando a conexão
$conn = new mysqli($servidor, $usuario, $senha, $banco);

// Verificando a conexão
if ($conn->connect_error) {
    die("Erro na conexão: " . $conn->connect_error);
}
?>
