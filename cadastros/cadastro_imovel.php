<?php
// Conexão com o banco de dados
$host = 'localhost';
$dbname = 'cadastro_imoveis_data';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Erro de conexão: ' . $e->getMessage();
    exit;
}

// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $proprietario = htmlspecialchars(trim($_POST['proprietario']));
    $endereco = htmlspecialchars(trim($_POST['endereco']));
    $cidade = htmlspecialchars(trim($_POST['cidade']));
    $estado = htmlspecialchars(trim($_POST['estado']));
    $tipo = htmlspecialchars(trim($_POST['tipo']));
    $valor = floatval($_POST['valor']);

    // Validação simples
    if (empty($proprietario) || empty($endereco) || empty($cidade) || empty($estado) || empty($tipo) || $valor <= 0) {
        echo "Por favor, preencha todos os campos corretamente.";
        exit;
    }

    // Insere os dados no banco
    $sql = "INSERT INTO imoveis (proprietario, endereco, cidade, estado, tipo, valor) 
            VALUES (:proprietario, :endereco, :cidade, :estado, :tipo, :valor)";
    
    try {
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':proprietario', $proprietario);
        $stmt->bindValue(':endereco', $endereco);
        $stmt->bindValue(':cidade', $cidade);
        $stmt->bindValue(':estado', $estado);
        $stmt->bindValue(':tipo', $tipo);
        $stmt->bindValue(':valor', $valor);
        $stmt->execute();

        echo "Imóvel cadastrado com sucesso!";
    } catch (PDOException $e) {
        echo "Erro ao cadastrar imóvel: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Imóvel</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(to right, #2c3e50, #3498db);
            color: #fff;
            text-align: center;
        }
        form {
            background-color: rgba(255, 255, 255, 0.9);
            max-width: 600px;
            margin: 20px auto;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        label {
            font-weight: bold;
            color: #333;
            display: block;
            margin-top: 10px;
        }
        input, select {
            width: 100%;
            padding: 12px;
            margin-top: 5px;
            border: 2px solid #3498db;
            border-radius: 8px;
            background-color: #f8f9fa;
            box-sizing: border-box;
        }
        button {
            background-color: #2980b9;
            color: white;
            font-size: 1.2em;
            padding: 15px;
            width: 100%;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            margin-top: 15px;
        }
        button:hover {
            background-color: #1c5980;
        }
    </style>
</head>
<body>
    <h2>Cadastro de Imóvel</h2>
    
    <form action="cadastro_imovel.php" method="POST">
        <label for="proprietario">Proprietário:</label>
        <input type="text" id="proprietario" name="proprietario" required>

        <label for="endereco">Endereço:</label>
        <input type="text" id="endereco" name="endereco" required>

        <label for="cidade">Cidade:</label>
        <input type="text" id="cidade" name="cidade" required>

        <label for="estado">Estado:</label>
        <input type="text" id="estado" name="estado" required>

        <label for="tipo">Tipo:</label>
        <select id="tipo" name="tipo" required>
            <option value="residencial">Residencial</option>
            <option value="comercial">Comercial</option>
        </select>

        <label for="valor">Valor (R$):</label>
        <input type="number" id="valor" name="valor" step="0.01" required>

        <button type="submit">Cadastrar</button>
    </form>
</body>
</html>
