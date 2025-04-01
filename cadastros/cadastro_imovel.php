<?php
// Conexão com o banco de dados
$host = 'localhost';
$dbname = 'seu_banco_de_dados';
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
    $proprietario = $_POST['proprietario'];
    $endereco = $_POST['endereco'];
    $cidade = $_POST['cidade'];
    $estado = $_POST['estado'];
    $tipo = $_POST['tipo'];
    $valor = $_POST['valor'];

    // Validação simples
    if (!is_numeric($valor) || $valor <= 0) {
        echo "Valor inválido. Por favor, insira um valor positivo.";
        exit;
    }

    // Insere os dados no banco
    $sql = "INSERT INTO imoveis (proprietario, endereco, cidade, estado, tipo, valor) 
            VALUES (:proprietario, :endereco, :cidade, :estado, :tipo, :valor)";
    
    try {
        $stmt = $pdo->prepare($sql);
        if ($stmt->execute([
            ':proprietario' => $proprietario,
            ':endereco' => $endereco,
            ':cidade' => $cidade,
            ':estado' => $estado,
            ':tipo' => $tipo,
            ':valor' => $valor
        ])) {
            echo "Imóvel cadastrado com sucesso!";
        } else {
            echo "Erro ao cadastrar imóvel!";
        }
    } catch (PDOException $e) {
        echo 'Erro ao inserir dados: ' . $e->getMessage();
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
    
    <form action="cadastro_de_imovel.php" method="POST">
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
            <option value="Casa">Casa</option>
            <option value="Apartamento">Apartamento</option>
            <option value="Terreno">Terreno</option>
            <option value="Comercial">Comercial</option>
        </select>

        <label for="valor">Valor (R$):</label>
        <input type="text" id="valor" name="valor" required>

        <button type="submit">Cadastrar</button>
    </form>
</body>
</html>
