<?php
// Função para validar campos obrigatórios
function validate_required($field, $value) {
    if (empty($value)) {
        return "O campo $field é obrigatório.";
    }
    return "";
}

// Função para validar CPF
function validate_cpf($cpf) {
    // Lógica simples para validar CPF (pode ser aprimorada)
    if (strlen($cpf) != 11) {
        return "CPF inválido.";
    }
    return "";
}

// Função para validar a data de nascimento
function validate_birthdate($birthdate) {
    // Lógica para validar se a data de nascimento é uma data válida
    if (strtotime($birthdate) === false) {
        return "Data de nascimento inválida.";
    }
    return "";
}
?>
