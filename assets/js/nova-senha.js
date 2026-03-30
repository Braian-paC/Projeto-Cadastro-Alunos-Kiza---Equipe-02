const form = document.getElementById('formNovaSenha');
const senhaInput = document.getElementById('senha');
const confirmarInput = document.getElementById('confirmarSenha');
const senhaError = document.getElementById('senhaError');
const confirmarError = document.getElementById('confirmarError');
const btnAlterar = form.querySelector('button[type="submit"]');

form.addEventListener('submit', async (e) => {
    e.preventDefault();

    //Limpa erross
    senhaError.innerText = '';
    confirmarError.innerText = '';

    const senha = senhaInput.value;
    const confirmar = confirmarInput.value;
    
    //Valida senha
    if (!senha) {
        senhaError.innerText = 'Digite a nova senha.';
        return;
    };

    if (senha.length < 8) {
        senhaError.innerText = 'A senha deve ter pelo menos 8 caracteres.';
        return;
    };

    //Valida confirmação
    if (!confirmar) {
        confirmarError.innerText = 'Confirme a nova senha.';
        return;
    };

    if (senha !== confirmar) {
        confirmarError.innerText = 'As senhas não conferem.';
        return;
    };

    //Feedback de carregamento
    const textoOriginal = btnAlterar.innerText;
    btnAlterar.innerText = 'Alterando...';
    btnAlterar.disabled = true;

    //Envia para o PHP
    const dados = new FormData();
    dados.append('senha', senha);

    try {
        const resposta = await fetch('../../services/alterar-senha.php', {
            method: 'POST',
            body: dados
        });

        const resultado = await resposta.json();

        if (resultado.success) {
            alert('Senha alterada com sucesso!');
            window.location.href = 'login.php';
        } else {
            senhaError.innerText = resultado.message;
        }
    } catch (erro) {
        console.error('Erro na requisição', erro);
        senhaError.innerText = 'Erro de conexão. Tente novamente.';
    } finally {
        btnAlterar.innerText = textoOriginal;
        btnAlterar.disabled = false;
    };


});