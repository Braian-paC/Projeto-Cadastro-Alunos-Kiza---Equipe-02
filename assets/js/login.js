const formulario = document.getElementById('formLogin')
const spanSenhaErro = document.getElementById('erro-senha')
const spanEmailErro = document.getElementById('email-error')

formulario.addEventListener('submit', async (e) => {
    e.preventDefault();

    spanSenhaErro.innerText = "";
    spanEmailErro.innerText = "";

    const dados = new FormData(formulario);

    const resposta = await fetch('../../services/loginService.php', {
        method: 'POST',
        body: dados
    });

    const resultado = await resposta.json();
    console.log(resultado);
    console.log();

    if(resultado.success) {
        window.location.href = '../../pages/home.php';
    } else {
            spanSenhaErro.innerText = resultado.message;
    };
});
