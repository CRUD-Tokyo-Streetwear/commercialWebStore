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


function habilitaEditarCategoria(){

// Recebe os elementos HTML dos td's da tabela
const categoriaNome = document.querySelector('#categoria_nome');
const categoriaDesc = document.querySelector('#categoria_desc');

//Pega o conteúdo de texto de dentro do td
const categoriaNomeText = categoriaNome.innerText;
const categoriaDescText = categoriaDesc.innerText;

//Recebe o nome de tag do primeiro filho
const tagHTML = categoriaNome.firstChild.tagName;


if (tagHTML === 'P') {
    categoriaNome.innerHTML = `<input type="text" class="form-control" name="editCategoriaNome" value="${categoriaNomeText}">`;
    categoriaDesc.innerHTML = `<input type="text" class="form-control" name="editCategoriaDesc"  value="${categoriaDescText}">`;
} else {
    categoriaNome.innerHTML = `<p>${categoriaNomeText}</p>`;
    categoriaDesc.innerHTML = `<p>${categoriaDescText}</p>`;
}

}


//Atualiza a pág com o parâmetro passado em milimêtros
function attPag(timeToAtt) {
    setTimeout(function () { window.location.href = "cadastroProdutos.php"; }, timeToAtt);
}