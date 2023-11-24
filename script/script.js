// Função para exibir a caixa de diálogo
function exibirCaixaDeDialogo() {
    let caixaDialogo = document.querySelector('.alert');

    setTimeout(function () {
        caixaDialogo.style.display = 'none';
    }, 2000);
}

exibirCaixaDeDialogo();

// Adiciona um novo campo de imagem URL.
function adicionarInputUrl() {
    const containerImagens = document.getElementById('containerImagens');
    const novoInput = document.createElement('input');
    novoInput.type = 'text';
    novoInput.name = 'imagem_url';
    novoInput.className = 'form-control';
    
    containerImagens.appendChild(novoInput);
}