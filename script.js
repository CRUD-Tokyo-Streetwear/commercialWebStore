// Função para exibir a caixa de diálogo
function exibirCaixaDeDialogo() {
    let caixaDialogo = document.querySelector('.alert');

    setTimeout(function() {
        caixaDialogo.style.display = 'none';
    }, 2000); 
}

exibirCaixaDeDialogo();
