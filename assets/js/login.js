const formulario = document.getElementById('formLogin')
const spanSenhaErro = document.getElementById('erro-senha')
const spanEmailErro = document.getElementById('email-error')

formulario.addEventListener('submit', async (e) => {
    e.preventDefault();

    spanSenhaErro.innerText = "";
    spanEmailErro.innerText = "";

    const dados = new FormData(formulario);

    const resposta = await fetch('/services/loginService.php', {
        method: 'POST',
        body: dados
    });

    const texto = await resposta.text();
    console.log('Resposta bruta:', resposta.status, resposta.headers.get('content-type'), texto);

    let resultado;
    try {
        resultado = JSON.parse(texto);
    } catch (err) {
        spanSenhaErro.innerText = 'Erro no servidor: resposta inválida.';
        console.error('Falha ao parsear JSON:', err, texto);
        return;
    }

    if (!resposta.ok) {
        spanSenhaErro.innerText = resultado.message || 'Erro HTTP ' + resposta.status;
        return;
    }

    if (resultado.success) {
        window.location.href = '../../pages/home.php';
    } else {
        spanSenhaErro.innerText = resultado.message;
    };
});
