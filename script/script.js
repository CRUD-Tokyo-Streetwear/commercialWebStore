// Função para exibir a caixa de diálogo
function exibirCaixaDeDialogo() {
    let caixaDialogo = document.querySelector('.alert');

    setTimeout(function () {
        caixaDialogo.style.display = 'none';
    }, 2000);
}

exibirCaixaDeDialogo();

//Atualiza a pág com o parâmetro passado em milimêtros
function attPag(timeToAtt) {
    setTimeout(function () { window.location.href = "cadastroProdutos.php"; }, timeToAtt);
}

function lineuAppear() {
    const svgEasterEgg = document.querySelector('#easter-egg');
    const lineu = document.querySelector('#lineu');
    var count = 0;
    var audio = new Audio("../audio/toastyAudio.mp3");

    svgEasterEgg.addEventListener("click", function () {
        count++;
        console.log(count);

        if (count == 10) {
            lineu.style.right = '-10px';
            lineu.style.bottom = '-5px';
            lineu.style.transition = 'right .5s ease-in-out, bottom .5s ease-in-out';
            audio.play();

            // Adiciona a classe 'retrair' após 1 segundo
            setTimeout(function () {
                lineu.style.right = '-240px';
                lineu.style.bottom = '-210px';

                // Reinicia o processo após 2 segundos
                setTimeout(lineuAppear, 2000);
            }, 2000);
        }
    });
}

lineuAppear();