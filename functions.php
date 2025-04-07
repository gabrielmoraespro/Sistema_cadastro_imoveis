<?php
// Função para validar campos obrigatórios
function validate_required($field, $value) {
    if (empty(trim($value))) {
        return "O campo $field é obrigatório.";
    }
    return null;
}

// Função para validar CPF
function validate_cpf($cpf) {
    // Remove caracteres não numéricos
    $cpf = preg_replace('/\D/', '', $cpf);

    // Verifica se o CPF tem 11 dígitos
    if (strlen($cpf) != 11 || preg_match('/(\d)\1{10}/', $cpf)) {
        return "CPF inválido.";
    }

    // Valida os dígitos verificadores
    for ($t = 9; $t < 11; $t++) {
        for ($d = 0, $c = 0; $c < $t; $c++) {
            $d += $cpf[$c] * (($t + 1) - $c);
        }
        $d = ((10 * $d) % 11) % 10;
        if ($cpf[$c] != $d) {
            return "CPF inválido.";
        }
    }

    return null;
}

// Função para validar a data de nascimento
function validate_birthdate($birthdate) {
    // Verifica se a data é válida
    if (strtotime($birthdate) === false) {
        return "Data de nascimento inválida.";
    }

    // Verifica se a data está no passado
    $birthdate_timestamp = strtotime($birthdate);
    if ($birthdate_timestamp > time()) {
        return "A data de nascimento não pode estar no futuro.";
    }

    // Verifica se a pessoa tem pelo menos 18 anos
    $age = date_diff(date_create($birthdate), date_create('today'))->y;
    if ($age < 18) {
        return "É necessário ter pelo menos 18 anos.";
    }

    return null;
}

// Função para validar e-mail
function validate_email($email) {
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return "E-mail inválido.";
    }
    return null;
}

// Função para validar senha
function validate_password($password) {
    if (strlen($password) < 8) {
        return "A senha deve ter pelo menos 8 caracteres.";
    }
    if (!preg_match('/[A-Z]/', $password)) {
        return "A senha deve conter pelo menos uma letra maiúscula.";
    }
    if (!preg_match('/[a-z]/', $password)) {
        return "A senha deve conter pelo menos uma letra minúscula.";
    }
    if (!preg_match('/[0-9]/', $password)) {
        return "A senha deve conter pelo menos um número.";
    }
    if (!preg_match('/[\W]/', $password)) {
        return "A senha deve conter pelo menos um caractere especial.";
    }
    return null;
}
?>
