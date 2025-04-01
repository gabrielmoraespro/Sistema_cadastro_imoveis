<?php
// Iniciar a sessão
session_start();

// Verificar se o usuário está logado
if (!isset($_SESSION['user_id'])) {
    header("Location: ../app/login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Sistema de Imóveis</title>
</head>
<body>
    <header>
        <h1>Bem-vindo ao Sistema de Imóveis, <?php echo $_SESSION['user_name']; ?>!</h1>
    </header>
    <p>Esta é a sua área restrita.</p>
    <footer>
        <p>&copy; 2025 Prefeitura Municipal de São Leopoldo | Todos os direitos reservados</p>
    </footer>
</body>
</html>
