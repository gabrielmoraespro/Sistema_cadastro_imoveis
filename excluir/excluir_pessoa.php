<?php
// Conectar ao banco de dados
include('../config/db_connect.php');

// Verificar se o ID da pessoa foi passado
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Excluir o registro da pessoa no banco de dados
    $sql = "DELETE FROM pessoas WHERE id = $id";
    
    if (mysqli_query($conn, $sql)) {
        header('Location: consultar_pessoas.php'); // Redirecionar para a página de consulta
    } else {
        echo "Erro ao excluir pessoa: " . mysqli_error($conn);
    }
} else {
    echo "ID da pessoa não fornecido.";
}
?>
