<?php
session_start();

// Verificar se o usuário está logado
if (!isset($_SESSION['usuario_id']) || !isset($_SESSION['usuario_nome'])) {
    $_SESSION['error'] = "Você precisa estar logado para acessar o painel.";
    header('Location: login.php');
    exit();
}

// Regenerar o ID da sessão para evitar roubo de sessão
if (!isset($_SESSION['regenerado'])) {
    session_regenerate_id(true);
    $_SESSION['regenerado'] = true;
}

// Exibir informações do usuário
$usuario_nome = htmlspecialchars($_SESSION['usuario_nome']);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="painel-container">
        <h1>Bem-vindo, <?= $usuario_nome ?>!</h1>
        <p>Você está logado no sistema.</p>
        <a href="logout.php" class="btn-logout">Sair</a>
    </div>
</body>
</html>
