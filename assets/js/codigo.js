const form = document.getElementById('formCodigo');
const codigoInput = document.getElementById('codigo');
const codigoError = document.getElementById('codigoError');
const btnConfirmar = form.querySelector('button[type="submit"]');

form.addEventListener('submit', async(e) => {
    e.preventDefault();

    codigoError.innerText = ''; //Limpa erro anterior

    const codigo = codigoInput.value.trim();

    if(!codigo) {
        codigoError.innerText = 'Digite o código.';
        return;
    };

    if(codigo.length !== 6) {
        codigoError.innerText = 'O código deve ter 6 dígitos.';
        return;
    };

    if(isNaN(codigo)) {
        codigoError.innerText = 'O código deve conter apenas números.'
        return;
    };

    //Feedback de carregamento
    const textoOriginal = btnConfirmar.innerText;
    btnConfirmar.innerText = 'Verificando...';
    btnConfirmar.disabled = true;

    //Enviando dados para o PHP
    const dados = new FormData();
    dados.append('codigo', codigo);

    try {
        const resposta = await fetch('../../services/validar-codigo.php', {
            method: "POST",
            body: dados
        });

        const resultado = await resposta.json()

        if(resultado.success) {
            window.location.href = 'novaSenha.php'; //Código valido, leva o usuario para a página de nova senha
        } else {
            codigoError.innerText = resultado.message;
        }

    } catch (erro) {
        console.error('Erro na requisição:', erro)
        codigoError.innerText = 'Erro de conexão. Tente novamente.';
    } finally {
        btnConfirmar.innerText = textoOriginal;
        btnConfirmar.disabled = false;
    }
});