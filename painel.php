<?php
session_start();

// Verificar se o usuário está logado (exemplo simples)
if (!isset($_SESSION['usuario_id'])) {
    header('Location: login.php'); // Redireciona para o login caso não esteja logado
    exit;
}

echo "Bem-vindo ao painel!";
?>
