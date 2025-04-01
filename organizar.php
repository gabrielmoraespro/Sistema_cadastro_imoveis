<?php

$baseDir = __DIR__;

// Definir diretórios para organizar
$pastasFixas = ['cadastros', 'consultas', 'css', 'editar', 'excluir', 'images', 'includes', 'js'];
$diretoriosCriar = [
    'app',           // Para arquivos PHP que estão soltos na raiz
    'public',        // Pasta pública
    'public/images'  // Para armazenar imagens
];

// Criar diretórios se não existirem
foreach ($diretoriosCriar as $dir) {
    if (!is_dir("$baseDir/$dir")) {
        mkdir("$baseDir/$dir", 0777, true);
        echo "Criado: $dir\n";
    }
}

// Organizar arquivos da raiz
$arquivos = scandir($baseDir);

foreach ($arquivos as $arquivo) {
    if ($arquivo == '.' || $arquivo == '..' || $arquivo == 'organizar.php') continue;

    $caminhoCompleto = "$baseDir/$arquivo";
    
    if (is_file($caminhoCompleto)) {
        $extensao = pathinfo($arquivo, PATHINFO_EXTENSION);

        if ($extensao == 'php') {
            rename($caminhoCompleto, "$baseDir/app/$arquivo");
            echo "Movido: $arquivo → app/\n";
        } elseif (in_array($extensao, ['jpg', 'jpeg', 'png', 'gif'])) {
            rename($caminhoCompleto, "$baseDir/public/images/$arquivo");
            echo "Movido: $arquivo → public/images/\n";
        }
    }
}

echo "Organização concluída!\n";

?>
