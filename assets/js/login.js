const formulario = document.getElementById('formLogin')
const spanErro = document.getElementById('erro-senha')

formulario.addEventListener('submit', async (e) => {
    e.preventDefault();

    spanErro.innerText = "";

    const dados = new FormData(formulario);

    const resposta = await fetch('login.php', {
        method: 'POST',
        body: dados
    });

    const resultado = await resposta.json();

    if(resultado.success) {
        window.location.href = 'home.php';
    } else {
        spanErro.innerText = resultado.message;
    };

});