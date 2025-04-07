<?php
// Iniciar a sessão
session_start();

// Verificar se o usuário está logado
if (!isset($_SESSION['user_id']) || !isset($_SESSION['user_name'])) {
    $_SESSION['error'] = "Você precisa estar logado para acessar o painel.";
    header("Location: login.php");
    exit();
}

// Regenerar o ID da sessão para evitar roubo de sessão
if (!isset($_SESSION['regenerado'])) {
    session_regenerate_id(true);
    $_SESSION['regenerado'] = true;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Sistema de Imóveis</title>
    <link rel="stylesheet" href="css/style.css"> <!-- Arquivo de estilos -->
</head>
<body>
    <header>
        <h1>Bem-vindo ao Sistema de Imóveis, <?= htmlspecialchars($_SESSION['user_name']); ?>!</h1>
        <nav>
            <ul>
                <li><a href="consultas/consultar_pessoas.php">Consultar Pessoas</a></li>
                <li><a href="consultas/consultar_imoveis.php">Consultar Imóveis</a></li>
                <li><a href="logout.php" class="btn-logout">Sair</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <p>Esta é a sua área restrita. Aqui você pode gerenciar pessoas e imóveis cadastrados no sistema.</p>
    </main>
    <footer>
        <p>&copy; 2025 Prefeitura Municipal de São Leopoldo | Todos os direitos reservados</p>
    </footer>
</body>
</html>
