// Função para validar CPF
function validateCPF(cpf) {
    // Regex simples para validar CPF
    var regex = /^\d{11}$/;
    return regex.test(cpf);
}

// Função para validar a data de nascimento
function validateBirthdate(birthdate) {
    var today = new Date();
    var birth = new Date(birthdate);
    return birth < today;
}

// Função para validar os campos obrigatórios
function validateRequired(fields) {
    var errors = [];
    fields.forEach(function(field) {
        if (field.value.trim() === "") {
            errors.push(field.name + " é obrigatório.");
        }
    });
    return errors;
}

// Função para validar o formulário de cadastro de pessoa
function validatePersonForm() {
    var name = document.getElementById("name");
    var birthdate = document.getElementById("birthdate");
    var cpf = document.getElementById("cpf");

    // Validar campos obrigatórios
    var requiredFields = [name, birthdate, cpf];
    var errors = validateRequired(requiredFields);

    // Validar CPF
    if (!validateCPF(cpf.value)) {
        errors.push("CPF inválido.");
    }

    // Validar data de nascimento
    if (!validateBirthdate(birthdate.value)) {
        errors.push("Data de nascimento inválida.");
    }

    return errors;
}
