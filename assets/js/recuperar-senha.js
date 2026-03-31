const form = document.getElementById('formRecuperarSenha');
const emailError = document.getElementById('emailError');
const modal = document.getElementById('modalCodigoEnviado');
const btnFechar = document.getElementById('fecharModalCodigo');
const btnEnviar = form.querySelector('button[type="submit"]');

// Função de validação de email
const validateEmail = (email) => {
    return /^[^\s@]+@[^\s@]+\.[a-zA-Z]{2,}$/.test(email);
};

form.addEventListener('submit', async (e) => {
    e.preventDefault();

    // Limpa erro anterior
    emailError.innerText = '';

    const email = document.getElementById('email').value;

    // Validação
    if (!email.trim()) {
        emailError.innerText = 'Digite seu email.';
        return;
    }

    if (!validateEmail(email)) {
        emailError.innerText = 'E-mail inválido.';
        return;
    }

    // Mostrar feedback de carregamento
    const textoOriginal = btnEnviar.innerText;
    btnEnviar.innerText = '📧 Enviando...';
    btnEnviar.disabled = true;

    // Envia para o PHP
    const dados = new FormData(form);

    try {
        const resposta = await fetch('../../services/envia_email_recuperacao.php', {
            method: 'POST',
            body: dados
        });

        const resultado = await resposta.json();

        if (resultado.success) {
            // Mostra modal de sucesso
            modal.style.display = 'flex';
        } else {
            // Mostra erro no span
            emailError.innerText = resultado.message;
        }
    } catch (erro) {
        console.error('Erro na requisição:', erro);
        emailError.innerText = 'Erro de conexão. Tente novamente.';
    } finally {
        // Restaura o botão
        btnEnviar.innerText = textoOriginal;
        btnEnviar.disabled = false;
    }
});

// Fechar modal e levar usuário para página de código
if (btnFechar) {
    btnFechar.onclick = () => {
        modal.style.display = 'none';
        window.location.href = 'codigo.php';
    };
}

// Fechar modal ao clicar fora
window.addEventListener('click', (e) => {
    if (e.target === modal) {
        modal.style.display = 'none';
        window.location.href = 'codigo.php';
    }
});