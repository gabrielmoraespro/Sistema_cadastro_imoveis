<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
// filepath: /Applications/XAMPP/xamppfiles/htdocs/cadastro_imoveis/consultas/consultar_imoveis.php

// Conexão com o banco de dados
$host = 'localhost';
$dbname = 'cadastro_imoveis_data';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Erro na conexão: ' . $e->getMessage();
    exit;
}

// Consultar imóveis
$query = "
    SELECT 
        id,
        proprietario,
        endereco,
        cidade,
        estado,
        tipo,
        valor,
        criado_em
    FROM 
        imoveis
";

try {
    $stmt = $pdo->query($query);
    $imoveis = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo 'Erro na consulta: ' . $e->getMessage();
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consultar Imóveis</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <!-- Custom CSS -->
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #2b1055, #7597de);
            color: #fff;
            min-height: 100vh;
            margin: 0;
            display: flex;
            flex-direction: column;
        }

        .container {
            background: rgba(255, 255, 255, 0.1);
            padding: 30px;
            border-radius: 12px;
            margin-top: 50px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }

        h1 {
            text-align: center;
            font-weight: 600;
            margin-bottom: 30px;
        }

        .table {
            background: rgba(255, 255, 255, 0.2);
            border-radius: 8px;
            overflow: hidden;
        }

        .table th {
            background:rgb(12, 5, 19);
            color: #fff;
            text-align: center;
        }

        .table tbody tr {
            transition: all 0.3s ease-in-out;
        }

        .table tbody tr:hover {
            background: rgba(255, 255, 255, 0.1);
            transform: scale(1.02);
        }

        .btn-back {
            display: inline-block;
            margin-bottom: 20px;
            background: linear-gradient(135deg, #5a189a, #4361ee);
            color: #fff;
            padding: 10px 20px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease-in-out;
        }

        .btn-back:hover {
            background: linear-gradient(135deg, #4361ee, #5a189a);
            transform: translateX(-5px);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
        }

        footer {
            margin-top: auto;
            text-align: center;
            padding: 15px;
            background: rgba(0, 0, 0, 0.6);
            color: #fff;
        }
    </style>
</head>
<body>

<div class="container">
    <a href="javascript:history.back()" class="btn-back">&larr; Voltar</a>
    <h1>Lista de Imóveis</h1>

    <table class="table table-hover text-center">
        <thead>
            <tr>
                <th>ID</th>
                <th>Proprietário</th>
                <th>Endereço</th>
                <th>Cidade</th>
                <th>Estado</th>
                <th>Tipo</th>
                <th>Valor (R$)</th>
                <th>Criado em</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($imoveis)): ?>
                <?php foreach ($imoveis as $imovel): ?>
                    <tr>
                        <td><?= htmlspecialchars($imovel['id'], ENT_QUOTES, 'UTF-8') ?></td>
                        <td><?= htmlspecialchars($imovel['proprietario'], ENT_QUOTES, 'UTF-8') ?></td>
                        <td><?= htmlspecialchars($imovel['endereco'], ENT_QUOTES, 'UTF-8') ?></td>
                        <td><?= htmlspecialchars($imovel['cidade'], ENT_QUOTES, 'UTF-8') ?></td>
                        <td><?= htmlspecialchars($imovel['estado'], ENT_QUOTES, 'UTF-8') ?></td>
                        <td><?= htmlspecialchars($imovel['tipo'], ENT_QUOTES, 'UTF-8') ?></td>
                        <td><?= number_format($imovel['valor'], 2, ',', '.') ?></td>
                        <td><?= htmlspecialchars($imovel['criado_em'], ENT_QUOTES, 'UTF-8') ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="8">Nenhum imóvel encontrado.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<footer>
    &copy; 2025 Prefeitura Municipal de São Leopoldo | Todos os direitos reservados
</footer>

<!-- Bootstrap 5 JS -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

</body>
</html>