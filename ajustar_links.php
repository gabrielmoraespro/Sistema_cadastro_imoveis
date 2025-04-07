<?php

$dir = __DIR__ . "/app"; // Pasta onde os arquivos PHP foram movidos

function atualizarCaminhos($arquivo) {
    $conteudo = file_get_contents($arquivo);

    // Ajustar includes e requires
    $conteudo = preg_replace('/(include|require)(_once)?\s*[\'"](config.php|conexao.php|index.php)[\'"]/', '$1$2 \'../app/$3\'', $conteudo);

    // Ajustar redirecionamentos
    $conteudo = preg_replace('/header\s*\(\s*"Location:\s*(.*?)\.php"\s*\)/', 'header("Location: ../app/$1.php")', $conteudo);

    file_put_contents($arquivo, $conteudo);
    echo "Atualizado: $arquivo\n";
}

function percorrerArquivos($dir) {
    $arquivos = scandir($dir);

    foreach ($arquivos as $arquivo) {
        if ($arquivo == '.' || $arquivo == '..') continue;

        $caminhoCompleto = "$dir/$arquivo";

        if (is_file($caminhoCompleto) && pathinfo($arquivo, PATHINFO_EXTENSION) == 'php') {
            atualizarCaminhos($caminhoCompleto);
        } elseif (is_dir($caminhoCompleto)) {
            percorrerArquivos($caminhoCompleto); // Recursão para subpastas
        }
    }
}

percorrerArquivos($dir);
echo "Ajuste dos links concluído!\n";

?>
