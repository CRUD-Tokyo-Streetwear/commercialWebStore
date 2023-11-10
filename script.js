// Função para exibir a caixa de diálogo
function exibirCaixaDeDialogo() {
    let caixaDialogo = document.querySelector('.alert');

    setTimeout(function() {
        caixaDialogo.style.display = 'none';
    }, 2000); 
}

exibirCaixaDeDialogo();




const myModal = document.getElementById('myModal')
const myInput = document.getElementById('myInput')

myModal.addEventListener('shown.bs.modal', () => {
  myInput.focus()
})