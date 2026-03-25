// ---> FUNÇÕES DE FORMATAÇÃO | Ainda precisa ser ligada com o Html
const formatCPF = (value) => { // função chamada formatCPF comque recebe um texto (value) como entrada

    value = value.replace(/\D/g, ''); //Procura tudo que não é número e remove, ou seja, o usuário só pode escrever letras mas elas serão cortadas
    value = value.substring(0, 11); //Assume que o VALUE ja é string e corta ele para ter no maximo 11 caracteres 
    //=> Mascaras:
    if (value.length > 9) {
        return value.replace(/(\d{3})(\d{3})(\d{3})(\d{1,2})/, '$1.$2.$3-$4'); // Separa em 4 blocos e monta o formato final: xxx.xxx.xxx-XX
    } else if (value.length > 6) {
        return value.replace(/(\d{3})(\d{3})(\d{1,3})/, '$1.$2.$3'); //Coloca o segundo . do cpf
    } else if (value.length > 3) {
        return value.replace(/(\d{3})(\d{1,3})/, '$1.$2'); //Coloca o primeiro ponto do cpf
    }
    
    return value; //Se ele digitou apenas 1,2 ou 3 numeros a funcao devolve o numero limpo, sem pontos
}

// ---> FUNÇÕES DE VALIDAÇÃO 
const validateCPF = (cpf) => {
    cpf = cpf.replace(/\D/g, '');
    
    if (cpf.length !== 11) {
        return { valid: false, message: 'O CPF deve conter 11 dígitos.' };
    }
    
    if (/^(\d)\1{10}$/.test(cpf)) {
        return { valid: false, message: 'CPF inválido. Dígitos não podem ser todos iguais.' };
    }
    
    const calcularDigito = (cpfParcial) => {
        let soma = 0;
        const tamanho = cpfParcial.length;
        
        for (let i = 0; i < tamanho; i++) {
            const digito = parseInt(cpfParcial.charAt(i));
            const peso = (tamanho + 1 - i);
            soma += digito * peso;
        }
        
        const resto = soma % 11;
        return resto < 2 ? '0' : (11 - resto).toString();
    }
    
    const primeiroDigito = calcularDigito(cpf.substring(0, 9));
    const segundoDigito = calcularDigito(cpf.substring(0, 9) + primeiroDigito);
    const cpfCorreto = cpf.substring(0, 9) + primeiroDigito + segundoDigito;
    
    if (cpf !== cpfCorreto) {
        return { valid: false, message: 'CPF inválido. Dígitos verificadores incorretos.' };
    }
    
    return { valid: true, message: 'CPF válido!' };
}

const validateEmail = (email) => {
    // Exige domínio com pelo menos 2 letras
    return /^[^\s@]+@[^\s@]+\.[a-zA-Z]{2,}$/.test(email);
};

const validateNome = (nome) => {
    return nome.trim().length >= 3;
};

const validateSenha = (senha) => {
    return senha.length >= 8;
};

// ---> FUNÇÕES DE FEEDBACK   
const setError = (errorId, inputId, message) => {
    const errorEl = document.getElementById(errorId);
    const inputEl = document.getElementById(inputId);
    
    if (!errorEl) {
        console.warn(`⚠️ Elemento de erro não encontrado: ${errorId}`);
        return;
    }
    
    errorEl.textContent = message;
    
    // Atualiza aria-invalid para acessibilidade
    if (inputEl) {
        inputEl.setAttribute('aria-invalid', message ? 'true' : 'false');
    }
};

const setInputState = (input, valid) => {
    if (!input) return;
    
    input.classList.toggle('invalid', !valid);
    input.classList.toggle('valid', valid);
};

const clearAllStates = () => {
    const inputs = [inputCPF, inputNome, inputSenha, inputConfirmSenha, inputEmail];
    inputs.forEach(input => {
        if (input) {
            input.classList.remove('valid', 'invalid');
            input.setAttribute('aria-invalid', 'false');
        }
    });
    
    // Limpa mensagens de erro
    ['nomeError', 'cpfError', 'emailError', 'senhaError', 'confirmSenhaError', 'termosError'].forEach(id => {
        const el = document.getElementById(id);
        if (el) el.textContent = '';
    });
};

// ---> ELEMENTOS DO DOM 
const registerForm = document.getElementById('registerForm');
const inputCPF = document.getElementById('cpf');
const inputNome = document.getElementById('nome');
const inputSenha = document.getElementById('senha');
const inputConfirmSenha = document.getElementById('confirmSenha');
const inputEmail = document.getElementById('email');
const inputTermos = document.getElementById('termos');

// ---> VERIFICAÇÃO DE SEGURANÇA 
if (!registerForm || !inputCPF || !inputNome || !inputSenha || !inputConfirmSenha || !inputEmail || !inputTermos) {
    console.error('❌ ERRO CRÍTICO: Elementos do formulário não encontrados!');
    console.error('Verifique se os IDs no HTML estão corretos:', {
        registerForm: !!registerForm,
        inputCPF: !!inputCPF,
        inputNome: !!inputNome,
        inputSenha: !!inputSenha,
        inputConfirmSenha: !!inputConfirmSenha,
        inputEmail: !!inputEmail,
        inputTermos: !!inputTermos
    });
} else {
    // ---> FORMATAÇÃO AUTOMÁTICA DO CPF 
    inputCPF.addEventListener('keypress', (event) => {
        if (!/\d/.test(event.key)) {
            event.preventDefault();
        }
    });

    inputCPF.addEventListener('input', (event) => {
        event.target.value = formatCPF(event.target.value);
        
        const digitosApenas = event.target.value.replace(/\D/g, '');
        if (digitosApenas.length < 11) {
            setError('cpfError', 'cpf', '');
            setInputState(inputCPF, true);
        }
    });

    inputCPF.addEventListener('blur', () => {
        const value = inputCPF.value;
        const digitosApenas = value.replace(/\D/g, '');
        
        if (digitosApenas.length > 0 && digitosApenas.length !== 11) {
            setError('cpfError', 'cpf', 'O CPF deve conter 11 dígitos.');
            setInputState(inputCPF, false);
        }
    });

    inputCPF.addEventListener('focus', () => {
        if (inputCPF.value === '') {
            setError('cpfError', 'cpf', '');
            setInputState(inputCPF, true);
        }
    });

    // ---> Validação do registro completo
    registerForm.addEventListener('submit', (event) => { //O atributo do botao no html tem quer ser submit tbm
        event.preventDefault(); //Sem isso, não conseguiriamos ver os erros e validação porque a página daria um refresh

        let valid = true; //Flag inicial


        // =>O padrão de validação  é bem repetitivo para cada campo 

        // Validação do Nome
        if (!validateNome(inputNome.value)) {
            setError('nomeError', 'nome', 'Nome deve ter pelo menos 3 caracteres.');
            setInputState(inputNome, false);
            valid = false;
        } else {
            setError('nomeError', 'nome', '');
            setInputState(inputNome, true);
        }

        // Validação do CPF
        const cpfResult = validateCPF(inputCPF.value);
        if (!cpfResult.valid) {
            setError('cpfError', 'cpf', cpfResult.message);
            setInputState(inputCPF, false);
            valid = false;
        } else {
            setError('cpfError', 'cpf', '');
            setInputState(inputCPF, true);
        }

        // Validação do Email
        if (!validateEmail(inputEmail.value)) {
            setError('emailError', 'email', 'E-mail inválido.');
            setInputState(inputEmail, false);
            valid = false;
        } else {
            setError('emailError', 'email', '');
            setInputState(inputEmail, true);
        }

        // Validação da Senha
        if (!validateSenha(inputSenha.value)) {
            setError('senhaError', 'senha', 'Senha deve ter ao menos 8 caracteres.');
            setInputState(inputSenha, false);
            valid = false;
        } else {
            setError('senhaError', 'senha', '');
            setInputState(inputSenha, true);
        }

        // Validação de Confirmar Senha
        if (inputConfirmSenha.value !== inputSenha.value || inputConfirmSenha.value === '') {
            setError('confirmSenhaError', 'confirmSenha', 'As senhas não conferem.');
            setInputState(inputConfirmSenha, false);
            valid = false;
        } else {
            setError('confirmSenhaError', 'confirmSenha', '');
            setInputState(inputConfirmSenha, true);
        }

        // Validação dos Termos
        if (!inputTermos.checked) {
            setError('termosError', 'termos', 'Você precisa aceitar os termos.');
            valid = false;
        } else {
            setError('termosError', 'termos', '');
        }

        // Se tudo válido(email, cpf, senha), envia
        if (valid) {
            console.log('✅ Formulário válido! Dados:', {
                nome: inputNome.value,
                cpf: inputCPF.value,
                email: inputEmail.value,
                senha: '[PROTEGIDO]'
            });
            alert('Cadastro realizado com sucesso!');
            registerForm.reset();
            clearAllStates();
        } else {
            console.warn('❌ Formulário contém erros. Corrija antes de enviar.');
        }
    });
}
