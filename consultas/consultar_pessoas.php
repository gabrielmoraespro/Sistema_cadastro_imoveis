<?php
// Configuração do Banco de Dados
$host = 'localhost';
$dbname = 'seu_banco_de_dados';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die('<p style="color:red;">Erro de conexão com o banco de dados.</p>');
}

// Consulta os dados das pessoas
try {
    $sql = "SELECT id, nome, data_nascimento, cpf, sexo, telefone, email FROM pessoas ORDER BY nome ASC";
    $stmt = $pdo->query($sql);
    $pessoas = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die('<p style="color:red;">Erro ao buscar os dados das pessoas.</p>');
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consultar Pessoas</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEJv3K2j0nFjsoddCjZyyJ4dwyCZbS5v5hPBXIrc9jjEfjg7qpuFz5Tc6YdKf" crossorigin="anonymous">
    
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
            color: #fff;
            min-height: 100vh;
        }

        .container {
            margin-top: 50px;
            padding: 20px;
            background-color: rgba(0, 0, 0, 0.6);
            border-radius: 15px;
        }

        h2 {
            font-size: 2rem;
            font-weight: 600;
            color: #f0f0f0;
            margin-bottom: 20px;
        }

        .table th, .table td {
            text-align: center;
        }

        .table {
            border: 2px solid #ddd;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
        }

        .table thead {
            background-color: #4c6ef5;
            color: #fff;
        }

        .table tbody tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .table tbody tr:nth-child(odd) {
            background-color: #e9efff;
        }

        .table-hover tbody tr:hover {
            background-color: #e0aaff;
        }

        .btn-back {
            background: linear-gradient(135deg, #00c6ff, #0072ff);
            color: white;
            padding: 10px 20px;
            border-radius: 50px;
            font-weight: bold;
            text-decoration: none;
            transition: transform 0.3s ease-in-out;
        }

        .btn-back:hover {
            transform: scale(1.05);
            box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>

<div class="container">
<a href="/cadastro_imoveis/index.php" class="btn-back mb-3">Voltar para o Índice</a>

    <h2 class="text-center">Consultar Pessoas Cadastradas</h2>

    <?php if (!empty($pessoas)): ?>
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Data de Nascimento</th>
                    <th>CPF</th>
                    <th>Sexo</th>
                    <th>Telefone</th>
                    <th>E-mail</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($pessoas as $pessoa): ?>
                    <tr>
                        <td><?= htmlspecialchars($pessoa['id']); ?></td>
                        <td><?= htmlspecialchars($pessoa['nome']); ?></td>
                        <td><?= date('d/m/Y', strtotime($pessoa['data_nascimento'])); ?></td>
                        <td><?= htmlspecialchars($pessoa['cpf']); ?></td>
                        <td><?= htmlspecialchars($pessoa['sexo']); ?></td>
                        <td><?= htmlspecialchars($pessoa['telefone']); ?></td>
                        <td><?= htmlspecialchars($pessoa['email']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p class="text-center text-danger">Nenhuma pessoa cadastrada.</p>
    <?php endif; ?>
</div>

<!-- Bootstrap 5 JS and Popper.js -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz4fnFO9gybT9Bv5d2zQugGVlz5g3Be0BZ9O4SoF3t4eVxgxNlg30p8bFz" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-pzjw8f+ua7Kw1TIq0v8FqW4zEykvKNQzeE7vtnzv0J7U69bJzF6g25tH8JdF0bFz" crossorigin="anonymous"></script>

</body>
</html>
