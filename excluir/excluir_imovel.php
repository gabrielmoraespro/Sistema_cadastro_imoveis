<?php
// Conectar ao banco de dados
include('../config/db_connect.php');

// Verificar se o ID do imóvel foi passado
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Excluir o registro do imóvel no banco de dados
    $sql = "DELETE FROM imoveis WHERE id = $id";
    
    if (mysqli_query($conn, $sql)) {
        header('Location: consultar_imoveis.php'); // Redirecionar para a página de consulta
    } else {
        echo "Erro ao excluir imóvel: " . mysqli_error($conn);
    }
} else {
    echo "ID do imóvel não fornecido.";
}
?>
