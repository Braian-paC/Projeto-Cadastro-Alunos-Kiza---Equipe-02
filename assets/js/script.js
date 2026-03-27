// ---> FUNÇÕES DE FORMATAÇÃO 
const formatCPF = (value) => { 
    
    value = value.replace(/\D/g, ''); //Procura tudo que não é número e remove, ou seja, o usuário só pode escrever letras mas elas serão cortadas
    
    if (value.length > 9) {
        return value.replace(/(\d{3})(\d{3})(\d{3})(\d{1,2})/, '$1.$2.$3-$4'); // Separa em 4 blocos e monta o formato final: xxx.xxx.xxx-XX
    } else if (value.length > 6) {
        return value.replace(/(\d{3})(\d{3})(\d{1,3})/, '$1.$2.$3'); //Coloca o segundo . do cpf
    } else if (value.length > 3) {
        return value.replace(/(\d{3})(\d{1,3})/, '$1.$2'); //Coloca o primeiro . do cpf
    }
    
    return value; //Se ele digitou apenas 1,2 ou 3 numeros a funcao devolve o numero limpo, sem pontos
}

// ---> FUNÇÕES DE VALIDAÇÃO 
const validateCPF = (cpf) => { 
    cpf = cpf.replace(/\D/g, ''); //Deixa apenas numeros no codigo para garantir que nao havera letras/caracteres diferentes
    
    if (cpf.length !== 11) {
        return { valid: false, message: 'O CPF deve conter 11 dígitos.' }; // Se não tiver 11 numeros, retorna um objeto e solta a mensagem de erro
    }
    
    if (/^(\d)\1{10}$/.test(cpf)) { // Verifica se todos os numeros sao iguais, ex: 111.111.111-11
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
        return resto < 2 ? '0' : (11 - resto).toString();  //Logica dos 2 ultimos numeros do cpf 
    }
    
    const primeiroDigito = calcularDigito(cpf.substring(0, 9)); // Roda a conta nos 9 primeiros numero para achar o numero 10
    const segundoDigito = calcularDigito(cpf.substring(0, 9) + primeiroDigito); // Roda a conta nos 10 primeiros numero para achar o numero 11
    const cpfCorreto = cpf.substring(0, 9) + primeiroDigito + segundoDigito; //Monta como realmente deveria ser o cpf
    
    if (cpf !== cpfCorreto) { 
        return { valid: false, message: 'CPF inválido. Dígitos verificadores incorretos.' };
    }
    
    return { valid: true, message: 'CPF válido!' };
}

const validateEmail = (email) => {
    return /^[^\s@]+@[^\s@]+\.[a-zA-Z]{2,}$/.test(email); // Confere se tem @, 1 ponto e pelo menos 2 letras no fim
};

const validateNome = (nome) => {
    return nome.trim().length >= 3; //Remove espaços inuteis e checa se o nome tem pelo menos 3 letras
};

const validateSenha = (senha) => { 
return senha.length >= 8; //Checa se a senha tem pelo menos 8 caracteres
};

// ---> FUNÇÕES DE FEEDBACK   
const setError = (errorId, inputId, message) => {
    const errorEl = document.getElementById(errorId);
    const inputEl = document.getElementById(inputId);
    
    if (!errorEl) {
        console.warn(`⚠️ Elemento de erro não encontrado: ${errorId}`); //Se nao tiver conectado no html vai gerar esse erro para o site nao quebrar
        return;
    }
    
    errorEl.textContent = message;
    
    
    if (inputEl) { // Diz ao usuario que o campo esta com os dados errados
        inputEl.setAttribute('aria-invalid', message ? 'true' : 'false');
    }
};

const setInputState = (input, valid) => {
    if (!input) return;
    
    input.classList.toggle('invalid', !valid); //Se valid for falso ele adiciona a classe css .invalid se for verdadeiro ele remove
    input.classList.toggle('valid', valid); //O contrario do de cima
};

const clearAllStates = () => {
    const inputs = [inputCPF, inputNome, inputSenha, inputConfirmSenha, inputEmail];
    inputs.forEach(input => {
        if (input) {
            input.classList.remove('valid', 'invalid'); //Remove as cores de erro e sucesso. O campo volta ao estado visual neutro
            input.setAttribute('aria-invalid', 'false'); //Reseta o estado de acessibilidade dizendo que o campo nao e mais invalido
        }
    });
    
    
    ['nomeError', 'cpfError', 'emailError', 'senhaError', 'confirmSenhaError', 'termosError'].forEach(id => {
        const el = document.getElementById(id);
        if (el) el.textContent = '';
    });
};

// ---> ELEMENTOS DO DOM 
const registerForm = document.getElementById('registerForm');                      // Chama a parte de html 
const inputCPF = document.getElementById('cpf');
const inputNome = document.getElementById('nome');
const inputSenha = document.getElementById('senha');
const inputConfirmSenha = document.getElementById('confirm_senha');
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
    registerForm.addEventListener('submit', (event) => { 
        event.preventDefault(); //Sem isso, não conseguiriamos ver os erros e validação porque a página daria um refresh

        let valid = true; 


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
            setError('confirmSenhaError', 'confirm_senha', 'As senhas não conferem.');
            setInputState(inputConfirmSenha, false);
            valid = false;
        } else {
            setError('confirmSenhaError', 'confirm_senha', '');
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

            //Mostra o modal que eu fiz no registro.php
            const modal = document.getElementById('modalSucesso');
            modal.style.display = 'flex';
            
            //Quando o botao de OK for clicado envia o formulario para o php
            const btnFechar = document.getElementById('fecharModal');
            btnFechar.onclick = () => {
                modal.style.display = 'none';
                registerForm.submit(); //ENvio de formulario
            }
        } else {
            console.warn('❌ Formulário contém erros. Corrija antes de enviar.');
        }
    });
}

//Modal dos termos
const modalTermos = document.getElementById('modalTermos');
const abrirTermos = document.getElementById('abrirTermos');
const fecharTermos = document.getElementById('fecharModalTermos');

if (abrirTermos) {
    abrirTermos.addEventListener('click', (e) => {
        e.preventDefault();
        modalTermos.style.display= 'flex';
    });
};

if (fecharTermos) {
    fecharTermos.addEventListener('click', () =>{
        modalTermos.style.display = 'none';
    });
};

//Fechar modal ao vlicar fora do conteudo
window.addEventListener('click', (e) => {
    if (e.target === modalTermos) {
        modalTermos.style.display = 'none';
    }
});